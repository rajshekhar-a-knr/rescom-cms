@extends('admin.layouts.app')
@section('title','Interns')
@section('breadcrumb')<span>></span><span class="current">Interns</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Interns</h1></div><a href="{{ route('admin.interns.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Intern</a></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Member</th><th>Department</th><th>Designation</th><th>Type</th><th>Featured</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@foreach($interns as $member)
<tr><td><div style="display:flex;align-items:center;gap:10px">@if($member->photo)<img src="{{ media_url($member->photo) }}" style="width:38px;height:38px;border-radius:50%;object-fit:cover">@else<div style="width:38px;height:38px;background:linear-gradient(135deg,#3b82f6,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700">{{ strtoupper(substr($member->name,0,1)) }}</div>@endif<div style="font-weight:600">{{ $member->name }}</div></div></td>
<td style="font-size:13px">{{ $member->department?->name ?? '—' }}</td><td style="font-size:13px">{{ $member->designation }}</td><td style="font-size:13px;text-transform:capitalize">{{ $member->intern_type }}</td>
<td>{{ $member->is_featured ? 'Yes' : 'No' }}</td>
<td><span class="badge {{ $member->is_active ? 'badge-green' : 'badge-gray' }}">{{ $member->is_active ? 'Active' : 'Hidden' }}</span></td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.interns.edit',$member) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.interns.destroy',$member) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div><div style="padding:16px">{{ $interns->links() }}</div></div>
@endsection
