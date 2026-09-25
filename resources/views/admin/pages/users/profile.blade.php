@extends('admin.layouts.app')
@section('title','My Profile')
@section('breadcrumb')<span>></span><span class="current">Profile</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">My Profile</h1></div>
<div style="max-width:600px">
<form class="single-card-form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="card"><div class="card-header"><h3 class="card-title">Profile Information</h3></div><div class="card-body">
<div style="display:flex;align-items:center;gap:16px;margin-bottom:20px">
@if(auth()->user()->avatar)
    <img src="{{ media_url(auth()->user()->avatar) }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid #3b82f6;box-shadow:0 4px 12px rgba(37,99,235,0.18);" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
    <div style="display:none;width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#2563eb,#1d4ed8);color:#fff;align-items:center;justify-content:center;font-size:32px;font-weight:700;border:3px solid #3b82f6;box-shadow:0 4px 12px rgba(37,99,235,0.18);">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    </div>
@else
    <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#2563eb,#1d4ed8);color:#fff;display:flex;align-items:center;justify-content:center;font-size:32px;font-weight:700;border:3px solid #3b82f6;box-shadow:0 4px 12px rgba(37,99,235,0.18);">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    </div>
@endif
<div><label class="form-label">Change Photo</label><input type="file" name="avatar" class="form-control" accept="image/*"></div>
</div>
<div class="form-row"><div class="form-group"><label class="form-label">Full Name</label><input type="text" name="name" class="form-control" value="{{ old('name',auth()->user()->name) }}" required></div><div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email',auth()->user()->email) }}" required></div></div>
<hr style="border:none;border-top:1px solid var(--border);margin:20px 0">
<h4 style="font-size:14px;font-weight:700;margin-bottom:16px">Change Password</h4>
<div class="form-row"><div class="form-group"><label class="form-label">New Password</label><input type="password" name="password" class="form-control"></div><div class="form-group"><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" class="form-control"></div></div>
<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Profile</button>
</div></div>
</form></div>
@endsection

