@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="page-hero">
    <div class="container">
        <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:16px">
            <i class="fas fa-calendar-check"></i> Events
        </div>
        <h1>Upcoming And Past Highlights</h1>
        <p>Join us at community events, product launches, and expert sessions.</p>
</div>
</div>

@include('partials.resources-tabs', ['activeKey' => 'events'])

<div class="tabs-shell" style="border-top:1px solid #e2e8f0">
    <div class="container">
        <div class="tab-bar">
            <a href="{{ route('events') }}" class="tab-pill {{ empty($type) ? 'active' : '' }}">All Events</a>
            @foreach(($types ?? []) as $t)
                <a href="{{ route('events', ['type' => $t]) }}" class="tab-pill {{ ($type === $t) ? 'active' : '' }}">{{ $t }}</a>
            @endforeach
        </div>
    </div>
</div>

<style>
    .events-fullbleed { width:100vw; margin-left:calc(50% - 50vw); padding:0 24px 24px; }
    @media (max-width: 768px) { .events-fullbleed { padding:0 16px 20px; } }
</style>

<section class="section events-section" style="padding-top:24px">
    <div class="events-fullbleed">
        <div class="events-grid">
            @foreach($events as $event)
            <a href="{{ route('events.show', $event->slug) }}" class="events-card" data-aos="fade-up">
                <div class="events-thumb">
                    @if($event->image)
                        <img src="{{ media_url($event->image) }}" alt="{{ $event->title }}">
                    @else
                        <div class="events-thumb-placeholder"><i class="fas fa-calendar"></i></div>
                    @endif
                    <span class="events-date">
                        {{ $event->event_date ? $event->event_date->format('M d, Y') : 'TBA' }}
                    </span>
                </div>
                <div class="events-body">
                    <h3>{{ $event->title }}</h3>
                    @if($event->summary)<p>{{ $event->summary }}</p>@endif
                    <div class="events-meta">
                        <span><i class="fas fa-location-dot"></i> {{ $event->location ?? 'Location TBA' }}</span>
                        <span><i class="fas fa-arrow-right"></i> View details</span>
                    </div>
                </div>
            </a>
            @endforeach

            @if($events->isEmpty())
                <div class="events-empty" data-aos="fade-up">
                    <i class="fas fa-calendar"></i>
                    <h3>No events scheduled</h3>
                    <p>We are planning new sessions. Check back soon.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection



