@extends('admin.layouts.app')
@section('title', isset($technology) ? 'Edit Technology' : 'Add Technology')
@section('breadcrumb')<span>></span><a href="{{ route('admin.technologies.index') }}" style="color:#94a3b8;text-decoration:none">Technologies</a><span>></span><span class="current">{{ isset($technology) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($technology) ? 'Edit' : 'Add' }} Technology</h1><a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<div style="max-width:500px"><form class="single-card-form" action="{{ isset($technology) ? route('admin.technologies.update',$technology) : route('admin.technologies.store') }}" method="POST">
@csrf @if(isset($technology)) @method('PUT') @endif
<div class="card"><div class="card-body">
<div class="form-group"><label class="form-label">Technology Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$technology->name??'') }}" required></div>
<div class="form-group"><label class="form-label">Category</label><select name="category" class="form-control"><option value="frontend">Frontend</option><option value="backend">Backend</option><option value="mobile">Mobile</option><option value="database">Database</option><option value="cloud">Cloud</option><option value="devops">DevOps</option><option value="other">Other</option></select></div>
<div class="form-row"><div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$technology->sort_order??0) }}"></div><div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:26px"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$technology->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div></div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($technology) ? 'Update' : 'Submit' }}</button>
</div>
</div></div>
</form></div>
@endsection

