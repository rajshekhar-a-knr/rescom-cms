<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopScroller extends Model
{
    protected $fillable = [
        'text',
        'url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'bool',
        'sort_order' => 'int',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}

