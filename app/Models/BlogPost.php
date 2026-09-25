<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class BlogPost extends Model {
    protected $fillable = ['category_id','author_id','title','slug','excerpt','content','featured_image','reading_time','views','is_featured','status','published_at','meta_title','meta_description','meta_keywords'];
    protected $casts = ['is_featured'=>'boolean','published_at'=>'datetime'];
    public function category() { return $this->belongsTo(BlogCategory::class, 'category_id'); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function tags() { return $this->belongsToMany(BlogTag::class, 'blog_post_tags', 'post_id', 'tag_id'); }
}
