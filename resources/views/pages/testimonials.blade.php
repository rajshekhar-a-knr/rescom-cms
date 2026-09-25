@extends('layouts.app')

@section('title', 'Testimonials')

@section('content')
<div class="page-hero">
    <div class="container">
        <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:16px">
            <i class="fas fa-quote-left"></i> Testimonials
        </div>
        <h1>What Our Clients Say</h1>
        <p>Real stories from teams we have helped build and scale.</p>
</div>
</div>

@include('partials.resources-tabs', ['activeKey' => 'testimonials'])

<section class="section resource-section">
    <div class="container" style="max-width:100%">
        <div class="testimonials-grid">
            @foreach($testimonials as $t)
            <div class="testimonial-card-alt" data-aos="fade-up">
                <div class="testimonial-card-alt-header">
                    <div class="testimonial-avatar">
                        @if($t->client_photo)
                            <img src="{{ media_url($t->client_photo) }}" alt="{{ $t->client_name }}">
                        @else
                            <span>{{ strtoupper(substr($t->client_name ?? 'C', 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <h3>{{ $t->client_name }}</h3>
                        <p>{{ $t->client_designation }}@if($t->client_company) • {{ $t->client_company }}@endif</p>
                        @if($t->testimonial_source === 'student-college')
                            <div style="display:inline-flex;align-items:center;padding:4px 10px;border-radius:999px;background:#eff6ff;color:#1d4ed8;font-size:11px;font-weight:700;margin-top:6px">Student / College</div>
                        @endif
                    </div>
                </div>
                <div class="testimonial-rating">
                    @for($i=1;$i<=5;$i++)
                        <i class="fas fa-star {{ $i <= ($t->rating ?? 5) ? 'active' : '' }}"></i>
                    @endfor
                </div>
                <p class="testimonial-quote">“{{ $t->content }}”</p>
            </div>
            @endforeach

            @if($testimonials->isEmpty())
                <div class="resource-empty" data-aos="fade-up">
                    <i class="fas fa-quote-left"></i>
                    <h3>No testimonials yet</h3>
                    <p>Please check back soon.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection


