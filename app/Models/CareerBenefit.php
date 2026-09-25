<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerBenefit extends Model
{
    protected $fillable = [
        'icon',
        'color',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];
}
