@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<div class="page-hero">
    <div class="container">
        <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:16px">
            <i class="fas fa-camera-retro"></i> Gallery
        </div>
        <h1>Moments, Spaces, And Stories</h1>
        <p>A curated look at our work culture, milestones, and project highlights.</p>
</div>
</div>

@include('partials.resources-tabs', ['activeKey' => 'gallery'])

<div class="tabs-shell" style="border-top:1px solid #e2e8f0" data-aos="fade-up">
    <div class="container">
        <div class="tab-bar">
            <a href="{{ route('gallery') }}" class="tab-pill {{ request('category') ? '' : 'active' }}">All Gallery</a>
            @foreach($categories as $cat)
                <a href="{{ route('gallery', ['category' => $cat->category]) }}" class="tab-pill {{ request('category') === $cat->category ? 'active' : '' }}">
                    {{ $cat->category }}
                    <span class="tab-count">{{ $cat->total }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

<style>
    .gallery-fullbleed { width:100vw; margin-left:calc(50% - 50vw); padding:0 24px 32px; }
    .gallery-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:18px; }
    .gallery-card {
        position:relative; overflow:hidden; border-radius:18px; background:#ffffff;
        border:1px solid rgba(0,0,0,0.06); box-shadow:0 12px 28px rgba(15,23,42,0.10);
        transition:transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }
    .gallery-card:hover { transform:translateY(-6px); box-shadow:0 20px 40px rgba(15,23,42,0.18); border-color:#c7d2fe; }
    .gallery-card img { width:100%; height:220px; object-fit:contain; background:#f8fafc; display:block; }
    .gallery-overlay {
        position:absolute; inset:0;
        background:linear-gradient(180deg, rgba(15,23,42,0) 0%, rgba(15,23,42,0.7) 100%);
        opacity:0; transition:opacity 0.25s ease;
    }
    .gallery-card:hover .gallery-overlay { opacity:1; }
    .gallery-type {
        position:absolute; left:14px; top:14px; padding:5px 12px; border-radius:999px;
        background:rgba(255,255,255,0.65); color:#0f172a; font-size:11.5px; font-weight:700;
        border:1px solid rgba(255,255,255,0.6); backdrop-filter:blur(6px);
        box-shadow:0 6px 16px rgba(15,23,42,0.10); letter-spacing:0.2px;
    }
    .gallery-caption {
        position:absolute; left:14px; right:14px; bottom:14px;
        color:#f8fafc; font-size:12.5px; line-height:1.6; opacity:0; transform:translateY(10px);
        transition:opacity 0.25s ease, transform 0.25s ease;
        background:rgba(2,6,23,0.65); padding:12px 14px; border-radius:16px;
        box-shadow:0 14px 28px rgba(2,6,23,0.28), inset 0 0 0 1px rgba(255,255,255,0.06);
        backdrop-filter:blur(6px);
    }
    .gallery-caption-title { font-size:13.5px; font-weight:800; margin-bottom:4px; color:#fff; }
    .gallery-card:hover .gallery-caption { opacity:1; transform:translateY(0); }
    @media (max-width: 768px) {
        .gallery-fullbleed { padding:0 16px 20px; }
        .gallery-card img { height:180px; }
    }
</style>

<section class="section gallery-section" style="padding-top:24px">
    <div class="gallery-fullbleed">
        <div class="gallery-grid">
            @foreach($items as $item)
            <a class="gallery-card lightbox-item" href="{{ media_url($item->image) }}" data-lightbox-group="gallery" data-aos="zoom-in">
                <img src="{{ media_url($item->image) }}" alt="{{ $item->title ?? 'Gallery image' }}">
                <span class="gallery-type">{{ $item->category ?? 'General' }}</span>
                <div class="gallery-overlay"></div>
                @if($item->caption)
                    <div class="gallery-caption">
                        <div class="gallery-caption-title">{{ $item->title ?? 'Gallery' }}</div>
                        {{ $item->caption }}
                    </div>
                @endif
            </a>
            @endforeach

            @if($items->isEmpty())
                <div class="gallery-empty" data-aos="fade-up">
                    <i class="fas fa-image"></i>
                    <h3>No images yet</h3>
                    <p>Check back soon for new uploads.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
