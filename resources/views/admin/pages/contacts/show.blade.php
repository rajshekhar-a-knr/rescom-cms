@extends('admin.layouts.app')
@section('title','Inquiry Details')
@section('breadcrumb')<span>></span><a href="{{ route('admin.contacts.index') }}" style="color:#94a3b8;text-decoration:none">Inquiries</a><span>></span><span class="current">View</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Inquiry from {{ $contact->name }}</h1><p class="page-subtitle">{{ $contact->created_at->format('M d, Y h:i A') }}</p></div>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
    <div>
        <div class="card" style="margin-bottom:16px">
            <div class="card-header"><h3 class="card-title">Message</h3></div>
            <div class="card-body"><p style="line-height:1.8;color:#374151;font-size:15px;white-space:pre-wrap">{{ $contact->message }}</p></div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Send Reply</h3></div>
            <div class="card-body">
                <form class="single-card-form" action="{{ route('admin.contacts.reply',$contact->id) }}" method="POST">
                    @csrf
                    <div class="form-group"><label class="form-label">Reply Message *</label><textarea name="reply_message" class="form-control" rows="6" required placeholder="Type your reply..."></textarea></div>
                    <div class="form-group"><label class="form-label">Admin Notes (private)</label><textarea name="admin_notes" class="form-control" rows="2">{{ $contact->admin_notes }}</textarea></div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send Reply</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <div class="card" style="margin-bottom:16px">
            <div class="card-header"><h3 class="card-title">Contact Details</h3></div>
            <div class="card-body">
                @foreach(['Name'=>$contact->name,'Email'=>$contact->email,'Phone'=>$contact->phone,'Company'=>$contact->company,'Service'=>$contact->service_interested,'Budget'=>$contact->budget_range,'IP'=>$contact->ip_address] as $label=>$value)
                @if($value)<div style="margin-bottom:12px"><div style="font-size:11px;text-transform:uppercase;color:#94a3b8;margin-bottom:2px">{{ $label }}</div><div style="font-weight:500;color:#1e293b">{{ $value }}</div></div>@endif
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Update Status</h3></div>
            <div class="card-body">
                <form class="single-card-form" action="{{ route('admin.contacts.status',$contact->id) }}" method="POST">
                    @csrf
                    <div class="form-group"><select name="status" class="form-control">@foreach(['new','read','replied','spam','archived'] as $s)<option value="{{ $s }}" {{ $contact->status===$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
                    <button class="btn btn-primary" style="width:100%">Update</button>
                </form>
                <div style="margin-top:10px;display:flex;gap:8px">
                    <a href="mailto:{{ $contact->email }}" class="btn btn-secondary" style="flex:1;justify-content:center"><i class="fas fa-envelope"></i></a>
                    @if($contact->phone)<a href="tel:{{ $contact->phone }}" class="btn btn-secondary" style="flex:1;justify-content:center"><i class="fas fa-phone"></i></a>@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

