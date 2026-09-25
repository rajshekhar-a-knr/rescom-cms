<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'event_type',
        'summary',
        'description',
        'event_date',
        'location',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function photos()
    {
        return $this->hasMany(EventPhoto::class)->orderBy('sort_order')->orderBy('created_at');
    }
}
