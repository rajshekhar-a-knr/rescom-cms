@extends('admin.layouts.app')
@section('title','Email Settings')
@section('breadcrumb')<span>></span><span class="current">Email Settings</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">Email Configuration</h1></div>
<div style="display:flex;gap:0;margin-bottom:24px;border-bottom:2px solid var(--border)">
    @foreach([
        route('admin.settings.index') => 'General',
        route('admin.settings.header') => 'Header',
        route('admin.settings.footer') => 'Footer',
        route('admin.settings.seo') => 'SEO',
        route('admin.settings.social') => 'Social',
        route('admin.settings.topscroller') => 'Top Scroller',
        route('admin.settings.email') => 'Email',
        route('admin.settings.content') => 'Content'
    ] as $url => $label)
    <a href="{{ $url }}" style="padding:10px 20px;text-decoration:none;font-size:14px;font-weight:600;border-bottom:3px solid {{ request()->url()===$url ? 'var(--primary)' : 'transparent' }};color:{{ request()->url()===$url ? 'var(--primary)' : 'var(--text-muted)' }};margin-bottom:-2px;white-space:nowrap">{{ $label }}</a>
    @endforeach
</div>
<div class="alert alert-info"><i class="fas fa-info-circle"></i> Email settings are configured in the .env file. Update the MAIL_* variables in your server environment.</div>
<div class="card">
    <div class="card-header"><h3 class="card-title">Current Email Configuration (from .env)</h3></div>
    <div class="card-body">
        @foreach(['MAIL_MAILER'=>config('mail.default'),'MAIL_HOST'=>config('mail.mailers.smtp.host'),'MAIL_PORT'=>config('mail.mailers.smtp.port'),'MAIL_FROM_ADDRESS'=>config('mail.from.address'),'MAIL_FROM_NAME'=>config('mail.from.name')] as $key=>$value)
        <div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9"><span style="font-weight:600;font-size:13px">{{ $key }}</span><span style="color:#64748b;font-size:13px">{{ $value ?: 'Not set' }}</span></div>
        @endforeach
    </div>
</div>
@endsection


