<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'enquiry_id',
        'employee_id',
        'admission_amount',
        'discount',
        'scholarship',
        'paid_amount',
        'balance',
        'payment_mode',
        'transaction_number',
        'receipt_number'
    ];

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
