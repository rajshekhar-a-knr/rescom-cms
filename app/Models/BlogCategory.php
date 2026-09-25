<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BlogCategory extends Model {
    protected $fillable = ['name','slug','description','featured_image','sort_order','is_active'];
    public function posts() { return $this->hasMany(BlogPost::class, 'category_id'); }
}
