@extends('admin.layouts.app')
@section('title','Hero Banners')
@section('breadcrumb')<span>></span><span class="current">Banners</span>@endsection
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Hero Banners</h1>
        <p class="page-subtitle">Manage homepage slider banners</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Banner</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title">Banner List</div>
            <div class="card-subtitle">{{ $banners->count() }} total banners</div>
        </div>
        <div class="table-toolbar">
            <div class="table-search">
                <i class="fas fa-search"></i>
                <input type="text" id="tableSearch" placeholder="Search title, subtitle, buttons...">
            </div>
            <select id="statusFilter" class="table-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="hidden">Hidden</option>
            </select>
            <select id="pageSize" class="table-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>
    <div class="table-container table-sticky">
        <table class="table-compact" id="bannersTable">
            <thead>
                <tr>
                    <th>Banner</th>
                    <th>Buttons</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $b)
                <tr data-row="banner"
                    data-title="{{ Str::lower($b->title ?? '') }}"
                    data-subtitle="{{ Str::lower($b->subtitle ?? '') }}"
                    data-buttons="{{ Str::lower(($b->btn1_text ?? '').' '.($b->btn2_text ?? '')) }}"
                    data-status="{{ $b->is_active ? 'active' : 'hidden' }}"
                    data-order="{{ $b->sort_order }}">
                    <td>
                        <div style="font-weight:600;font-size:13.5px">{{ Str::limit($b->title,60) }}</div>
                        @if($b->subtitle)<div style="font-size:12px;color:#3b82f6">{{ $b->subtitle }}</div>@endif
                    </td>
                    <td style="font-size:12px">
                        @if($b->btn1_text)<span class="badge badge-blue">{{ $b->btn1_text }}</span>@endif
                        @if($b->btn2_text)<span class="badge badge-gray">{{ $b->btn2_text }}</span>@endif
                    </td>
                    <td><span class="badge {{ $b->is_active ? 'badge-green' : 'badge-gray' }}">{{ $b->is_active ? 'Active' : 'Hidden' }}</span></td>
                    <td>{{ $b->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.banners.edit',$b) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                            <form class="single-card-form" action="{{ route('admin.banners.destroy',$b) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-confirm="Delete banner?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr class="table-empty" style="display:none"><td colspan="5">No banners match your filters.</td></tr>
            </tbody>
        </table>
    </div>
    <div class="table-footer">
        <div class="table-info" id="tableInfo">Showing 0 of 0</div>
        <div class="table-pagination">
            <button class="btn btn-secondary btn-sm" id="prevPage" disabled>Prev</button>
            <span class="table-info" id="pageInfo">1 / 1</span>
            <button class="btn btn-secondary btn-sm" id="nextPage" disabled>Next</button>
        </div>
    </div>
</div>
@endsection


