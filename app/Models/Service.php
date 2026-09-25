<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Service extends Model {
    protected $fillable = ['category_id','title','slug','short_description','description','icon','featured_image','banner_image','features','technologies','sort_order','is_featured','is_active','meta_title','meta_description'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean','features'=>'array','technologies'=>'array'];
    public function category() { return $this->belongsTo(ServiceCategory::class, 'category_id'); }
}
