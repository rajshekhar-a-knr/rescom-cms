@extends('admin.layouts.app')
@section('title','Job Listings')
@section('breadcrumb')<span>></span><span class="current">Jobs</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Job Listings</h1></div><div style="display:flex;gap:10px"><a href="{{ route('admin.jobs.applications') }}" class="btn btn-secondary"><i class="fas fa-users"></i> Applications</a><a href="{{ route('admin.jobs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Post Job</a></div></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Job Title</th><th>Department</th><th>Location</th><th>Type</th><th>Applications</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@foreach($jobs as $job)
<tr><td><div style="font-weight:600">{{ $job->title }}</div><div style="font-size:12px;color:#94a3b8">{{ $job->experience }}</div></td><td style="font-size:13px">{{ $job->department }}</td><td style="font-size:13px">{{ $job->location }}</td><td><span class="badge badge-blue">{{ str_replace('-',' ',ucfirst($job->job_type)) }}</span></td>
<td><span class="badge badge-purple">{{ $job->applications_count }}</span></td>
<td><span class="badge {{ $job->status==='open' ? 'badge-green' : 'badge-red' }}">{{ ucfirst($job->status) }}</span></td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.jobs.edit',$job) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.jobs.destroy',$job) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div></div>
@endsection

