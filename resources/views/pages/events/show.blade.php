@extends('layouts.app')

@section('title', $event->title)

@section('content')
<style>
    .event-hero {
        background:linear-gradient(135deg,#0b4f92 0%, #0f6fb0 55%, #129fc0 100%);
        border-bottom:1px solid rgba(255,255,255,0.2);
        color:#fff;
    }
    .event-hero-inner { padding:70px 0 86px; text-align:center; }
    .event-hero-inner h1 { font-size:clamp(28px,4.4vw,52px); font-weight:900; letter-spacing:-0.5px; margin-bottom:12px; }
    .event-hero-inner p { color:rgba(255,255,255,0.85); font-size:15.5px; max-width:860px; margin:0 auto; line-height:1.8; }
    .event-hero-badge {
        display:inline-flex; align-items:center; gap:8px; padding:8px 14px; border-radius:999px;
        background:rgba(255,255,255,0.12); color:#fff; border:1px solid rgba(255,255,255,0.25);
        font-size:12px; font-weight:700; margin-bottom:16px;
    }
    .event-detail-wrap { display:flex; flex-direction:column; gap:28px; }
    .event-detail-card {
        background:#fff; border-radius:24px; border:1px solid rgba(0,0,0,0.06);
        box-shadow:var(--shadow-sm); overflow:hidden; display:grid; grid-template-columns:1.1fr 1fr;
    }
    .event-detail-thumb { min-height:320px; background:var(--gradient); position:relative; }
    .event-detail-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
    .event-detail-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:64px; color:rgba(255,255,255,0.7); }
    .event-detail-body { padding:36px; }
    .event-chip {
        display:inline-flex; align-items:center; gap:8px; padding:6px 12px; border-radius:999px;
        background:rgba(37,99,235,0.1); color:#1d4ed8; font-size:12px; font-weight:700; margin-bottom:12px;
    }
    .event-detail-summary { color:#64748b; font-size:15px; line-height:1.7; margin:12px 0 18px; }
    .event-meta { display:flex; gap:12px; flex-wrap:wrap; margin:16px 0 22px; }
    .event-meta span {
        display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:12px;
        background:#f8fafc; border:1px solid #e2e8f0; font-size:12.5px; color:#475569; font-weight:600;
    }
    .event-detail-actions { display:flex; gap:12px; flex-wrap:wrap; }
    .event-content-card {
        background:#fff; border-radius:20px; border:1px solid rgba(0,0,0,0.06);
        box-shadow:var(--shadow-sm); padding:28px; color:#475569; line-height:1.8; font-size:14.5px;
    }
    .event-photos { margin-top:8px; }
    .event-photos h3 { font-size:18px; margin-bottom:14px; }
    .event-photos-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:14px; }
    .event-photos-grid a {
        display:block; background:#f8fafc; border:1px solid #e2e8f0; border-radius:14px;
        overflow:hidden; aspect-ratio:16/10;
    }
    .event-photos-grid img {
        width:100%; height:100%; object-fit:contain; background:#fff; padding:8px;
    }
    @media (max-width: 1024px) {
        .event-detail-card { grid-template-columns:1fr; }
        .event-detail-thumb { min-height:260px; }
        .event-detail-body { padding:26px; }
    }
    @media (max-width: 640px) {
        .event-hero-inner { padding:46px 0 56px; }
        .event-detail-thumb { min-height:220px; }
        .event-content-card { padding:22px; }
        .event-photos-grid a { aspect-ratio:4/3; }
    }
</style>

<section class="event-hero">
    <div class="container event-hero-inner">
        <div class="event-hero-badge">
            <i class="fas fa-calendar-check"></i> {{ $event->event_type ?? 'Event' }}
        </div>
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->summary ?? 'Join us for insights, networking, and new perspectives on technology and innovation.' }}</p>
    </div>
</section>

<section class="section" style="padding-top:24px">
    <div class="container">
        <div class="event-detail-wrap" data-aos="fade-up">
            <div class="event-detail-card">
                <div class="event-detail-thumb">
                    @if($event->image)
                        <img src="{{ media_url($event->image) }}" alt="{{ $event->title }}">
                    @else
                        <div class="event-detail-placeholder"><i class="fas fa-calendar"></i></div>
                    @endif
                </div>
                <div class="event-detail-body">
                    <span class="event-chip"><i class="fas fa-sparkles"></i> Featured Event</span>
                    <h2 class="section-title" style="text-align:left">{{ $event->title }}</h2>
                    @if($event->summary)<p class="event-detail-summary">{{ $event->summary }}</p>@endif
                    <div class="event-meta">
                        <span><i class="fas fa-calendar-day"></i> {{ $event->event_date ? $event->event_date->format('M d, Y') : 'TBA' }}</span>
                        <span><i class="fas fa-location-dot"></i> {{ $event->location ?? 'Location TBA' }}</span>
                        <span><i class="fas fa-tag"></i> {{ $event->event_type ?? 'General' }}</span>
                    </div>
                    <div class="event-detail-actions">
                        <a href="{{ route('contact') }}" class="btn btn-blue">Get in touch <i class="fas fa-arrow-right"></i></a>
                        <a href="{{ route('events') }}" class="btn btn-secondary">Back to Events</a>
                    </div>
                </div>
            </div>

            @if($event->description)
            <div class="event-content-card">
                {!! nl2br(e($event->description)) !!}
            </div>
            @endif

            @if($event->photos && $event->photos->count())
            <div class="event-photos">
                <div class="section-header" style="text-align:left;margin-bottom:12px">
                    <div class="section-badge"><i class="fas fa-images"></i> Gallery</div>
                    <h2 class="section-title" style="text-align:left">Event Highlights</h2>
                </div>
                <div class="event-photos-grid">
                    @foreach($event->photos as $photo)
                        <a href="{{ media_url($photo->image) }}" class="lightbox-item" data-lightbox-group="event-{{ $event->id }}">
                            <img src="{{ media_url($photo->image) }}" alt="{{ $event->title }}">
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection


