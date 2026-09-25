@extends('admin.layouts.app')
@section('title','Legal Pages')
@section('breadcrumb')<span>></span><span class="current">Legal Pages</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Legal Pages</h1></div>
    <a href="{{ route('admin.legal-pages.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Legal Page</a>
</div>
<div class="card">
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
            <tr>
                <td style="font-weight:600">{{ $page->title }}</td>
                <td style="font-size:13px;color:#64748b">/legal/{{ $page->slug }}</td>
                <td style="font-size:13px">{{ $page->sort_order }}</td>
                <td><span class="badge {{ $page->is_active ? 'badge-green' : 'badge-gray' }}">{{ $page->is_active ? 'Active' : 'Hidden' }}</span></td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.legal-pages.edit',$page) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                        <form class="single-card-form" action="{{ route('admin.legal-pages.destroy',$page) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


