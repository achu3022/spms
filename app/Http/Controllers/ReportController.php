<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\LeadSource;
use App\Models\Enquiry;
use App\Models\Activity;
use App\Models\FollowUp;
use App\Models\User;
use App\Models\Team;
use App\Services\ExportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $exportService;

    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    public function index()
    {
        $branches = Branch::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        $leadSources = LeadSource::where('status', 'active')->get();
        $user = auth()->user();
        
        if ($user->hasRole(['Super Admin', 'Sales Head'])) {
            $employees = User::all();
            $teams = Team::all();
        } elseif ($user->hasRole('Team Leader')) {
            $userTeamId = $user->team ? $user->team->id : null;
            if ($userTeamId) {
                $employees = User::whereHas('teams', function($q) use ($userTeamId) {
                    $q->where('teams.id', $userTeamId);
                })->get();
                $teams = Team::where('id', $userTeamId)->get();
            } else {
                $employees = User::where('id', $user->id)->get();
                $teams = collect();
            }
        } else {
            $employees = User::where('id', $user->id)->get();
            $teams = collect();
        }

        return view('reports.index', compact('branches', 'courses', 'leadSources', 'employees', 'teams'));
    }

    public function generate(Request $request)
    {
        $type = $request->input('report_type');
        $preset = $request->input('date_preset', 'month');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $exportFormat = $request->input('export_format'); // excel, pdf, print

        // Compile query date filter range
        [$startDate, $endDate] = $this->resolveDateRange($preset, $start, $end);

        // Fetch additional filters
        $branchId = $request->input('branch_id');
        $courseId = $request->input('course_id');
        $leadSourceId = $request->input('lead_source_id');
        $user = auth()->user();
        $employeeId = $request->input('employee_id');
        $teamId = $request->input('team_id');

        // Enforce RBAC restrictions
        if (!$user->hasRole(['Super Admin', 'Sales Head'])) {
            if ($user->hasRole('Team Leader')) {
                $userTeamId = $user->team ? $user->team->id : null;
                $teamId = $userTeamId; // Team leaders can only see their team
                
                if ($employeeId && $userTeamId) {
                    $requestedEmployee = User::find($employeeId);
                    $requestedEmployeeTeamId = $requestedEmployee && $requestedEmployee->team ? $requestedEmployee->team->id : null;
                    
                    if (!$requestedEmployee || $requestedEmployeeTeamId !== $userTeamId) {
                        $employeeId = $user->id; // Fallback if trying to query outside team
                    }
                } elseif (!$userTeamId) {
                    $employeeId = $user->id;
                }
            } else {
                // Regular employee can only see themselves
                $employeeId = $user->id;
                $teamId = null;
            }
        }

        $data = [];
        $viewName = 'reports.templates.enquiry'; // Fallback template

        switch ($type) {
            case 'enquiry':
                $viewName = 'reports.templates.enquiry';
                $query = Enquiry::with(['branch', 'course', 'leadSource', 'assignedEmployee', 'assignedTeam'])
                    ->whereBetween('created_at', [$startDate, $endDate]);
                
                if ($branchId) $query->where('branch_id', $branchId);
                if ($courseId) $query->where('course_id', $courseId);
                if ($leadSourceId) $query->where('lead_source_id', $leadSourceId);
                if ($employeeId) $query->where('assigned_employee_id', $employeeId);
                if ($teamId) $query->where('assigned_team_id', $teamId);
                
                $data['records'] = $query->get();
                $data['report_title'] = 'Enquiry Report';
                break;

            case 'admission':
                $viewName = 'reports.templates.admission';
                $query = Enquiry::with(['branch', 'course', 'assignedEmployee', 'payments'])
                    ->where('current_status', 'Admitted')
                    ->whereBetween('updated_at', [$startDate, $endDate]);
                
                if ($branchId) $query->where('branch_id', $branchId);
                if ($courseId) $query->where('course_id', $courseId);
                if ($employeeId) $query->where('assigned_employee_id', $employeeId);
                
                $data['records'] = $query->get();
                $data['report_title'] = 'Admission Report';
                break;

            case 'registration':
                $viewName = 'reports.templates.registration';
                $query = Enquiry::with(['branch', 'course', 'assignedEmployee'])
                    ->whereIn('current_status', ['Registered', 'Admitted', 'Full Payment'])
                    ->whereBetween('updated_at', [$startDate, $endDate]);

                if ($branchId) $query->where('branch_id', $branchId);
                if ($courseId) $query->where('course_id', $courseId);
                
                $data['records'] = $query->get();
                $data['report_title'] = 'Registration Report';
                break;

            case 'walkin':
                $viewName = 'reports.templates.walkin';
                $query = Enquiry::with(['branch', 'course', 'assignedEmployee'])
                    ->whereIn('current_status', ['Walk-in', 'Registered', 'Admitted', 'Full Payment'])
                    ->whereBetween('updated_at', [$startDate, $endDate]);

                if ($branchId) $query->where('branch_id', $branchId);
                
                $data['records'] = $query->get();
                $data['report_title'] = 'Walk-in Report';
                break;

            case 'employee':
                $viewName = 'reports.templates.employee';
                $query = User::with(['employeeProfile', 'teams'])
                    ->withCount(['enquiries' => function ($q) use ($startDate, $endDate) {
                        $q->whereBetween('created_at', [$startDate, $endDate]);
                    }]);
                
                if ($employeeId) {
                    $query->where('id', $employeeId);
                }
                
                $employees = $query->get();
                foreach ($employees as $emp) {
                    // Current month score for the filtered period
                    $emp->period_score = Activity::where('employee_id', $emp->id)
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->sum('score');
                }
                
                $data['records'] = $employees;
                $data['report_title'] = 'Employee Performance Report';
                break;

            case 'team':
                $viewName = 'reports.templates.team';
                $query = Team::with(['users']);
                if ($teamId) {
                    $query->where('id', $teamId);
                }
                
                $teams = $query->get();
                foreach ($teams as $team) {
                    $team->period_score = Activity::where('team_id', $team->id)
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->sum('score');
                    $team->enquiry_count = Enquiry::where('assigned_team_id', $team->id)
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->count();
                }
                
                $data['records'] = $teams;
                $data['report_title'] = 'Team Performance Report';
                break;

            case 'followup':
                $viewName = 'reports.templates.followup';
                $query = FollowUp::with(['enquiry', 'employee'])
                    ->whereBetween('follow_up_date', [date('Y-m-d', strtotime($startDate)), date('Y-m-d', strtotime($endDate))]);

                if ($employeeId) $query->where('employee_id', $employeeId);

                $data['records'] = $query->get();
                $data['report_title'] = 'Follow-up Report';
                break;

            case 'performance':
                $viewName = 'reports.templates.performance';
                // Scores logged during this time
                $data['records'] = Activity::with(['enquiry', 'employee', 'team'])
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('score', '>', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
                $data['report_title'] = 'Points Performance Log';
                break;

            case 'conversion':
                $viewName = 'reports.templates.conversion';
                // Conversion ratios by employee
                $employees = User::with(['employeeProfile'])->get();
                $conversionData = [];
                
                foreach ($employees as $emp) {
                    $total = Enquiry::where('assigned_employee_id', $emp->id)
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->count();
                        
                    $converted = Enquiry::where('assigned_employee_id', $emp->id)
                        ->whereIn('current_status', ['Admitted', 'Full Payment'])
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->count();
                        
                    $conversionData[] = (object)[
                        'employee_name' => $emp->name,
                        'employee_id' => $emp->employeeProfile?->employee_id ?? 'N/A',
                        'total_enquiries' => $total,
                        'converted_enquiries' => $converted,
                        'ratio' => $total > 0 ? round(($converted / $total) * 100, 2) : 0.00
                    ];
                }
                
                $data['records'] = collect($conversionData);
                $data['report_title'] = 'Conversion Analysis Report';
                break;
        }

        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        $data['preset'] = $preset;

        if ($exportFormat === 'excel') {
            return $this->exportService->exportToExcel($viewName, $data, \Illuminate\Support\Str::slug($data['report_title']) . '_' . date('Ymd'));
        } elseif ($exportFormat === 'pdf') {
            return $this->exportService->exportToPdf($viewName, $data, \Illuminate\Support\Str::slug($data['report_title']) . '_' . date('Ymd'), 'landscape');
        } elseif ($exportFormat === 'print') {
            return view($viewName . '_print', $data); // Renders layout clean for window.print()
        }

        return view('reports.view', compact('data', 'type', 'preset', 'start', 'end', 'viewName'));
    }

    protected function resolveDateRange(string $preset, ?string $start, ?string $end): array
    {
        switch ($preset) {
            case 'today':
                return [now()->startOfDay()->toDateTimeString(), now()->endOfDay()->toDateTimeString()];
            case 'yesterday':
                return [now()->subDay()->startOfDay()->toDateTimeString(), now()->subDay()->endOfDay()->toDateTimeString()];
            case 'week':
                return [now()->startOfWeek()->toDateTimeString(), now()->endOfWeek()->toDateTimeString()];
            case 'year':
                return [now()->startOfYear()->toDateTimeString(), now()->endOfYear()->toDateTimeString()];
            case 'custom':
                if ($start && $end) {
                    return [$start . ' 00:00:00', $end . ' 23:59:59'];
                }
            case 'month':
            default:
                return [now()->startOfMonth()->toDateTimeString(), now()->endOfMonth()->toDateTimeString()];
        }
    }
}
