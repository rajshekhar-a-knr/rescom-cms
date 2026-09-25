@extends('admin.layouts.app')
@php $job = $job ?? null; @endphp
@section('title', isset($job) ? 'Edit Job' : 'Post Job')
@section('breadcrumb')<span></span><a href="{{ route('admin.jobs.index') }}" style="color:#94a3b8;text-decoration:none">Jobs</a><span></span><span class="current">{{ isset($job) ? 'Edit' : 'New' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($job) ? 'Edit' : 'Post New' }} Job</h1><a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<form class="single-card-form" action="{{ isset($job) ? route('admin.jobs.update',$job) : route('admin.jobs.store') }}" method="POST">
@csrf @if(isset($job)) @method('PUT') @endif
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
<div><div class="card" style="margin-bottom:16px"><div class="card-header"><h3 class="card-title">Job Details</h3></div><div class="card-body">
<div class="form-group"><label class="form-label">Job Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$job->title??'') }}" required></div>
<div class="form-row"><div class="form-group"><label class="form-label">Department</label><input type="text" name="department" class="form-control" value="{{ old('department',$job->department??'') }}"></div><div class="form-group"><label class="form-label">Location</label><input type="text" name="location" class="form-control" value="{{ old('location',$job->location??'Bengaluru, Karnataka') }}"></div></div>
<div class="form-row"><div class="form-group"><label class="form-label">Job Type</label><select name="job_type" class="form-control">@foreach(['full-time','part-time','contract','internship','remote'] as $t)<option value="{{ $t }}" {{ old('job_type',$job->job_type??'full-time')===$t?'selected':'' }}>{{ ucwords(str_replace('-',' ',$t)) }}</option>@endforeach</select></div><div class="form-group"><label class="form-label">Experience Required</label><input type="text" name="experience" class="form-control" value="{{ old('experience',$job->experience??'') }}" placeholder="e.g. 3-5 years"></div></div>
<div class="form-row"><div class="form-group"><label class="form-label">Salary Range</label><input type="text" name="salary_range" class="form-control" value="{{ old('salary_range',$job->salary_range??'') }}" placeholder="e.g. ?8 LPA - ?15 LPA"></div><div class="form-group"><label class="form-label">Vacancies</label><input type="number" name="vacancies" class="form-control" value="{{ old('vacancies',$job->vacancies??1) }}"></div></div>
<div class="form-group"><label class="form-label">Job Description</label><textarea name="description" class="form-control" rows="5">{{ old('description',$job->description??'') }}</textarea></div>
<div class="form-group"><label class="form-label">Requirements</label><textarea name="requirements" class="form-control" rows="5" placeholder="One requirement per line">{{ old('requirements',$job->requirements??'') }}</textarea></div>
<div class="form-group"><label class="form-label">Responsibilities</label><textarea name="responsibilities" class="form-control" rows="5">{{ old('responsibilities',$job->responsibilities??'') }}</textarea></div>
<div class="form-group"><label class="form-label">Benefits</label><textarea name="benefits" class="form-control" rows="3">{{ old('benefits',$job->benefits??'') }}</textarea></div>
<div class="form-group"><label class="form-label">Skills Required (one per line)</label><textarea name="skills_required_raw" class="form-control" rows="4">{{ old('skills_required_raw', isset($job->skills_required) ? implode("
",$job->skills_required) : '') }}</textarea></div>
</div></div></div>
<div><div class="card"><div class="card-header"><h3 class="card-title">Settings</h3></div><div class="card-body">
<div class="form-group"><label class="form-label">Status</label><select name="status" class="form-control"><option value="open" {{ old('status',$job->status??'open')==='open'?'selected':'' }}>Open</option><option value="closed" {{ old('status',$job->status??'')==='closed'?'selected':'' }}>Closed</option><option value="draft" {{ old('status',$job->status??'')==='draft'?'selected':'' }}>Draft</option></select></div>
<div class="form-group"><label class="form-label">Application Deadline</label><input type="date" name="deadline" class="form-control" value="{{ old('deadline',$job?->deadline?->format('Y-m-d')??'') }}"></div>
</div></div></div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($job) ? 'Update' : 'Submit' }}</button>
</div>
</form>
@endsection







