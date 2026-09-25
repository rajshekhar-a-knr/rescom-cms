@extends('admin.layouts.app')
@section('title','Products')
@section('breadcrumb')<span>></span><span class="current">Products</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Products </h1></div>
    <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Project</a>
</div>
<div class="card">
    <div class="table-container">
        <table>
            <thead><tr><th>Project</th><th>Client</th><th>Category</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($portfolios as $p)
                <tr>
                    <td><div style="display:flex;align-items:center;gap:10px">@if($p->featured_image)<img src="{{ media_url($p->featured_image) }}" style="width:50px;height:35px;object-fit:cover;border-radius:6px">@else<div style="width:50px;height:35px;background:#eff6ff;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:18px"><i class="fas fa-briefcase"></i></div>@endif<div><div style="font-weight:600">{{ Str::limit($p->title,40) }}</div>@if($p->is_featured)<span class="badge badge-yellow" style="font-size:10px">Featured</span>@endif</div></div></td>
                    <td style="font-size:13px">{{ $p->client_name ?? '-' }}</td>
                    <td><span class="badge badge-blue">{{ $p->category?->name ?? 'General' }}</span></td>
                    <td><span class="badge badge-blue" style="font-weight:700">{{ $p->sort_order }}</span></td>
                    <td><span class="badge {{ $p->is_active ? 'badge-green' : 'badge-gray' }}">{{ $p->is_active ? 'Active' : 'Hidden' }}</span></td>
                    <td><div style="display:flex;gap:6px"><a href="{{ route('admin.portfolio.edit',$p) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.portfolio.destroy',$p) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $portfolios->links() }}</div>
</div>
@endsection



