@extends('layouts.app')
@section('title', $category->name . ' - Tech Insights | Rescom')
@section('meta_description', $category->description ?? 'Explore ' . $category->name . ' insights and technical analysis from Rescom.')

@section('content')
<!-- =============== FUTURISTIC CATEGORY HERO (DARK CYBER THEME) =============== -->
<section class="futuristic-page-hero">
    <style>
        /* Header Contrast */
        body:not(.detail-hero-light) #mainHeader:not(.scrolled) .nav-link {
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 600;
        }
        body:not(.detail-hero-light) #mainHeader:not(.scrolled) .nav-link:hover,
        body:not(.detail-hero-light) #mainHeader:not(.scrolled) .nav-link.active {
            color: #38bdf8 !important;
            background: rgba(56, 189, 248, 0.12);
        }
        body:not(.detail-hero-light) #mainHeader:not(.scrolled) .logo-tagline {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        body:not(.detail-hero-light) #mainHeader:not(.scrolled) .nav-search-btn i {
            color: rgba(255, 255, 255, 0.95) !important;
        }
        body:not(.detail-hero-light) #mainHeader:not(.scrolled) .mobile-search-btn,
        body:not(.detail-hero-light) #mainHeader:not(.scrolled) .mobile-toggle {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
        }

        .futuristic-page-hero {
            position: relative;
            background: #060b18;
            padding-top: clamp(140px, 17vh, 185px);
            padding-bottom: clamp(60px, 8vh, 90px);
            color: #ffffff;
            overflow: hidden;
            text-align: center;
        }
        .has-topbar .futuristic-page-hero { padding-top: clamp(165px, 20vh, 210px); }

        .f-hero-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 15% 25%, rgba(37, 99, 235, 0.22) 0%, transparent 45%),
                radial-gradient(circle at 85% 30%, rgba(147, 51, 234, 0.22) 0%, transparent 45%),
                linear-gradient(180deg, #070d1d 0%, #060a16 60%, #040711 100%);
            z-index: 1;
            pointer-events: none;
        }
        .f-cyber-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(56, 189, 248, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.06) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 1;
            pointer-events: none;
        }

        .futuristic-page-hero .container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
        }

        .f-hud-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(56, 189, 248, 0.35);
            padding: 6px 18px;
            border-radius: 999px;
            margin-bottom: 20px;
            backdrop-filter: blur(14px);
        }
        .f-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #00f2fe;
            box-shadow: 0 0 10px #00f2fe;
        }
        .f-hero-title {
            font-size: clamp(32px, 4.5vw, 52px);
            font-weight: 850;
            line-height: 1.15;
            color: #ffffff;
            margin-bottom: 16px;
            text-shadow: none !important;
        }
        .f-hero-desc {
            font-size: clamp(15px, 1.2vw, 17px);
            color: #94a3b8;
            line-height: 1.7;
            max-width: 720px;
            margin: 0 auto;
        }

        /* Full Width Container */
        .f-wide-container {
            width: 100%;
            max-width: 1680px;
            margin: 0 auto;
            padding: 0 clamp(20px, 4vw, 64px);
            position: relative;
            z-index: 2;
        }

        .futuristic-blog-section {
            position: relative;
            background: #f8fafc;
            padding: clamp(50px, 7vh, 80px) 0 clamp(80px, 10vh, 120px) 0;
            color: #0f172a;
            min-height: 500px;
        }
        .f-blog-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.035) 1px, transparent 1px);
            background-size: 36px 36px;
            pointer-events: none;
        }

        .f-catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 30px;
        }

        .f-article-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        }
        .f-article-card:hover {
            transform: translateY(-8px) scale(1.015);
            border-color: #0284c7;
            box-shadow: 0 22px 50px -10px rgba(14, 165, 233, 0.2);
        }

        .f-card-preview-bay {
            position: relative;
            height: 220px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }
        .f-card-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .f-article-card:hover .f-card-img { transform: scale(1.08); }

        .f-blog-icon-bay {
            width: 80px;
            height: 80px;
            border-radius: 22px;
            background: #ffffff;
            border: 1.5px solid rgba(14, 165, 233, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            color: #0284c7;
            box-shadow: 0 10px 28px rgba(14, 165, 233, 0.2);
        }

        .f-card-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
            background: #ffffff;
        }
        .f-card-title {
            font-size: 17.5px;
            font-weight: 850;
            color: #0f172a;
            line-height: 1.38;
            margin-bottom: 10px;
            transition: color 0.2s ease;
        }
        .f-article-card:hover .f-card-title { color: #0284c7; }
        .f-card-desc {
            color: #64748b;
            font-size: 14px;
            line-height: 1.65;
            margin-bottom: 18px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .f-card-footer {
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .f-card-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0284c7;
            font-size: 13.5px;
            font-weight: 750;
            text-decoration: none;
        }
    </style>

    <div class="f-hero-bg"></div>
    <div class="f-cyber-grid"></div>

    <div class="container">
        <div class="f-hud-badge" data-aos="fade-down">
            <span class="f-radar-dot"></span>
            <span style="font-size:11.5px;font-weight:800;letter-spacing:1.6px;text-transform:uppercase;color:#e2e8f0">CATEGORY INSIGHTS</span>
        </div>

        <h1 class="f-hero-title" data-aos="fade-up">
            {{ $category->name }}
        </h1>

        @if($category->description)
        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            {{ $category->description }}
        </p>
        @else
        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            Explore our curated technical articles and industry perspectives covering {{ $category->name }}.
        </p>
        @endif
    </div>
</section>

<!-- =============== CATEGORY POSTS GRID =============== -->
<section class="futuristic-blog-section">
    <div class="f-blog-grid-mesh"></div>

    <div class="f-wide-container">
        <div style="margin-bottom:28px">
            <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:8px;font-size:13.5px;font-weight:750;color:#0284c7;text-decoration:none">
                <i class="fas fa-arrow-left"></i>
                <span>Back to All Insights</span>
            </a>
        </div>

        @if($posts->count())
        <div class="f-catalog-grid">
            @foreach($posts as $i => $post)
            <article class="f-article-card" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}"
                     onclick="location.href='{{ route('blog.show', $post->slug) }}'">
                <div class="f-card-preview-bay">
                    @if($post->featured_image)
                    <img src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}" class="f-card-img">
                    @else
                    <div class="f-blog-icon-bay">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    @endif
                </div>

                <div class="f-card-body">
                    <div>
                        <h3 class="f-card-title">{{ $post->title }}</h3>
                        <p class="f-card-desc">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}</p>
                    </div>

                    <div class="f-card-footer">
                        <span style="font-size:12.5px;color:#94a3b8;font-weight:600">
                            <i class="far fa-calendar-alt"></i> {{ $post->published_at?->format('M d, Y') ?? date('M d, Y') }}
                        </span>
                        <span class="f-card-link">
                            <span>Read Insight</span>
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div style="margin-top:48px;display:flex;justify-content:center">
            {{ $posts->links() }}
        </div>
        @else
        <div style="background:#ffffff;border:1.5px solid #e2e8f0;border-radius:20px;padding:60px 24px;text-align:center">
            <h3 style="font-size:20px;font-weight:800;color:#0f172a;margin-bottom:8px">No Articles in this Category Yet</h3>
            <p style="color:#64748b;font-size:14px;margin-bottom:20px">Check back soon as we publish new technical guides and analysis.</p>
            <a href="{{ route('blog') }}" class="btn btn-primary">Browse All Articles</a>
        </div>
        @endif
    </div>
</section>
@endsection
