@extends('admin.layouts.app')
@section('title', isset($item) ? 'Edit Image' : 'Add Image')
@section('breadcrumb')<span>></span><a href="{{ route('admin.gallery.index') }}" style="color:#94a3b8;text-decoration:none">Gallery</a><span>></span><span class="current">{{ isset($item) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($item) ? 'Edit' : 'Add' }} Gallery Image</h1>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form class="single-card-form" action="{{ isset($item) ? route('admin.gallery.update',$item) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($item)) @method('PUT') @endif

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title',$item->title ?? '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category',$item->category ?? '') }}" placeholder="e.g. Office, Events">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Caption</label>
            <input type="text" name="caption" class="form-control" value="{{ old('caption',$item->caption ?? '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$item->sort_order ?? 0) }}">
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Image {{ isset($item) ? '(optional)' : '' }}</label>
        <input type="file" name="image" class="form-control image-resize" data-resize-max="1920" accept="image/*" {{ isset($item) ? '' : 'required' }}>
        @if(isset($item) && $item->image)
            <div style="margin-top:10px">
                <img src="{{ media_url($item->image) }}" class="img-preview" loading="lazy" decoding="async">
            </div>
        @endif
    </div>

    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
        <label style="margin:0;font-size:13px;font-weight:600">Active</label>
        <label class="toggle-switch">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active',$item->is_active ?? true)?'checked':'' }}>
            <span class="toggle-slider"></span>
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($item) ? 'Update' : 'Submit' }}</button>
    </div>
</form>
@endsection




