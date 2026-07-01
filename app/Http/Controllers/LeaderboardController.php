<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use App\Models\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', 'monthly'); // daily, weekly, monthly, yearly, etc
        $customMonth = $request->input('custom_month');
        $customYear = $request->input('custom_year');
        
        [$startDate, $endDate] = $this->resolvePeriodDates($period, $customMonth, $customYear);

        // Employee rankings
        $users = User::with(['employeeProfile', 'teams'])
            ->whereDoesntHave('roles', function ($q) {
                $q->whereIn('name', ['Super Admin', 'Sales Head (HOD)']);
            })
            ->get();
        $employeeRankings = [];

        foreach ($users as $user) {
            $score = Activity::where('employee_id', $user->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('score');
            
            $employeeRankings[] = (object)[
                'user' => $user,
                'name' => $user->name,
                'photo' => $user->employeeProfile?->photo,
                'designation' => $user->employeeProfile?->designation,
                'team_name' => $user->team?->name ?? 'No Team',
                'score' => $score
            ];
        }
        usort($employeeRankings, fn($a, $b) => $b->score <=> $a->score);

        // Team rankings
        $teams = Team::all();
        $teamRankings = [];

        foreach ($teams as $team) {
            $score = Activity::where('team_id', $team->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('score');
                
            $teamRankings[] = (object)[
                'team' => $team,
                'name' => $team->name,
                'leader_name' => $team->leader?->name ?? 'No Leader',
                'score' => $score
            ];
        }
        usort($teamRankings, fn($a, $b) => $b->score <=> $a->score);

        // Get Top Performer and Top Team
        $topEmployee = count($employeeRankings) > 0 ? $employeeRankings[0] : null;
        $topTeam = count($teamRankings) > 0 ? $teamRankings[0] : null;

        return view('leaderboard.index', compact('employeeRankings', 'teamRankings', 'topEmployee', 'topTeam', 'period', 'customMonth', 'customYear'));
    }

    protected function resolvePeriodDates(string $period, $customMonth = null, $customYear = null): array
    {
        switch ($period) {
            case 'daily':
                return [now()->startOfDay()->toDateTimeString(), now()->endOfDay()->toDateTimeString()];
            case 'weekly':
                return [now()->startOfWeek()->toDateTimeString(), now()->endOfWeek()->toDateTimeString()];
            case 'last_week':
                return [now()->subWeek()->startOfWeek()->toDateTimeString(), now()->subWeek()->endOfWeek()->toDateTimeString()];
            case 'last_month':
                return [now()->subMonth()->startOfMonth()->toDateTimeString(), now()->subMonth()->endOfMonth()->toDateTimeString()];
            case 'yearly':
                return [now()->startOfYear()->toDateTimeString(), now()->endOfYear()->toDateTimeString()];
            case 'custom_month':
                $date = Carbon::create($customYear ?? now()->year, $customMonth ?? now()->month, 1);
                return [$date->copy()->startOfMonth()->toDateTimeString(), $date->copy()->endOfMonth()->toDateTimeString()];
            case 'monthly':
            default:
                return [now()->startOfMonth()->toDateTimeString(), now()->endOfMonth()->toDateTimeString()];
        }
    }
}
