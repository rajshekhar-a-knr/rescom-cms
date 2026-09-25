<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Portfolio extends Model {
    protected $fillable = ['category_id','title','slug','client_name','client_url','short_description','description','challenge','solution','results','featured_image','gallery','technologies','project_url','completion_date','is_featured','is_active','sort_order','meta_title','meta_description'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean','gallery'=>'array','technologies'=>'array','completion_date'=>'date'];
    public function category() { return $this->belongsTo(PortfolioCategory::class, 'category_id'); }
}
