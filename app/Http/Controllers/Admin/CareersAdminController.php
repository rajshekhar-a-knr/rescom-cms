<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\JobApplication;
use Illuminate\Support\Str;

class CareersAdminController extends Controller {
    public function index() {
        $jobs = JobListing::withCount('applications')->orderBy('created_at','desc')->paginate(20);
        return view('admin.pages.careers.index', compact('jobs'));
    }
    public function create() { return view('admin.pages.careers.form'); }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_type' => 'nullable|in:full-time,part-time,contract,internship,remote',
            'experience' => 'nullable|string|max:100',
            'salary_range' => 'nullable|string|max:100',
            'vacancies' => 'nullable|integer|min:1|max:999',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'skills_required_raw' => 'nullable|string|max:2000',
            'status' => 'nullable|in:open,closed,draft',
            'deadline' => 'nullable|date',
        ]);
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(4);
        if ($request->skills_required_raw) $data['skills_required'] = array_filter(explode("\n",$request->skills_required_raw));
        JobListing::create($data);
        return redirect()->route('admin.jobs.index')->with('success','Job posted!');
    }
    public function edit(JobListing $job) { return view('admin.pages.careers.form', compact('job')); }
    public function update(Request $request, JobListing $job) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'job_type' => 'nullable|in:full-time,part-time,contract,internship,remote',
            'experience' => 'nullable|string|max:100',
            'salary_range' => 'nullable|string|max:100',
            'vacancies' => 'nullable|integer|min:1|max:999',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'skills_required_raw' => 'nullable|string|max:2000',
            'status' => 'nullable|in:open,closed,draft',
            'deadline' => 'nullable|date',
        ]);
        if ($request->skills_required_raw) $data['skills_required'] = array_filter(explode("\n",$request->skills_required_raw));
        $job->update($data);
        return redirect()->route('admin.jobs.index')->with('success','Job updated!');
    }
    public function destroy(JobListing $job) {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success','Job deleted!');
    }
    public function applications(Request $request) {
        $query = JobApplication::with('job')->orderBy('created_at','desc');
        if ($request->status) $query->where('status',$request->status);
        if ($request->job_id) $query->where('job_id',$request->job_id);
        $applications = $query->paginate(25);
        $jobs = JobListing::orderBy('title')->get();
        return view('admin.pages.careers.applications', compact('applications','jobs'));
    }
    public function applicationShow($id) {
        $application = JobApplication::with('job')->findOrFail($id);
        return view('admin.pages.careers.application-show', compact('application'));
    }
    public function updateStatus(Request $request, $id) {
        $data = $request->validate([
            'status' => 'required|in:pending,reviewing,shortlisted,interviewed,hired,rejected',
            'admin_notes' => 'nullable|string|max:2000',
        ]);
        JobApplication::findOrFail($id)->update($data);
        return back()->with('success','Application status updated!');
    }
}
