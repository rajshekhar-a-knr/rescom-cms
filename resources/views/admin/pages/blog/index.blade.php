@extends('admin.layouts.app')
@section('title','Blog Posts')
@section('breadcrumb')<span>></span><span class="current">Blog</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Blog Posts</h1><p class="page-subtitle">Manage your content marketing articles</p></div>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Post</a>
</div>
<div class="card">
    <div class="table-container">
        <table>
            <thead><tr><th>Title</th><th>Category</th><th>Author</th><th>Status</th><th>Views</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td><div style="font-weight:600;font-size:13.5px">{{ Str::limit($post->title,55) }}</div>@if($post->is_featured)<span class="badge badge-yellow" style="font-size:10px">Featured</span>@endif</td>
                    <td><span class="badge badge-blue">{{ $post->category?->name ?? 'Uncategorized' }}</span></td>
                    <td style="font-size:13px">{{ $post->author?->name ?? 'Admin' }}</td>
                    <td><span class="badge {{ $post->status==='published' ? 'badge-green' : 'badge-yellow' }}">{{ ucfirst($post->status) }}</span></td>
                    <td style="font-size:13px;color:#64748b">{{ number_format($post->views) }}</td>
                    <td style="font-size:12px;color:#94a3b8">{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</td>
                    <td><div style="display:flex;gap:6px"><a href="{{ route('admin.blog.edit',$post) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.blog.destroy',$post) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete post?"><i class="fas fa-trash"></i></button></form></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $posts->links() }}</div>
</div>
@endsection

