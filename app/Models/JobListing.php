<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobListing extends Model {
    protected $fillable = ['title','slug','department','location','job_type','experience','salary_range','description','requirements','responsibilities','benefits','skills_required','vacancies','deadline','status'];
    protected $casts = ['skills_required'=>'array','deadline'=>'date'];
    public function applications() { return $this->hasMany(JobApplication::class, 'job_id'); }
}
