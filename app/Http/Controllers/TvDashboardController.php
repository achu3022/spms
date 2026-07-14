<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\Activity;

class TvDashboardController extends Controller
{
    private function getDashboardData($lastActivityId = null)
    {
        // Use Cache to prevent heavy DB load (cache for 15 seconds)
        $cacheKey = 'tv_dashboard_standings';
        
        $standings = \Illuminate\Support\Facades\Cache::remember($cacheKey, 15, function () {
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();

            // 1. Fetch Top Performers
            $userScores = Activity::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->selectRaw('employee_id, SUM(score) as total_score')
                ->groupBy('employee_id')
                ->orderByDesc('total_score')
                ->take(5)
                ->get();

            $userIds = $userScores->pluck('employee_id');
            $users = User::with(['employeeProfile', 'teams'])->whereIn('id', $userIds)->get();

            $topPerformers = $userScores->map(function($scoreRow) use ($users) {
                $user = $users->firstWhere('id', $scoreRow->employee_id);
                if ($user) {
                    $user->activities_sum_score = $scoreRow->total_score;
                    return $user;
                }
                return null;
            })->filter()->values();

            // 2. Fetch Top Teams
            $teamScores = Activity::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->whereNotNull('team_id')
                ->selectRaw('team_id, SUM(score) as total_score')
                ->groupBy('team_id')
                ->orderByDesc('total_score')
                ->take(5)
                ->get();

            $teamIds = $teamScores->pluck('team_id');
            $teamsData = Team::with(['leaders.employeeProfile', 'users'])->whereIn('id', $teamIds)->get();

            $teams = $teamScores->map(function($scoreRow) use ($teamsData) {
                $team = $teamsData->firstWhere('id', $scoreRow->team_id);
                if ($team) {
                    $team->activities_sum_score = $scoreRow->total_score;
                    return $team;
                }
                return null;
            })->filter()->values();

            return [
                'topPerformers' => $topPerformers->toArray(),
                'teams' => $teams->toArray()
            ];
        });

        $topPerformers = collect($standings['topPerformers']);
        $teams = collect($standings['teams']);

        $topPerformer = $topPerformers->first();
        $otherPerformers = $topPerformers->slice(1)->values();

        $topTeam = $teams->first();
        $otherTeams = $teams->slice(1)->values();

        // Check for new activities for notifications
        $latestActivities = collect();
        if ($lastActivityId) {
            $latestActivities = Activity::with(['employee.employeeProfile', 'team'])
                ->where('id', '>', $lastActivityId)
                ->orderBy('id', 'desc')
                ->get();
        }

        $newLastActivityId = Activity::max('id') ?? 0;

        return [
            'topPerformer' => $topPerformer,
            'otherPerformers' => $otherPerformers,
            'topTeam' => $topTeam,
            'otherTeams' => $otherTeams,
            'latestActivities' => $latestActivities,
            'lastActivityId' => $newLastActivityId
        ];
    }

    public function index()
    {
        $initialData = json_encode($this->getDashboardData(null));
        return view('tv.dashboard', compact('initialData'));
    }

    public function data(Request $request)
    {
        $lastActivityId = $request->input('last_activity_id');
        $data = $this->getDashboardData($lastActivityId);
        return response()->json($data);
    }
}
