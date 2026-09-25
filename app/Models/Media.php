<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Media extends Model {
    protected $fillable = ['filename','original_name','path','mime_type','size','width','height','alt_text','caption','folder','uploaded_by'];
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
