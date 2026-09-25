<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TeamDepartment extends Model {
    protected $fillable = ['name','slug','sort_order'];
    public function members() { return $this->hasMany(TeamMember::class, 'department_id'); }
}
