@extends('layouts.app')

@php
    $metaDescription = $page->meta_description
        ?: \Illuminate\Support\Str::limit(strip_tags($page->content ?? ''), 155);
    $isPreview = $isPreview ?? false;
@endphp

@section('title', $page->meta_title ?: $page->title)
@section('meta_description', $metaDescription)
@section('og_title', $page->meta_title ?: $page->title)
@section('og_description', $metaDescription)
@if($page->featured_image)
@section('og_image', media_url($page->featured_image))
@endif

@section('content')
<div class="page-hero" style="padding:110px 0 60px">
    <div class="container">
        <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:16px">
            <i class="fas fa-file-lines"></i> {{ $isPreview ? 'Preview' : 'Page' }}
        </div>
        <h1>{{ $page->title }}</h1>
        @if($page->excerpt)
            <p>{{ $page->excerpt }}</p>
        @endif
    </div>
</div>

<section class="section">
    <div class="container">
        @if($page->featured_image)
            <div style="margin-bottom:28px">
                <img src="{{ media_url($page->featured_image) }}" alt="{{ $page->title }}" style="width:100%;border-radius:18px;box-shadow:var(--shadow-md);border:1px solid rgba(0,0,0,0.05)">
            </div>
        @endif

        <div style="max-width:960px;margin:0 auto;font-size:15.5px;line-height:1.9;color:#475569">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection

