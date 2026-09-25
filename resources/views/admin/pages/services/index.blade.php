@extends('admin.layouts.app')
@section('title','Services')
@section('breadcrumb')<span>></span><span class="current">Services</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Services</h1><p class="page-subtitle">Manage your IT service offerings</p></div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Service</a>
</div>
<div class="card">
    <div class="table-container">
        <table>
            <thead><tr><th>Service</th><th>Category</th><th>Featured</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td><div style="display:flex;align-items:center;gap:10px"><div style="width:36px;height:36px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="{{ $service->icon ?? 'fas fa-code' }}" style="color:#3b82f6"></i></div><div><div style="font-weight:600;font-size:13.5px">{{ $service->title }}</div><div style="font-size:11px;color:#94a3b8">{{ Str::limit($service->short_description,50) }}</div></div></div></td>
                    <td><span class="badge badge-blue">{{ $service->category?->name ?? 'None' }}</span></td>
                    <td>{{ $service->is_featured ? 'Yes' : 'No' }}</td>
                    <td><span class="badge {{ $service->is_active ? 'badge-green' : 'badge-gray' }}">{{ $service->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td><span class="badge badge-blue" style="font-weight:700">{{ $service->sort_order }}</span></td>
                    <td><div style="display:flex;gap:6px"><a href="{{ route('admin.services.edit',$service) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.services.destroy',$service) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $services->links() }}</div>
</div>
@endsection


