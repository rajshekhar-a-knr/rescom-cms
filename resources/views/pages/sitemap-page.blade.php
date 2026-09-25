@extends('layouts.app')

@section('title', 'Sitemap')

@section('content')
<section class="section sitemap-hero">
    <div class="container1">
        <div class="sitemap-hero-inner" data-aos="fade-up">
            <div class="sitemap-hero-text">
                <span class="section-badge">Sitemap</span>
                <h1 class="section-title">Everything In One Place</h1>
                <p class="section-subtitle">Jump straight to any page, service, portfolio item, or blog post.</p>
                <div class="sitemap-hero-actions">
                    <a href="{{ route('contact') }}" class="btn-blue">Contact Us <i class="fas fa-arrow-right"></i></a>
                    <a href="{{ route('services') }}" class="btn-outline-white">Explore Services</a>
                </div>
            </div>
            <div class="sitemap-hero-card">
                <div class="sitemap-hero-icon"><i class="fas fa-sitemap"></i></div>
                <h3>Quick Navigation</h3>
                <p>Browse curated sections with icons and smart grouping.</p>
                <div class="sitemap-hero-stats">
                    <div>
                        <span class="sitemap-stat">{{ $services->count() }}</span>
                        <span class="sitemap-stat-label">Services</span>
                    </div>
                    <div>
                        <span class="sitemap-stat">{{ $portfolios->count() }}</span>
                        <span class="sitemap-stat-label">Portfolio</span>
                    </div>
                    <div>
                        <span class="sitemap-stat">{{ $blogs->count() }}</span>
                        <span class="sitemap-stat-label">Blogs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section sitemap-section">
    <div class="container1">
        <div class="sitemap-grid">
            <div class="sitemap-card" data-aos="fade-up">
                <div class="sitemap-card-head">
                    <span class="sitemap-card-icon"><i class="fas fa-compass"></i></span>
                    <div>
                        <h3>Main Pages</h3>
                        <p>Start your journey here.</p>
                    </div>
                </div>
                <ul class="sitemap-links">
                    <li><a href="{{ route('home') }}"><i class="fas fa-house"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-user-group"></i> About</a></li>
                    <li><a href="{{ route('services') }}"><i class="fas fa-layer-group"></i> Services</a></li>
                    <li><a href="{{ route('portfolio') }}"><i class="fas fa-briefcase"></i> Portfolio</a></li>
                    <li><a href="{{ route('blog') }}"><i class="fas fa-pen-nib"></i> Blog</a></li>
                    <li><a href="{{ route('gallery') }}"><i class="fas fa-camera-retro"></i> Gallery</a></li>
                    <li><a href="{{ route('events') }}"><i class="fas fa-calendar-check"></i> Events</a></li>
                    <li><a href="{{ route('careers') }}"><i class="fas fa-rocket"></i> Careers</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fas fa-envelope-open-text"></i> Contact</a></li>
                    <li><a href="{{ route('privacy') }}"><i class="fas fa-shield-halved"></i> Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                </ul>
            </div>

            <div class="sitemap-card" data-aos="fade-up" data-aos-delay="50">
                <div class="sitemap-card-head">
                    <span class="sitemap-card-icon"><i class="fas fa-cubes"></i></span>
                    <div>
                        <h3>Services</h3>
                        <p>Everything we can build for you.</p>
                    </div>
                </div>
                <ul class="sitemap-links">
                    @foreach($services as $s)
                        <li><a href="{{ route('services.show', $s->slug) }}"><i class="fas fa-arrow-right"></i> {{ Str::headline(str_replace('-', ' ', $s->slug)) }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="sitemap-card" data-aos="fade-up" data-aos-delay="100">
                <div class="sitemap-card-head">
                    <span class="sitemap-card-icon"><i class="fas fa-briefcase"></i></span>
                    <div>
                        <h3>Portfolio</h3>
                        <p>Real projects, real impact.</p>
                    </div>
                </div>
                <ul class="sitemap-links">
                    @foreach($portfolios as $p)
                        <li><a href="{{ route('portfolio.show', $p->slug) }}"><i class="fas fa-arrow-right"></i> {{ Str::headline(str_replace('-', ' ', $p->slug)) }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="sitemap-card" data-aos="fade-up" data-aos-delay="150">
                <div class="sitemap-card-head">
                    <span class="sitemap-card-icon"><i class="fas fa-newspaper"></i></span>
                    <div>
                        <h3>Blog</h3>
                        <p>Insights, trends, and expert tips.</p>
                    </div>
                </div>
                <ul class="sitemap-links">
                    @foreach($blogs as $b)
                        <li><a href="{{ route('blog.show', $b->slug) }}"><i class="fas fa-arrow-right"></i> {{ Str::headline(str_replace('-', ' ', $b->slug)) }}</a></li>
                    @endforeach
                </ul>
                <div class="sitemap-note">
                    For search engines, use the XML sitemap at <a href="{{ route('sitemap') }}">/sitemap.xml</a>.
                </div>
            </div>

            <div class="sitemap-card" data-aos="fade-up" data-aos-delay="200">
                <div class="sitemap-card-head">
                    <span class="sitemap-card-icon"><i class="fas fa-calendar-check"></i></span>
                    <div>
                        <h3>Events</h3>
                        <p>Our latest sessions and meetups.</p>
                    </div>
                </div>
                <ul class="sitemap-links">
                    @foreach($events as $e)
                        <li><a href="{{ route('events.show', $e->slug) }}"><i class="fas fa-arrow-right"></i> {{ Str::headline(str_replace('-', ' ', $e->slug)) }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
