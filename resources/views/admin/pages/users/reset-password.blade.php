@extends('admin.layouts.app')
@section('title','Reset Password')
@section('breadcrumb')<span>></span><a href="{{ route('admin.users.index') }}" style="color:#94a3b8;text-decoration:none">Users</a><span>></span><span class="current">Reset Password</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">Reset Password</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div style="max-width:520px">
<form class="single-card-form" action="{{ route('admin.users.update-password', $user) }}" method="POST">
@csrf
<div class="card"><div class="card-body">
    <div class="form-group">
        <label class="form-label">User</label>
        <input type="text" class="form-control" value="{{ $user->name }} ({{ $user->email }})" disabled>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label class="form-label">New Password *</label>
            <input type="password" name="password" class="form-control" required minlength="8">
        </div>
        <div class="form-group">
            <label class="form-label">Confirm Password *</label>
            <input type="password" name="password_confirmation" class="form-control" required minlength="8">
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> Reset Password</button>
    </div>
</div></div>
</form>
</div>
@endsection
