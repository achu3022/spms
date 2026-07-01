<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use App\Models\Enquiry;
use App\Models\Activity;
use App\Models\FollowUp;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            return $this->superAdminDashboard();
        } elseif ($user->hasRole('Sales Head (HOD)')) {
            return $this->salesHeadDashboard();
        } elseif ($user->hasRole('Team Leader') || $user->hasRole('Vice Team Leader')) {
            return $this->teamLeaderDashboard($user);
        } else {
            return $this->employeeDashboard($user);
        }
    }

    protected function superAdminDashboard()
    {
        $data = [];
        $data['total_employees'] = User::count();
        $data['total_teams'] = Team::count();

        // Today's metrics
        $today = Carbon::today();
        $data['today_enquiries'] = \App\Models\DailyClosing::whereDate('date', $today)->whereIn('closing_type', ['Walk-in', 'Registration'])->sum('count');
        $data['today_walkins'] = \App\Models\DailyClosing::whereDate('date', $today)->where('closing_type', 'Walk-in')->sum('count');
        $data['today_registrations'] = \App\Models\DailyClosing::whereDate('date', $today)->where('closing_type', 'Registration')->sum('count');
        $data['today_admissions'] = \App\Models\DailyClosing::whereDate('date', $today)->where('closing_type', 'Admission')->sum('count');
        $data['today_payments'] = \App\Models\DailyClosing::whereDate('date', $today)->where('closing_type', 'Full Payment')->sum('count');
        $data['today_score'] = Activity::whereDate('created_at', $today)->sum('score');

        // Monthly score
        $data['monthly_score'] = Activity::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('score');

        // Top team and employee this month
        $data['top_employee'] = $this->getTopEmployee();
        $data['top_team'] = $this->getTopTeam();

        // Chart data: monthly sales (Daily admissions, registrations, walkins over last 7 days)
        $chartData = $this->getDailyTrendData();
        $data['chart_days'] = $chartData['days'];
        $data['chart_walkins'] = $chartData['walkins'];
        $data['chart_registrations'] = $chartData['registrations'];
        $data['chart_admissions'] = $chartData['admissions'];
        $data['chart_payments'] = $chartData['payments'];

        // Extra info for new columns
        $data['active_branches'] = \App\Models\Branch::where('status', 'active')->count();
        $data['active_courses'] = \App\Models\Course::where('status', 'active')->count();
        $data['active_lead_sources'] = \App\Models\LeadSource::where('status', 'active')->count();

        // Performance Snapshot (overall)
        $data['overall_walkins'] = \App\Models\DailyClosing::where('closing_type', 'Walk-in')->sum('count');
        $data['overall_admissions'] = \App\Models\DailyClosing::where('closing_type', 'Admission')->sum('count');

        return view('dashboards.super_admin', $data);
    }

    protected function salesHeadDashboard()
    {
        $data = [];
        $data['overall_enquiries'] = \App\Models\DailyClosing::whereIn('closing_type', ['Walk-in', 'Registration'])->sum('count');
        $data['overall_admissions'] = \App\Models\DailyClosing::where('closing_type', 'Admission')->sum('count');
        $data['overall_payments'] = \App\Models\DailyClosing::where('closing_type', 'Full Payment')->sum('count');
        
        $totalEnquiries = $data['overall_enquiries'];
        $converted = $data['overall_admissions'] + $data['overall_payments'];
        $data['conversion_ratio'] = $totalEnquiries > 0 ? round(($converted / $totalEnquiries) * 100, 2) : 0;

        // Leaderboards
        $data['employee_leaderboard'] = $this->getEmployeeLeaderboard(5);
        $data['team_leaderboard'] = $this->getTeamLeaderboard();

        // Monthly growth
        $thisMonthScore = Activity::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('score');
        $lastMonthScore = Activity::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->sum('score');
        
        if ($lastMonthScore > 0) {
            $data['monthly_growth'] = round((($thisMonthScore - $lastMonthScore) / $lastMonthScore) * 100, 2);
        } else {
            $data['monthly_growth'] = $thisMonthScore > 0 ? 100 : 0;
        }
        $data['this_month_score'] = $thisMonthScore;

        // Activity trends
        $chartData = $this->getDailyTrendData();
        $data['chart_days'] = $chartData['days'];
        $data['chart_walkins'] = $chartData['walkins'];
        $data['chart_registrations'] = $chartData['registrations'];
        $data['chart_admissions'] = $chartData['admissions'];
        $data['chart_payments'] = $chartData['payments'];

        return view('dashboards.sales_head', $data);
    }

    protected function teamLeaderDashboard($user)
    {
        $team = $user->team;
        if (!$team) {
            return view('dashboards.team_leader', [
                'team' => null,
                'team_score' => 0,
                'rankings' => collect(),
                'today_activities' => collect(),
                'pending_followups' => 0,
                'daily_closings' => collect(),
                'chart_days' => collect(),
                'chart_scores' => collect(),
                'top_employee' => $this->getTopEmployee(),
                'top_team' => $this->getTopTeam(),
                'today_score' => Activity::whereDate('created_at', Carbon::today())->sum('score'),
                'monthly_score' => Activity::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('score'),
                'activity_points' => [
                    ['activity' => 'Walk-in', 'points' => \App\Models\Setting::get('walk_in_score', 1)],
                    ['activity' => 'Registration', 'points' => \App\Models\Setting::get('registration_score', 1)],
                    ['activity' => 'Admission', 'points' => \App\Models\Setting::get('admission_score', 4)],
                    ['activity' => 'Full Payment', 'points' => \App\Models\Setting::get('admission_score', 4) + \App\Models\Setting::get('payment_score', 6)],
                ]
            ]);
        }

        $data = [];
        $data['team'] = $team;
        
        // Team monthly score
        $data['team_score'] = Activity::where('team_id', $team->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('score');
            
        // Top Performers for widget
        $data['top_employee'] = $this->getTopEmployee();
        $data['top_team'] = $this->getTopTeam();
        $data['today_score'] = Activity::whereDate('created_at', Carbon::today())->sum('score');
        $data['monthly_score'] = Activity::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('score');

        // Member rankings in this team
        $members = $team->users;
        $rankings = [];
        foreach ($members as $member) {
            $score = Activity::where('employee_id', $member->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('score');
            $rankings[] = (object)[
                'name' => $member->name,
                'photo' => $member->employeeProfile?->photo,
                'designation' => $member->employeeProfile?->designation,
                'score' => $score
            ];
        }
        
        usort($rankings, fn($a, $b) => $b->score <=> $a->score);
        $data['rankings'] = collect($rankings);

        // Today's activities
        $data['today_activities'] = Activity::with(['enquiry', 'employee'])
            ->where('team_id', $team->id)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        // Team pending followups
        $memberIds = $team->users->pluck('id')->toArray();
        $data['pending_followups'] = FollowUp::whereIn('employee_id', $memberIds)
            ->where('status', 'Pending')
            ->whereDate('next_follow_up_date', '<=', now()->toDateString())
            ->count();

        // Team monthly performance trend
        $trend = $this->getTeamDailyTrendData($team->id);
        $data['chart_days'] = $trend['days'];
        $data['chart_scores'] = $trend['scores'];

        // My recent daily closings
        $data['daily_closings'] = \App\Models\DailyClosing::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Points reference table
        $data['activity_points'] = [
            ['activity' => 'Walk-in', 'points' => \App\Models\Setting::get('walk_in_score', 1)],
            ['activity' => 'Registration', 'points' => \App\Models\Setting::get('registration_score', 1)],
            ['activity' => 'Admission', 'points' => \App\Models\Setting::get('admission_score', 4)],
            ['activity' => 'Full Payment', 'points' => \App\Models\Setting::get('admission_score', 4) + \App\Models\Setting::get('payment_score', 6)],
        ];

        return view('dashboards.team_leader', $data);
    }

    protected function employeeDashboard($user)
    {
        $data = [];
        $data['today_score'] = $user->today_score;
        
        // Top Performers for widget
        $data['top_employee'] = $this->getTopEmployee();
        $data['top_team'] = $this->getTopTeam();
        $data['monthly_score'] = Activity::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('score');
        
        // Enquiries and follow-ups
        $data['my_enquiries_count'] = Enquiry::where('assigned_employee_id', $user->id)->count();
        
        $data['pending_followups'] = FollowUp::with('enquiry')
            ->where('employee_id', $user->id)
            ->where('status', 'Pending')
            ->whereDate('next_follow_up_date', '<=', now()->toDateString())
            ->orderBy('next_follow_up_date', 'asc')
            ->get();

        // Rank calculations
        $data['my_rank'] = $this->getUserRank($user->id);
        $data['my_team_rank'] = $user->team ? $this->getTeamRank($user->team->id) : 'N/A';

        // Last 7 days performance points
        $chartData = $this->getUserLast7DaysTrend($user->id);
        $data['chart_days'] = $chartData['days'];
        $data['chart_scores'] = $chartData['scores'];

        // Courses and branches for quick add modal
        $data['courses'] = \App\Models\Course::where('status', 'active')->get();
        $data['branches'] = \App\Models\Branch::where('status', 'active')->get();
        $data['lead_sources'] = \App\Models\LeadSource::where('status', 'active')->get();
        $data['states'] = \App\Models\State::all();

        // My recent daily closings
        $data['daily_closings'] = \App\Models\DailyClosing::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Points reference table
        $data['activity_points'] = [
            ['activity' => 'Walk-in', 'points' => \App\Models\Setting::get('walk_in_score', 1)],
            ['activity' => 'Registration', 'points' => \App\Models\Setting::get('registration_score', 1)],
            ['activity' => 'Admission', 'points' => \App\Models\Setting::get('admission_score', 4)],
            ['activity' => 'Full Payment', 'points' => \App\Models\Setting::get('admission_score', 4) + \App\Models\Setting::get('payment_score', 6)],
        ];

        return view('dashboards.employee', $data);
    }

    // Helper functions

    private function getTopEmployee()
    {
        $leaderboard = $this->getEmployeeLeaderboard(1);
        return $leaderboard->first();
    }

    private function getTopTeam()
    {
        $leaderboard = $this->getTeamLeaderboard(1);
        return $leaderboard->first();
    }

    private function getEmployeeLeaderboard(int $limit = 10)
    {
        $users = User::with('employeeProfile', 'teams')->get();
        $leaderboard = [];
        
        foreach ($users as $user) {
            $score = Activity::where('employee_id', $user->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('score');
            
            $leaderboard[] = (object)[
                'user_id' => $user->id,
                'name' => $user->name,
                'photo' => $user->employeeProfile?->photo,
                'designation' => $user->employeeProfile?->designation,
                'team_name' => $user->team?->name ?? 'No Team',
                'score' => $score
            ];
        }

        usort($leaderboard, fn($a, $b) => $b->score <=> $a->score);
        return collect(array_slice($leaderboard, 0, $limit));
    }

    private function getTeamLeaderboard(int $limit = 10)
    {
        $teams = Team::all();
        $leaderboard = [];

        foreach ($teams as $team) {
            $score = Activity::where('team_id', $team->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('score');
            
            $leaderboard[] = (object)[
                'team_id' => $team->id,
                'name' => $team->name,
                'leader_name' => $team->leader?->name ?? 'No Leader',
                'score' => $score
            ];
        }

        usort($leaderboard, fn($a, $b) => $b->score <=> $a->score);
        return collect(array_slice($leaderboard, 0, $limit));
    }

    private function getUserRank(int $userId)
    {
        $users = User::all();
        $rankings = [];
        
        foreach ($users as $user) {
            $score = Activity::where('employee_id', $user->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('score');
            $rankings[$user->id] = $score;
        }

        arsort($rankings);
        $rank = 1;
        foreach ($rankings as $id => $score) {
            if ($id == $userId) {
                return $rank;
            }
            $rank++;
        }
        return 'N/A';
    }

    private function getTeamRank(int $teamId)
    {
        $teams = Team::all();
        $rankings = [];

        foreach ($teams as $team) {
            $score = Activity::where('team_id', $team->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('score');
            $rankings[$team->id] = $score;
        }

        arsort($rankings);
        $rank = 1;
        foreach ($rankings as $id => $score) {
            if ($id == $teamId) {
                return $rank;
            }
            $rank++;
        }
        return 'N/A';
    }

    private function getDailyTrendData(): array
    {
        $days = [];
        $walkins = [];
        $registrations = [];
        $admissions = [];
        $payments = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('D, M d');
            
            $walkins[] = \App\Models\DailyClosing::whereDate('date', $date)->whereIn('closing_type', ['Walk-in', 'walk_in'])->sum('count');
            $registrations[] = \App\Models\DailyClosing::whereDate('date', $date)->whereIn('closing_type', ['Registration', 'Registered'])->sum('count');
            $admissions[] = \App\Models\DailyClosing::whereDate('date', $date)->whereIn('closing_type', ['Admission', 'Admitted'])->sum('count');
            $payments[] = \App\Models\DailyClosing::whereDate('date', $date)->where('closing_type', 'Full Payment')->sum('count');
        }

        return compact('days', 'walkins', 'registrations', 'admissions', 'payments');
    }

    private function getTeamDailyTrendData(int $teamId): array
    {
        $days = [];
        $scores = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('D, M d');
            
            $scores[] = Activity::where('team_id', $teamId)
                ->whereDate('created_at', $date)
                ->sum('score');
        }

        return compact('days', 'scores');
    }

    private function getUserLast7DaysTrend(int $userId): array
    {
        $days = [];
        $scores = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('D, M d');
            
            $scores[] = Activity::where('employee_id', $userId)
                ->whereDate('created_at', $date)
                ->sum('score');
        }

        return compact('days', 'scores');
    }
}
