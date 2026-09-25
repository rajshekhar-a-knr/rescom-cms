@extends('admin.layouts.app')
@section('title', isset($benefit) ? 'Edit Benefit' : 'Add Benefit')
@section('breadcrumb')<span>></span><a href="{{ route('admin.career-benefits.index') }}" style="color:#94a3b8;text-decoration:none">Career Benefits</a><span>></span><span class="current">{{ isset($benefit) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($benefit) ? 'Edit' : 'Add' }} Benefit</h1>
    <a href="{{ route('admin.career-benefits.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form class="single-card-form" action="{{ isset($benefit) ? route('admin.career-benefits.update', $benefit) : route('admin.career-benefits.store') }}" method="POST">
    @csrf @if(isset($benefit)) @method('PUT') @endif
    <div class="card">
        <div class="card-header"><h3 class="card-title">Benefit Details</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Icon (Font Awesome)</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $benefit->icon ?? '') }}" placeholder="fas fa-graduation-cap">
                </div>
                <div class="form-group">
                    <label class="form-label">Color</label>
                    <input type="text" name="color" class="form-control" value="{{ old('color', $benefit->color ?? '') }}" placeholder="#3b82f6">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $benefit->title ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $benefit->description ?? '') }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $benefit->sort_order ?? 0) }}">
                </div>
                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                    <label style="margin:0;font-size:13px;font-weight:600">Active</label>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $benefit->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($benefit) ? 'Update' : 'Submit' }}</button>
            </div>
        </div>
    </div>
</form>
@endsection
