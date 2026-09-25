<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HeroBanner extends Model {
    protected $fillable = ['title','subtitle','description','image','mobile_image','video_url','btn1_text','btn1_url','btn2_text','btn2_url','badge_text','text_color','overlay_opacity','is_active','sort_order'];
    protected $casts = ['is_active' => 'boolean'];
}
