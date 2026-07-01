<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderboardArchive extends Model
{
    protected $fillable = [
        'month',
        'year',
        'archive_type',
        'entity_id',
        'name',
        'score',
        'rank'
    ];
}
