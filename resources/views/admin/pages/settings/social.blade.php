@extends('admin.layouts.app')
@section('title','Social Settings')
@section('breadcrumb')<span>></span><span class="current">Social Settings</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">Social Media</h1></div>
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
        <div class="card-header"><h3 class="card-title">Social Media Links</h3></div>
        <div class="card-body">
            @foreach(['social_facebook'=>['Facebook','fab fa-facebook','#1877f2'],'social_twitter'=>['Twitter / X','fab fa-x-twitter','#000'],'social_linkedin'=>['LinkedIn','fab fa-linkedin','#0077b5'],'social_instagram'=>['Instagram','fab fa-instagram','#e4405f'],'social_youtube'=>['YouTube','fab fa-youtube','#ff0000'],'social_github'=>['GitHub','fab fa-github','#333']] as $key=>[$label,$icon,$color])
            <div class="form-group" style="display:flex;align-items:center;gap:12px">
                <div style="width:36px;height:36px;background:{{ $color }}20;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="{{ $icon }}" style="color:{{ $color }}"></i></div>
                <div style="flex:1"><label class="form-label">{{ $label }}</label><input type="url" name="{{ $key }}" class="form-control" value="{{ $get($key) }}" placeholder="https://..."></div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Social Links</button>
    </div>
</form>
@endsection



