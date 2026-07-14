<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Fetch Top 5 Employees for the current month
        $users = \App\Models\User::with(['employeeProfile', 'teams'])
            ->whereDoesntHave('roles', function ($q) {
                $q->whereIn('name', ['Super Admin', 'Sales Head (HOD)']);
            })
            ->get();
            
        $employeeRankings = [];
        $startDate = now()->startOfMonth()->toDateTimeString();
        $endDate = now()->endOfMonth()->toDateTimeString();

        foreach ($users as $user) {
            $score = \App\Models\Activity::where('employee_id', $user->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('score');
            
            $employeeRankings[] = (object)[
                'user' => $user,
                'name' => $user->name,
                'photo' => $user->employeeProfile?->photo,
                'designation' => $user->employeeProfile?->designation,
                'score' => $score
            ];
        }
        usort($employeeRankings, fn($a, $b) => $b->score <=> $a->score);
        $topEmployees = array_slice($employeeRankings, 0, 5);

        // Fetch Top 3 Teams for the current month
        $teams = \App\Models\Team::all();
        $teamRankings = [];

        foreach ($teams as $team) {
            $score = \App\Models\Activity::where('team_id', $team->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('score');
                
            $teamRankings[] = (object)[
                'team' => $team,
                'name' => $team->name,
                'score' => $score
            ];
        }
        usort($teamRankings, fn($a, $b) => $b->score <=> $a->score);
        $topTeams = array_slice($teamRankings, 0, 3);

        return view('auth.login', compact('topEmployees', 'topTeams'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // Redirect employees to the Welcome League page, others to the Dashboard
        if ($user && !$user->hasRole(['Super Admin', 'Sales Head (HOD)'])) {
            return redirect()->route('welcome.league');
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
