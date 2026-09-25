<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobApplication extends Model {
    protected $fillable = ['job_id','applicant_name','applicant_email','applicant_phone','cover_letter','resume_path','portfolio_url','linkedin_url','current_ctc','expected_ctc','notice_period','status','admin_notes'];
    public function job() { return $this->belongsTo(JobListing::class, 'job_id'); }
}
