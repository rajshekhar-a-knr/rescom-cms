<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model {
    protected $fillable = [
        'department_id',
        'name',
        'designation',
        'bio',
        'college_name',
        'college_guide',
        'knr_guide',
        'photo',
        'email',
        'phone',
        'linkedin_url',
        'twitter_url',
        'github_url',
        'skills',
        'experience_years',
        'intern_type',
        'certificate',
        'certificate_token',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'skills' => 'array',
    ];

    public function department() {
        return $this->belongsTo(TeamDepartment::class, 'department_id');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
