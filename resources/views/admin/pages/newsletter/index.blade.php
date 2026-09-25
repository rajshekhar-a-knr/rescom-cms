@extends('admin.layouts.app')
@section('title','Newsletter Subscribers')
@section('breadcrumb')<span>&rsaquo;</span><span class="current">Newsletter</span>@endsection
@section('content')
@php
    $totalSubscribers = \App\Models\NewsletterSubscriber::count();
    $activeSubscribers = \App\Models\NewsletterSubscriber::where('status', 'active')->count();
    $inactiveSubscribers = \App\Models\NewsletterSubscriber::where('status', 'inactive')->count();
@endphp
<div class="page-header">
    <div>
        <h1 class="page-title">Newsletter Subscribers</h1>
        <p class="page-subtitle">Manage and export your subscriber list</p>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
        <form class="single-card-form" action="{{ route('admin.newsletter.export') }}" method="POST">
            @csrf
            <button class="btn btn-primary"><i class="fas fa-download"></i> Export CSV</button>
        </form>
        <a href="{{ route('admin.newsletter') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
    </div>
</div>

<div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap">
    <span class="badge badge-blue">Total {{ $totalSubscribers }}</span>
    <span class="badge badge-green">Active {{ $activeSubscribers }}</span>
    <span class="badge badge-gray">Inactive {{ $inactiveSubscribers }}</span>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Subscribed At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $s)
                @php
                    $status = $s->status ?: 'active';
                    $badge = $status === 'active' ? 'green' : ($status === 'inactive' ? 'gray' : 'red');
                    $dateValue = $s->subscribed_at ?? $s->created_at;
                @endphp
                <tr>
                    <td style="font-weight:600">{{ $s->name ?? '—' }}</td>
                    <td><a href="mailto:{{ $s->email }}" style="color:#3b82f6;text-decoration:none">{{ $s->email }}</a></td>
                    <td><span class="badge badge-{{ $badge }}">{{ ucfirst($status) }}</span></td>
                    <td style="font-size:12px;color:#94a3b8">{{ $dateValue ? $dateValue->format('M d, Y') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:#94a3b8;padding:24px">No subscribers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $subscribers->links() }}</div>
</div>
@endsection

