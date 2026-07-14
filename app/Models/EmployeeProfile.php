<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'photo',
        'phone',
        'whatsapp',
        'address',
        'emergency_contact',
        'emergency_phone',
        'dob',
        'joining_date',
        'department',
        'designation',
        'status',
        'target',
        'last_login_at'
    ];

    protected $casts = [
        'dob' => 'date',
        'joining_date' => 'date',
        'last_login_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
