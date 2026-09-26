@extends('layouts.app')
@section('title', setting('portfolio_meta_title', 'Portfolio - Featured Properties & Projects | Rescom'))
@section('meta_description', setting('portfolio_meta_description', 'Explore our portfolio of premier residential developments, commercial hubs, architectural landmarks, and managed estates.'))

@section('content')
<!-- =============== FUTURISTIC PRODUCTS HERO (DARK CYBER THEME) =============== -->
<section class="futuristic-page-hero">
    <style>
        /* ===== HEADER CONTRAST FOR DARK HERO BANNER ===== */
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

        /* ===== FUTURISTIC DARK HERO & WHITE CARDS STYLES ===== */
        .futuristic-page-hero {
            position: relative;
            background: #060b18;
            padding-top: clamp(140px, 17vh, 185px);
            padding-bottom: clamp(60px, 8vh, 90px);
            color: #ffffff;
            overflow: hidden;
            text-align: center;
        }

        .has-topbar .futuristic-page-hero {
            padding-top: clamp(165px, 20vh, 210px);
        }

        /* Ambient Cyber Grid & Glow */
        .f-hero-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 15% 25%, rgba(37, 99, 235, 0.22) 0%, transparent 45%),
                radial-gradient(circle at 85% 30%, rgba(147, 51, 234, 0.22) 0%, transparent 45%),
                radial-gradient(circle at 50% 85%, rgba(6, 182, 212, 0.18) 0%, transparent 50%),
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
            mask-image: radial-gradient(circle at 50% 45%, black 30%, transparent 85%);
            -webkit-mask-image: radial-gradient(circle at 50% 45%, black 30%, transparent 85%);
            z-index: 1;
            pointer-events: none;
        }

        .f-energy-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 1;
            opacity: 0.6;
            animation: fOrbPulseDark 8s ease-in-out infinite alternate;
        }
        .f-orb-left { width: 400px; height: 400px; background: rgba(37, 99, 235, 0.25); top: 10%; left: -5%; }
        .f-orb-right { width: 450px; height: 450px; background: rgba(147, 51, 234, 0.22); top: 15%; right: -5%; animation-delay: -3s; }

        @keyframes fOrbPulseDark {
            0% { transform: scale(1) translateY(0); opacity: 0.5; }
            100% { transform: scale(1.15) translateY(-20px); opacity: 0.7; }
        }

        .futuristic-page-hero .container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
        }

        /* HUD Live Beacon Badge */
        .f-hud-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(56, 189, 248, 0.35);
            padding: 6px 16px;
            border-radius: 999px;
            margin-bottom: 20px;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 4px 20px rgba(6, 182, 212, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .f-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #00f2fe;
            box-shadow: 0 0 10px #00f2fe, 0 0 20px #00f2fe;
            position: relative;
            display: inline-block;
            flex-shrink: 0;
        }
        .f-radar-dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1.5px solid #00f2fe;
            animation: fRadarWaveDark 2s ease-out infinite;
        }
        @keyframes fRadarWaveDark {
            0% { transform: scale(0.6); opacity: 1; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        .f-badge-subtitle {
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: #e2e8f0;
        }

        .f-badge-divider {
            width: 1px;
            height: 12px;
            background: rgba(255, 255, 255, 0.25);
        }

        .f-badge-tag {
            font-size: 11px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Page Hero Title & Subtitle */
        .f-hero-title {
            font-size: clamp(32px, 4.5vw, 54px);
            font-weight: 850;
            line-height: 1.15;
            letter-spacing: -0.025em;
            color: #ffffff;
            margin-bottom: 16px;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.6);
        }

        .f-gradient-text {
            background: linear-gradient(135deg, #ffffff 10%, #bae6fd 40%, #38bdf8 70%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline;
        }

        .f-hero-desc {
            font-size: clamp(15px, 1.2vw, 17px);
            color: #94a3b8;
            line-height: 1.7;
            max-width: 680px;
            margin: 0 auto 28px auto;
        }

        /* Catalog Telemetry Capsules */
        .f-catalog-stats {
            display: inline-flex;
            align-items: center;
            gap: 24px;
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(56, 189, 248, 0.25);
            padding: 10px 26px;
            border-radius: 999px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            flex-wrap: wrap;
            justify-content: center;
        }
        .f-stat-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #cbd5e1;
        }
        .f-stat-val {
            color: #38bdf8;
            font-weight: 800;
            font-size: 15px;
        }
        .f-stat-sep {
            width: 1px;
            height: 14px;
            background: rgba(255, 255, 255, 0.15);
        }

        /* ===== CATEGORY FILTER HUD MATRIX ===== */
        .f-filter-strip {
            position: relative;
            background: #ffffff;
            padding: 24px 0;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            z-index: 10;
        }

        .f-filter-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .f-filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 999px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            color: #334155;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        }

        .f-filter-btn:hover {
            color: #0284c7;
            border-color: #0284c7;
            background: #f0f9ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.15);
        }

        .f-filter-btn.active {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            border-color: #0284c7;
            color: #ffffff;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.35);
            font-weight: 700;
        }

        .f-filter-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.08);
            border-radius: 999px;
            padding: 2px 7px;
            font-size: 11px;
            font-weight: 700;
            color: inherit;
        }
        .f-filter-btn.active .f-filter-count {
            background: rgba(0, 0, 0, 0.25);
            color: #ffffff;
        }

        /* ===== PRODUCTS GRID SECTION (WHITE THEME) ===== */
        .futuristic-catalog-section {
            position: relative;
            background: #f8fafc;
            padding: 70px 0 90px 0;
            color: #0f172a;
            min-height: 500px;
        }

        .f-catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 30px;
        }

        /* Futuristic White Product Card */
        .f-product-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.9);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .f-product-card:hover {
            transform: translateY(-8px) scale(1.015);
            border-color: #0284c7;
            box-shadow: 
                0 22px 50px -10px rgba(14, 165, 233, 0.2),
                0 0 25px rgba(56, 189, 248, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        /* Top Display Bay */
        .f-card-preview-bay {
            position: relative;
            height: 230px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px 24px;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }

        .f-card-circuit {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(14, 165, 233, 0.08) 1.5px, transparent 1.5px);
            background-size: 16px 16px;
            pointer-events: none;
        }

        .f-card-img {
            max-width: 82%;
            max-height: 78%;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;
            position: relative;
            z-index: 2;
        }
        .f-product-card:hover .f-card-img {
            transform: scale(1.08);
            filter: drop-shadow(0 6px 16px rgba(37, 99, 235, 0.15));
        }

        /* Badges */
        .f-card-cat-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(14, 165, 233, 0.35);
            color: #0369a1;
            padding: 4px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
            z-index: 3;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .f-cat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #0284c7;
            box-shadow: 0 0 6px #0284c7;
        }

        .f-card-featured-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.95) 0%, rgba(234, 88, 12, 0.95) 100%);
            border: 1px solid rgba(254, 215, 170, 0.4);
            color: #ffffff;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.5px;
            z-index: 3;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Target Reticles */
        .f-card-corner {
            position: absolute;
            width: 12px;
            height: 12px;
            border-color: #0284c7;
            border-style: solid;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 3;
        }
        .f-product-card:hover .f-card-corner {
            opacity: 0.9;
        }
        .f-corner-tl { top: 10px; left: 10px; border-width: 1.5px 0 0 1.5px; }
        .f-corner-tr { top: 10px; right: 10px; border-width: 1.5px 1.5px 0 0; }
        .f-corner-bl { bottom: 10px; left: 10px; border-width: 0 0 1.5px 1.5px; }
        .f-corner-br { bottom: 10px; right: 10px; border-width: 0 1.5px 1.5px 0; }

        /* Card Content Body */
        .f-card-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
            background: #ffffff;
        }

        .f-card-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 8px;
            transition: color 0.2s ease;
        }
        .f-product-card:hover .f-card-title {
            color: #0284c7;
        }

        .f-card-client {
            font-size: 12px;
            font-weight: 600;
            color: #0284c7;
            margin-bottom: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

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

        /* Tech Chips */
        .f-card-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 20px;
        }
        .f-card-chip {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #334155;
            padding: 3.5px 9px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .f-product-card:hover .f-card-chip {
            background: #e0f2fe;
            border-color: #bae6fd;
            color: #0369a1;
        }

        /* Card Footer */
        .f-card-footer {
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .f-card-meta {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .f-card-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0284c7;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-left: auto;
        }
        .f-card-link i {
            transition: transform 0.2s ease;
        }
        .f-product-card:hover .f-card-link {
            color: #1d4ed8;
        }
        .f-product-card:hover .f-card-link i {
            transform: translateX(4px);
        }

        /* ===== FUTURISTIC PAGINATION ===== */
        .f-pagination-wrap {
            margin-top: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .f-pagination {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            padding: 6px 12px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
        }

        .f-page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid transparent;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .f-page-btn:hover:not(.disabled) {
            background: #f1f5f9;
            color: #0284c7;
        }
        .f-page-btn.active {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            border-color: #0284c7;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
            font-weight: 700;
        }
        .f-page-btn.disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        .f-page-summary {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        /* ===== FUTURISTIC BOTTOM CTA SECTION ===== */
        .futuristic-cta-banner {
            position: relative;
            background: linear-gradient(180deg, #f8fafc 0%, #f0f7ff 100%);
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            padding: 90px 0;
            color: #0f172a;
            overflow: hidden;
            text-align: center;
        }
        .f-cta-box {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.9);
            padding: 50px 36px;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08), 0 0 30px rgba(14, 165, 233, 0.1);
        }
        .f-cta-title {
            font-size: clamp(26px, 3.5vw, 38px);
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 14px;
        }
        .f-cta-desc {
            color: #64748b;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .f-cta-actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .f-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 60%, #06b6d4 100%);
            color: #ffffff !important;
            padding: 14px 34px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.35), 0 0 20px rgba(6, 182, 212, 0.25);
            transition: all 0.3s ease;
        }
        .f-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(37, 99, 235, 0.5), 0 0 30px rgba(6, 182, 212, 0.4);
        }
        .f-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            color: #0f172a !important;
            padding: 13.5px 30px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
        }
        .f-btn-secondary:hover {
            background: #f8fafc;
            border-color: #0284c7;
            color: #0284c7 !important;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .f-catalog-grid {
                grid-template-columns: 1fr;
            }
            .f-catalog-stats {
                gap: 14px;
                padding: 10px 16px;
            }
            .f-cta-box {
                padding: 36px 20px;
            }
        }
    </style>

    <div class="f-hero-bg"></div>
    <div class="f-cyber-grid"></div>
    <div class="f-energy-orb f-orb-left"></div>
    <div class="f-energy-orb f-orb-right"></div>

    <div class="container">
        <!-- Live HUD Beacon -->
        <div class="f-hud-badge" data-aos="fade-down">
            <span class="f-radar-dot"></span>
            <span class="f-badge-subtitle">ENTERPRISE PROPERTY PORTFOLIO</span>
            <span class="f-badge-divider"></span>
            <span class="f-badge-tag"><i class="fas fa-building"></i> FEATURED DEVELOPMENTS</span>
        </div>

        <!-- Headline -->
        <h1 class="f-hero-title" data-aos="fade-up">
            Properties That <span class="f-gradient-text">Redefine Modern Living & Commerce</span>
        </h1>

        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            Explore our portfolio of premier residential developments, commercial hubs, architectural landmarks, and managed estates.
        </p>

        <!-- Catalog Telemetry Capsule -->
        <div class="f-catalog-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="f-stat-item">
                <span class="f-stat-val">{{ $portfolios->total() ?? '50+' }}</span>
                <span>Featured Properties</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">100%</span>
                <span>RERA Verified</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">{{ $categories->count() ?? '6+' }}</span>
                <span>Key Categories</span>
            </div>
        </div>
    </div>
