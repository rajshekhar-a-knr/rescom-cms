@extends('admin.layouts.app')
@section('title','Settings')
@section('breadcrumb')<span>></span><span class="current">Settings</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">Site Settings</h1></div>
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
@php
    $get = function ($key, $default = '') use ($settings) {
        if (function_exists('setting')) {
            return old($key, $settings[$key]->value ?? setting($key, $default));
        }
        return old($key, $settings[$key]->value ?? $default);
    };
@endphp
<form class="single-card-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
        <div>
            <div class="settings-section" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">General Settings</h3></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Site Name</label><input type="text" name="site_name" class="form-control" value="{{ $get('site_name') }}"></div>
                    <div class="form-group"><label class="form-label">Site Tagline</label><input type="text" name="site_tagline" class="form-control" value="{{ $get('site_tagline') }}"></div>
                    <div class="form-group"><label class="form-label">Site Description</label><textarea name="site_description" class="form-control" rows="3">{{ $get('site_description') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Footer About</label><textarea name="footer_about" class="form-control" rows="3">{{ $get('footer_about') }}</textarea></div>
                </div>
            </div>
            <div class="settings-section">
                <div class="card-header"><h3 class="card-title">Contact Info</h3></div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group"><label class="form-label">Email</label><input type="email" name="contact_email" class="form-control" value="{{ $get('contact_email') }}"></div>
                        <div class="form-group"><label class="form-label">Phone</label><input type="text" name="contact_phone" class="form-control" value="{{ $get('contact_phone') }}" inputmode="tel" pattern="[0-9\\s\\+\\-\\(\\)]+" title="Please use numbers only." data-min-digits="10"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label class="form-label">Phone 2</label><input type="text" name="contact_phone2" class="form-control" value="{{ $get('contact_phone2') }}" inputmode="tel" pattern="[0-9\\s\\+\\-\\(\\)]+" title="Please use numbers only." data-min-digits="10"></div>
                        <div class="form-group"><label class="form-label">WhatsApp</label><input type="text" name="whatsapp_number" class="form-control" value="{{ $get('whatsapp_number') }}" inputmode="tel" pattern="[0-9\\s\\+\\-\\(\\)]+" title="Please use numbers only." data-min-digits="10"></div>
                    </div>
                    <div class="form-group"><label class="form-label">Address</label><textarea name="contact_address" class="form-control" rows="2">{{ $get('contact_address') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Business Hours</label><input type="text" name="business_hours" class="form-control" value="{{ $get('business_hours') }}"></div>
                </div>
            </div>
            <div class="settings-section" style="margin-top:16px">
                <div class="card-header"><h3 class="card-title">Top Bar</h3></div>
                <div class="card-body">
                    <div style="font-size:13px;color:var(--text-muted)">
                        Manage the Top Bar announcements in <a href="{{ route('admin.settings.topscroller') }}">Top Scroller</a>.
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="settings-section" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Logo & Assets</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Site Logo</label>
                        @php($siteLogo = $get('site_logo'))
                        @if($siteLogo)
                            <img src="{{ $siteLogo }}" style="height:40px;margin-bottom:8px;display:block">
                        @endif
                        <input type="file" name="site_logo" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group"><label class="form-label">Favicon</label><input type="file" name="site_favicon" class="form-control" accept="image/*"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Settings</button>
    </div>
</form>
@endsection



