<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Technology extends Model {
    protected $fillable = ['name','logo','category','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
}
