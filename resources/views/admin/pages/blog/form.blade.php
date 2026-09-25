@extends('admin.layouts.app')
@section('title', isset($post) ? 'Edit Post' : 'New Post')
@section('head')<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css">@endsection
@section('breadcrumb')<span>></span><a href="{{ route('admin.blog.index') }}" style="color:#94a3b8;text-decoration:none">Blog</a><span>></span><span class="current">{{ isset($post) ? 'Edit' : 'New' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($post) ? 'Edit Post' : 'New Blog Post' }}</h1>
    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<form class="single-card-form" action="{{ isset($post) ? route('admin.blog.update',$post) : route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf @if(isset($post)) @method('PUT') @endif
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Post Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$post->title??'') }}" required style="font-size:18px;padding:12px"></div>
                    <div class="form-group"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt',$post->excerpt??'') }}</textarea></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">Content</h3></div>
                <div class="card-body"><textarea name="content" id="editor" class="form-control" rows="20">{{ old('content',$post->content??'') }}</textarea></div>
            </div>
        </div>
        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Publish</h3></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Status</label><select name="status" class="form-control"><option value="draft" {{ old('status',$post->status??'draft')==='draft'?'selected':'' }}>Draft</option><option value="published" {{ old('status',$post->status??'')==='published'?'selected':'' }}>Published</option><option value="archived" {{ old('status',$post->status??'')==='archived'?'selected':'' }}>Archived</option></select></div>
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Featured</label><label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$post->is_featured??false)?'checked':'' }}><span class="toggle-slider"></span></label></div>
                    <div class="form-group" style="margin-top:12px"><label class="form-label">Reading Time (min)</label><input type="number" name="reading_time" class="form-control" value="{{ old('reading_time',$post->reading_time??5) }}"></div>
                </div>
            </div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Category & Tags</h3></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Category</label><select name="category_id" class="form-control"><option value="">Uncategorized</option>@foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id',$post->category_id??'')==$c->id?'selected':'' }}>{{ $c->name }}</option>@endforeach</select></div>
                    <div class="form-group"><label class="form-label">Tags</label><div style="display:flex;flex-wrap:wrap;gap:8px">@foreach($tags as $tag)<label style="display:flex;align-items:center;gap:5px;font-size:13px;cursor:pointer"><input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ isset($post) && $post->tags->contains($tag->id)?'checked':'' }}> {{ $tag->name }}</label>@endforeach</div></div>
                </div>
            </div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Featured Image</h3></div>
                <div class="card-body">@if(isset($post) && $post->featured_image)<img src="{{ media_url($post->featured_image) }}" style="width:100%;border-radius:8px;margin-bottom:10px">@endif<input type="file" name="featured_image" class="form-control" accept="image/*"></div>
            </div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">SEO</h3></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="{{ old('meta_title',$post->meta_title??'') }}"></div>
                    <div class="form-group"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description',$post->meta_description??'') }}</textarea></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($post) ? 'Update' : 'Submit' }}</button>
    </div>
</form>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>
<script>new SimpleMDE({ element: document.getElementById("editor"), spellChecker: false });</script>
@endsection



