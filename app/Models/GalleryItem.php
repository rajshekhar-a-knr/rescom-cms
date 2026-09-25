<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'title',
        'caption',
        'category',
        'image',
        'event_id',
        'is_active',
        'sort_order',
    ];
}
