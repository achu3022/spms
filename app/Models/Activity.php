<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'enquiry_id',
        'employee_id',
        'team_id',
        'activity_type',
        'remarks',
        'score'
    ];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
