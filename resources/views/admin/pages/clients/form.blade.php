@extends('admin.layouts.app')
@section('title', isset($client) ? 'Edit Client' : 'Add Client')
@section('breadcrumb')<span>></span><a href="{{ route('admin.clients.index') }}" style="color:#94a3b8;text-decoration:none">Clients</a><span>></span><span class="current">{{ isset($client) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($client) ? 'Edit' : 'Add' }} Client</h1><a href="{{ route('admin.clients.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<div style="max-width:600px">
<form class="single-card-form" action="{{ isset($client) ? route('admin.clients.update',$client) : route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
@csrf @if(isset($client)) @method('PUT') @endif
<div class="card"><div class="card-body">
<div class="form-group"><label class="form-label">Company Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$client->name??'') }}" required></div>
<div class="form-group"><label class="form-label">Type</label><select name="type" class="form-control"><option value="client" {{ old('type',$client->type??'')==='client'?'selected':'' }}>Client</option><option value="partner" {{ old('type',$client->type??'')==='partner'?'selected':'' }}>Partner</option><option value="technology" {{ old('type',$client->type??'')==='technology'?'selected':'' }}>Technology Partner</option></select></div>
<div class="form-group"><label class="form-label">Website URL</label><input type="url" name="website_url" class="form-control" value="{{ old('website_url',$client->website_url??'') }}"></div>
<div class="form-group"><label class="form-label">Logo</label>@if(isset($client) && $client->logo)<img src="{{ media_url($client->logo) }}" style="height:40px;margin-bottom:8px;display:block">@endif<input type="file" name="logo" class="form-control" accept="image/*"></div>
<div class="form-row">
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$client->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Featured</label><label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$client->is_featured??false)?'checked':'' }}><span class="toggle-slider"></span></label></div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($client) ? 'Update' : 'Submit' }}</button>
</div>
</div></div>
</form></div>
@endsection



