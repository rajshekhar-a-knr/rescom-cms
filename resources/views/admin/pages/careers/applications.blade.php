@extends('admin.layouts.app')
@section('title','Applications')
@section('breadcrumb')<span>></span><a href="{{ route('admin.jobs.index') }}" style="color:#94a3b8;text-decoration:none">Jobs</a><span>></span><span class="current">Applications</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Job Applications</h1></div><div style="display:flex;gap:8px">
<select class="form-control" style="width:auto;padding:8px 12px" onchange="location.href='{{ route('admin.jobs.applications') }}?status='+this.value">
<option value="">All Status</option>
@foreach(['pending','reviewing','shortlisted','interviewed','hired','rejected'] as $s)<option value="{{ $s }}" {{ request('status')===$s?'selected':'' }}>{{ ucfirst($s) }}</option>@endforeach
</select>
</div></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Applicant</th><th>Job</th><th>Contact</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead><tbody>
@foreach($applications as $app)
<tr><td><div style="font-weight:600">{{ $app->applicant_name }}</div></td><td style="font-size:13px">{{ $app->job?->title ?? 'N/A' }}</td>
<td style="font-size:12px"><div>{{ $app->applicant_email }}</div><div>{{ $app->applicant_phone }}</div></td>
<td>@php $colors=['pending'=>'yellow','reviewing'=>'blue','shortlisted'=>'purple','interviewed'=>'blue','hired'=>'green','rejected'=>'red']; @endphp<span class="badge badge-{{ $colors[$app->status] ?? 'gray' }}">{{ ucfirst($app->status) }}</span></td>
<td style="font-size:12px;color:#94a3b8">{{ $app->created_at->format('M d, Y') }}</td>
<td><a href="{{ route('admin.jobs.application.show',$app->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td></tr>
@endforeach
</tbody></table></div><div style="padding:16px">{{ $applications->links() }}</div></div>
@endsection

