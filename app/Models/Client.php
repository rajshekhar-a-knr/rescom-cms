<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Client extends Model {
    protected $fillable = ['name','logo','website_url','type','is_featured','is_active','sort_order'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean'];
}
