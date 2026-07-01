<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * All users belonging to the team (members, leaders, vice leaders).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_members')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Get the team leader(s).
     */
    public function leaders()
    {
        return $this->belongsToMany(User::class, 'team_members')
                    ->wherePivot('role', 'leader')
                    ->withTimestamps();
    }

    /**
     * Get the team vice leader(s).
     */
    public function viceLeaders()
    {
        return $this->belongsToMany(User::class, 'team_members')
                    ->wherePivot('role', 'vice_leader')
                    ->withTimestamps();
    }

    /**
     * Get regular team members.
     */
    public function regularMembers()
    {
        return $this->belongsToMany(User::class, 'team_members')
                    ->wherePivot('role', 'member')
                    ->withTimestamps();
    }

    /**
     * Helper to get the first Leader model directly.
     */
    public function getLeaderAttribute()
    {
        return $this->leaders()->first();
    }

    /**
     * Helper to get the first Vice Leader model directly.
     */
    public function getViceLeaderAttribute()
    {
        return $this->viceLeaders()->first();
    }

    /**
     * Enquiries assigned to this team.
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'assigned_team_id');
    }

    /**
     * Activities performed under this team.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
