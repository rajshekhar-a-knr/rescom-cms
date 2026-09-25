<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PortfolioCategory extends Model {
    protected $fillable = ['name','slug','description','sort_order','is_active'];
    public function portfolios() { return $this->hasMany(Portfolio::class, 'category_id'); }
}
