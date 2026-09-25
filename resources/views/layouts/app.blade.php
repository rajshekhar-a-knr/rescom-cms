<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>@yield('title', setting('site_name', 'Rescom')) {{ setting('meta_title_suffix', ' | IT Solutions Company') }}</title>
    <meta name="description" content="@yield('meta_description', setting('site_description', 'Rescom - Leading IT Solutions Company'))">
    <meta name="keywords" content="@yield('meta_keywords', 'IT solutions, web development, mobile app development, cloud computing, cybersecurity, AI, digital transformation')">
    <meta name="author" content="Rescom">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', setting('site_name'))">
    <meta property="og:description" content="@yield('og_description', setting('site_description'))">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ setting('site_name', 'Rescom') }}">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', setting('site_name'))">
    <meta name="twitter:description" content="@yield('twitter_description', setting('site_description'))">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    
    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ setting('site_favicon') ? setting('site_favicon') : asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ setting('site_logo') ? setting('site_logo') : asset('images/apple-touch-icon.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ time() }}">
    <style>
        .field-error { color: #dc2626; font-size: 12px; margin-top: 6px; }
        :root { --header-height: 80px; }
        .mobile-menu { top: 0; height: 100%; padding-top: var(--header-height); }
        @media (max-width: 768px) { :root { --header-height: 72px; } }
        .mobile-menu {
            background: linear-gradient(180deg, #0b1f3a 0%, #0c2444 60%, #0a1a2e 100%);
            box-shadow: 0 30px 60px rgba(2, 6, 23, 0.45);
            padding: 18px 18px 28px;
        }
        .mobile-menu-link {
            padding: 14px 14px;
            border-radius: 14px;
            font-weight: 700;
            letter-spacing: 0.2px;
            color: rgba(255,255,255,0.92);
            transition: background 0.2s ease, transform 0.2s ease, color 0.2s ease;
        }
        .mobile-menu-link:hover,
        .mobile-menu-link.active {
            background: rgba(255,255,255,0.12);
            color: #ffffff;
            transform: translateX(2px);
        }
        .mobile-menu-section {
            margin: 18px 8px 8px;
            font-size: 11px;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.55);
        }
        .mobile-menu-text { font-size: 16px; }

                        .footer-bottom {
            border-top: 1px solid rgba(0,0,0,0.08);
            padding: 18px 0 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
        }
        .footer-copyright {
            color: #475569;
            font-size: 13.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            margin: 0;
            line-height: 1;
            text-align: center;
        }
        .footer-copy-text {
            color: #475569;
            font-size: 13.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            line-height: 1;
        }
        .footer-brand-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13.5px;
            font-weight: 500;
            color: #475569;
            white-space: nowrap;
            line-height: 1;
        }
        .footer-badge-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            padding: 2px 9px;
            height: 25px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            vertical-align: middle;
            transition: all 0.2s ease;
        }
        .footer-badge-pill:hover {
            border-color: #94a3b8;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }
        .footer-credit-logo {
            display: inline-block !important;
            vertical-align: middle !important;
            object-fit: contain !important;
        }
        .footer-webcore-logo {
            height: 16px !important;
            max-height: 16px !important;
            max-width: 68px !important;
            width: auto !important;
        }
        .footer-knr-logo {
            height: 16px !important;
            max-height: 16px !important;
            max-width: 72px !important;
            width: auto !important;
        }
        .footer-rescom-logo {
            height: 16px !important;
            max-height: 16px !important;
            max-width: 70px !important;
            width: auto !important;
        }

/* ===== FUTURISTIC HEADER PRESENTATION BUTTON ===== */
        .btn-header-presentation {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 14px 7px 8px;
            border-radius: 999px;
            font-size: 13.5px;
            font-weight: 750;
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            text-decoration: none;
            color: #ffffff !important;
            background: linear-gradient(135deg, rgba(8, 22, 52, 0.88) 0%, rgba(16, 44, 94, 0.78) 100%);
            border: 1.5px solid rgba(56, 189, 248, 0.45);
            box-shadow: 0 4px 18px rgba(0, 240, 255, 0.18), inset 0 1px 1px rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
            overflow: hidden;
            z-index: 1;
        }

        /* Ambient Shimmer Sweep */
        .btn-header-presentation::before {
            content: '';
            position: absolute;
            top: -60%;
            left: -80%;
            width: 55%;
            height: 220%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), rgba(0, 240, 255, 0.25), transparent);
            transform: rotate(25deg);
            pointer-events: none;
            animation: btnPresShimmer 4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            z-index: 2;
        }

        @keyframes btnPresShimmer {
            0% { left: -80%; }
            30%, 100% { left: 160%; }
        }

        .btn-header-presentation .btn-pres-icon-wrap {
            position: relative;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #00f0ff 0%, #0284c7 100%);
            color: #031127 !important;
            box-shadow: 0 0 12px rgba(0, 240, 255, 0.5);
            font-size: 12px;
            flex-shrink: 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 3;
        }

        .btn-header-presentation .btn-pres-radar {
            position: absolute;
            top: -1px;
            right: -1px;
            width: 7px;
            height: 7px;
            background: #22c55e;
            border-radius: 50%;
            border: 1.5px solid #08162d;
            box-shadow: 0 0 6px #22c55e;
            animation: btnPresPing 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes btnPresPing {
            0% { transform: scale(0.95); opacity: 0.9; }
            50% { transform: scale(1.3); opacity: 1; box-shadow: 0 0 10px #22c55e; }
            100% { transform: scale(0.95); opacity: 0.9; }
        }

        .btn-header-presentation .btn-pres-text {
            display: inline-flex;
            align-items: center;
            letter-spacing: 0.15px;
            z-index: 3;
        }

        .btn-header-presentation .btn-pres-badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 7px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 850;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            background: rgba(0, 240, 255, 0.16);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.45);
            box-shadow: 0 0 8px rgba(0, 240, 255, 0.2);
            margin-left: 2px;
            z-index: 3;
            transition: all 0.25s ease;
        }

        .btn-header-presentation:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, rgba(14, 35, 75, 0.94) 0%, rgba(24, 62, 126, 0.88) 100%);
            border-color: #00f0ff;
            color: #ffffff !important;
            box-shadow: 0 8px 28px rgba(0, 240, 255, 0.4), 0 0 16px rgba(56, 189, 248, 0.35);
        }

        .btn-header-presentation:hover .btn-pres-icon-wrap {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 0 18px rgba(0, 240, 255, 0.8);
        }

        .btn-header-presentation:hover .btn-pres-badge {
            background: linear-gradient(135deg, #00f0ff, #0284c7);
            color: #040714;
            border-color: #00f0ff;
            box-shadow: 0 0 12px rgba(0, 240, 255, 0.5);
        }

        /* Scrolled & Light Page Contrast */
        .header.scrolled .btn-header-presentation,
        .home-hero-light .header .btn-header-presentation,
        .detail-hero-light .header .btn-header-presentation {
            color: #0c203b !important;
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
            border-color: rgba(2, 132, 199, 0.35);
            box-shadow: 0 4px 18px rgba(2, 132, 199, 0.14), inset 0 1px 2px rgba(255, 255, 255, 0.95);
        }
        .header.scrolled .btn-header-presentation::before,
        .home-hero-light .header .btn-header-presentation::before,
        .detail-hero-light .header .btn-header-presentation::before {
            background: linear-gradient(90deg, transparent, rgba(2, 132, 199, 0.18), transparent);
        }
        .header.scrolled .btn-header-presentation .btn-pres-icon-wrap,
        .home-hero-light .header .btn-header-presentation .btn-pres-icon-wrap,
        .detail-hero-light .header .btn-header-presentation .btn-pres-icon-wrap {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(2, 132, 199, 0.35);
        }
        .header.scrolled .btn-header-presentation .btn-pres-radar,
        .home-hero-light .header .btn-header-presentation .btn-pres-radar,
        .detail-hero-light .header .btn-header-presentation .btn-pres-radar {
            border-color: #ffffff;
        }
        .header.scrolled .btn-header-presentation .btn-pres-badge,
        .home-hero-light .header .btn-header-presentation .btn-pres-badge,
        .detail-hero-light .header .btn-header-presentation .btn-pres-badge {
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.1), rgba(56, 189, 248, 0.15));
            color: #0284c7;
            border-color: rgba(2, 132, 199, 0.3);
            box-shadow: none;
        }
        .header.scrolled .btn-header-presentation:hover,
        .home-hero-light .header .btn-header-presentation:hover,
        .detail-hero-light .header .btn-header-presentation:hover {
            background: #ffffff;
            border-color: #0284c7;
            color: #0284c7 !important;
            box-shadow: 0 8px 25px rgba(2, 132, 199, 0.25), 0 0 12px rgba(56, 189, 248, 0.2);
        }
        .header.scrolled .btn-header-presentation:hover .btn-pres-badge,
        .home-hero-light .header .btn-header-presentation:hover .btn-pres-badge,
        .detail-hero-light .header .btn-header-presentation:hover .btn-pres-badge {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
        }

        /* Highlighted Company Link in Footer */
        .footer-highlight-deck-link {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            background: linear-gradient(90deg, rgba(2, 132, 199, 0.08) 0%, transparent 100%);
            padding: 4px 8px;
            border-radius: 8px;
            border-left: 2.5px solid #0284c7;
            font-weight: 750 !important;
            color: #0f172a !important;
        }
        .footer-highlight-deck-link:hover {
            background: linear-gradient(90deg, rgba(2, 132, 199, 0.16) 0%, rgba(2, 132, 199, 0.04) 100%);
            color: #0284c7 !important;
            padding-left: 10px !important;
        }
        .footer-live-chip {
            font-size: 9.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            background: linear-gradient(135deg, #00f0ff, #0284c7);
            color: #040714;
            padding: 1px 7px;
            border-radius: 999px;
            box-shadow: 0 0 10px rgba(0, 240, 255, 0.35);
            display: inline-block;
        }
    </style>
    
    @yield('head')
    
    <!-- Analytics -->
    @if(setting('analytics_code'))
        {!! setting('analytics_code') !!}
    @endif

    
</head>
@php
    $topbarEnabled = setting('topbar_enabled') === '1';
    $topScrollerItems = collect();
    $fallbackText = '';
    $fallbackUrl = null;
    $topScrollerSpeed = (int) setting('top_scroller_speed', 18);
    $topScrollerSpeed = max(6, min(120, $topScrollerSpeed));

    if ($topbarEnabled) {
        try {
            $topScrollerItems = \App\Models\TopScroller::active()->orderBy('sort_order')->orderBy('id')->get();
        } catch (\Throwable $e) {
            $topScrollerItems = collect();
        }

        $fallbackText = setting('topbar_marquee_text', '');
        $fallbackUrl = setting('topbar_marquee_url', setting('topbar_right_url'));
        if ($topScrollerItems->isEmpty() && $fallbackText) {
            $topScrollerItems = collect([['text' => $fallbackText, 'url' => $fallbackUrl]]);
        }
    }

    $showTopbar = $topbarEnabled && $topScrollerItems->isNotEmpty();
@endphp
<body class="{{ $showTopbar ? 'has-topbar' : '' }} {{ request()->routeIs('team.show') || request()->routeIs('internship*') || request()->routeIs('admin.login*') || request()->is('admin/login*') ? 'detail-hero-light' : '' }}">
@php
    $siteName = setting('site_name', 'Rescom');
    $siteLogo = setting('site_logo');
    $siteTagline = setting('site_tagline', 'IT Solutions');
@endphp

<div class="page-loader" id="pageLoader" aria-hidden="true">
    <div class="page-loader__inner">
        @if($siteLogo)
            <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="page-loader__logo">
        @else
            <div class="page-loader__logo-text">{{ strtoupper(substr($siteName, 0, 3)) }}</div>
        @endif
        <div class="page-loader__spinner" aria-hidden="true"></div>
    </div>
</div>

<!-- =============== HEADER =============== -->
@if($showTopbar)
<div class="topbar" id="topBar" style="--topbar-speed: {{ $topScrollerSpeed }}s;">
    <div class="topbar-inner">
        <div class="topbar-left" aria-label="Site name">
            <a class="topbar-brand" href="{{ route('home') }}">{{ setting('site_name', 'Rescom') }}</a>
        </div>

        <div class="topbar-middle">
            <div class="topbar-marquee" aria-label="Top announcements">
                <div class="topbar-track">
                    <div class="topbar-group">
                        @foreach($topScrollerItems as $item)
                            <div class="topbar-item">
                                <i class="fas fa-bullhorn"></i>
                                @if(data_get($item, 'url'))
                                    <a href="{{ data_get($item, 'url') }}">{{ data_get($item, 'text') }}</a>
                                @else
                                    <span>{{ data_get($item, 'text') }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="topbar-right" aria-label="Quick actions">
            @if(setting('contact_phone'))
                <a class="topbar-call" href="tel:{{ setting('contact_phone') }}">
                    <i class="fas fa-phone"></i>
                    <span>{{ setting('contact_phone') }}</span>
                </a>
            @endif

            <div class="topbar-social" aria-label="Social links">
                @if(setting('social_facebook'))<a class="topbar-icon" href="{{ setting('social_facebook') }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>@endif
                @if(setting('social_twitter'))<a class="topbar-icon" href="{{ setting('social_twitter') }}" target="_blank" rel="noopener" aria-label="X"><i class="fab fa-x-twitter"></i></a>@endif
                @if(setting('social_linkedin'))<a class="topbar-icon" href="{{ setting('social_linkedin') }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>@endif
                @if(setting('social_instagram'))<a class="topbar-icon" href="{{ setting('social_instagram') }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>@endif
                @if(setting('social_youtube'))<a class="topbar-icon" href="{{ setting('social_youtube') }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>@endif
                @if(setting('social_github'))<a class="topbar-icon" href="{{ setting('social_github') }}" target="_blank" rel="noopener" aria-label="GitHub"><i class="fab fa-github"></i></a>@endif
            </div>
        </div>
    </div>
</div>
@endif

<header class="header" id="mainHeader">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-stack">
                @if($siteLogo)
                    <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="logo-image">
                @else
                    <div class="logo-icon">{{ strtoupper(substr($siteName, 0, 3)) }}</div>
                @endif
                @if($siteTagline)
                    <span class="logo-tagline">{{ $siteTagline }}</span>
                @endif
            </div>
        </a>

        @php
            $navPages = collect();
            $headerMenuItems = collect();
            try {
                $headerMenuItems = \App\Models\MenuItem::where('menu_id', 1)
                    ->where('is_active', 1)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
                $navPages = \App\Models\Page::where('status', 'published')
                    ->where('show_in_header', 1)
                    ->orderBy('sort_order')
                    ->get();
            } catch (\Throwable $e) {
                $headerMenuItems = collect();
                $navPages = collect();
            }
        @endphp
        @if(setting('header_menu_enabled', 1))
        <nav class="nav">
            @if($headerMenuItems->isNotEmpty())
                @foreach($headerMenuItems as $item)
                    @if($item->item_type === 'dropdown_products')
                        <div class="nav-dropdown nav-dropdown--fit">
                            <a href="{{ $item->url ?: route('portfolio') }}" class="nav-link {{ request()->routeIs('portfolio*') ? 'active' : '' }}">
                                @if($item->icon)<i class="{{ $item->icon }}"></i>@endif
                                {{ $item->title }}
                                @if($item->badge_text)
                                    <span class="nav-badge" style="font-size:10px;padding:2px 7px;border-radius:999px;background:var(--accent);color:white;margin-left:4px;font-weight:700">{{ $item->badge_text }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu--tabs">
                                @php
                                    $portfolioCategories = \App\Models\PortfolioCategory::with(['portfolios' => fn($q) => $q->where('is_active',1)->orderBy('sort_order')])
                                        ->withCount(['portfolios' => fn($q) => $q->where('is_active',1)])
                                        ->orderBy('sort_order')
                                        ->get()
                                        ->filter(fn($cat) => (int) $cat->portfolios_count > 0)
                                        ->values();
                                @endphp
                                <div class="dropdown-tabs" data-tabs="products">
                                    <div class="dropdown-tabs-nav">
                                        @foreach($portfolioCategories as $cat)
                                            <button type="button" class="dropdown-tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $cat->slug }}">
                                                {{ $cat->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-tabs-panels">
                                        @foreach($portfolioCategories as $cat)
                                            <div class="dropdown-tab-panel {{ $loop->first ? 'active' : '' }}" data-tab-panel="{{ $cat->slug }}">
                                                @foreach($cat->portfolios as $p)
                                                    <a href="{{ route('portfolio.show', $p->slug) }}" class="dropdown-item">
                                                        {{ $p->title }}
                                                    </a>
                                                @endforeach
                                                <a href="{{ route('portfolio', ['category' => $cat->slug]) }}" class="dropdown-item dropdown-item-muted">
                                                    View all {{ $cat->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('portfolio') }}" class="dropdown-item dropdown-item-all">
                                        All Products
                                    </a>
                                </div>
                            </div>
                        </div>
                    @elseif($item->item_type === 'dropdown_services')
                        <div class="nav-dropdown nav-dropdown--fit">
                            <a href="{{ $item->url ?: route('services') }}" class="nav-link {{ request()->routeIs('services*') ? 'active' : '' }}">
                                @if($item->icon)<i class="{{ $item->icon }}"></i>@endif
                                {{ $item->title }}
                                @if($item->badge_text)
                                    <span class="nav-badge" style="font-size:10px;padding:2px 7px;border-radius:999px;background:var(--accent);color:white;margin-left:4px;font-weight:700">{{ $item->badge_text }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu--tabs">
                                @php
                                    $serviceCategories = \App\Models\ServiceCategory::with(['services' => fn($q) => $q->where('is_active',1)->orderBy('sort_order')])
                                        ->withCount(['services' => fn($q) => $q->where('is_active',1)])
                                        ->where('is_active',1)
                                        ->orderBy('sort_order')
                                        ->get()
                                        ->filter(fn($cat) => (int) $cat->services_count > 0)
                                        ->values();
                                @endphp
                                <div class="dropdown-tabs" data-tabs="services">
                                    <div class="dropdown-tabs-nav">
                                        @foreach($serviceCategories as $cat)
                                            <button type="button" class="dropdown-tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $cat->slug }}">
                                                {{ $cat->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-tabs-panels">
                                        @foreach($serviceCategories as $cat)
                                            <div class="dropdown-tab-panel {{ $loop->first ? 'active' : '' }}" data-tab-panel="{{ $cat->slug }}">
                                                @foreach($cat->services as $s)
                                                    <a href="{{ route('services.show', $s->slug) }}" class="dropdown-item">
                                                        {{ $s->title }}
                                                    </a>
                                                @endforeach
                                                <a href="{{ route('services', ['category' => $cat->slug]) }}" class="dropdown-item dropdown-item-muted">
                                                    View all {{ $cat->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('services') }}" class="dropdown-item dropdown-item-all">
                                        All Services
                                    </a>
                                </div>
                            </div>
                        </div>
                    @elseif($item->item_type === 'dropdown_resources')
                        <div class="nav-dropdown nav-dropdown--fit">
                            <a href="javascript:void(0)" 
                               class="nav-link {{ request()->routeIs('gallery') || request()->routeIs('blog*') || request()->routeIs('faqs.page') || request()->routeIs('testimonials') || request()->routeIs('events*') || request()->routeIs('internship*') ? 'active' : '' }}">
                                @if($item->icon)<i class="{{ $item->icon }}"></i>@endif
                                {{ $item->title }}
                                @if($item->badge_text)
                                    <span class="nav-badge" style="font-size:10px;padding:2px 7px;border-radius:999px;background:var(--accent);color:white;margin-left:4px;font-weight:700">{{ $item->badge_text }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu">
                                @php
                                    $eventsCount = 0;
                                    $galleryCount = 0;
                                    $blogsCount = 0;
                                    $testimonialsCount = 0;
                                    $faqsCount = 0;
                                    try {
                                        $eventsCount = \App\Models\Event::where('is_active',1)->count();
                                        $galleryCount = \App\Models\GalleryItem::where('is_active',1)->count();
                                        $blogsCount = \App\Models\BlogPost::where('status','published')->count();
                                        $testimonialsCount = \App\Models\Testimonial::where('is_active',1)->count();
                                        $faqsCount = \App\Models\Faq::where('is_active',1)->count();
                                    } catch (\Throwable $e) {}

                                    $resources = collect([
                                        ['label' => 'Internship', 'url' => route('internship'), 'count' => 1],
                                        ['label' => 'Events', 'url' => route('events'), 'count' => $eventsCount],
                                        ['label' => 'Gallery', 'url' => route('gallery'), 'count' => $galleryCount],
                                        ['label' => 'Blogs', 'url' => route('blog'), 'count' => $blogsCount],
                                        ['label' => 'Testimonials', 'url' => route('testimonials'), 'count' => $testimonialsCount],
                                        ['label' => 'FAQs', 'url' => route('faqs.page'), 'count' => $faqsCount],
                                    ])->filter(fn($r) => (int) $r['count'] > 0);
                                @endphp
                                @foreach($resources as $r)
                                    <a href="{{ $r['url'] }}" class="dropdown-item">
                                        {{ $r['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @elseif($item->item_type === 'presentation')
                        <a href="{{ $item->url ?: route('presentation.show', 'rescom-presentation') }}" target="{{ $item->target ?: '_blank' }}" class="nav-link {{ request()->is('presentation*') || request()->is('rescom-presentation') ? 'active' : '' }}" title="Rescom Corporate Presentation">
                            @if($item->icon)<i class="{{ $item->icon }}"></i>@endif
                            {{ $item->title }}
                            @if($item->badge_text)
                                <span class="nav-badge" style="font-size:10px;padding:2px 7px;border-radius:999px;background:linear-gradient(135deg,#00f0ff,#0284c7);color:#040714;font-weight:800;margin-left:4px">{{ $item->badge_text }}</span>
                            @endif
                        </a>
                    @else
                        @php
                            $itemUrl = $item->url ? (str_starts_with($item->url, 'http') || str_starts_with($item->url, '/') || str_starts_with($item->url, '#') ? $item->url : url($item->url)) : '#';
                            $isActive = trim($item->url, '/') && (request()->is(trim($item->url, '/')) || request()->is(trim($item->url, '/').'/*'));
                        @endphp
                        <a href="{{ $itemUrl }}" target="{{ $item->target ?: '_self' }}" class="nav-link {{ $isActive ? 'active' : '' }}">
                            @if($item->icon)<i class="{{ $item->icon }}"></i>@endif
                            {{ $item->title }}
                            @if($item->badge_text)
                                <span class="nav-badge" style="font-size:10px;padding:2px 7px;border-radius:999px;background:var(--accent);color:white;margin-left:4px;font-weight:700">{{ $item->badge_text }}</span>
                            @endif
                        </a>
                    @endif
                @endforeach
            @else
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <div class="nav-dropdown nav-dropdown--fit">
                    <a href="{{ route('portfolio') }}" class="nav-link {{ request()->routeIs('portfolio*') ? 'active' : '' }}">Products</a>
                    <div class="dropdown-menu dropdown-menu--tabs">
                        @php
                            $portfolioCategories = \App\Models\PortfolioCategory::with(['portfolios' => fn($q) => $q->where('is_active',1)->orderBy('sort_order')])
                                ->withCount(['portfolios' => fn($q) => $q->where('is_active',1)])
                                ->orderBy('sort_order')
                                ->get()
                                ->filter(fn($cat) => (int) $cat->portfolios_count > 0)
                                ->values();
                        @endphp
                        <div class="dropdown-tabs" data-tabs="products">
                            <div class="dropdown-tabs-nav">
                                @foreach($portfolioCategories as $cat)
                                    <button type="button" class="dropdown-tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $cat->slug }}">
                                        {{ $cat->name }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="dropdown-tabs-panels">
                                @foreach($portfolioCategories as $cat)
                                    <div class="dropdown-tab-panel {{ $loop->first ? 'active' : '' }}" data-tab-panel="{{ $cat->slug }}">
                                        @foreach($cat->portfolios as $p)
                                            <a href="{{ route('portfolio.show', $p->slug) }}" class="dropdown-item">
                                                {{ $p->title }}
                                            </a>
                                        @endforeach
                                        <a href="{{ route('portfolio', ['category' => $cat->slug]) }}" class="dropdown-item dropdown-item-muted">
                                            View all {{ $cat->name }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('portfolio') }}" class="dropdown-item dropdown-item-all">
                                All Products
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-dropdown nav-dropdown--fit">
                    <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services*') ? 'active' : '' }}">Services</a>
                    <div class="dropdown-menu dropdown-menu--tabs">
                        @php
                            $serviceCategories = \App\Models\ServiceCategory::with(['services' => fn($q) => $q->where('is_active',1)->orderBy('sort_order')])
                                ->withCount(['services' => fn($q) => $q->where('is_active',1)])
                                ->where('is_active',1)
                                ->orderBy('sort_order')
                                ->get()
                                ->filter(fn($cat) => (int) $cat->services_count > 0)
                                ->values();
                        @endphp
                        <div class="dropdown-tabs" data-tabs="services">
                            <div class="dropdown-tabs-nav">
                                @foreach($serviceCategories as $cat)
                                    <button type="button" class="dropdown-tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $cat->slug }}">
                                        {{ $cat->name }}
                                    </button>
                                @endforeach
                            </div>
                            <div class="dropdown-tabs-panels">
                                @foreach($serviceCategories as $cat)
                                    <div class="dropdown-tab-panel {{ $loop->first ? 'active' : '' }}" data-tab-panel="{{ $cat->slug }}">
                                        @foreach($cat->services as $s)
                                            <a href="{{ route('services.show', $s->slug) }}" class="dropdown-item">
                                                {{ $s->title }}
                                            </a>
                                        @endforeach
                                        <a href="{{ route('services', ['category' => $cat->slug]) }}" class="dropdown-item dropdown-item-muted">
                                            View all {{ $cat->name }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('services') }}" class="dropdown-item dropdown-item-all">
                                All Services
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('careers') }}" class="nav-link {{ request()->routeIs('careers*') ? 'active' : '' }}">Careers</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            @endif

            @foreach($navPages as $page)
                <a href="{{ route('page.show', $page->slug) }}" class="nav-link {{ request()->is('page/'.$page->slug) ? 'active' : '' }}">
                    {{ $page->title }}
                </a>
            @endforeach

            @if(setting('header_search_enabled', 1))
            <div class="nav-search">
                <button class="nav-link nav-search-btn" type="button" id="openSearch" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            @endif
        </nav>
        @endif

        <div class="nav-search-panel" id="navSearchPanel" aria-hidden="true">
            <div class="nav-search-field">
                <i class="fas fa-search"></i>
                <input type="text" id="navSearchInput" placeholder="Search the website..." autocomplete="off">
                <button type="button" class="nav-search-close" id="navSearchClose" aria-label="Close search">&times;</button>
            </div>
            <div class="nav-search-results" id="navSearchResults"></div>
            <div class="nav-search-hint" id="navSearchHint">Type at least 2 characters to search.</div>
        </div>

        <div class="nav-actions">
            @if(setting('header_presentation_enabled', 1))
            <a href="{{ route('presentation.show', 'rescom-presentation') }}" target="_blank" class="btn-header-presentation" title="Launch Interactive Corporate Presentation">
                <span class="btn-pres-icon-wrap">
                    <i class="fas fa-desktop"></i>
                    <span class="btn-pres-radar"></span>
                </span>
                <span class="btn-pres-text">{{ setting('header_presentation_text', 'Presentation') }}</span>
            </a>
            @endif
            @if(setting('header_cta_enabled', 1))
            <a href="{{ setting('header_cta_url', route('demo-products.index')) }}" class="btn-primary">
                {{ setting('header_cta_text', 'Request Demo') }} <i class="fas fa-arrow-right"></i>
            </a>
            @endif
        </div>

        <div class="header-actions-mobile">
            @if(setting('header_search_enabled', 1))
            <button class="mobile-search-btn" type="button" id="openSearchMobileHeader" aria-label="Search">
                <i class="fas fa-search"></i>
            </button>
            @endif
            <button class="mobile-toggle" id="mobileToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Search Popup -->
<div class="mobile-search-overlay" id="mobileSearchOverlay" aria-hidden="true">
    <div class="mobile-search-backdrop" data-mobile-search-close></div>
    <div class="mobile-search-panel" role="dialog" aria-modal="true" aria-label="Search">
        <div class="mobile-search-field">
            <i class="fas fa-search"></i>
            <input type="text" id="mobileSearchInput" placeholder="Search the website..." autocomplete="off">
            <button type="button" class="mobile-search-close" id="mobileSearchClose" aria-label="Close search">&times;</button>
        </div>
        <div class="mobile-search-results" id="mobileSearchResults"></div>
        <div class="nav-search-hint" id="mobileSearchHint">Type at least 2 characters to search.</div>
    </div>
</div>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-brand" style="display:flex;align-items:center;gap:12px;padding:14px 12px 18px;border-bottom:1px solid rgba(255,255,255,0.12);margin-bottom:10px">
        @if($siteLogo)
            <img src="{{ $siteLogo }}" alt="{{ $siteName }}" style="width:40px;height:40px;border-radius:10px;background:white;padding:4px;box-shadow:0 8px 18px rgba(0,0,0,0.25)">
        @else
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;font-weight:800;color:white">
                {{ strtoupper(substr($siteName, 0, 3)) }}
            </div>
        @endif
        <div>
            <div style="color:white;font-weight:800;font-size:16px;line-height:1">{{ $siteName }}</div>
            @if($siteTagline)<div style="color:rgba(255,255,255,0.6);font-size:11px;letter-spacing:1px;text-transform:uppercase;margin-top:4px">{{ $siteTagline }}</div>@endif
        </div>
    </div>
    
    @if(setting('header_menu_enabled', 1))
        @if($headerMenuItems->isNotEmpty())
            @foreach($headerMenuItems as $item)
                @if($item->item_type === 'presentation')
                    <a href="{{ $item->url ?: route('presentation.show', 'rescom-presentation') }}" target="{{ $item->target ?: '_blank' }}" class="mobile-menu-link">
                        <span class="mobile-menu-text">{{ $item->title }}</span>
                        @if($item->badge_text)
                            <span style="font-size:10px;font-weight:800;background:linear-gradient(135deg,#00f0ff,#0284c7);color:#040714;padding:2px 8px;border-radius:999px;margin-left:auto">{{ $item->badge_text }}</span>
                        @endif
                    </a>
                @elseif($item->item_type === 'dropdown_resources')
                    <div class="mobile-menu-section">{{ $item->title }}</div>
                    @php
                        $mobileRes = collect([
                            ['label' => 'Internship', 'url' => route('internship')],
                            ['label' => 'Events', 'url' => route('events')],
                            ['label' => 'Gallery', 'url' => route('gallery')],
                            ['label' => 'Blogs', 'url' => route('blog')],
                            ['label' => 'Testimonials', 'url' => route('testimonials')],
                            ['label' => 'FAQs', 'url' => route('faqs.page')],
                        ]);
                    @endphp
                    @foreach($mobileRes as $mr)
                        <a href="{{ $mr['url'] }}" class="mobile-menu-link">
                            <span class="mobile-menu-text">{{ $mr['label'] }}</span>
                        </a>
                    @endforeach
                @else
                    @php
                        $itemUrl = $item->url ? (str_starts_with($item->url, 'http') || str_starts_with($item->url, '/') || str_starts_with($item->url, '#') ? $item->url : url($item->url)) : '#';
                        $isActive = trim($item->url, '/') && (request()->is(trim($item->url, '/')) || request()->is(trim($item->url, '/').'/*'));
                    @endphp
                    <a href="{{ $itemUrl }}" target="{{ $item->target ?: '_self' }}" class="mobile-menu-link {{ $isActive ? 'active' : '' }}">
                        <span class="mobile-menu-text">{{ $item->title }}</span>
                        @if($item->badge_text)
                            <span style="font-size:10px;font-weight:800;background:rgba(255,255,255,0.2);color:white;padding:2px 8px;border-radius:999px;margin-left:auto">{{ $item->badge_text }}</span>
                        @endif
                    </a>
                @endif
            @endforeach
        @else
            <a href="{{ route('about') }}" class="mobile-menu-link {{ request()->routeIs('about') ? 'active' : '' }}">
                <span class="mobile-menu-text">About</span>
            </a>
            <a href="{{ route('presentation.show', 'rescom-presentation') }}" target="_blank" class="mobile-menu-link">
                <span class="mobile-menu-text">Corporate Presentation</span>
                <span style="font-size:10px;font-weight:800;background:linear-gradient(135deg,#00f0ff,#0284c7);color:#040714;padding:2px 8px;border-radius:999px;margin-left:auto">Live</span>
            </a>
            <a href="{{ route('services') }}" class="mobile-menu-link {{ request()->routeIs('services*') ? 'active' : '' }}">
                <span class="mobile-menu-text">Services</span>
            </a>
            <a href="{{ route('portfolio') }}" class="mobile-menu-link {{ request()->routeIs('portfolio*') ? 'active' : '' }}">
                <span class="mobile-menu-text">Products</span>
            </a>
            <a href="{{ route('events') }}" class="mobile-menu-link {{ request()->routeIs('events*') ? 'active' : '' }}">
                <span class="mobile-menu-text">Events</span>
            </a>
            <div class="mobile-menu-section">Resources</div>
            <a href="{{ route('internship') }}" class="mobile-menu-link {{ request()->routeIs('internship') ? 'active' : '' }}">
                <span class="mobile-menu-text">Internship</span>
            </a>
            <a href="{{ route('gallery') }}" class="mobile-menu-link {{ request()->routeIs('gallery') ? 'active' : '' }}">
                <span class="mobile-menu-text">Gallery</span>
            </a>
            <a href="{{ route('testimonials') }}" class="mobile-menu-link {{ request()->routeIs('testimonials') ? 'active' : '' }}">
                <span class="mobile-menu-text">Testimonials</span>
            </a>
            <a href="{{ route('blog') }}" class="mobile-menu-link {{ request()->routeIs('blog*') ? 'active' : '' }}">
                <span class="mobile-menu-text">Blogs</span>
            </a>
            <a href="{{ route('faqs.page') }}" class="mobile-menu-link {{ request()->routeIs('faqs.page') ? 'active' : '' }}">
                <span class="mobile-menu-text">FAQs</span>
            </a>
            <a href="{{ route('careers') }}" class="mobile-menu-link {{ request()->routeIs('careers*') ? 'active' : '' }}">
                <span class="mobile-menu-text">Careers</span>
            </a>
            <a href="{{ route('contact') }}" class="mobile-menu-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                <span class="mobile-menu-text">Contact</span>
            </a>
        @endif

        @foreach($navPages as $page)
            <a href="{{ route('page.show', $page->slug) }}" class="mobile-menu-link {{ request()->is('page/'.$page->slug) ? 'active' : '' }}">
                <span class="mobile-menu-text">{{ $page->title }}</span>
            </a>
        @endforeach
    @endif

    <div style="margin-top:30px;display:flex;flex-direction:column;gap:12px">
        @if(setting('header_cta_enabled', 1))
            <a href="{{ setting('header_cta_url', route('demo-products.index')) }}" class="btn btn-blue" style="justify-content:center">{{ setting('header_cta_text', 'Request Demo') }}</a>
        @endif
        @if(setting('contact_phone'))
            <a href="tel:{{ setting('contact_phone') }}" class="btn btn-outline-white" style="justify-content:center">
                <i class="fas fa-phone"></i> {{ setting('contact_phone') }}
            </a>
        @endif
    </div>
</div>

<!-- =============== PAGE CONTENT =============== -->
<main class="main-content" id="main-content">
    @yield('content')
</main>

<!-- =============== FOOTER =============== -->
@if(setting('footer_enabled', 1))
<footer class="footer" id="mainFooter">
    <div class="footer-container">
        @php
            $footerServicesItems = collect();
            $footerCompanyItems = collect();
            $footerPolicyItems = collect();
            $footerLegalPages = collect();
            $footerPages = collect();

            try {
                $footerServicesItems = \App\Models\MenuItem::where('menu_id', 2)
                    ->where('section', 'services')
                    ->where('is_active', 1)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();

                $footerCompanyItems = \App\Models\MenuItem::where('menu_id', 2)
                    ->where('section', 'company')
                    ->where('is_active', 1)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();

                $footerPolicyItems = \App\Models\MenuItem::where('menu_id', 2)
                    ->where('section', 'policies')
                    ->where('is_active', 1)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();

                $footerLegalPages = \App\Models\LegalPage::where('is_active', 1)->orderBy('sort_order')->get();
                $footerPages = \App\Models\Page::where('status', 'published')
                    ->where('show_in_footer', 1)
                    ->orderBy('sort_order')
                    ->get();
            } catch (\Throwable $e) {}
        @endphp
        <div class="footer-grid">
            @if(setting('footer_about_enabled', 1))
            <div class="footer-about">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-stack">
                        @if($siteLogo)
                            <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="logo-image">
                        @else
                            <div class="logo-icon">{{ strtoupper(substr($siteName, 0, 3)) }}</div>
                        @endif
                        <div class="logo-text">
                            <span class="tagline">{{ $siteTagline }}</span>
                        </div>
                    </div>
                </a>
                <p>{{ setting('footer_about', 'Rescom is your trusted technology partner for digital transformation. We build innovative solutions that drive business growth.') }}</p>
                
                @if(setting('footer_social_enabled', 1))
                <div class="social-links">
                    @if(setting('social_facebook'))<a href="{{ setting('social_facebook') }}" target="_blank" class="social-link social-link--facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>@endif
                    @if(setting('social_twitter'))<a href="{{ setting('social_twitter') }}" target="_blank" class="social-link social-link--x" aria-label="X"><i class="fab fa-x-twitter"></i></a>@endif
                    @if(setting('social_linkedin'))<a href="{{ setting('social_linkedin') }}" target="_blank" class="social-link social-link--linkedin" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>@endif
                    @if(setting('social_instagram'))<a href="{{ setting('social_instagram') }}" target="_blank" class="social-link social-link--instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>@endif
                    @if(setting('social_youtube'))<a href="{{ setting('social_youtube') }}" target="_blank" class="social-link social-link--youtube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>@endif
                    @if(setting('social_github'))<a href="{{ setting('social_github') }}" target="_blank" class="social-link social-link--github" aria-label="GitHub"><i class="fab fa-github"></i></a>@endif
                </div>
                @endif

                <!-- Newsletter Mini -->
                @if(setting('footer_newsletter_enabled', 1))
                <div class="footer-newsletter" style="margin-top:20px">
                    <p class="footer-newsletter-label" style="color:rgba(255,255,255,0.6);font-size:13px;margin-bottom:10px">{{ setting('footer_newsletter_label', 'Subscribe to our newsletter') }}</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="footer-newsletter-form" style="display:flex;gap:8px" id="newsletter">
                        @csrf
                        <input type="text" name="newsletter_website" value="" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0">
                        <input type="hidden" name="newsletter_started_at" value="{{ time() }}">
                        <input type="email" name="email" placeholder="Your email" required 
                               class="footer-newsletter-input"
                               maxlength="255"
                               style="flex:1;padding:10px 14px;border-radius:8px;border:1.5px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.07);color:white;font-size:13px">
                        <button type="submit" class="footer-newsletter-btn" style="background:var(--accent);color:white;border:none;padding:10px 14px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @endif

            @if(setting('footer_services_enabled', 1))
            <div>
                <h4 class="footer-title">{{ setting('footer_services_title', 'Our Services') }}</h4>
                <ul class="footer-links">
                    @if($footerServicesItems->isNotEmpty())
                        @foreach($footerServicesItems as $item)
                            @php
                                $sUrl = $item->url ? (str_starts_with($item->url, 'http') || str_starts_with($item->url, '/') || str_starts_with($item->url, '#') ? $item->url : url($item->url)) : '#';
                            @endphp
                            <li>
                                <a href="{{ $sUrl }}" target="{{ $item->target ?: '_self' }}">
                                    {{ $item->title }}
                                    @if($item->badge_text)
                                        <span style="font-size:9.5px;font-weight:800;background:var(--accent);color:white;padding:1px 6px;border-radius:999px;margin-left:4px">{{ $item->badge_text }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    @else
                        @php
                            $customFooterServices = json_decode(setting('footer_services_links', ''), true);
                            if (is_array($customFooterServices) && !empty($customFooterServices)) {
                                $footerServicesLinks = $customFooterServices;
                            } else {
                                try {
                                    $footerServicesLinks = \App\Models\Service::where('is_active', 1)
                                        ->orderBy('sort_order')
                                        ->orderBy('id')
                                        ->take(8)
                                        ->get()
                                        ->map(fn($s) => [
                                            'label' => $s->title,
                                            'url' => route('services.show', $s->slug)
                                        ])
                                        ->all();
                                } catch (\Throwable $e) {
                                    $footerServicesLinks = [];
                                }
                            }
                        @endphp
                        @foreach($footerServicesLinks as $link)
                            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            @endif

            @if(setting('footer_company_enabled', 1))
            <div>
                <h4 class="footer-title">{{ setting('footer_company_title', 'Company') }}</h4>
                <ul class="footer-links">
                    @if($footerCompanyItems->isNotEmpty())
                        @foreach($footerCompanyItems as $item)
                            @php
                                $cUrl = $item->url ? (str_starts_with($item->url, 'http') || str_starts_with($item->url, '/') || str_starts_with($item->url, '#') ? $item->url : url($item->url)) : '#';
                                $isPres = $item->item_type === 'presentation' || str_contains(strtolower($item->title), 'presentation') || str_contains($cUrl, 'presentation');
                            @endphp
                            <li>
                                @if($isPres)
                                    <a href="{{ $cUrl }}" target="{{ $item->target ?: '_blank' }}" class="footer-highlight-deck-link">
                                        <i class="fas fa-desktop" style="color:#0284c7"></i>
                                        <span>{{ $item->title }}</span>
                                        @if($item->badge_text)
                                            <span class="footer-live-chip">{{ $item->badge_text }}</span>
                                        @endif
                                    </a>
                                @else
                                    <a href="{{ $cUrl }}" target="{{ $item->target ?: '_self' }}">
                                        {{ $item->title }}
                                        @if($item->badge_text)
                                            <span style="font-size:9.5px;font-weight:800;background:var(--accent);color:white;padding:1px 6px;border-radius:999px;margin-left:4px">{{ $item->badge_text }}</span>
                                        @endif
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif

                    @foreach($footerPages as $page)
                        <li><a href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(setting('footer_legal_enabled', 1))
            <div>
                <h4 class="footer-title">{{ setting('footer_legal_title', 'Policies') }}</h4>
                <ul class="footer-links">
                    @if($footerPolicyItems->isNotEmpty())
                        @foreach($footerPolicyItems as $item)
                            @php
                                $pUrl = $item->url ? (str_starts_with($item->url, 'http') || str_starts_with($item->url, '/') || str_starts_with($item->url, '#') ? $item->url : url($item->url)) : '#';
                            @endphp
                            <li>
                                <a href="{{ $pUrl }}" target="{{ $item->target ?: '_self' }}">
                                    {{ $item->title }}
                                    @if($item->badge_text)
                                        <span style="font-size:9.5px;font-weight:800;background:var(--accent);color:white;padding:1px 6px;border-radius:999px;margin-left:4px">{{ $item->badge_text }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    @elseif($footerLegalPages->isNotEmpty())
                        @foreach($footerLegalPages as $legal)
                            <li><a href="{{ route('legal.show', $legal->slug) }}">{{ $legal->title }}</a></li>
                        @endforeach
                    @else
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Website Terms and Conditions</a></li>
                        <li><a href="{{ url('/legal/anti-spam-policy') }}">Anti-SPAM Policy</a></li>
                        <li><a href="{{ url('/legal/license-agreement') }}">License Agreement</a></li>
                        <li><a href="{{ url('/legal/cookies-policy') }}">Cookies Policy</a></li>
                    @endif
                </ul>
            </div>
            @endif

            @if(setting('footer_contact_enabled', 1))
            <div>
                <h4 class="footer-title">{{ setting('footer_contact_title', 'Get In Touch') }}</h4>
                @if(setting('contact_aus_address'))
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ setting('contact_aus_title', 'Australia Office') }}: {{ setting('contact_aus_address', 'Rescom, Melbourne, Australia') }}</span>
                </div>
                @endif
                @if(setting('contact_address'))
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ setting('contact_india_title', 'India Office') }}: {{ setting('contact_address', '123 Tech Park, Electronic City, Bengaluru - 560100') }}</span>
                </div>
                @endif
               
                @if(setting('contact_phone') || setting('contact_phone2'))
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        @if(setting('contact_phone2'))<a href="tel:{{ setting('contact_phone2') }}" style="color:rgba(255,255,255,0.55);text-decoration:none">{{ setting('contact_phone2') }}</a><br>@endif
                        @if(setting('contact_phone'))<a href="tel:{{ setting('contact_phone') }}" style="color:rgba(255,255,255,0.55);text-decoration:none">{{ setting('contact_phone') }}</a>@endif
                    </div>
                </div>
                @endif
                @if(setting('contact_email'))
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:{{ setting('contact_email') }}" style="color:rgba(255,255,255,0.55);text-decoration:none">{{ setting('contact_email') }}</a>
                </div>
                @endif
                @if(setting('business_hours'))
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ setting('business_hours', 'Mon-Sat: 9AM - 7PM IST') }}</span>
                </div>
                @endif
            </div>
            @endif
        </div>
        <div class="footer-bottom">
            <div class="footer-copyright">
                <span class="footer-copy-text">© {{ date('Y') }} by {{ $siteName }}. All rights reserved.</span>
              
                <span class="footer-brand-item">
                    <span>Powered by</span>
                    <span class="footer-badge-pill">
                        <img src="https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/Webcorebg.png" alt="WEBcore" class="footer-credit-logo footer-webcore-logo">
                    </span>
                </span>
                
                <span class="footer-brand-item">
                    <span>Designed by</span>
                    <span class="footer-badge-pill">
                        <img src="https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/KNR-WEBSITE_f817360c-0c15-4992-bc1b-4df24f071612_KNR-Logo.png" alt="KNR" class="footer-credit-logo footer-knr-logo">
                    </span>
                </span>
            </div>
        </div>
    </div>
</footer>
@endif

@if(setting('chatbot_enabled', '1') === '1')
<!-- =============== CHATBOT =============== -->
<div class="knr-chatbot" id="knrChatbot">
    <button class="knr-chatbot-toggle" id="knrChatbotToggle" aria-label="Open Rescom">
        <dotlottie-player
            src="https://lottie.host/f5214a1d-a024-4573-ac0e-58ed0e99cd1f/FN0MJypHqg.lottie"
            background="transparent"
            speed="1"
            loop
            autoplay
            class="knr-chatbot-toggle-icon"
            aria-hidden="true">
        </dotlottie-player>
        <!-- <span class="knr-chatbot-toggle-text">Rescom</span> -->
        <span class="knr-chatbot-tooltip">Hi, I'm Rescom</span>
    </button>

    <div class="knr-chatbot-panel" id="knrChatbotPanel" aria-hidden="true">
        <div class="knr-chatbot-header">
            <div>
                <div class="knr-chatbot-title">Rescom</div>
                <div class="knr-chatbot-subtitle">Corporate Virtual Assistant</div>
            </div>
            <div class="knr-chatbot-header-actions">
                <button class="knr-chatbot-clear" id="knrChatbotClear" type="button" aria-label="Clear chat">
                    <i class="fas fa-rotate-right"></i>
                </button>
                <button class="knr-chatbot-close" id="knrChatbotClose" aria-label="Close chatbot">&times;</button>
            </div>
        </div>
        <div class="knr-chatbot-body" id="knrChatbotBody">
            <div class="knr-chatbot-message bot">
                Hi! I'm Rescom. Ask me anything!</div>
        </div>
        <div class="knr-chatbot-suggestions" id="knrChatbotSuggestions"></div>
        <div class="knr-chatbot-input">
            <input type="text" id="knrChatbotInput" placeholder="Type your question..." autocomplete="off">
            <button id="knrChatbotSend" aria-label="Send"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.js"></script>
@endif

<!-- WhatsApp Float -->
@if(setting('whatsapp_number'))
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number')) }}?text=Hi, I would like to know more about your IT services." 
   target="_blank" class="whatsapp-float" title="Chat on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>
@endif

<!-- Back to Top -->
<button class="back-to-top" id="backToTop" title="Back to top">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" aria-hidden="true">
    <div class="lightbox-backdrop" data-lightbox-close></div>
    <div class="lightbox-panel" role="dialog" aria-modal="true">
        <button class="lightbox-close" type="button" aria-label="Close" data-lightbox-close>&times;</button>
        <button class="lightbox-nav lightbox-prev" type="button" aria-label="Previous" data-lightbox-prev>
            <i class="fas fa-chevron-left"></i>
        </button>
        <img class="lightbox-image" alt="">
        <div class="lightbox-caption"></div>
        <button class="lightbox-nav lightbox-next" type="button" aria-label="Next" data-lightbox-next>
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/CountUp.js/2.8.0/countUp.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/site.js') }}"></script>

<script>
    const attachBlurValidation = (root = document) => {
        const fields = root.querySelectorAll('input, select, textarea');
        const countDigits = (value) => (value.match(/\d/g) || []).length;
        const customValidityMessage = (el) => {
            const minDigits = el.getAttribute('data-min-digits');
            if (minDigits) {
                const min = parseInt(minDigits, 10);
                const digits = countDigits(el.value || '');
                if (digits > 0 && digits < min) return `Please enter at least ${min} digits.`;
            }
            const maxDigits = el.getAttribute('data-max-digits');
            if (maxDigits) {
                const max = parseInt(maxDigits, 10);
                const digits = countDigits(el.value || '');
                if (digits > max) return `Please enter no more than ${max} digits.`;
            }
            if (el.hasAttribute('data-country-selector')) {
                const select = el.parentElement ? el.parentElement.querySelector('[data-digits-source]') : null;
                const expected = parseInt((select && select.selectedOptions && select.selectedOptions[0] && select.selectedOptions[0].dataset && select.selectedOptions[0].dataset.digits) || '0', 10);
                const digits = countDigits(el.value || '');
                if (digits > 0 && expected && digits !== expected) {
                    return `Please enter exactly ${expected} digits.`;
                }
            }
            return '';
        };
        const showError = (el) => {
            if (!el || !el.willValidate) return;
            const container = el.closest('.f-form-group') || el.closest('.form-group') || (el.parentElement && (el.parentElement.classList.contains('f-input-wrapper') || el.parentElement.classList.contains('input-wrapper')) ? el.parentElement.parentElement : el.parentElement);
            if (!container) return;
            let errorEl = container.querySelector('.field-error');
            if (!errorEl) {
                errorEl = document.createElement('div');
                errorEl.className = 'field-error';
                container.appendChild(errorEl);
            }
            let message = customValidityMessage(el) || el.validationMessage;
            if (!customValidityMessage(el) && el.validity.patternMismatch && el.title) message = el.title;
            errorEl.innerHTML = `<i class="fa-solid fa-circle-exclamation" style="margin-right:4px;"></i> <span>${message}</span>`;
        };
        const clearError = (el) => {
            const container = el ? (el.closest('.f-form-group') || el.closest('.form-group') || (el.parentElement && (el.parentElement.classList.contains('f-input-wrapper') || el.parentElement.classList.contains('input-wrapper')) ? el.parentElement.parentElement : el.parentElement)) : null;
            const errorEl = container ? container.querySelector('.field-error') : null;
            if (errorEl) errorEl.remove();
        };

        fields.forEach((el) => {
            if (!el.willValidate) return;
            el.addEventListener('blur', () => {
                if (customValidityMessage(el) || !el.checkValidity()) showError(el);
                else clearError(el);
            });
            el.addEventListener('input', () => {
                if (!customValidityMessage(el) && el.checkValidity()) clearError(el);
            });
        });

        root.querySelectorAll('form').forEach((form) => {
            form.addEventListener('submit', (e) => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    fields.forEach((el) => {
                        if (el.form === form && !el.checkValidity()) showError(el);
                    });
                    return;
                }
                const invalidCustom = Array.from(fields).filter((el) => el.form === form && customValidityMessage(el));
                if (invalidCustom.length) {
                    e.preventDefault();
                    invalidCustom.forEach(showError);
                }
            });
        });
    };

    document.addEventListener('DOMContentLoaded', () => attachBlurValidation());

    // Init AOS
    if (window.AOS && typeof window.AOS.init === 'function') {
        AOS.init({ duration: 700, once: true, offset: 80, easing: 'ease-out-cubic' });
    }

    // Header scroll effect
    const header = document.getElementById('mainHeader');
    const topBar = document.getElementById('topBar');
    const backToTop = document.getElementById('backToTop');
    const hasTopbar = document.body.classList.contains('has-topbar');
    const updateHeader = () => {
        if (!header) return;
        const scrolled = window.scrollY > 50;
        const hideTopbar = window.scrollY > 0;
        header.classList.toggle('scrolled', scrolled);
        if (topBar) topBar.classList.toggle('is-hidden', hideTopbar);
        header.style.top = hasTopbar ? (hideTopbar ? '0' : '38px') : '0';
        if (backToTop) backToTop.classList.toggle('visible', window.scrollY > 300);
    };
    const syncHeader = () => requestAnimationFrame(updateHeader);
    window.addEventListener('scroll', updateHeader, { passive: true });
    window.addEventListener('resize', syncHeader);
    window.addEventListener('load', syncHeader);
    window.addEventListener('pageshow', syncHeader);
    syncHeader();
    setTimeout(syncHeader, 50);

    // Mobile menu
    const mobileToggle = document.getElementById('mobileToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    const openMobileMenu = () => {
        if (!mobileMenu) return;
        mobileMenu.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const closeMobileMenu = () => {
        if (!mobileMenu) return;
        mobileMenu.classList.remove('open');
        document.body.style.overflow = '';
    };

    if (mobileToggle) {
        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            openMobileMenu();
        });
    }

    if (mobileMenu) {
        mobileMenu.addEventListener('click', (e) => e.stopPropagation());
        mobileMenu.querySelectorAll('.mobile-menu-link').forEach(link => {
            link.addEventListener('click', () => closeMobileMenu());
        });
    }

    document.addEventListener('click', () => {
        if (window.innerWidth > 768) return;
        if (!mobileMenu || !mobileMenu.classList.contains('open')) return;
        closeMobileMenu();
    });

    // Chatbot
    const chatbot = document.getElementById('knrChatbot');
    const chatbotToggle = document.getElementById('knrChatbotToggle');
    const chatbotPanel = document.getElementById('knrChatbotPanel');
    const chatbotClose = document.getElementById('knrChatbotClose');
    const chatbotClear = document.getElementById('knrChatbotClear');
    const chatbotBody = document.getElementById('knrChatbotBody');
    const chatbotInput = document.getElementById('knrChatbotInput');
    const chatbotSend = document.getElementById('knrChatbotSend');
    const chatbotSuggestions = document.getElementById('knrChatbotSuggestions');

    const defaultSuggestions = ['Services', 'Solutions', 'Products', 'Contact'];
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

    // localStorage functions
    const CHATBOT_STORAGE_KEY = 'knr_chatbot_history';
    const saveMessageToStorage = (text, type) => {
        try {
            const history = JSON.parse(localStorage.getItem(CHATBOT_STORAGE_KEY) || '[]');
            history.push({ text, type, timestamp: Date.now() });
            localStorage.setItem(CHATBOT_STORAGE_KEY, JSON.stringify(history));
        } catch (e) {
            console.log('Failed to save to localStorage');
        }
    };

    const loadMessagesFromStorage = () => {
        try {
            const history = JSON.parse(localStorage.getItem(CHATBOT_STORAGE_KEY) || '[]');
            if (chatbotBody && history.length > 0) {
                chatbotBody.innerHTML = '';
                history.forEach(msg => {
                    const div = document.createElement('div');
                    div.className = `knr-chatbot-message ${msg.type}`;
                    div.textContent = msg.text;
                    chatbotBody.appendChild(div);
                });
                chatbotBody.scrollTop = chatbotBody.scrollHeight;
            }
        } catch (e) {
            console.log('Failed to load from localStorage');
        }
    };

    const clearChatStorage = () => {
        try {
            localStorage.removeItem(CHATBOT_STORAGE_KEY);
        } catch (e) {
            console.log('Failed to clear localStorage');
        }
    };

    const renderSuggestions = (items = defaultSuggestions) => {
        if (!chatbotSuggestions) return;
        chatbotSuggestions.innerHTML = '';
        items.slice(0, 4).forEach(text => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'knr-chatbot-suggestion';
            btn.textContent = text;
            btn.addEventListener('click', () => sendMessage(text));
            chatbotSuggestions.appendChild(btn);
        });
    };

    const appendMessage = (text, type = 'bot') => {
        if (!chatbotBody) return;
        const msg = document.createElement('div');
        msg.className = `knr-chatbot-message ${type}`;
        msg.textContent = text;
        chatbotBody.appendChild(msg);
        chatbotBody.scrollTop = chatbotBody.scrollHeight;
        saveMessageToStorage(text, type);
    };

    const appendRelatedLinks = (links = []) => {
        if (!chatbotBody || !Array.isArray(links) || links.length === 0) return;
        const wrap = document.createElement('div');
        wrap.className = 'knr-chatbot-related';
        const title = document.createElement('div');
        title.className = 'knr-chatbot-related-title';
        title.textContent = 'Related pages';
        wrap.appendChild(title);

        const list = document.createElement('div');
        list.className = 'knr-chatbot-related-list';
        links.slice(0, 4).forEach(item => {
            if (!item || !item.url) return;
            const link = document.createElement('a');
            link.href = item.url;
            link.className = 'knr-chatbot-related-link';
            link.textContent = item.title || 'View page';
            list.appendChild(link);
        });
        wrap.appendChild(list);
        chatbotBody.appendChild(wrap);
        chatbotBody.scrollTop = chatbotBody.scrollHeight;
    };

    const resetChat = () => {
        if (!chatbotBody) return;
        chatbotBody.innerHTML = '';
        appendMessage("Hi! I'm Rescom. Ask me anything!", 'bot');
        renderSuggestions();
        clearChatStorage();
    };

    const appendContactButton = (url) => {
        if (!chatbotBody || !url) return;
        const wrap = document.createElement('div');
        wrap.className = 'knr-chatbot-message bot';
        const link = document.createElement('a');
        link.href = url;
        link.className = 'knr-chatbot-action';
        link.innerHTML = '<i class="fas fa-headset"></i> Contact Support';
        wrap.appendChild(link);
        chatbotBody.appendChild(wrap);
        chatbotBody.scrollTop = chatbotBody.scrollHeight;
    };

    const appendTyping = () => {
        if (!chatbotBody) return null;
        const wrap = document.createElement('div');
        wrap.className = 'knr-chatbot-message bot';
        wrap.innerHTML = '<span class="knr-chatbot-typing"><span></span><span></span><span></span></span>';
        chatbotBody.appendChild(wrap);
        chatbotBody.scrollTop = chatbotBody.scrollHeight;
        return wrap;
    };

    const sendMessage = (text) => {
        if (!text || !chatbotBody) return;
        appendMessage(text, 'user');
        if (chatbotInput) chatbotInput.value = '';
        const typing = appendTyping();

        fetch(`{{ route('chatbot.ask') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: JSON.stringify({ question: text })
        })
            .then(res => res.json())
            .then(data => {
                if (typing) typing.remove();
                appendMessage(data.answer || 'Sorry, something went wrong.', 'bot');
                if (!data.matched && data.contact_url) {
                    appendContactButton(data.contact_url);
                }
                if (Array.isArray(data.related) && data.related.length) {
                    appendRelatedLinks(data.related);
                }
                if (Array.isArray(data.suggestions) && data.suggestions.length) {
                    renderSuggestions(data.suggestions);
                }
            })
            .catch(() => {
                if (typing) typing.remove();
                appendMessage('Unable to fetch a response right now.', 'bot');
            });
    };

    if (chatbot && chatbotToggle && chatbotPanel) {
        const CHATBOT_POSITION_KEY = 'knr_chatbot_position';
        const DRAG_THRESHOLD = 6;
        let dragState = null;
        let dragSuppressedClick = false;

        const resetChatbotPosition = () => {
            chatbot.style.left = '';
            chatbot.style.top = '';
            chatbot.style.right = '';
            chatbot.style.bottom = '';
        };

        const applyChatbotPosition = (left, top) => {
            chatbot.style.left = `${Math.max(8, Math.round(left))}px`;
            chatbot.style.top = `${Math.max(8, Math.round(top))}px`;
            chatbot.style.right = 'auto';
            chatbot.style.bottom = 'auto';
        };

        const restoreChatbotPosition = () => {
            try {
                const stored = JSON.parse(localStorage.getItem(CHATBOT_POSITION_KEY) || 'null');
                if (stored && typeof stored.left === 'number' && typeof stored.top === 'number') {
                    const nextPosition = clampChatbotPosition(stored.left, stored.top);
                    applyChatbotPosition(nextPosition.left, nextPosition.top);
                }
            } catch (error) {}
        };

        const saveChatbotPosition = (left, top) => {
            localStorage.setItem(CHATBOT_POSITION_KEY, JSON.stringify({ left, top }));
        };

        const clampChatbotPosition = (left, top) => {
            const rect = chatbot.getBoundingClientRect();
            const maxLeft = Math.max(8, window.innerWidth - rect.width - 8);
            const maxTop = Math.max(8, window.innerHeight - rect.height - 8);
            return {
                left: Math.min(Math.max(8, left), maxLeft),
                top: Math.min(Math.max(8, top), maxTop),
            };
        };

        restoreChatbotPosition();

        window.addEventListener('resize', () => {
            const rect = chatbot.getBoundingClientRect();
            const nextPosition = clampChatbotPosition(rect.left, rect.top);
            applyChatbotPosition(nextPosition.left, nextPosition.top);
        });

        // Load previous chat history if exists
        const history = JSON.parse(localStorage.getItem(CHATBOT_STORAGE_KEY) || '[]');
        if (history.length === 0) {
            renderSuggestions();
        } else {
            loadMessagesFromStorage();
        }

        chatbotToggle.addEventListener('pointerdown', (event) => {
            dragState = {
                pointerId: event.pointerId,
                startX: event.clientX,
                startY: event.clientY,
                startLeft: chatbot.getBoundingClientRect().left,
                startTop: chatbot.getBoundingClientRect().top,
                dragging: false,
            };
            dragSuppressedClick = false;
            chatbotToggle.setPointerCapture(event.pointerId);
        });

        window.addEventListener('pointermove', (event) => {
            if (!dragState || dragState.pointerId !== event.pointerId) return;

            const deltaX = event.clientX - dragState.startX;
            const deltaY = event.clientY - dragState.startY;

            if (!dragState.dragging && Math.hypot(deltaX, deltaY) < DRAG_THRESHOLD) {
                return;
            }

            dragState.dragging = true;
            dragSuppressedClick = true;
            event.preventDefault();

            const nextPosition = clampChatbotPosition(dragState.startLeft + deltaX, dragState.startTop + deltaY);
            applyChatbotPosition(nextPosition.left, nextPosition.top);
        });

        window.addEventListener('pointerup', (event) => {
            if (!dragState || dragState.pointerId !== event.pointerId) return;

            if (dragState.dragging) {
                const rect = chatbot.getBoundingClientRect();
                saveChatbotPosition(rect.left, rect.top);
            }

            dragState = null;
            setTimeout(() => {
                dragSuppressedClick = false;
            }, 0);
        });

        chatbotToggle.addEventListener('click', () => {
            if (dragSuppressedClick) {
                dragSuppressedClick = false;
                return;
            }
            chatbotPanel.classList.toggle('open');
            const isOpen = chatbotPanel.classList.contains('open');
            chatbotPanel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            document.body.classList.toggle('chatbot-open', isOpen);
            if (isOpen && chatbotInput) setTimeout(() => chatbotInput.focus(), 50);
        });
        if (chatbotClose) {
            chatbotClose.addEventListener('click', () => {
                chatbotPanel.classList.remove('open');
                chatbotPanel.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('chatbot-open');
            });
        }
        if (chatbotClear) {
            chatbotClear.addEventListener('click', () => resetChat());
        }
        if (chatbotSend) {
            chatbotSend.addEventListener('click', () => sendMessage((chatbotInput && chatbotInput.value ? chatbotInput.value.trim() : '') || ''));
        }
        if (chatbotInput) {
            chatbotInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendMessage(chatbotInput.value.trim());
                }
            });
        }
    }

    // Header search (inline)
    const openSearchBtn = document.getElementById('openSearch');
    const openSearchMobileHeader = document.getElementById('openSearchMobileHeader');
    const navSearchPanel = document.getElementById('navSearchPanel');
    const navSearchInput = document.getElementById('navSearchInput');
    const navSearchResults = document.getElementById('navSearchResults');
    const navSearchClose = document.getElementById('navSearchClose');
    const navSearchHint = document.getElementById('navSearchHint');
    const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');
    const mobileSearchInput = document.getElementById('mobileSearchInput');
    const mobileSearchResults = document.getElementById('mobileSearchResults');
    const mobileSearchClose = document.getElementById('mobileSearchClose');
    const mobileSearchHint = document.getElementById('mobileSearchHint');
    let searchDebounce = null;

    const openSearch = () => {
        closeMobileMenu();
        if (window.innerWidth <= 768) {
            if (!mobileSearchOverlay) return;
            mobileSearchOverlay.classList.add('open');
            mobileSearchOverlay.setAttribute('aria-hidden', 'false');
            if (mobileSearchInput) setTimeout(() => mobileSearchInput.focus(), 50);
        } else {
            if (!navSearchPanel) return;
            navSearchPanel.classList.add('open');
            navSearchPanel.setAttribute('aria-hidden', 'false');
            if (navSearchInput) setTimeout(() => navSearchInput.focus(), 50);
        }
    };

    const closeSearch = () => {
        if (navSearchPanel) {
            navSearchPanel.classList.remove('open');
            navSearchPanel.setAttribute('aria-hidden', 'true');
        }
        if (mobileSearchOverlay) {
            mobileSearchOverlay.classList.remove('open');
            mobileSearchOverlay.setAttribute('aria-hidden', 'true');
        }
    };

    const renderSearchResults = (payload, isMobile = false) => {
        const target = isMobile ? mobileSearchResults : navSearchResults;
        if (!target) return;
        target.innerHTML = '';
        if (!payload || !payload.sections || payload.total === 0) {
            target.innerHTML = '<div class="nav-search-empty">No results found.</div>';
            return;
        }
        payload.sections.forEach(section => {
            const wrapper = document.createElement('div');
            wrapper.className = 'nav-search-section';
            wrapper.innerHTML = `<div class="nav-search-section-title">${section.title}</div>`;
            const list = document.createElement('div');
            list.className = 'nav-search-list';
            section.items.forEach(item => {
                const link = document.createElement('a');
                link.className = 'nav-search-item';
                link.href = item.url;
                link.innerHTML = `<span class="nav-search-item-title">${item.title}</span>` +
                    (item.snippet ? `<span class="nav-search-item-snippet">${item.snippet}</span>` : '');
                list.appendChild(link);
            });
            wrapper.appendChild(list);
            target.appendChild(wrapper);
        });
    };

    const fetchSearch = (query, isMobile = false) => {
        const target = isMobile ? mobileSearchResults : navSearchResults;
        const hint = isMobile ? mobileSearchHint : navSearchHint;
        if (!query || query.length < 2) {
            if (target) target.innerHTML = '';
            if (hint) hint.style.display = 'block';
            return;
        }
        if (hint) hint.style.display = 'none';
        fetch(`{{ route('search') }}?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(payload => renderSearchResults(payload, isMobile))
            .catch(() => {
                if (target) target.innerHTML = '<div class="nav-search-empty">Unable to load results.</div>';
            });
    };

    if (openSearchBtn) openSearchBtn.addEventListener('click', openSearch);
    if (openSearchMobileHeader) openSearchMobileHeader.addEventListener('click', openSearch);
    if (navSearchClose) navSearchClose.addEventListener('click', closeSearch);
    if (mobileSearchClose) mobileSearchClose.addEventListener('click', closeSearch);
    if (mobileSearchOverlay) {
        mobileSearchOverlay.querySelectorAll('[data-mobile-search-close]').forEach(el => {
            el.addEventListener('click', closeSearch);
        });
    }

    if (navSearchInput) {
        navSearchInput.addEventListener('input', (e) => {
            const value = e.target.value.trim();
            if (searchDebounce) clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => fetchSearch(value), 250);
        });
        navSearchInput.addEventListener('keydown', (e) => {
            if (e.key !== 'Enter') return;
            e.preventDefault();
            const firstLink = navSearchResults ? navSearchResults.querySelector('a.nav-search-item') : null;
            if (firstLink) window.location.href = firstLink.href;
        });
    }

    if (mobileSearchInput) {
        mobileSearchInput.addEventListener('input', (e) => {
            const value = e.target.value.trim();
            if (searchDebounce) clearTimeout(searchDebounce);
            searchDebounce = setTimeout(() => fetchSearch(value, true), 250);
        });
        mobileSearchInput.addEventListener('keydown', (e) => {
            if (e.key !== 'Enter') return;
            e.preventDefault();
            const firstLink = mobileSearchResults ? mobileSearchResults.querySelector('a.nav-search-item') : null;
            if (firstLink) window.location.href = firstLink.href;
        });
    }

    document.addEventListener('click', (e) => {
        if (navSearchPanel && navSearchPanel.classList.contains('open')) {
            if (navSearchPanel.contains(e.target) || (openSearchBtn && openSearchBtn.contains(e.target))) return;
            closeSearch();
        }
        if (mobileSearchOverlay && mobileSearchOverlay.classList.contains('open')) {
            if (mobileSearchOverlay.contains(e.target) && !e.target.hasAttribute('data-mobile-search-close')) return;
            if (openSearchMobileHeader && openSearchMobileHeader.contains(e.target)) return;
            closeSearch();
        }
    });


    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSearch();
        if (e.key === '/' && !/input|textarea/i.test(((document.activeElement && document.activeElement.tagName) || ''))) {
            e.preventDefault();
            openSearch();
        }
    });

    // Dropdown tabs (services/products)
    document.querySelectorAll('.dropdown-tabs').forEach((tabs) => {
        const buttons = tabs.querySelectorAll('.dropdown-tab-btn');
        const panels = tabs.querySelectorAll('.dropdown-tab-panel');
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-tab');
                buttons.forEach(b => b.classList.remove('active'));
                panels.forEach(p => p.classList.remove('active'));
                btn.classList.add('active');
                const panel = tabs.querySelector(`.dropdown-tab-panel[data-tab-panel="${target}"]`);
                if (panel) panel.classList.add('active');
            });
        });
    });

    // Back to top
    document.getElementById('backToTop').addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Counter animation
    const counters = document.querySelectorAll('[data-count]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-count'));
                const suffix = entry.target.getAttribute('data-suffix') || '';
                new CountUp.CountUp(entry.target, target, { suffix, duration: 2.5 }).start();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(c => observer.observe(c));

    // Flash messages auto-dismiss
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(a => a.style.opacity = '0');
    }, 5000);

    // Newsletter submit spinner
    const newsletterForm = document.getElementById('newsletter');
    if (newsletterForm) {
        const newsletterBtn = newsletterForm.querySelector('button[type="submit"]');
        newsletterForm.addEventListener('submit', () => {
            if (!newsletterBtn) return;
            newsletterBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            newsletterBtn.disabled = true;
        });
    }

    // Page loader
    window.addEventListener('load', () => {
        const loader = document.getElementById('pageLoader');
        if (loader) loader.classList.add('is-hidden');
    });
</script>

@yield('scripts')

@if(request('newsletter') === 'success' || request('newsletter') === 'info')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (!window.Swal) return;
        const type = '{{ request('newsletter') }}';
        let icon = 'success';
        let title = 'Congratulations!';
        let text = 'You are subscribed. Thanks for joining our newsletter.';

        if (type === 'info') {
            icon = 'info';
            title = 'Already Subscribed';
            text = 'This email is already on our list. Thanks for staying with us.';
        }

        Swal.fire({
            icon,
            title,
            text,
            confirmButtonText: 'OK',
            confirmButtonColor: '#f97316',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });

        if (window.history && window.history.replaceState) {
            const url = new URL(window.location.href);
            url.searchParams.delete('newsletter');
            url.hash = '';
            window.history.replaceState({}, document.title, url.toString());
        }
    });
</script>
@endif
</body>
</html>




