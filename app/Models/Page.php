<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Page extends Model {
    protected $fillable = ['title','slug','content','excerpt','featured_image','template','meta_title','meta_description','meta_keywords','og_image','status','sort_order','show_in_header','show_in_footer','author_id','published_at'];
    protected $casts = ['published_at'=>'datetime','show_in_header'=>'boolean','show_in_footer'=>'boolean'];
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
}
