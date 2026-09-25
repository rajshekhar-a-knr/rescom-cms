@extends('admin.layouts.app')
@section('title', isset($banner) ? 'Edit Banner' : 'Add Banner')
@section('breadcrumb')<span>></span><a href="{{ route('admin.banners.index') }}" style="color:#94a3b8;text-decoration:none">Banners</a><span>></span><span class="current">{{ isset($banner) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">{{ isset($banner) ? 'Edit' : 'Add' }} Banner</h1>
        <p class="page-subtitle">Build a high-converting hero slide with clear messaging and strong CTAs.</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<form class="single-card-form" action="{{ isset($banner) ? route('admin.banners.update',$banner) : route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
@csrf @if(isset($banner)) @method('PUT') @endif
<div class="form-layout">
    <div class="form-main">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Banner Content</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Badge Text (optional)</label>
                    <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text',$banner->badge_text??'') }}" placeholder="e.g. Trusted by 200+ Companies">
                </div>
                <div class="form-group">
                    <label class="form-label">Subtitle (optional)</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle',$banner->subtitle??'') }}" placeholder="e.g. Next-Gen IT Services">
                </div>
                <div class="form-group">
                    <label class="form-label">Main Title *</label>
                    <textarea name="title" class="form-control" rows="3" required>{{ old('title',$banner->title??'') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description',$banner->description??'') }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Button 1 Text</label>
                        <input type="text" name="btn1_text" class="form-control" value="{{ old('btn1_text',$banner->btn1_text??'') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Button 1 URL</label>
                        <input type="text" name="btn1_url" class="form-control" value="{{ old('btn1_url',$banner->btn1_url??'') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Button 2 Text</label>
                        <input type="text" name="btn2_text" class="form-control" value="{{ old('btn2_text',$banner->btn2_text??'') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Button 2 URL</label>
                        <input type="text" name="btn2_url" class="form-control" value="{{ old('btn2_url',$banner->btn2_url??'') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-sidebar">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Settings</h3>
            </div>
            <div class="card-body">
                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                    <label style="margin:0;font-size:13px;font-weight:600">Active</label>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active',$banner->is_active??true)?'checked':'' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="form-group" style="margin-top:12px">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$banner->sort_order??1) }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Background Image</h3>
            </div>
            <div class="card-body">
                @if(isset($banner) && $banner->image)
                    <img src="{{ media_url($banner->image) }}" class="image-preview">
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <p class="form-hint">Recommended: 1920x1080px JPG/PNG</p>
            </div>
        </div>
</div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($banner) ? 'Update' : 'Submit' }}</button>
</div>
</form>
@endsection





