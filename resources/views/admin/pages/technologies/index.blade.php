@extends('admin.layouts.app')
@section('title','Technologies')
@section('breadcrumb')<span>></span><span class="current">Technologies</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Technologies</h1></div><a href="{{ route('admin.technologies.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Tech</a></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Technology</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@foreach($technologies as $t)
<tr><td style="font-weight:600">{{ $t->name }}</td><td><span class="badge badge-blue">{{ ucfirst($t->category) }}</span></td><td><span class="badge {{ $t->is_active ? 'badge-green' : 'badge-gray' }}">{{ $t->is_active ? 'Active' : 'Hidden' }}</span></td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.technologies.edit',$t) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.technologies.destroy',$t) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div></div>
@endsection

