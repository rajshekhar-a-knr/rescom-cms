@extends('admin.layouts.app')
@section('title','Inquiries')
@section('breadcrumb')<span>></span><span class="current">Inquiries</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Customer Inquiries</h1><p class="page-subtitle">Manage contact form submissions</p></div>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
</div>
<div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap">
    @foreach([''=>'All','new'=>'New','read'=>'Read','replied'=>'Replied','spam'=>'Spam'] as $s=>$l)
    <a href="{{ route('admin.contacts.index',['status'=>$s]) }}" class="btn {{ request('status')===$s ? 'btn-primary' : 'btn-secondary' }}">{{ $l }}
        @if(isset($counts[$s ?: 'all'])) <span style="background:rgba(0,0,0,0.15);padding:1px 7px;border-radius:50px;font-size:11px;margin-left:4px">{{ $counts[$s ?: 'all'] }}</span>@endif
    </a>
    @endforeach
</div>
<div class="card">
    <div class="table-container">
        <table>
            <thead><tr><th>Contact</th><th>Service</th><th>Message</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr style="{{ $contact->status==='new' ? 'background:#fffbeb' : '' }}">
                    <td><div style="font-weight:600">{{ $contact->name }} @if($contact->status==='new')<i class="fas fa-circle" style="color:#ef4444;font-size:10px"></i>@endif</div><div style="font-size:12px;color:#3b82f6"><a href="mailto:{{ $contact->email }}" style="color:#3b82f6;text-decoration:none">{{ $contact->email }}</a></div>@if($contact->phone)<div style="font-size:12px;color:#94a3b8">{{ $contact->phone }}</div>@endif</td>
                    <td style="font-size:13px">{{ $contact->service_interested ?? '>' }}</td>
                    <td style="font-size:13px;max-width:200px">{{ Str::limit($contact->message,80) }}</td>
                    <td>@php $colors=['new'=>'blue','read'=>'yellow','replied'=>'green','spam'=>'red','archived'=>'gray']; @endphp<span class="badge badge-{{ $colors[$contact->status] ?? 'gray' }}">{{ ucfirst($contact->status) }}</span></td>
                    <td style="font-size:12px;color:#94a3b8">{{ $contact->created_at->format('M d, Y') }}</td>
                    <td><div style="display:flex;gap:6px"><a href="{{ route('admin.contacts.show',$contact->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a><form class="single-card-form" action="{{ route('admin.contacts.destroy',$contact->id) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $contacts->links() }}</div>
</div>
@endsection

