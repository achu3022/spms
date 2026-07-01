<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeProfile;
use App\Models\Team;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $auditService;

    public function __construct(AuditLogService $auditService)
    {
        $this->auditService = $auditService;
    }

    public function index()
    {
        $users = User::with(['employeeProfile', 'teams', 'roles'])
            ->whereDoesntHave('roles', function ($q) {
                $q->whereIn('name', ['Super Admin', 'Sales Head (HOD)']);
            })
            ->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        $teams = Team::all();
        return view('users.create', compact('roles', 'teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', 'exists:roles,name', \Illuminate\Validation\Rule::notIn(['Super Admin'])],
            'employee_id' => 'required|string|unique:employee_profiles,employee_id|max:50',
            'designation' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'photo' => 'nullable|image|max:2048',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'require_password_reset' => !in_array($request->role, ['Super Admin', 'Sales Head (HOD)']),
            ]);

            $user->assignRole($request->role);

            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            EmployeeProfile::create([
                'user_id' => $user->id,
                'employee_id' => $request->employee_id,
                'department' => 'Sales',
                'designation' => $request->designation,
                'status' => $request->status,
                'photo' => $photoPath,
            ]);

            // Save team membership
            if ($request->team_id) {
                DB::table('team_members')->insert([
                    'team_id' => $request->team_id,
                    'user_id' => $user->id,
                    'role' => 'member', // Default role in team
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $team = Team::find($request->team_id);
                $this->auditService->logTransfer($user, null, $team);
            }
        });

        return redirect()->route('users.index')->with('success', 'Employee profile created successfully.');
    }

    public function edit(User $user)
    {
        $user->load('employeeProfile', 'teams');
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        $teams = Team::all();
        $currentRole = $user->roles->first()?->name;
        $currentTeamId = $user->team?->id;

        return view('users.edit', compact('user', 'roles', 'teams', 'currentRole', 'currentTeamId'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', 'exists:roles,name', \Illuminate\Validation\Rule::notIn(['Super Admin'])],
            'employee_id' => 'required|string|max:50|unique:employee_profiles,employee_id,' . ($user->employeeProfile?->id ?? 0),
            'designation' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'photo' => 'nullable|image|max:2048',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        DB::transaction(function () use ($request, $user) {
            // Update base user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->password) {
                $user->update(['password' => Hash::make($request->password)]);
            }

            // Sync Role & Log Role Change
            $oldRole = $user->roles->first()?->name ?? 'None';
            if ($oldRole !== $request->role) {
                $user->syncRoles([$request->role]);
                $this->auditService->logRoleChange($user, $oldRole, $request->role);
            }

            // Sync Profile
            $profile = $user->employeeProfile;
            
            // Handle photo upload
            $photoPath = $profile?->photo;
            if ($request->hasFile('photo')) {
                if ($photoPath) {
                    Storage::disk('public')->delete($photoPath);
                }
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            $profileData = [
                'employee_id' => $request->employee_id,
                'department' => 'Sales',
                'designation' => $request->designation,
                'status' => $request->status,
                'photo' => $photoPath,
            ];

            if ($profile) {
                $profile->update($profileData);
            } else {
                $user->employeeProfile()->create($profileData);
            }

            // Sync Team
            $oldTeam = $user->team;
            $newTeamId = $request->team_id;
            
            if (($oldTeam?->id ?? 0) !== (int)$newTeamId) {
                // Clear old
                DB::table('team_members')->where('user_id', $user->id)->delete();
                
                if ($newTeamId) {
                    DB::table('team_members')->insert([
                        'team_id' => $newTeamId,
                        'user_id' => $user->id,
                        'role' => 'member', // Default
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $newTeam = Team::find($newTeamId);
                    $this->auditService->logTransfer($user, $oldTeam, $newTeam);
                } else {
                    $this->auditService->logTransfer($user, $oldTeam, null);
                }
            }
        });

        return redirect()->route('users.index')->with('success', 'Employee profile updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting Super Admin
        if ($user->hasRole('Super Admin')) {
            return redirect()->route('users.index')->with('error', 'Cannot delete Super Admin account.');
        }

        // Delete photo if exists
        if ($user->employeeProfile && $user->employeeProfile->photo) {
            Storage::disk('public')->delete($user->employeeProfile->photo);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Employee deleted successfully.');
    }
}
