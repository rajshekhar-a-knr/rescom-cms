<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'location',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class)->orderBy('sort_order');
    }

    public function activeItems()
    {
        return $this->hasMany(MenuItem::class)->where('is_active', 1)->orderBy('sort_order');
    }
}
