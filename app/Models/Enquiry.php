<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'enquiry_number',
        'student_name',
        'phone_number',
        'whatsapp_number',
        'parent_phone',
        'email',
        'gender',
        'place',
        'district_id',
        'state_id',
        'qualification',
        'course_id',
        'branch_id',
        'lead_source_id',
        'assigned_employee_id',
        'assigned_team_id',
        'remarks',
        'current_status',
        'total_score'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function assignedEmployee()
    {
        return $this->belongsTo(User::class, 'assigned_employee_id');
    }

    public function assignedTeam()
    {
        return $this->belongsTo(Team::class, 'assigned_team_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
