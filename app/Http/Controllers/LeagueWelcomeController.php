<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeagueWelcomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Calculate user's total score for the current month
        $scoreThisMonth = Activity::where('employee_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('score');

        // Retrieve individual score target from employee profile
        $scoreTarget = $user->employeeProfile?->target ?? 10;
        
        $isTeamLeader = $user->team_role === 'leader';
        $team = null;
        $teamTarget = 0;
        $teamScoreThisMonth = 0;

        if ($isTeamLeader) {
            $team = $user->team;
            if ($team) {
                $teamTarget = Setting::get("team_{$team->id}_target", 50);
                $teamUserIds = $team->users->pluck('id');
                $teamScoreThisMonth = Activity::whereIn('employee_id', $teamUserIds)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('score');
            }
        }

        return view('welcome_league', compact(
            'user', 
            'scoreThisMonth', 
            'scoreTarget',
            'isTeamLeader',
            'team',
            'teamTarget',
            'teamScoreThisMonth'
        ));
    }
}
