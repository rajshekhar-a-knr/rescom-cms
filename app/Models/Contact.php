<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Contact extends Model {
    protected $fillable = ['name','email','phone','company','subject','service_interested','product_interested','message','source','ip_address','status','admin_notes','replied_at'];
    protected $casts = ['replied_at'=>'datetime'];
}
