<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_highlight',
        'hero_subtitle',
        'story_badge',
        'story_title',
        'story_highlight',
        'story_body_1',
        'story_body_2',
        'vision_title',
        'vision_body',
        'mission_title',
        'mission_body',
        'values_title',
        'values',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'values' => 'array',
        'is_active' => 'boolean',
    ];
}
