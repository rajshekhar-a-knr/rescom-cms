@extends('admin.layouts.app')
@section('title', isset($stat) ? 'Edit Stat' : 'Add Stat')
@section('breadcrumb')<span>></span><a href="{{ route('admin.stats.index') }}" style="color:#94a3b8;text-decoration:none">Stats</a><span>></span><span class="current">{{ isset($stat) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($stat) ? 'Edit' : 'Add' }} Stat</h1><a href="{{ route('admin.stats.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<div style="max-width:500px"><form class="single-card-form" action="{{ isset($stat) ? route('admin.stats.update',$stat) : route('admin.stats.store') }}" method="POST">
@csrf @if(isset($stat)) @method('PUT') @endif
<div class="card"><div class="card-body">
<div class="form-group"><label class="form-label">Stat Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$stat->title??'') }}" required placeholder="Projects Completed"></div>
<div class="form-row"><div class="form-group"><label class="form-label">Value *</label><input type="text" name="value" class="form-control" value="{{ old('value',$stat->value??'') }}" required placeholder="500"></div><div class="form-group"><label class="form-label">Suffix</label><input type="text" name="suffix" class="form-control" value="{{ old('suffix',$stat->suffix??'') }}" placeholder="+ or %"></div></div>
<div class="form-group"><label class="form-label">Icon (Font Awesome class)</label><input type="text" name="icon" class="form-control" value="{{ old('icon',$stat->icon??'') }}" placeholder="fas fa-rocket"></div>
<div class="form-row"><div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$stat->sort_order??0) }}"></div><div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:26px"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$stat->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div></div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($stat) ? 'Update' : 'Submit' }}</button>
</div>
</div></div>
</form></div>
@endsection

