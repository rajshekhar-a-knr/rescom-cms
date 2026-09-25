<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'intern_id',
        'testimonial_source',
        'client_name',
        'client_designation',
        'client_company',
        'client_photo',
        'content',
        'rating',
        'project_type',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }
}
