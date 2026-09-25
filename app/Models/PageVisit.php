<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = [
        'path',
        'full_url',
        'referrer',
        'ip',
        'user_agent',
        'device_type',
        'country',
        'state',
        'city',
        'district',
        'latitude',
        'longitude',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
