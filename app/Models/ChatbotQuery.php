<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotQuery extends Model
{
    protected $fillable = [
        'user_question',
        'status',
        'admin_response',
        'resolved_faq_id',
    ];

    public function faq()
    {
        return $this->belongsTo(ChatbotFaq::class, 'resolved_faq_id');
    }
}
