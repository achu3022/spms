<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditLogService
{
    public function logLogin(User $user): void
    {
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'login',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "Employee {$user->name} logged in successfully.",
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);

        // Update last login timestamp in employee profile
        if ($user->employeeProfile) {
            $user->employeeProfile->update(['last_login_at' => now()]);
        }
    }

    public function logLogout(User $user): void
    {
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'logout',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "Employee {$user->name} logged out.",
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public function logTransfer(User $employee, ?Team $oldTeam, ?Team $newTeam): void
    {
        $oldName = $oldTeam ? $oldTeam->name : 'No Team';
        $newName = $newTeam ? $newTeam->name : 'No Team';

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'transfer',
            'model_type' => User::class,
            'model_id' => $employee->id,
            'description' => "Transferred employee {$employee->name} from team '{$oldName}' to '{$newName}'.",
            'old_values' => ['team_id' => $oldTeam?->id, 'team_name' => $oldName],
            'new_values' => ['team_id' => $newTeam?->id, 'team_name' => $newName],
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public function logRoleChange(User $employee, string $oldRole, string $newRole): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'role_change',
            'model_type' => User::class,
            'model_id' => $employee->id,
            'description' => "Changed role of employee {$employee->name} from '{$oldRole}' to '{$newRole}'.",
            'old_values' => ['role' => $oldRole],
            'new_values' => ['role' => $newRole],
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