</section>

<!-- =============== CATEGORY FILTER MATRIX =============== -->
<div class="f-filter-strip">
    <div class="container">
        <div class="f-filter-container">
            <a href="{{ route('portfolio') }}" class="f-filter-btn {{ !request('category') ? 'active' : '' }}">
                <i class="fas fa-layer-group" style="font-size:12px"></i>
                <span>All Products</span>
                <span class="f-filter-count">{{ \App\Models\Portfolio::where('is_active', 1)->count() }}</span>
            </a>
            @foreach($categories->filter(fn($c) => (int) $c->portfolios_count > 0) as $cat)
            <a href="{{ route('portfolio', ['category' => $cat->slug]) }}" class="f-filter-btn {{ request('category') === $cat->slug ? 'active' : '' }}">
                <span>{{ $cat->name }}</span>
                <span class="f-filter-count">{{ $cat->portfolios_count }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- =============== PRODUCTS CATALOG GRID (WHITE THEME) =============== -->
<section class="futuristic-catalog-section">
    <div class="container">
        <div class="f-catalog-grid">
            @foreach($portfolios as $i => $project)
            <div class="f-product-card" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}"
                 onclick="location.href='{{ route('portfolio.show', $project->slug) }}'">
                <!-- Top Display Bay -->
                <div class="f-card-preview-bay">
                    <div class="f-card-circuit"></div>
                    <div class="f-card-corner f-corner-tl"></div>
                    <div class="f-card-corner f-corner-tr"></div>
                    <div class="f-card-corner f-corner-bl"></div>
                    <div class="f-card-corner f-corner-br"></div>

                    @if($project->category)
                    <div class="f-card-cat-badge">
                        <span class="f-cat-dot"></span>
                        <span>{{ $project->category->name }}</span>
                    </div>
                    @endif

                    @if($project->is_featured)
                    <div class="f-card-featured-badge">
                        <i class="fas fa-star" style="font-size:10px"></i> Featured
                    </div>
                    @endif

                    @if($project->featured_image)
                    <img src="{{ media_url($project->featured_image) }}" alt="{{ $project->title }}" class="f-card-img">
                    @else
                    <div style="font-size:55px;color:#0284c7;opacity:0.3"><i class="fas fa-cubes"></i></div>
                    @endif
                </div>

                <!-- Card Content -->
                <div class="f-card-body">
                    <div>
                        <h3 class="f-card-title">{{ $project->title }}</h3>

                        @if($project->client_name)
                        <div class="f-card-client">
                            <i class="fas fa-building"></i>
                            <span>{{ $project->client_name }}</span>
                        </div>
                        @endif

                        <p class="f-card-desc">{{ $project->short_description }}</p>

                        @if($project->technologies && count($project->technologies) > 0)
                        <div class="f-card-chips">
                            @php
                                $projTechs = is_array($project->technologies)
                                    ? $project->technologies
                                    : ((is_string($project->technologies) && $project->technologies !== '')
                                        ? (json_decode($project->technologies, true) ?: [])
                                        : []);
                            @endphp
                            @foreach(array_slice($projTechs, 0, 4) as $tech)
                            <span class="f-card-chip">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Footer Details -->
                    <div class="f-card-footer">
                        @if($project->completion_date)
                        <span class="f-card-meta">
                            <i class="fas fa-calendar-alt"></i> {{ $project->completion_date->format('M Y') }}
                        </span>
                        @endif

                        <a href="{{ route('portfolio.show', $project->slug) }}" class="f-card-link" onclick="event.stopPropagation()">
                            <span>Case Study</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($portfolios->hasPages())
        <div class="f-pagination-wrap" data-aos="fade-up">
            <nav class="f-pagination">
                {{-- Previous Page --}}
                @if($portfolios->onFirstPage())
                    <span class="f-page-btn disabled"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $portfolios->previousPageUrl() }}" class="f-page-btn"><i class="fas fa-chevron-left"></i></a>
                @endif

                {{-- Page Numbers --}}
                @foreach($portfolios->links()->elements[0] as $page => $url)
                    @if(is_string($page) && $page === '...')
                        <span class="f-page-btn disabled" style="opacity:0.6">…</span>
                    @elseif($page == $portfolios->currentPage())
                        <span class="f-page-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="f-page-btn">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if($portfolios->hasMorePages())
                    <a href="{{ $portfolios->nextPageUrl() }}" class="f-page-btn"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="f-page-btn disabled"><i class="fas fa-chevron-right"></i></span>
                @endif
            </nav>

            <div class="f-page-summary">
                Showing {{ $portfolios->firstItem() }} to {{ $portfolios->lastItem() }} of {{ $portfolios->total() }} total products
            </div>
        </div>
        @endif
    </div>
</section>

<!-- =============== FUTURISTIC BOTTOM CTA =============== -->
<section class="futuristic-cta-banner">
    <div class="container">
        <div class="f-cta-box" data-aos="zoom-in">
            <h2 class="f-cta-title">
                Ready to Explore <span class="f-gradient-text" style="background:linear-gradient(135deg, #1d4ed8 0%, #0284c7 50%, #06b6d4 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Exclusive Properties & Projects?</span>
            </h2>
            <p class="f-cta-desc">
                Partner with our real estate specialists, architects, and structural engineering team to secure or construct your ideal space.
            </p>
            <div class="f-cta-actions">
                <a href="{{ route('contact') }}" class="f-btn-primary">
                    <i class="fas fa-calendar-check"></i>
                    <span>Schedule Consultation</span>
                </a>
                <a href="{{ route('services') }}" class="f-btn-secondary">
                    <i class="fas fa-building"></i>
                    <span>Explore Services</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection