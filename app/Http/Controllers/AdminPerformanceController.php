<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyClosing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminPerformanceController extends Controller
{
    public function index(Request $request)
    {
        $preset = $request->input('date_preset', 'today');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $employeeId = $request->input('employee_id');

        [$startDate, $endDate] = $this->resolveDateRange($preset, $start, $end);

        $query = DailyClosing::with('user')->whereBetween('date', [$startDate, $endDate]);

        if ($employeeId) {
            $query->where('user_id', $employeeId);
        }

        // Aggregate counts
        $walkins = (clone $query)->whereIn('closing_type', ['Walk-in', 'walk_in'])->sum('count');
        $registrations = (clone $query)->whereIn('closing_type', ['Registration', 'Registered'])->sum('count');
        $admissions = (clone $query)->whereIn('closing_type', ['Admission', 'Admitted'])->sum('count');
        $payments = (clone $query)->where('closing_type', 'Full Payment')->sum('count');

        // Records for the table
        $rawRecords = $query->orderBy('date', 'desc')->get();
        $records = $this->groupRecords($rawRecords);

        // Get employees for dropdown
        $employees = User::whereDoesntHave('roles', function($q) {
            $q->whereIn('name', ['Super Admin', 'Sales Head (HOD)']);
        })->get();

        return view('admin.performance.index', compact(
            'preset', 'start', 'end', 'employeeId', 'startDate', 'endDate',
            'walkins', 'registrations', 'admissions', 'payments',
            'records', 'employees'
        ));
    }

    public function export(Request $request)
    {
        $preset = $request->input('date_preset', 'today');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $employeeId = $request->input('employee_id');

        [$startDate, $endDate] = $this->resolveDateRange($preset, $start, $end);

        $query = DailyClosing::with('user')->whereBetween('date', [$startDate, $endDate]);

        if ($employeeId) {
            $query->where('user_id', $employeeId);
        }

        // Aggregate counts
        $walkins = (clone $query)->whereIn('closing_type', ['Walk-in', 'walk_in'])->sum('count');
        $registrations = (clone $query)->whereIn('closing_type', ['Registration', 'Registered'])->sum('count');
        $admissions = (clone $query)->whereIn('closing_type', ['Admission', 'Admitted'])->sum('count');
        $payments = (clone $query)->where('closing_type', 'Full Payment')->sum('count');

        $rawRecords = $query->orderBy('date', 'desc')->get();
        $records = $this->groupRecords($rawRecords);
        $report_title = "Performance Report";
        
        return view('admin.performance.print', compact(
            'preset', 'startDate', 'endDate', 'employeeId',
            'walkins', 'registrations', 'admissions', 'payments',
            'records', 'report_title'
        ));
    }

    protected function resolveDateRange(string $preset, ?string $start, ?string $end): array
    {
        switch ($preset) {
            case 'today':
                return [now()->startOfDay()->toDateTimeString(), now()->endOfDay()->toDateTimeString()];
            case 'weekly':
                return [now()->startOfWeek()->toDateTimeString(), now()->endOfWeek()->toDateTimeString()];
            case 'custom':
                if ($start && $end) {
                    return [$start . ' 00:00:00', $end . ' 23:59:59'];
                }
            case 'monthly':
            default:
                return [now()->startOfMonth()->toDateTimeString(), now()->endOfMonth()->toDateTimeString()];
        }
    }

    protected function groupRecords($rawRecords)
    {
        $grouped = [];
        foreach ($rawRecords as $record) {
            $date = \Carbon\Carbon::parse($record->date)->format('Y-m-d');
            $userId = $record->user_id;
            $key = $date . '_' . $userId;
            
            if (!isset($grouped[$key])) {
                $grouped[$key] = (object)[
                    'date' => $date,
                    'user' => $record->user,
                    'walkins' => 0,
                    'registrations' => 0,
                    'admissions' => 0,
                    'payments' => 0
                ];
            }
            
            $type = strtolower($record->closing_type);
            if (in_array($type, ['walk-in', 'walk_in'])) {
                $grouped[$key]->walkins += $record->count;
            } elseif (in_array($type, ['registration', 'registered'])) {
                $grouped[$key]->registrations += $record->count;
            } elseif (in_array($type, ['admission', 'admitted'])) {
                $grouped[$key]->admissions += $record->count;
            } elseif ($type == 'full payment') {
                $grouped[$key]->payments += $record->count;
            }
        }
        
        $filtered = array_filter($grouped, function($item) {
            return ($item->walkins > 0 || $item->registrations > 0 || $item->admissions > 0 || $item->payments > 0);
        });
        
        return array_values($filtered);
    }
}
