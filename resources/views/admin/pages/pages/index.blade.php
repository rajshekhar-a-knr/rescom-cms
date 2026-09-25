@extends('admin.layouts.app')
@section('title','Pages')
@section('breadcrumb')<span>></span><span class="current">Pages</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Pages</h1></div><a href="{{ route('admin.pages.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Page</a></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Title</th><th>Slug</th><th>Header</th><th>Footer</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@foreach($pages as $page)
<tr><td style="font-weight:600">{{ $page->title }}</td><td style="font-size:13px;color:#64748b">/page/{{ $page->slug }}</td><td><span class="badge {{ $page->show_in_header ? 'badge-green' : 'badge-gray' }}">{{ $page->show_in_header ? 'Yes' : 'No' }}</span></td><td><span class="badge {{ $page->show_in_footer ? 'badge-green' : 'badge-gray' }}">{{ $page->show_in_footer ? 'Yes' : 'No' }}</span></td><td style="font-size:13px">{{ $page->sort_order }}</td><td><span class="badge {{ $page->status==='published' ? 'badge-green' : 'badge-yellow' }}">{{ ucfirst($page->status) }}</span></td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.pages.edit',$page) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.pages.destroy',$page) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div></div>
@endsection

