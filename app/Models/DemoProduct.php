<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemoProduct extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'preview_video',
        'short_description',
        'features',
        'demo_url',
        'login_url',
        'credential_email',
        'credential_username',
        'credential_password',
        'credential_notes',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function requests()
    {
        return $this->hasMany(DemoProductRequest::class);
    }
}
