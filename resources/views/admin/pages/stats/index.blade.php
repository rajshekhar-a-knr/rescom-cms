@extends('admin.layouts.app')
@section('title','Stats')
@section('breadcrumb')<span>></span><span class="current">Stats</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Stats & Counters</h1></div><a href="{{ route('admin.stats.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Stat</a></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Stat</th><th>Value</th><th>Icon</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@foreach($stats as $s)
<tr><td style="font-weight:600">{{ $s->title }}</td><td style="font-size:20px;font-weight:800;color:#3b82f6">{{ $s->value }}{{ $s->suffix }}</td><td><i class="{{ $s->icon }}"></i></td><td><span class="badge {{ $s->is_active ? 'badge-green' : 'badge-gray' }}">{{ $s->is_active ? 'Active' : 'Hidden' }}</span></td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.stats.edit',$s) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.stats.destroy',$s) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div></div>
@endsection

