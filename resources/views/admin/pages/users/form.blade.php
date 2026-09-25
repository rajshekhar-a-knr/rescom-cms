@extends('admin.layouts.app')
@section('title', isset($user) ? 'Edit User' : 'Add User')
@section('breadcrumb')<span>></span><a href="{{ route('admin.users.index') }}" style="color:#94a3b8;text-decoration:none">Users</a><span>></span><span class="current">{{ isset($user) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($user) ? 'Edit' : 'Add' }} Admin User</h1><a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<div style="max-width:600px">
<form class="single-card-form" action="{{ isset($user) ? route('admin.users.update',$user) : route('admin.users.store') }}" method="POST">
@csrf @if(isset($user)) @method('PUT') @endif
<div class="card"><div class="card-body">
<div class="form-row"><div class="form-group"><label class="form-label">Full Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$user->name??'') }}" required></div><div class="form-group"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" value="{{ old('email',$user->email??'') }}" required></div></div>
<div class="form-row"><div class="form-group"><label class="form-label">Password {{ isset($user) ? '(leave blank to keep)' : '*' }}</label><input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}></div><div class="form-group"><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" class="form-control"></div></div>
@if(auth()->user()->isSuperAdmin())
<div class="form-group"><label class="form-label">Role</label><select name="role" class="form-control"><option value="editor" {{ old('role',$user->role??'')==='editor'?'selected':'' }}>Editor</option><option value="admin" {{ old('role',$user->role??'')==='admin'?'selected':'' }}>Admin</option><option value="superadmin" {{ old('role',$user->role??'')==='superadmin'?'selected':'' }}>Super Admin</option></select></div>
@endif
@if(auth()->user()->isSuperAdmin() && !empty($permissions))
<div class="form-group">
    <label class="form-label">Custom Permissions</label>
    <div class="card" style="border:1px solid #e2e8f0">
        <div class="card-body" style="max-height:240px;overflow:auto;display:grid;grid-template-columns:1fr 1fr;gap:8px">
            @foreach($permissions as $perm)
                <label style="display:flex;align-items:center;gap:8px;font-size:13px">
                    <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                        {{ in_array($perm->id, old('permissions', $assignedPermissions ?? [])) ? 'checked' : '' }}>
                    <span>{{ $perm->label }}</span>
                </label>
            @endforeach
        </div>
    </div>
    <div style="font-size:12px;color:#94a3b8;margin-top:6px">If none selected, the role defaults apply.</div>
</div>
@endif
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$user->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($user) ? 'Update' : 'Submit' }}</button>
</div>
</div></div>
</form></div>
@endsection

