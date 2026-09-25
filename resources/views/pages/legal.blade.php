@extends('layouts.app')

@php
    $metaDescription = \Illuminate\Support\Str::limit(strip_tags($page->content ?? ''), 155);
@endphp

@section('title', $page->title)
@section('meta_description', $metaDescription)
@section('og_title', $page->title)
@section('og_description', $metaDescription)

@section('content')
<div class="page-hero" style="padding:110px 0 60px">
    <div class="container">
        <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:16px">
            <i class="fas fa-scale-balanced"></i> Legal
        </div>
        <h1>{{ $page->title }}</h1>
    </div>
</div>

<section class="section"> 
    <div class="container">
        <div style="max-width:980px;margin:0 auto;font-size:15.5px;line-height:1.9;color:#475569">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection

