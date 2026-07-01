<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{
    protected $fillable = ['user_id', 'date', 'closing_type', 'count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
