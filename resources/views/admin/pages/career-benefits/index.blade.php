@extends('admin.layouts.app')
@section('title','Career Benefits')
@section('breadcrumb')<span>></span><span class="current">Career Benefits</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">Career Benefits</h1>
    <a href="{{ route('admin.career-benefits.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Benefit</a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width:70px">Order</th>
                    <th>Title</th>
                    <th style="width:140px">Color</th>
                    <th style="width:120px">Status</th>
                    <th style="width:140px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($benefits as $benefit)
                    <tr>
                        <td>{{ $benefit->sort_order }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px">
                                @if($benefit->icon)
                                    <i class="{{ $benefit->icon }}" style="color:{{ $benefit->color ?? '#3b82f6' }}"></i>
                                @endif
                                <div style="font-weight:600">{{ $benefit->title }}</div>
                            </div>
                            @if($benefit->description)
                                <div style="color:#94a3b8;font-size:12.5px;margin-top:4px">{{ Str::limit($benefit->description, 80) }}</div>
                            @endif
                        </td>
                        <td>{{ $benefit->color ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $benefit->is_active ? 'badge-green' : 'badge-gray' }}">{{ $benefit->is_active ? 'Active' : 'Inactive' }}</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.career-benefits.edit', $benefit) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.career-benefits.destroy', $benefit) }}" method="POST" class="single-card-form">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-confirm="Delete this benefit?"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:18px">No benefits added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
