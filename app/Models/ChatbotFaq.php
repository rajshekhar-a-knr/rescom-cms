<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotFaq extends Model
{
    protected $fillable = [
        'category',
        'question',
        'answer',
        'keywords',
        'is_active',
        'times_asked',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'times_asked' => 'integer',
    ];
}
