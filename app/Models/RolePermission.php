<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class RolePermission extends Model
{
    public $timestamps = false;
    protected $fillable = ['role', 'permission_id'];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
