@extends('admin.layouts.app')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')
@section('breadcrumb')<span>></span><a href="{{ route('admin.testimonials.index') }}" style="color:#94a3b8;text-decoration:none">Testimonials</a><span>></span><span class="current">{{ isset($testimonial) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($testimonial) ? 'Edit' : 'Add' }} Testimonial</h1><a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<form class="single-card-form" action="{{ isset($testimonial) ? route('admin.testimonials.update',$testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
@csrf @if(isset($testimonial)) @method('PUT') @endif
<div class="card">
    <div class="card-header"><h3 class="card-title">Testimonial Details</h3></div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Client Name *</label>
                <input type="text" name="client_name" class="form-control" value="{{ old('client_name',$testimonial->client_name??'') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Designation</label>
                <input type="text" name="client_designation" class="form-control" value="{{ old('client_designation',$testimonial->client_designation??'') }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Company</label>
                <input type="text" name="client_company" class="form-control" value="{{ old('client_company',$testimonial->client_company??'') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Rating (1-5)</label>
                <select name="rating" class="form-control">
                    @for($i=5;$i>=1;$i--)
                        <option value="{{ $i }}" {{ old('rating',$testimonial->rating??5)==$i?'selected':'' }}>{{ $i }} Stars</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Testimonial Content *</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content',$testimonial->content??'') }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Project Type</label>
                <input type="text" name="project_type" class="form-control" value="{{ old('project_type',$testimonial->project_type??'') }}" placeholder="e.g. Web Development, Mobile App">
            </div>
            <div class="form-group">
                <label class="form-label">Client Photo</label>
                @if(isset($testimonial) && $testimonial->client_photo)
                    @php
                        $photo = $testimonial->client_photo;
                        $photoUrl = \Illuminate\Support\Str::startsWith($photo, ['http://','https://']) ? $photo : media_url($photo);
                    @endphp
                    <div style="margin-bottom:10px">
                        <img src="{{ $photoUrl }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover">
                    </div>
                @endif
                <input type="file" name="client_photo" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="form-row" style="margin-top:6px">
            <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                <label style="margin:0;font-size:13px;font-weight:600">Active</label>
                <label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$testimonial->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label>
            </div>
            <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                <label style="margin:0;font-size:13px;font-weight:600">Featured</label>
                <label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$testimonial->is_featured??false)?'checked':'' }}><span class="toggle-slider"></span></label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($testimonial) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </div>
</div>
</form>
@endsection
