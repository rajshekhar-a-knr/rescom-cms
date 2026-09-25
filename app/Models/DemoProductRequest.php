<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemoProductRequest extends Model
{
    protected $fillable = [
        'demo_product_id',
        'full_name',
        'email',
        'phone',
        'organization',
        'ip_address',
        'user_agent',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(DemoProduct::class, 'demo_product_id');
    }
}
