@extends('admin.layouts.app')
@section('title','Application Details')
@section('breadcrumb')<span>></span><a href="{{ route('admin.jobs.applications') }}" style="color:#94a3b8;text-decoration:none">Applications</a><span>></span><span class="current">View</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">{{ $application->applicant_name }}</h1><p class="page-subtitle">Applied for: {{ $application->job?->title }}</p></div><a href="{{ route('admin.jobs.applications') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
<div>
<div class="card" style="margin-bottom:16px"><div class="card-header"><h3 class="card-title">Cover Letter</h3></div><div class="card-body"><p style="line-height:1.8;white-space:pre-wrap">{{ $application->cover_letter ?: 'No cover letter provided.' }}</p></div></div>
</div>
<div>
<div class="card" style="margin-bottom:16px"><div class="card-header"><h3 class="card-title">Applicant Info</h3></div><div class="card-body">
@foreach(['Name'=>$application->applicant_name,'Email'=>$application->applicant_email,'Phone'=>$application->applicant_phone,'Expected CTC'=>$application->expected_ctc,'Current CTC'=>$application->current_ctc,'Notice Period'=>$application->notice_period] as $l=>$v)
@if($v)<div style="margin-bottom:12px"><div style="font-size:11px;text-transform:uppercase;color:#94a3b8;margin-bottom:2px">{{ $l }}</div><div style="font-weight:500">{{ $v }}</div></div>@endif
@endforeach
@if($application->resume_path)<a href="{{ media_url($application->resume_path) }}" target="_blank" class="btn btn-secondary" style="width:100%;justify-content:center;margin-top:8px"><i class="fas fa-file-pdf"></i> View Resume</a>@endif
</div></div>
<div class="card"><div class="card-header"><h3 class="card-title">Update Status</h3></div><div class="card-body">
<form class="single-card-form" action="{{ route('admin.jobs.application.status',$application->id) }}" method="POST">
@csrf
<div class="form-group"><select name="status" class="form-control">@foreach(['pending','reviewing','shortlisted','interviewed','hired','rejected'] as $s)<option value="{{ $s }}" {{ $application->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
<div class="form-group"><label class="form-label">Notes</label><textarea name="admin_notes" class="form-control" rows="3">{{ $application->admin_notes }}</textarea></div>
<button class="btn btn-primary" style="width:100%">Update Status</button>
</form>
</div></div>
</div>
</div>
@endsection



