<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * One-to-one relationship with EmployeeProfile.
     */
    public function employeeProfile()
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    /**
     * Team membership relationship.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_members')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Accessor to get the active team of the user.
     */
    public function getTeamAttribute()
    {
        return $this->teams()->first();
    }

    /**
     * Accessor to get the user's role inside the team.
     */
    public function getTeamRoleAttribute()
    {
        $team = $this->teams()->first();
        return $team ? $team->pivot->role : null;
    }

    /**
     * Enquiries assigned to this user.
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'assigned_employee_id');
    }

    /**
     * Activities logged by this user.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'employee_id');
    }

    /**
     * Follow ups logged by this user.
     */
    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'employee_id');
    }

    /**
     * Payments collected/handled by this user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'employee_id');
    }

    /**
     * Get current month's score.
     */
    public function getCurrentMonthScoreAttribute(): int
    {
        return $this->activities()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('score');
    }

    /**
     * Get today's score.
     */
    public function getTodayScoreAttribute(): int
    {
        return $this->activities()
            ->whereDate('created_at', now()->toDateString())
            ->sum('score');
    }
}
