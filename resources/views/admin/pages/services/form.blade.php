@extends('admin.layouts.app')
@section('title', isset($service) ? 'Edit Service' : 'Add Service')
@section('breadcrumb')<span>></span><a href="{{ route('admin.services.index') }}" style="color:#94a3b8;text-decoration:none">Services</a><span>></span><span class="current">{{ isset($service) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($service) ? 'Edit Service' : 'Add New Service' }}</h1>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<form class="single-card-form" action="{{ isset($service) ? route('admin.services.update',$service) : route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf @if(isset($service)) @method('PUT') @endif
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Service Details</h3></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Service Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$service->title??'') }}" required></div>
                    <div class="form-row">
                        <div class="form-group"><label class="form-label">Category</label><select name="category_id" class="form-control"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id',$service->category_id??'')==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach</select></div>
                        <div class="form-group"><label class="form-label">Icon (Font Awesome)</label><input type="text" name="icon" class="form-control" placeholder="fas fa-code" value="{{ old('icon',$service->icon??'') }}"></div>
                    </div>
                    <div class="form-group"><label class="form-label">Short Description</label><textarea name="short_description" class="form-control" rows="2">{{ old('short_description',$service->short_description??'') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Full Description</label><textarea name="description" class="form-control" rows="10">{{ old('description',$service->description??'') }}</textarea></div>
                    <div class="form-row">
                        <div class="form-group"><label class="form-label">Features (one per line)</label><textarea name="features" class="form-control" rows="6">{{ old('features', isset($service->features) ? implode("\n",$service->features) : '') }}</textarea></div>
                        <div class="form-group"><label class="form-label">Technologies (one per line)</label><textarea name="technologies" class="form-control" rows="6">{{ old('technologies', isset($service->technologies) ? implode("\n",$service->technologies) : '') }}</textarea></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Settings</h3></div>
                <div class="card-body">
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label class="form-label" style="margin:0">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$service->is_active??true) ? 'checked' : '' }}><span class="toggle-slider"></span></label></div>
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:12px"><label class="form-label" style="margin:0">Featured</label><label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$service->is_featured??false) ? 'checked' : '' }}><span class="toggle-slider"></span></label></div>
                    <div class="form-group" style="margin-top:12px">
                        <label class="form-label" style="font-weight:700">Display / Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0" placeholder="0">
                        <small style="font-size:11px;color:#64748b;display:block;margin-top:4px">Lower numbers appear first on the website (0, 1, 2...)</small>
                    </div>
                </div>
            </div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Featured Image</h3></div>
                <div class="card-body">
                    @if(isset($service) && $service->featured_image)<img src="{{ media_url($service->featured_image) }}" style="width:100%;border-radius:8px;margin-bottom:10px">@endif
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">SEO</h3></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="{{ old('meta_title',$service->meta_title??'') }}"></div>
                    <div class="form-group"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description',$service->meta_description??'') }}</textarea></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($service) ? 'Update' : 'Submit' }}</button>
    </div>
</form>
@endsection




