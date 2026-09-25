@extends('admin.layouts.app')
@section('title','Clients')
@section('breadcrumb')<span>></span><span class="current">Clients</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Clients & Partners</h1></div><a href="{{ route('admin.clients.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Client</a></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Client</th><th>Type</th><th>Website</th><th>Featured</th><th>Actions</th></tr></thead><tbody>
@foreach($clients as $c)
<tr><td><div style="font-weight:600">{{ $c->name }}</div></td><td><span class="badge badge-blue">{{ ucfirst($c->type) }}</span></td><td style="font-size:13px">@if($c->website_url)<a href="{{ $c->website_url }}" target="_blank" style="color:#3b82f6">Visit</a>@else N/A @endif</td><td>{{ $c->is_featured ? 'Yes' : 'No' }}</td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.clients.edit',$c) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.clients.destroy',$c) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div></div>
@endsection

