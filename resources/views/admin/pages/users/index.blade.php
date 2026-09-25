@extends('admin.layouts.app')
@section('title','Admin Users')
@section('breadcrumb')<span>></span><span class="current">Users</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Admin Users</h1></div>
    @if(auth()->user()->isSuperAdmin())
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add User</a>
    @endif
</div>
<div class="card"><div class="table-container"><table><thead><tr><th>User</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th><th>Actions</th></tr></thead><tbody>
@foreach($users as $user)
@if($user->role === 'superadmin')
@continue
@endif
<tr><td><div style="display:flex;align-items:center;gap:10px"><div style="width:36px;height:36px;background:linear-gradient(135deg,#3b82f6,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:700">{{ strtoupper(substr($user->name,0,1)) }}</div><div style="font-weight:600">{{ $user->name }}</div></div></td>
<td style="font-size:13px">{{ $user->email }}</td>
<td><span class="badge {{ $user->role==='superadmin' ? 'badge-purple' : ($user->role==='admin' ? 'badge-blue' : 'badge-gray') }}">{{ ucfirst($user->role) }}</span></td>
<td><span class="badge {{ $user->is_active ? 'badge-green' : 'badge-red' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span></td>
<td style="font-size:12px;color:#94a3b8">{{ $user->created_at->format('M d, Y') }}</td>
<td>
    <div style="display:flex;gap:6px;flex-wrap:wrap">
        <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
        @if(auth()->user()->isSuperAdmin())
            <a href="{{ route('admin.users.reset-password',$user) }}" class="btn btn-light btn-sm" title="Reset Password"><i class="fas fa-key"></i></a>
        @endif
        @if($user->id !== auth()->id() && auth()->user()->isSuperAdmin())
            <form class="single-card-form" action="{{ route('admin.users.destroy',$user) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete user?"><i class="fas fa-trash"></i></button></form>
        @endif
    </div>
</td></tr>
@endforeach
</tbody></table></div></div>
@endsection

