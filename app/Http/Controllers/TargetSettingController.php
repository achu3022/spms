<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeProfile;
use App\Models\Setting;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TargetSettingController extends Controller
{
    public function index()
    {
        // Get all employees except Super Admin
        $users = User::with('employeeProfile')
            ->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'Super Admin');
            })
            ->get();
            
        $teams = Team::all();
        $teamTargets = [];
        foreach ($teams as $team) {
            $teamTargets[$team->id] = Setting::get("team_{$team->id}_target", 50);
        }
        return view('target-settings.index', compact('users', 'teams', 'teamTargets'));
    }

    public function update(Request $request)
    {
        if ($request->has('type') && $request->type === 'employee') {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'target' => 'required|integer|min:0',
            ]);

            $user = User::findOrFail($request->user_id);
            
            if ($user->employeeProfile) {
                $user->employeeProfile->update(['target' => $request->target]);
            } else {
                $user->employeeProfile()->create([
                    'target' => $request->target,
                ]);
            }
            return redirect()->route('target-settings.index')->with('success', "Target for {$user->name} updated successfully.");
        } else {
            $request->validate([
                'team_id' => 'required|exists:teams,id',
                'target' => 'required|integer|min:1',
            ]);
            
            Setting::set("team_{$request->team_id}_target", $request->target);
            return redirect()->route('target-settings.index')->with('success', "Team target updated successfully.");
        }
    }
}
