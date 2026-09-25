@extends('admin.layouts.app')
@section('title','SEO Settings')
@section('breadcrumb')<span>></span><span class="current">SEO Settings</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">SEO Settings</h1></div>
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
<form class="single-card-form" action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <div class="settings-section">
        <div class="card-header"><h3 class="card-title">SEO Configuration</h3></div>
        <div class="card-body">
            <div class="form-group"><label class="form-label">Meta Title Suffix</label><input type="text" name="meta_title_suffix" class="form-control" value="{{ $get('meta_title_suffix') }}" placeholder=" | Rescom"></div>
            <div class="form-group"><label class="form-label">Google Analytics Code</label><textarea name="analytics_code" class="form-control" rows="5" placeholder="Paste your GA4 or GTM code here...">{{ $get('analytics_code') }}</textarea></div>
            <div class="form-group"><label class="form-label">reCAPTCHA Site Key</label><input type="text" name="recaptcha_site_key" class="form-control" value="{{ $get('recaptcha_site_key') }}"></div>
            <div class="form-group"><label class="form-label">reCAPTCHA Secret Key</label><input type="text" name="recaptcha_secret_key" class="form-control" value="{{ $get('recaptcha_secret_key') }}"></div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save SEO Settings</button>
    </div>
</form>
@endsection



