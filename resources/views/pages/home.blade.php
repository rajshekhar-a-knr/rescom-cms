@extends('layouts.app')

@section('title', setting('home_meta_title', 'Rescom - Solutions Company in India'))
@section('meta_description', setting('home_meta_description', 'Rescom delivers world-class web development, mobile apps, cloud solutions, cybersecurity, and AI/ML services. 500+ Products delivered, 200+ happy clients.'))

@section('content')

<!-- =============== FUTURISTIC HERO SLIDER =============== -->
<section class="hero futuristic-hero" id="home">
    <style>
        /* ===== FUTURISTIC HERO STYLES ===== */
        .futuristic-hero {
            position: relative;
            height: 100vh;
            height: 100svh;
            min-height: 560px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #060b18;
            overflow: hidden;
            padding-top: clamp(80px, 11vh, 110px);
            padding-bottom: clamp(16px, 2.5vh, 28px);
            box-sizing: border-box;
            color: #ffffff;
        }

        .has-topbar .futuristic-hero {
            padding-top: clamp(105px, 13.5vh, 135px);
        }

        /* Ensure header navigation tabs & icons are crystal clear on dark futuristic hero */
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

        /* Ambient Cyber Grid & Glow */
        .futuristic-hero-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 12% 25%, rgba(37, 99, 235, 0.22) 0%, transparent 45%),
                radial-gradient(circle at 88% 30%, rgba(99, 102, 241, 0.25) 0%, transparent 45%),
                radial-gradient(circle at 50% 85%, rgba(6, 182, 212, 0.18) 0%, transparent 50%),
                linear-gradient(180deg, #070d1d 0%, #060a16 60%, #040711 100%);
            z-index: 1;
            pointer-events: none;
        }

        .futuristic-cyber-grid {
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

        .futuristic-energy-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 1;
            opacity: 0.65;
            animation: fOrbPulse 8s ease-in-out infinite alternate;
        }
        .f-orb-1 { width: 450px; height: 450px; background: rgba(37, 99, 235, 0.3); top: 10%; left: -5%; }
        .f-orb-2 { width: 500px; height: 500px; background: rgba(147, 51, 234, 0.25); top: 15%; right: -5%; animation-delay: -3s; }
        .f-orb-3 { width: 350px; height: 350px; background: rgba(6, 182, 212, 0.22); bottom: 5%; left: 35%; animation-delay: -5s; }

        @keyframes fOrbPulse {
            0% { transform: scale(1) translateY(0); opacity: 0.55; }
            100% { transform: scale(1.15) translateY(-25px); opacity: 0.75; }
        }

        /* Container & Grid */
        .futuristic-hero .hero-container {
            position: relative;
            z-index: 3;
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding-left: clamp(20px, 3.5vw, 45px);
            padding-right: clamp(20px, 3.5vw, 45px);
        }

        .futuristic-hero .hero-grid {
            display: grid;
            grid-template-columns: 1.12fr 0.88fr;
            gap: clamp(24px, 3.5vw, 55px);
            align-items: center;
        }

        /* Left Side Content */
        .futuristic-hero-content {
            position: relative;
            z-index: 4;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* HUD Live Beacon Badge */
        .futuristic-hud-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(56, 189, 248, 0.35);
            padding: 4px 13px;
            border-radius: 999px;
            margin-bottom: clamp(8px, 1.3vh, 14px);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 4px 16px rgba(6, 182, 212, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.15);
            width: fit-content;
        }

        .futuristic-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #00f2fe;
            box-shadow: 0 0 8px #00f2fe, 0 0 16px #00f2fe;
            position: relative;
            display: inline-block;
            flex-shrink: 0;
        }
        .futuristic-radar-dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1.5px solid #00f2fe;
            animation: fRadarWave 2s ease-out infinite;
        }
        @keyframes fRadarWave {
            0% { transform: scale(0.6); opacity: 1; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        .futuristic-badge-subtitle {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: #e2e8f0;
        }

        .futuristic-badge-divider {
            width: 1px;
            height: 10px;
            background: rgba(255, 255, 255, 0.25);
        }

        .futuristic-badge-tag {
            font-size: 10.5px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Headline */
        .futuristic-hero-title {
            font-size: clamp(24px, 2.7vw, 42px);
            font-weight: 850;
            line-height: 1.15;
            letter-spacing: -0.025em;
            color: #ffffff;
            margin-bottom: clamp(8px, 1.2vh, 12px);
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.6);
        }

        .futuristic-gradient-text {
            background: linear-gradient(135deg, #ffffff 10%, #bae6fd 40%, #38bdf8 70%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline;
        }

        /* Description */
        .futuristic-hero-description {
            font-size: clamp(13px, 0.92vw, 15px);
            color: #94a3b8;
            line-height: 1.52;
            margin-bottom: clamp(10px, 1.4vh, 15px);
            max-width: 580px;
            font-weight: 400;
        }

        /* Micro Tech Tags */
        .futuristic-tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-bottom: clamp(10px, 1.5vh, 16px);
        }

        .futuristic-tech-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 7px;
            padding: 3.5px 9px;
            font-size: 11px;
            font-weight: 600;
            color: #cbd5e1;
            backdrop-filter: blur(8px);
            transition: all 0.25s ease;
        }
        .futuristic-tech-tag:hover {
            border-color: rgba(56, 189, 248, 0.5);
            background: rgba(14, 165, 233, 0.12);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(56, 189, 248, 0.2);
        }
        .futuristic-tech-tag i {
            color: #38bdf8;
            font-size: 11px;
        }

        /* CTA Buttons */
        .futuristic-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: clamp(12px, 1.8vh, 18px);
        }

        .futuristic-btn-primary {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 60%, #06b6d4 100%);
            color: #ffffff !important;
            padding: 9.5px 22px;
            border-radius: 9px;
            font-size: 13.5px;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-decoration: none;
            box-shadow: 0 6px 22px rgba(37, 99, 235, 0.45), 0 0 15px rgba(6, 182, 212, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.35);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            z-index: 1;
        }
        .futuristic-btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
            z-index: -1;
        }
        .futuristic-btn-primary:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.6), 0 0 25px rgba(6, 182, 212, 0.4);
            color: #ffffff;
        }
        .futuristic-btn-primary:hover::before {
            left: 100%;
        }
        .futuristic-btn-primary i {
            transition: transform 0.25s ease;
        }
        .futuristic-btn-primary:hover i {
            transform: translateX(4px);
        }

        .futuristic-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(15, 23, 42, 0.65);
            border: 1.5px solid rgba(148, 163, 184, 0.25);
            color: #f1f5f9 !important;
            padding: 8.5px 18px;
            border-radius: 9px;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
        }
        .futuristic-btn-secondary:hover {
            background: rgba(30, 41, 59, 0.9);
            border-color: #38bdf8;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(56, 189, 248, 0.25);
        }
        .futuristic-btn-secondary .btn-play-icon {
            color: #38bdf8;
            font-size: 12px;
            transition: transform 0.2s ease;
        }
        .futuristic-btn-secondary:hover .btn-play-icon {
            transform: scale(1.15);
        }

        /* Metric Capsules */
        .futuristic-metrics-strip {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-top: clamp(8px, 1.2vh, 12px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .f-metric-item {
            display: flex;
            flex-direction: column;
        }
        .f-metric-val {
            font-size: clamp(16px, 1.5vw, 19px);
            font-weight: 850;
            color: #ffffff;
            line-height: 1.1;
            font-feature-settings: "tnum";
        }
        .f-metric-val span {
            color: #38bdf8;
            font-weight: 700;
        }
        .f-metric-lbl {
            font-size: 9.5px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-top: 1px;
        }
        .f-metric-sep {
            width: 1px;
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
        }

        /* ===== RIGHT SIDE - 3D HOLOGRAPHIC SHOWCASE ===== */
        .futuristic-visual-wrap {
            position: relative;
            z-index: 4;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        /* Ambient Glow behind Device */
        .futuristic-ambient-halo {
            position: absolute;
            inset: -15px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.28) 0%, rgba(99, 102, 241, 0.18) 45%, transparent 70%);
            filter: blur(35px);
            z-index: -1;
            border-radius: 24px;
            animation: fHaloBreath 6s ease-in-out infinite alternate;
        }
        @keyframes fHaloBreath {
            0% { transform: scale(0.95); opacity: 0.6; }
            100% { transform: scale(1.08); opacity: 0.9; }
        }

        /* Main Device Console Frame */
        .futuristic-device-frame {
            position: relative;
            width: 100%;
            background: rgba(13, 20, 36, 0.85);
            border: 1px solid rgba(56, 189, 248, 0.35);
            border-radius: 14px;
            box-shadow: 
                0 25px 60px -12px rgba(2, 6, 23, 0.85),
                0 0 35px rgba(56, 189, 248, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            overflow: hidden;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease;
        }
        .futuristic-device-frame:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 
                0 30px 75px -12px rgba(2, 6, 23, 0.9),
                0 0 45px rgba(56, 189, 248, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        /* Top HUD Terminal Bar */
        .futuristic-hud-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 7px 13px;
            background: rgba(8, 14, 28, 0.9);
            border-bottom: 1px solid rgba(56, 189, 248, 0.2);
        }
        .hud-dots-group {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .hud-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        .hud-dot-red { background: #ef4444; box-shadow: 0 0 6px rgba(239, 68, 68, 0.6); }
        .hud-dot-amber { background: #f59e0b; box-shadow: 0 0 6px rgba(245, 158, 11, 0.6); }
        .hud-dot-cyan { background: #06b6d4; box-shadow: 0 0 6px rgba(6, 182, 212, 0.6); }

        .hud-terminal-address {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10.5px;
            font-family: monospace, sans-serif;
            color: #94a3b8;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 3px 9px;
            border-radius: 5px;
        }
        .hud-terminal-address span.live-node {
            color: #38bdf8;
            font-weight: 700;
        }

        .hud-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 700;
            color: #10b981;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }
        .hud-status-dot-green {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 8px #10b981;
        }

        /* Screen Container */
        .futuristic-screen-area {
            position: relative;
            height: clamp(200px, 28vh, 320px);
            background: #ffffff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .futuristic-screen-area img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #ffffff;
            display: block;
            transition: transform 0.5s ease;
        }
        .futuristic-device-frame:hover .futuristic-screen-area img {
            transform: scale(1.02);
        }

        /* Corner Target Brackets HUD */
        .hud-corner {
            position: absolute;
            width: 14px;
            height: 14px;
            border-color: #38bdf8;
            border-style: solid;
            pointer-events: none;
            z-index: 5;
            opacity: 0.8;
        }
        .hud-corner-tl { top: 10px; left: 10px; border-width: 2px 0 0 2px; }
        .hud-corner-tr { top: 10px; right: 10px; border-width: 2px 2px 0 0; }
        .hud-corner-bl { bottom: 10px; left: 10px; border-width: 0 0 2px 2px; }
        .hud-corner-br { bottom: 10px; right: 10px; border-width: 0 2px 2px 0; }

        /* Floating Hologram Widgets */
        .futuristic-holo-widget {
            position: absolute;
            background: rgba(11, 19, 38, 0.9);
            border: 1px solid rgba(56, 189, 248, 0.4);
            border-radius: 9px;
            padding: 6px 12px;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6), 0 0 16px rgba(56, 189, 248, 0.25);
            z-index: 6;
            pointer-events: none;
            animation: fFloatWidget 5s ease-in-out infinite alternate;
        }
        .holo-widget-top {
            top: -10px;
            right: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .holo-widget-bottom {
            bottom: -10px;
            left: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            animation-delay: -2.5s;
        }

        @keyframes fFloatWidget {
            0% { transform: translateY(0); }
            100% { transform: translateY(-6px); }
        }

        .holo-widget-icon {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            background: rgba(56, 189, 248, 0.15);
            border: 1px solid rgba(56, 189, 248, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #38bdf8;
            font-size: 11px;
        }
        .holo-widget-title {
            font-size: 11px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
        }
        .holo-widget-sub {
            font-size: 9px;
            font-weight: 600;
            color: #38bdf8;
            margin-top: 1px;
        }

        /* Swiper Arrows */
        .futuristic-hero .swiper-button-prev,
        .futuristic-hero .swiper-button-next {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(56, 189, 248, 0.3);
            color: #ffffff;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            transition: all 0.25s ease;
            z-index: 10;
        }
        .futuristic-hero .swiper-button-prev:after,
        .futuristic-hero .swiper-button-next:after {
            font-size: 14px;
            font-weight: 900;
            color: #38bdf8;
        }
        .futuristic-hero .swiper-button-prev:hover,
        .futuristic-hero .swiper-button-next:hover {
            background: rgba(37, 99, 235, 0.85);
            border-color: #38bdf8;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
            transform: scale(1.08);
        }
        .futuristic-hero .swiper-button-prev:hover:after,
        .futuristic-hero .swiper-button-next:hover:after {
            color: #ffffff;
        }

        /* Pagination Segmented Laser Bars */
        .futuristic-hero .hero-pagination {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            z-index: 10;
        }
        .futuristic-hero .swiper-pagination-bullet {
            width: 10px;
            height: 4px;
            border-radius: 3px;
            background: rgba(148, 163, 184, 0.35);
            opacity: 1;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            margin: 0 !important;
            cursor: pointer;
        }
        .futuristic-hero .swiper-pagination-bullet-active {
            width: 32px;
            background: linear-gradient(90deg, #38bdf8, #6366f1);
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.7);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .futuristic-hero .hero-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .futuristic-hero {
                height: auto;
                min-height: auto;
                padding-top: 130px;
                padding-bottom: 60px;
            }
            .has-topbar .futuristic-hero {
                padding-top: 160px;
            }
            .futuristic-screen-area {
                height: clamp(240px, 35vh, 360px);
            }
        }
        @media (max-width: 768px) {
            .futuristic-hero {
                padding-top: 115px;
                padding-bottom: 50px;
            }
            .has-topbar .futuristic-hero {
                padding-top: 145px;
            }
            .futuristic-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .futuristic-btn-primary, .futuristic-btn-secondary {
                justify-content: center;
            }
            .futuristic-metrics-strip {
                gap: 12px;
                justify-content: space-between;
            }
            .futuristic-hero .swiper-button-prev,
            .futuristic-hero .swiper-button-next {
                display: none;
            }
            .holo-widget-top, .holo-widget-bottom {
                display: none;
            }
        }

        .hero-lightbox {
            position: fixed; inset: 0; background: rgba(2,6,23,0.85); display: none; align-items: center; justify-content: center;
            z-index: 9999; padding: 24px; backdrop-filter: blur(10px);
        }
        .hero-lightbox.open { display: flex; }
        .hero-lightbox img { max-width: 90vw; max-height: 85vh; object-fit: contain; background: #fff; border-radius: 14px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
        .hero-lightbox .close-btn {
            position: absolute; top: 16px; right: 16px; width: 40px; height: 40px; border-radius: 999px;
            background: rgba(255,255,255,0.18); color: #fff; border: 1px solid rgba(255,255,255,0.35);
            display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px;
        }
    </style>

    <!-- Cyber Background Layers -->
    <div class="futuristic-hero-bg"></div>
    <div class="futuristic-cyber-grid"></div>
    <div class="futuristic-energy-orb f-orb-1"></div>
    <div class="futuristic-energy-orb f-orb-2"></div>
    <div class="futuristic-energy-orb f-orb-3"></div>

    <!-- Hidden Swiper for Background synchronization -->
    <div class="swiper hero-swiper" style="position:absolute;inset:0;z-index:1;opacity:0;pointer-events:none;">
        <div class="swiper-wrapper">
            @foreach($heroBanners as $banner)
            <div class="swiper-slide"></div>
            @endforeach
        </div>
    </div>

    <div class="container1 hero-container">
        <div class="hero-grid">
            <!-- Left Side: Futuristic Content Swiper -->
            <div class="swiper hero-content-swiper" style="overflow:hidden;width:100%">
                <div class="swiper-wrapper">
                    @foreach($heroBanners as $banner)
                    <div class="swiper-slide futuristic-hero-content" data-hero-image="{{ $banner->image ? media_url($banner->image) : '' }}">
                        <!-- Live HUD Badge -->
                        <div class="futuristic-hud-badge">
                            <span class="futuristic-radar-dot"></span>
                            <span class="futuristic-badge-subtitle">{{ $banner->subtitle ?? 'NEXT-GEN IT ECOSYSTEM' }}</span>
                            <span class="futuristic-badge-divider"></span>
                            <span class="futuristic-badge-tag"><i class="fas fa-bolt"></i> {{ $banner->badge_text ?? 'AI READY' }}</span>
                        </div>

                        <!-- Hero Futuristic Title -->
                        <h1 class="futuristic-hero-title">
                            <span class="futuristic-gradient-text">{{ $banner->title }}</span>
                        </h1>

                        <!-- Hero Futuristic Description -->
                        @if($banner->description)
                        <p class="futuristic-hero-description">{{ $banner->description }}</p>
                        @endif

                        <!-- Futuristic Micro Tech Tags -->
                        <div class="futuristic-tech-tags">
                            <span class="futuristic-tech-tag"><i class="fas fa-microchip"></i> Next-Gen Architecture</span>
                            <span class="futuristic-tech-tag"><i class="fas fa-shield-halved"></i> Enterprise Security</span>
                            <span class="futuristic-tech-tag"><i class="fas fa-bolt"></i> High-Speed Cloud</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="futuristic-actions">
                            @if($banner->btn1_text)
                            <a href="{{ $banner->btn1_url ?? '/contact' }}" class="futuristic-btn-primary">
                                <span>{{ $banner->btn1_text }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            @endif

                            @if($banner->btn2_text)
                            <a href="{{ $banner->btn2_url ?? '/portfolio' }}" class="futuristic-btn-secondary">
                                <i class="fas fa-play btn-play-icon"></i>
                                <span>{{ $banner->btn2_text }}</span>
                            </a>
                            @endif
                        </div>

                        <!-- Metric Capsule Bar -->
                        <div class="futuristic-metrics-strip">
                            <div class="f-metric-item">
                                <span class="f-metric-val">500<span>+</span></span>
                                <span class="f-metric-lbl">Deployments</span>
                            </div>
                            <div class="f-metric-sep"></div>
                            <div class="f-metric-item">
                                <span class="f-metric-val">99.9<span>%</span></span>
                                <span class="f-metric-lbl">Uptime SLA</span>
                            </div>
                            <div class="f-metric-sep"></div>
                            <div class="f-metric-item">
                                <span class="f-metric-val">200<span>+</span></span>
                                <span class="f-metric-lbl">Global Clients</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Side: 3D Holographic Cyber Device Showcase -->
            <div class="futuristic-visual-wrap" data-aos="fade-left" onclick="openHeroImage()">
                <div class="futuristic-ambient-halo"></div>
                
                <!-- Floating Hologram Widget Top -->
                <div class="futuristic-holo-widget holo-widget-top">
                    <div class="holo-widget-icon"><i class="fas fa-signal"></i></div>
                    <div>
                        <div class="holo-widget-title">Cloud Network Live</div>
                        <div class="holo-widget-sub"><i class="fas fa-circle" style="font-size:7px;color:#10b981;margin-right:3px;"></i> 99.99% Operational</div>
                    </div>
                </div>

                <!-- Main Device Console -->
                <div class="futuristic-device-frame">
                    <!-- Top HUD Terminal Bar -->
                    <div class="futuristic-hud-topbar">
                        <div class="hud-dots-group">
                            <span class="hud-dot hud-dot-red"></span>
                            <span class="hud-dot hud-dot-amber"></span>
                            <span class="hud-dot hud-dot-cyan"></span>
                        </div>
                        <div class="hud-terminal-address">
                            <i class="fas fa-lock" style="font-size:10px;color:#10b981"></i>
                            <span>rescom://</span><span class="live-node">core.cloud.v2.6/live</span>
                        </div>
                        <div class="hud-status-badge">
                            <span class="hud-status-dot-green"></span>
                            <span>Live 60 FPS</span>
                        </div>
                    </div>

                    <!-- Screen Area -->
                    <div class="futuristic-screen-area">
                        <div class="hud-corner hud-corner-tl"></div>
                        <div class="hud-corner hud-corner-tr"></div>
                        <div class="hud-corner hud-corner-bl"></div>
                        <div class="hud-corner hud-corner-br"></div>

                        @php
                            $heroImageBanner = $heroBanners->firstWhere('image', '!=', null) ?? $heroBanners->first();
                        @endphp
                        @if($heroImageBanner && $heroImageBanner->image)
                            <img id="heroImage"
                                 src="{{ media_url($heroImageBanner->image) }}"
                                 alt="{{ $heroImageBanner->title ?? 'Hero Image' }}">
                        @else
                            <div class="hero-orbit">
                                <div class="hero-orbit-inner">
                                    <div class="hero-orbit-core">&#128187;</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Floating Hologram Widget Bottom -->
                <div class="futuristic-holo-widget holo-widget-bottom">
                    <div class="holo-widget-icon"><i class="fas fa-shield-check"></i></div>
                    <div>
                        <div class="holo-widget-title">Zero-Trust Shield</div>
                        <div class="holo-widget-sub">Military-Grade Defense</div>
                    </div>
                </div>
            </div>

            <div id="heroLightbox" class="hero-lightbox" onclick="closeHeroImage(event)">
                <button class="close-btn" aria-label="Close image">&times;</button>
                <img id="heroLightboxImg" src="" alt="Hero preview">
            </div>
        </div>
    </div>

    <!-- Futuristic Swiper Navigation Controls -->
    <div class="swiper-button-prev" aria-label="Previous Slide"></div>
    <div class="swiper-button-next" aria-label="Next Slide"></div>
    <div class="swiper-pagination hero-pagination"></div>
</section>

<!-- =============== TRUSTED BY =============== -->
<section class="trusted-strip">
    <div class="container">
        <div class="trusted-marquee">
            <span class="trusted-label">{{ setting('home_trusted_label', 'Trusted by:') }}</span>
            <div class="trusted-track-wrap">
                <div class="trusted-track">
                    @foreach($featuredClients as $client)
                    <div class="trusted-item {{ !empty($client->website_url) ? 'is-link' : '' }}" style="display:inline-flex;align-items:center;gap:8px;white-space:nowrap">
                        @if(!empty($client->logo))
                            <img class="trusted-logo" src="{{ media_url($client->logo) }}" alt="{{ $client->name }}" style="height:26px;max-width:70px;width:auto;object-fit:contain;flex-shrink:0">
                        @endif
                        @if(!empty($client->website_url))
                            <a class="trusted-link" href="{{ $client->website_url }}" target="_blank" rel="noopener noreferrer" style="color:inherit;text-decoration:none;display:inline-flex;align-items:center;line-height:1">{{ $client->name }}</a>
                        @else
                            <span class="trusted-text" style="color:inherit;display:inline-flex;align-items:center;line-height:1">{{ $client->name }}</span>
                        @endif
                    </div>
                    @endforeach
                    @foreach($featuredClients as $client)
                    <div class="trusted-item {{ !empty($client->website_url) ? 'is-link' : '' }}" style="display:inline-flex;align-items:center;gap:8px;white-space:nowrap">
                        @if(!empty($client->logo))
                            <img class="trusted-logo" src="{{ media_url($client->logo) }}" alt="{{ $client->name }}" style="height:26px;max-width:70px;width:auto;object-fit:contain;flex-shrink:0">
                        @endif
                        @if(!empty($client->website_url))
                            <a class="trusted-link" href="{{ $client->website_url }}" target="_blank" rel="noopener noreferrer" style="color:inherit;text-decoration:none;display:inline-flex;align-items:center;line-height:1">{{ $client->name }}</a>
                        @else
                            <span class="trusted-text" style="color:inherit;display:inline-flex;align-items:center;line-height:1">{{ $client->name }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============== FUTURISTIC SERVICES SECTION =============== -->
<section class="section futuristic-services-section" id="services">
    <style>
        /* ===== FUTURISTIC SERVICES STYLES ===== */
        .futuristic-services-section {
            position: relative;
            background: #f8fafc;
            padding: 80px 0 90px 0;
            overflow: hidden;
        }

        .futuristic-services-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 15% 20%, rgba(37, 99, 235, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 85% 80%, rgba(14, 165, 233, 0.06) 0%, transparent 45%),
                linear-gradient(180deg, #f8fafc 0%, #f1f5f9 50%, #f8fafc 100%);
            pointer-events: none;
        }

        .futuristic-services-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.04) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
        }

        /* 3-Column Section Header */
        .fsc-section-header-wrap {
            display: grid;
            grid-template-columns: minmax(130px, 1fr) auto minmax(130px, 1fr);
            align-items: flex-end;
            margin-bottom: 38px;
            gap: 24px;
        }

        .fsc-header-left {
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            margin-bottom: 6px;
        }

        .fsc-header-center {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 680px;
            margin: 0 auto;
        }

        .fsc-center-title {
            font-size: clamp(28px, 3.2vw, 44px);
            font-weight: 850;
            line-height: 1.2;
            letter-spacing: -0.025em;
            margin-bottom: 12px;
            color: #0f172a;
            text-shadow: none !important;
            text-align: center;
        }

        .fsc-center-desc {
            margin: 0 auto;
            max-width: 620px;
            color: #64748b;
            text-align: center;
        }

        .fsc-header-right {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            margin-bottom: 6px;
        }

        .fsc-view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff !important;
            padding: 12px 26px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 25px rgba(37, 99, 235, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
        }
        .fsc-view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.5), 0 0 20px rgba(6, 182, 212, 0.3);
        }

        .fsc-nav-arrows {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .fsc-nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            color: #0284c7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
            font-size: 15px;
        }
        .fsc-nav-btn:hover {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.35);
            transform: translateY(-2px);
        }
        .fsc-nav-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 992px) {
            .fsc-section-header-wrap {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 28px;
            }
            .fsc-header-center {
                grid-column: 1 / -1;
                order: 1;
            }
            .fsc-header-left {
                grid-column: 1;
                order: 2;
                justify-content: flex-start;
                margin-bottom: 0;
            }
            .fsc-header-right {
                grid-column: 2;
                order: 2;
                justify-content: flex-end;
                margin-bottom: 0;
            }
        }

        /* Continuous Scroller for Services */
        .futuristic-scroller-viewport {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            scrollbar-width: none;
            -ms-overflow-style: none;
            cursor: grab;
            user-select: none;
            padding: 20px 4px 30px 4px;
            position: relative;
            -webkit-overflow-scrolling: touch;
            touch-action: pan-y;
        }
        .futuristic-scroller-viewport::-webkit-scrollbar {
            display: none;
        }
        .futuristic-scroller-viewport:active {
            cursor: grabbing;
        }
        .futuristic-scroller-track {
            display: flex;
            gap: 24px;
            width: max-content;
            will-change: scroll-position;
        }
        .futuristic-scroller-item {
            flex: 0 0 360px;
            max-width: 360px;
            width: 360px;
        }
        @media (max-width: 768px) {
            .futuristic-scroller-item {
                flex: 0 0 290px;
                max-width: 290px;
                width: 290px;
            }
        }

        /* Futuristic White Service Card */
        .futuristic-service-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.9);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 420px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .futuristic-service-card:hover {
            transform: translateY(-8px) scale(1.015);
            border-color: #0284c7;
            box-shadow: 
                0 22px 50px -10px rgba(14, 165, 233, 0.2),
                0 0 25px rgba(56, 189, 248, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        /* Top Display Bay */
        .fsc-preview-bay {
            position: relative;
            height: 190px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }

        .fsc-circuit-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(14, 165, 233, 0.08) 1.5px, transparent 1.5px);
            background-size: 16px 16px;
            pointer-events: none;
        }

        .fsc-icon-bay {
            width: 76px;
            height: 76px;
            border-radius: 20px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border: 1.5px solid rgba(14, 165, 233, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #0284c7;
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.2);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, background 0.3s ease, color 0.3s ease;
            position: relative;
            z-index: 2;
        }
        .futuristic-service-card:hover .fsc-icon-bay {
            transform: scale(1.1) rotate(4deg);
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.35);
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
        }

        .fsc-service-img {
            max-width: 80%;
            max-height: 75%;
            object-fit: contain;
            position: relative;
            z-index: 2;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .futuristic-service-card:hover .fsc-service-img {
            transform: scale(1.08);
        }

        /* HUD Category Tag */
        .fsc-cat-badge {
            position: absolute;
            top: 12px;
            left: 12px;
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
        .fsc-cat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #0284c7;
            box-shadow: 0 0 6px #0284c7;
        }

        /* Live Status Pill */
        .fsc-status-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #059669;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 3;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Corner Reticles */
        .fsc-corner {
            position: absolute;
            width: 10px;
            height: 10px;
            border-color: #0284c7;
            border-style: solid;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 3;
        }
        .futuristic-service-card:hover .fsc-corner {
            opacity: 0.85;
        }
        .fsc-corner-tl { top: 8px; left: 8px; border-width: 1.5px 0 0 1.5px; }
        .fsc-corner-tr { top: 8px; right: 8px; border-width: 1.5px 1.5px 0 0; }
        .fsc-corner-bl { bottom: 8px; left: 8px; border-width: 0 0 1.5px 1.5px; }
        .fsc-corner-br { bottom: 8px; right: 8px; border-width: 0 1.5px 1.5px 0; }

        /* Card Content Body */
        .fsc-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
            background: #ffffff;
        }

        .fsc-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 8px;
            transition: color 0.2s ease;
        }
        .futuristic-service-card:hover .fsc-title {
            color: #0284c7;
        }

        .fsc-desc {
            color: #64748b;
            font-size: 13.5px;
            line-height: 1.6;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .fsc-features-list {
            list-style: none;
            padding: 0;
            margin: 0 0 16px 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .fsc-feature-item {
            font-size: 12.5px;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .fsc-feature-item i {
            color: #10b981;
            font-size: 11px;
            flex-shrink: 0;
        }

        /* Footer Telemetry & Action */
        .fsc-footer {
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .fsc-telemetry {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .fsc-telemetry i {
            color: #0284c7;
        }

        .fsc-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0284c7;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .fsc-action-btn i {
            transition: transform 0.2s ease;
        }
        .futuristic-service-card:hover .fsc-action-btn {
            color: #1d4ed8;
        }
        .futuristic-service-card:hover .fsc-action-btn i {
            transform: translateX(4px);
        }
    </style>

    <div class="futuristic-services-bg"></div>
    <div class="futuristic-services-grid-mesh"></div>

    <div class="container">
        <!-- Section Header (Left: Arrows, Center: Title & Content, Right: View All) -->
        <div class="fsc-section-header-wrap" data-aos="fade-up">
            <!-- Left: < > Navigation Arrows -->
            <div class="fsc-header-left">
                <div class="fsc-nav-arrows">
                    <button type="button" class="fsc-nav-btn fsc-prev" aria-label="Previous Services" title="Previous"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="fsc-nav-btn fsc-next" aria-label="Next Services" title="Next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <!-- Center: HUD Beacon, Title & Description -->
            <div class="fsc-header-center">
                <div class="f-white-hud-badge">
                    <span class="f-white-radar-dot"></span>
                    <span class="f-white-badge-subtitle">{{ setting('home_services_badge', 'OUR SERVICE CAPABILITIES') }}</span>
                    <span class="f-white-badge-divider"></span>
                    <span class="f-white-badge-tag"><i class="fas fa-cogs"></i> ENTERPRISE SOLUTIONS</span>
                </div>
                <h2 class="fsc-center-title">
                    {!! setting('home_services_title', 'Comprehensive <span class="f-white-gradient-text">IT Services</span> For Your Business') !!}
                </h2>
                <p class="futuristic-hero-description fsc-center-desc">
                    {{ setting('home_services_subtitle', 'From ideation to deployment, we provide end-to-end technology solutions that help businesses grow, scale, and succeed in the digital era.') }}
                </p>
            </div>

            <!-- Right: View All Services Button -->
            <div class="fsc-header-right">
                <a href="{{ setting('home_services_button_url', route('services')) }}" class="fsc-view-all-btn">
                    <span>{{ setting('home_services_button_text', 'View All Services') }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Continuous Scroller for Services (Instant hover freeze, smooth loop) -->
        @if($featuredServices->count() > 0)
        <div class="futuristic-scroller-viewport" id="servicesScroller" data-aos="fade-up" data-aos-delay="100">
            <div class="futuristic-scroller-track">
                @php
                    // Dynamic real-time featured services from DB
                    $slideServices = $featuredServices;
                    if ($slideServices->count() > 0 && $slideServices->count() < 8) {
                        $slideServices = $slideServices->concat($featuredServices)->concat($featuredServices);
                    }
                @endphp
                @foreach($slideServices as $index => $service)
                <div class="futuristic-scroller-item">
                    <div class="futuristic-service-card" onclick="location.href='{{ route('services.show', $service->slug) }}'" style="cursor:pointer">
                        <!-- Top Preview Bay -->
                        <div class="fsc-preview-bay">
                            <div class="fsc-circuit-pattern"></div>
                            <div class="fsc-corner fsc-corner-tl"></div>
                            <div class="fsc-corner fsc-corner-tr"></div>
                            <div class="fsc-corner fsc-corner-bl"></div>
                            <div class="fsc-corner fsc-corner-br"></div>

                            <div class="fsc-cat-badge">
                                <span class="fsc-cat-dot"></span>
                                <span>{{ $service->category ? $service->category->name : 'Enterprise IT' }}</span>
                            </div>

                            <div class="fsc-status-tag">
                                <i class="fas fa-check-circle"></i> Active
                            </div>

                            @if($service->featured_image)
                            <img src="{{ media_url($service->featured_image) }}" alt="{{ $service->title }}" class="fsc-service-img">
                            @else
                            <div class="fsc-icon-bay">
                                <i class="{{ $service->icon ?? 'fas fa-laptop-code' }}"></i>
                            </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="fsc-body">
                            <div>
                                <h3 class="fsc-title">{{ $service->title }}</h3>
                                <p class="fsc-desc">{{ $service->short_description }}</p>

                                @php
                                    $serviceFeatures = is_array($service->features)
                                        ? $service->features
                                        : ((is_string($service->features) && $service->features !== '')
                                            ? (json_decode($service->features, true) ?: [])
                                            : []);
                                @endphp

                                @if(!empty($serviceFeatures))
                                <ul class="fsc-features-list">
                                    @foreach(array_slice($serviceFeatures, 0, 3) as $feature)
                                    <li class="fsc-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ $feature }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>

                            <!-- Footer Actions -->
                            <div class="fsc-footer">
                                <a href="{{ route('services.show', $service->slug) }}" class="fsc-action-btn" onclick="event.stopPropagation()">
                                    <span>Explore</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($slideServices as $index => $service)
                <div class="futuristic-scroller-item">
                    <div class="futuristic-service-card" onclick="location.href='{{ route('services.show', $service->slug) }}'" style="cursor:pointer">
                        <!-- Top Preview Bay -->
                        <div class="fsc-preview-bay">
                            <div class="fsc-circuit-pattern"></div>
                            <div class="fsc-corner fsc-corner-tl"></div>
                            <div class="fsc-corner fsc-corner-tr"></div>
                            <div class="fsc-corner fsc-corner-bl"></div>
                            <div class="fsc-corner fsc-corner-br"></div>

                            <div class="fsc-cat-badge">
                                <span class="fsc-cat-dot"></span>
                                <span>{{ $service->category ? $service->category->name : 'Enterprise IT' }}</span>
                            </div>

                            <div class="fsc-status-tag">
                                <i class="fas fa-check-circle"></i> Active
                            </div>

                            @if($service->featured_image)
                            <img src="{{ media_url($service->featured_image) }}" alt="{{ $service->title }}" class="fsc-service-img">
                            @else
                            <div class="fsc-icon-bay">
                                <i class="{{ $service->icon ?? 'fas fa-laptop-code' }}"></i>
                            </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="fsc-body">
                            <div>
                                <h3 class="fsc-title">{{ $service->title }}</h3>
                                <p class="fsc-desc">{{ $service->short_description }}</p>

                                @php
                                    $serviceFeatures = is_array($service->features)
                                        ? $service->features
                                        : ((is_string($service->features) && $service->features !== '')
                                            ? (json_decode($service->features, true) ?: [])
                                            : []);
                                @endphp

                                @if(!empty($serviceFeatures))
                                <ul class="fsc-features-list">
                                    @foreach(array_slice($serviceFeatures, 0, 3) as $feature)
                                    <li class="fsc-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ $feature }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>

                            <!-- Footer Actions -->
                            <div class="fsc-footer">
                                <a href="{{ route('services.show', $service->slug) }}" class="fsc-action-btn" onclick="event.stopPropagation()">
                                    <span>Explore</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div style="text-align:center;padding:40px 20px;background:#ffffff;border-radius:16px;border:1px dashed #cbd5e1;margin-top:20px;">
            <p style="color:#64748b;font-size:15px;margin-bottom:12px;">No featured services currently selected.</p>
            <a href="{{ route('services') }}" class="fsc-view-all-btn" style="display:inline-flex;">View All Services &rarr;</a>
        </div>
        @endif
    </div>
</section>

<!-- =============== FUTURISTIC WHY CHOOSE US & STATS SECTION (WHITE THEME) =============== -->
<section class="futuristic-why-section section" id="why-us">
    <style>
        .futuristic-why-section {
            position: relative;
            background: linear-gradient(180deg, #f8fafc 0%, #f0f7ff 50%, #ffffff 100%);
            padding: clamp(70px, 9vh, 110px) 0;
            overflow: hidden;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .f-why-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.07) 0%, transparent 45%),
                radial-gradient(circle at 90% 80%, rgba(6, 182, 212, 0.08) 0%, transparent 45%);
            pointer-events: none;
            z-index: 1;
        }

        .f-why-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.04) 1px, transparent 1px);
            background-size: 36px 36px;
            mask-image: radial-gradient(circle at 50% 50%, black 50%, transparent 95%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 50%, transparent 95%);
            pointer-events: none;
            z-index: 1;
        }

        .futuristic-why-section .container {
            position: relative;
            z-index: 2;
        }

        .f-why-main-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.95fr;
            gap: 52px;
            align-items: center;
        }

        @media (max-width: 1024px) {
            .f-why-main-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        /* Left Side */
        .f-why-title {
            text-align: left;
            margin-bottom: 14px;
            font-size: clamp(28px, 3.2vw, 44px);
            font-weight: 850;
            line-height: 1.2;
            letter-spacing: -0.025em;
            color: #0f172a;
            text-shadow: none !important;
        }

        .f-why-desc {
            color: #64748b;
            font-size: 15px;
            line-height: 1.75;
            margin-bottom: 28px;
            max-width: 580px;
        }

        .f-why-features-wrap {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 32px;
        }

        .f-why-feature-card {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 20px;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }

        .f-why-feature-card:hover {
            transform: translateX(6px);
            border-color: #0284c7;
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.15), 0 0 15px rgba(56, 189, 248, 0.1);
        }

        .f-why-feature-icon-bay {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border: 1.5px solid rgba(14, 165, 233, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0284c7;
            font-size: 20px;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.15);
            transition: transform 0.35s ease, background 0.3s ease, color 0.3s ease;
        }

        .f-why-feature-card:hover .f-why-feature-icon-bay {
            transform: scale(1.1) rotate(4deg);
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
        }

        .f-why-feature-title {
            font-size: 15.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
            transition: color 0.2s ease;
        }

        .f-why-feature-card:hover .f-why-feature-title {
            color: #0284c7;
        }

        .f-why-feature-desc {
            color: #64748b;
            font-size: 13.5px;
            line-height: 1.6;
            margin: 0;
        }

        /* Micro Corner Reticles on Feature Card */
        .f-why-cb-tr, .f-why-cb-bl {
            position: absolute;
            width: 8px;
            height: 8px;
            border-color: #0284c7;
            border-style: solid;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .f-why-feature-card:hover .f-why-cb-tr,
        .f-why-feature-card:hover .f-why-cb-bl {
            opacity: 0.8;
        }
        .f-why-cb-tr { top: 6px; right: 6px; border-width: 1.5px 1.5px 0 0; }
        .f-why-cb-bl { bottom: 6px; left: 6px; border-width: 0 0 1.5px 1.5px; }

        .f-why-btn-primary {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 60%, #06b6d4 100%);
            color: #ffffff !important;
            padding: 13px 30px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-decoration: none;
            box-shadow: 0 6px 25px rgba(37, 99, 235, 0.4), 0 0 15px rgba(6, 182, 212, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.35);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }
        .f-why-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(37, 99, 235, 0.55), 0 0 25px rgba(6, 182, 212, 0.35);
            color: #ffffff;
        }
        .f-why-btn-primary i {
            transition: transform 0.25s ease;
        }
        .f-why-btn-primary:hover i {
            transform: translateX(4px);
        }

        /* Right Side: 3D Cyber Stat Cards Grid */
        .f-stat-cyber-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 576px) {
            .f-stat-cyber-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        .f-stat-cyber-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            padding: 28px 20px 24px 20px;
            text-align: center;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .f-stat-cyber-card:hover {
            transform: translateY(-7px) scale(1.02);
            border-color: #0284c7;
            box-shadow: 
                0 22px 50px -10px rgba(14, 165, 233, 0.22),
                0 0 25px rgba(56, 189, 248, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .f-stat-ambient-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 20%, rgba(14, 165, 233, 0.08) 0%, transparent 70%);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .f-stat-cyber-card:hover .f-stat-ambient-glow {
            opacity: 1;
        }

        .f-stat-circuit-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(14, 165, 233, 0.08) 1.5px, transparent 1.5px);
            background-size: 16px 16px;
            pointer-events: none;
        }

        /* Stat Reticles */
        .f-stat-corner {
            position: absolute;
            width: 10px;
            height: 10px;
            border-color: #0284c7;
            border-style: solid;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 3;
        }
        .f-stat-cyber-card:hover .f-stat-corner {
            opacity: 0.85;
        }
        .f-stat-corner-tl { top: 8px; left: 8px; border-width: 1.5px 0 0 1.5px; }
        .f-stat-corner-tr { top: 8px; right: 8px; border-width: 1.5px 1.5px 0 0; }
        .f-stat-corner-bl { bottom: 8px; left: 8px; border-width: 0 0 1.5px 1.5px; }
        .f-stat-corner-br { bottom: 8px; right: 8px; border-width: 0 1.5px 1.5px 0; }

        .f-stat-icon-bay {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
            position: relative;
            z-index: 2;
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease;
        }
        .f-stat-cyber-card:hover .f-stat-icon-bay {
            transform: scale(1.12) rotate(4deg);
            box-shadow: 0 12px 28px rgba(14, 165, 233, 0.45);
        }

        .f-stat-number-wrap {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: baseline;
            justify-content: center;
            font-feature-settings: "tnum";
            line-height: 1;
            margin-bottom: 8px;
        }

        .f-stat-number {
            font-size: clamp(32px, 2.6vw, 42px);
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .f-stat-suffix {
            font-size: clamp(24px, 2vw, 32px);
            font-weight: 850;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-left: 2px;
        }

        .f-stat-label {
            position: relative;
            z-index: 2;
            font-size: 12.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .f-stat-telemetry-bar {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            padding: 3px 9px;
            border-radius: 999px;
            background: rgba(14, 165, 233, 0.08);
            border: 1px solid rgba(14, 165, 233, 0.2);
            font-size: 9.5px;
            font-weight: 700;
            color: #0284c7;
            letter-spacing: 0.5px;
        }

        .f-stat-telemetry-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 6px #10b981;
        }
    </style>

    <div class="f-why-bg"></div>
    <div class="f-why-grid-mesh"></div>

    <div class="container">
        <div class="f-why-main-grid">
            <!-- Left Side: HUD badge, Title, Description, Feature rows, CTA -->
            <div data-aos="fade-right">
                <div class="f-white-hud-badge">
                    <span class="f-white-radar-dot"></span>
                    <span class="f-white-badge-subtitle">{{ setting('home_why_badge', 'WHY RESCOM') }}</span>
                    <span class="f-white-badge-divider"></span>
                    <span class="f-white-badge-tag"><i class="fas fa-shield-halved"></i> ENTERPRISE ECOSYSTEM</span>
                </div>

                <h2 class="f-why-title">
                    {!! setting('home_why_title', 'Your Trusted <span class="f-white-gradient-text">Technology Partner</span> Since 2019') !!}
                </h2>

                <p class="f-why-desc">
                    {{ setting('home_why_body', "Rescom plays a pivotal role in advancing innovation by fostering interdisciplinary collaboration and optimizing the management of digital information across platforms. Leveraging advanced mapping, analytics, and stakeholder integration, we drive productivity and create sustainable, tangible outcomes.") }}
                </p>

                @php
                    $homeWhyItems = json_decode(setting('home_why_items', ''), true);
                    if (!is_array($homeWhyItems) || empty($homeWhyItems)) {
                        $homeWhyItems = [
                            ['icon' => 'fas fa-shield-alt', 'color' => '#0284c7', 'title' => 'Enterprise-Grade Security', 'desc' => 'All our applications follow OWASP standards and undergo rigorous security testing before deployment.'],
                            ['icon' => 'fas fa-rocket', 'color' => '#10b981', 'title' => 'Agile Delivery', 'desc' => 'We deliver quality products on time using Agile methodology with complete transparency.'],
                            ['icon' => 'fas fa-headset', 'color' => '#f59e0b', 'title' => '24/7 Support', 'desc' => 'Dedicated support team available round-the-clock to ensure your business never stops.'],
                            ['icon' => 'fas fa-chart-line', 'color' => '#ef4444', 'title' => 'Proven ROI', 'desc' => 'Our clients see average 40% improvement in operational efficiency post-implementation.'],
                        ];
                    }
                @endphp

                <div class="f-why-features-wrap">
                    @foreach($homeWhyItems as $i => $item)
                        @php
                            $icon = $item['icon'] ?? 'fas fa-star';
                            $color = $item['color'] ?? '#0284c7';
                            $title = $item['title'] ?? '';
                            $desc = $item['desc'] ?? '';
                        @endphp
                        <div class="f-why-feature-card" data-aos="fade-up" data-aos-delay="{{ $i * 70 }}">
                            <div class="f-why-corner-bracket f-why-cb-tr"></div>
                            <div class="f-why-corner-bracket f-why-cb-bl"></div>

                            <div class="f-why-feature-icon-bay">
                                <i class="{{ $icon }}"></i>
                            </div>
                            <div class="f-why-feature-content">
                                <h4 class="f-why-feature-title">{{ $title }}</h4>
                                <p class="f-why-feature-desc">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="{{ setting('home_why_button_url', route('about')) }}" class="f-why-btn-primary">
                    <span>{{ setting('home_why_button_text', 'Know About Us') }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Right Side: 6 3D Cyber Stat Cards -->
            <div data-aos="fade-left">
                <div class="f-stat-cyber-grid">
                    @foreach($stats as $index => $stat)
                    <div class="f-stat-cyber-card" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                        <div class="f-stat-ambient-glow"></div>
                        <div class="f-stat-circuit-pattern"></div>
                        
                        <div class="f-stat-corner f-stat-corner-tl"></div>
                        <div class="f-stat-corner f-stat-corner-tr"></div>
                        <div class="f-stat-corner f-stat-corner-bl"></div>
                        <div class="f-stat-corner f-stat-corner-br"></div>

                        <div class="f-stat-icon-bay">
                            <i class="{{ $stat->icon }}"></i>
                        </div>

                        <div class="f-stat-number-wrap">
                            <span class="f-stat-number f-stat-counter" data-target="{{ (int) $stat->value }}">{{ $stat->value }}</span>
                            <span class="f-stat-suffix">{{ $stat->suffix }}</span>
                        </div>

                        <div class="f-stat-label">{{ $stat->title }}</div>

                        <div class="f-stat-telemetry-bar">
                            <span class="f-stat-telemetry-dot"></span>
                            <span>VERIFIED METRIC</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============== FUTURISTIC FEATURED PRODUCTS (CONTINUOUS SCROLL - WHITE THEME) =============== -->
<section class="futuristic-products-section section" id="products">
    <style>
        .futuristic-products-section {
            position: relative;
            background: linear-gradient(180deg, #f8fafc 0%, #f0f7ff 50%, #ffffff 100%);
            color: #0f172a;
            overflow: hidden;
            padding: clamp(60px, 8vh, 100px) 0;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .futuristic-products-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 12% 20%, rgba(37, 99, 235, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 88% 75%, rgba(6, 182, 212, 0.08) 0%, transparent 40%);
            pointer-events: none;
            z-index: 1;
        }

        .futuristic-products-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at 50% 50%, black 50%, transparent 95%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 50%, transparent 95%);
            pointer-events: none;
            z-index: 1;
        }

        .futuristic-products-section .container {
            position: relative;
            z-index: 2;
        }

        /* Continuous Scroller for Products */
        /* Re-uses .futuristic-scroller-viewport, .futuristic-scroller-track, .futuristic-scroller-item */

        /* Futuristic White Product Card */
        .futuristic-product-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.9);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 420px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .futuristic-product-card:hover {
            transform: translateY(-8px) scale(1.015);
            border-color: #0284c7;
            box-shadow: 
                0 22px 50px -10px rgba(14, 165, 233, 0.2),
                0 0 25px rgba(56, 189, 248, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        /* Card Top Display Bay */
        .fpc-preview-bay {
            position: relative;
            height: 200px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 24px;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .fpc-circuit-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(14, 165, 233, 0.08) 1.5px, transparent 1.5px);
            background-size: 16px 16px;
            pointer-events: none;
        }

        .fpc-logo-img {
            max-width: 80%;
            max-height: 75%;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;
            position: relative;
            z-index: 2;
        }
        .futuristic-product-card:hover .fpc-logo-img {
            transform: scale(1.08);
            filter: drop-shadow(0 6px 16px rgba(37, 99, 235, 0.15));
        }

        /* Category HUD Tag */
        .fpc-cat-badge {
            position: absolute;
            top: 12px;
            left: 12px;
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
        .fpc-cat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #0284c7;
            box-shadow: 0 0 6px #0284c7;
        }

        /* Live Status Pill */
        .fpc-status-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #059669;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 3;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Target Corner Brackets */
        .fpc-corner {
            position: absolute;
            width: 10px;
            height: 10px;
            border-color: #0284c7;
            border-style: solid;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 3;
        }
        .futuristic-product-card:hover .fpc-corner {
            opacity: 0.85;
        }
        .fpc-corner-tl { top: 8px; left: 8px; border-width: 1.5px 0 0 1.5px; }
        .fpc-corner-tr { top: 8px; right: 8px; border-width: 1.5px 1.5px 0 0; }
        .fpc-corner-bl { bottom: 8px; left: 8px; border-width: 0 0 1.5px 1.5px; }
        .fpc-corner-br { bottom: 8px; right: 8px; border-width: 0 1.5px 1.5px 0; }

        /* Card Content Body */
        .fpc-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
            background: #ffffff;
        }

        .fpc-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 8px;
            transition: color 0.2s ease;
        }
        .futuristic-product-card:hover .fpc-title {
            color: #0284c7;
        }

        .fpc-desc {
            color: #64748b;
            font-size: 13.5px;
            line-height: 1.6;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Tech Chip Matrix */
        .fpc-tech-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 18px;
        }
        .fpc-tech-chip {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #334155;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .futuristic-product-card:hover .fpc-tech-chip {
            background: #e0f2fe;
            border-color: #bae6fd;
            color: #0369a1;
        }

        /* Card Footer Telemetry & Action */
        .fpc-footer {
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .fpc-telemetry {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .fpc-telemetry i {
            color: #0284c7;
        }

        .fpc-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0284c7;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .fpc-action-btn i {
            transition: transform 0.2s ease;
        }
        .futuristic-product-card:hover .fpc-action-btn {
            color: #1d4ed8;
        }
        .futuristic-product-card:hover .fpc-action-btn i {
            transform: translateX(4px);
        }

        /* White HUD Live Badge */
        .f-white-hud-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(255, 255, 255, 0.95);
            border: 1.5px solid rgba(14, 165, 233, 0.35);
            padding: 6px 16px;
            border-radius: 999px;
            margin-bottom: 16px;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.12), inset 0 1px 0 #ffffff;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .f-white-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #0284c7;
            box-shadow: 0 0 8px #0284c7;
            position: relative;
            display: inline-block;
            flex-shrink: 0;
        }
        .f-white-radar-dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1.5px solid #0284c7;
            animation: fRadarWaveWhite 2s ease-out infinite;
        }
        @keyframes fRadarWaveWhite {
            0% { transform: scale(0.6); opacity: 1; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        .f-white-badge-subtitle {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: #0f172a;
        }
        .f-white-badge-divider {
            width: 1px;
            height: 10px;
            background: rgba(15, 23, 42, 0.2);
        }
        .f-white-badge-tag {
            font-size: 10.5px;
            font-weight: 700;
            color: #0284c7;
            letter-spacing: 0.4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .f-white-gradient-text {
            background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 50%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline;
            text-shadow: none !important;
            filter: none !important;
        }

        /* 3-Column Section Header (Left: Arrows, Center: Title & Content, Right: View All) */
        .fpc-section-header-wrap {
            display: grid;
            grid-template-columns: minmax(130px, 1fr) auto minmax(130px, 1fr);
            align-items: flex-end;
            margin-bottom: 38px;
            gap: 24px;
        }

        .fpc-header-left {
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            margin-bottom: 6px;
        }

        .fpc-header-center {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 660px;
            margin: 0 auto;
        }

        .fpc-center-title {
            font-size: clamp(28px, 3.2vw, 44px);
            font-weight: 850;
            line-height: 1.2;
            letter-spacing: -0.025em;
            margin-bottom: 12px;
            color: #0f172a;
            text-shadow: none !important;
            text-align: center;
        }

        .fpc-center-desc {
            margin: 0 auto;
            max-width: 600px;
            color: #64748b;
            text-align: center;
        }

        .fpc-header-right {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            margin-bottom: 6px;
        }

        .fpc-view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff !important;
            padding: 12px 26px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 25px rgba(37, 99, 235, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
        }
        .fpc-view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.5), 0 0 20px rgba(6, 182, 212, 0.3);
        }

        .fpc-nav-arrows {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .fpc-nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            color: #0284c7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
            font-size: 15px;
        }
        .fpc-nav-btn:hover {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.35);
            transform: translateY(-2px);
        }
        .fpc-nav-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 992px) {
            .fpc-section-header-wrap {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 28px;
            }
            .fpc-header-center {
                grid-column: 1 / -1;
                order: 1;
            }
            .fpc-header-left {
                grid-column: 1;
                order: 2;
                justify-content: flex-start;
                margin-bottom: 0;
            }
            .fpc-header-right {
                grid-column: 2;
                order: 2;
                justify-content: flex-end;
                margin-bottom: 0;
            }
        }
    </style>

    <div class="futuristic-products-bg"></div>
    <div class="futuristic-products-grid-mesh"></div>

    <div class="container">
        <!-- Section Header (Left: Arrows, Center: Title & Content, Right: View All) -->
        <div class="fpc-section-header-wrap" data-aos="fade-up">
            <!-- Left: < > Navigation Arrows -->
            <div class="fpc-header-left">
                <div class="fpc-nav-arrows">
                    <button type="button" class="fpc-nav-btn fpc-prev" aria-label="Previous Products" title="Previous"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="fpc-nav-btn fpc-next" aria-label="Next Products" title="Next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <!-- Center: HUD Beacon, Title & Description -->
            <div class="fpc-header-center">
                <div class="f-white-hud-badge">
                    <span class="f-white-radar-dot"></span>
                    <span class="f-white-badge-subtitle">{{ setting('home_portfolio_badge', 'OUR PRODUCT ECOSYSTEM') }}</span>
                    <span class="f-white-badge-divider"></span>
                    <span class="f-white-badge-tag"><i class="fas fa-microchip"></i> LIVE DEPLOYMENTS</span>
                </div>
                <h2 class="fpc-center-title">
                    {!! setting('home_portfolio_title', 'Featured <span class="f-white-gradient-text">Products</span> We\'re Proud Of') !!}
                </h2>
                <p class="futuristic-hero-description fpc-center-desc">
                    {{ setting('home_portfolio_subtitle', 'Browse our portfolio of high-impact products delivered for enterprise clients across industries worldwide.') }}
                </p>
            </div>

            <!-- Right: View All Products Button -->
            <div class="fpc-header-right">
                <a href="{{ setting('home_portfolio_button_url', route('portfolio')) }}" class="fpc-view-all-btn">
                    <span>{{ setting('home_portfolio_button_text', 'View All Products') }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Continuous Scroller for Products (Instant hover freeze, smooth loop) -->
        @if($featuredPortfolios->count() > 0)
        <div class="futuristic-scroller-viewport" id="productsScroller" data-aos="fade-up" data-aos-delay="100">
            <div class="futuristic-scroller-track">
                @php
                    // Duplicate elements if count is small so that continuous infinite loop flows smoothly
                    $slideProducts = $featuredPortfolios;
                    if ($slideProducts->count() > 0 && $slideProducts->count() < 8) {
                        $slideProducts = $slideProducts->concat($featuredPortfolios)->concat($featuredPortfolios);
                    }
                @endphp
                @foreach($slideProducts as $index => $project)
                <div class="futuristic-scroller-item">
                    <div class="futuristic-product-card" onclick="location.href='{{ route('portfolio.show', $project->slug) }}'" style="cursor:pointer">
                        <!-- Top Image / Logo Bay -->
                        <div class="fpc-preview-bay">
                            <div class="fpc-circuit-pattern"></div>
                            <div class="fpc-corner fpc-corner-tl"></div>
                            <div class="fpc-corner fpc-corner-tr"></div>
                            <div class="fpc-corner fpc-corner-bl"></div>
                            <div class="fpc-corner fpc-corner-br"></div>

                            @if($project->category)
                            <div class="fpc-cat-badge">
                                <span class="fpc-cat-dot"></span>
                                <span>{{ $project->category->name }}</span>
                            </div>
                            @endif

                            <div class="fpc-status-tag">
                                <i class="fas fa-bolt"></i> Live
                            </div>

                            @if($project->featured_image)
                            <img src="{{ media_url($project->featured_image) }}" alt="{{ $project->title }}" class="fpc-logo-img">
                            @else
                            <div style="font-size:50px;color:#38bdf8;opacity:0.6"><i class="fas fa-cubes"></i></div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="fpc-body">
                            <div>
                                <h3 class="fpc-title">{{ $project->title }}</h3>
                                <p class="fpc-desc">{{ $project->short_description }}</p>

                                @if($project->technologies)
                                <div class="fpc-tech-chips">
                                    @php
                                        $projectTechnologies = is_array($project->technologies)
                                             ? $project->technologies
                                             : ((is_string($project->technologies) && $project->technologies !== '')
                                                 ? (json_decode($project->technologies, true) ?: [])
                                                 : []);
                                    @endphp
                                    @foreach(array_slice($projectTechnologies, 0, 3) as $tech)
                                    <span class="fpc-tech-chip">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <!-- Footer Actions -->
                            <div class="fpc-footer">
                                <a href="{{ route('portfolio.show', $project->slug) }}" class="fpc-action-btn" onclick="event.stopPropagation()">
                                    <span>Explore</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($slideProducts as $index => $project)
                <div class="futuristic-scroller-item">
                    <div class="futuristic-product-card" onclick="location.href='{{ route('portfolio.show', $project->slug) }}'" style="cursor:pointer">
                        <!-- Top Image / Logo Bay -->
                        <div class="fpc-preview-bay">
                            <div class="fpc-circuit-pattern"></div>
                            <div class="fpc-corner fpc-corner-tl"></div>
                            <div class="fpc-corner fpc-corner-tr"></div>
                            <div class="fpc-corner fpc-corner-bl"></div>
                            <div class="fpc-corner fpc-corner-br"></div>

                            @if($project->category)
                            <div class="fpc-cat-badge">
                                <span class="fpc-cat-dot"></span>
                                <span>{{ $project->category->name }}</span>
                            </div>
                            @endif

                            <div class="fpc-status-tag">
                                <i class="fas fa-bolt"></i> Live
                            </div>

                            @if($project->featured_image)
                            <img src="{{ media_url($project->featured_image) }}" alt="{{ $project->title }}" class="fpc-logo-img">
                            @else
                            <div style="font-size:50px;color:#38bdf8;opacity:0.6"><i class="fas fa-cubes"></i></div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="fpc-body">
                            <div>
                                <h3 class="fpc-title">{{ $project->title }}</h3>
                                <p class="fpc-desc">{{ $project->short_description }}</p>

                                @if($project->technologies)
                                <div class="fpc-tech-chips">
                                    @php
                                        $projectTechnologies = is_array($project->technologies)
                                             ? $project->technologies
                                             : ((is_string($project->technologies) && $project->technologies !== '')
                                                 ? (json_decode($project->technologies, true) ?: [])
                                                 : []);
                                    @endphp
                                    @foreach(array_slice($projectTechnologies, 0, 3) as $tech)
                                    <span class="fpc-tech-chip">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <!-- Footer Actions -->
                            <div class="fpc-footer">
                                <a href="{{ route('portfolio.show', $project->slug) }}" class="fpc-action-btn" onclick="event.stopPropagation()">
                                    <span>Explore</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div style="text-align:center;padding:40px 20px;background:#ffffff;border-radius:16px;border:1px dashed #cbd5e1;margin-top:20px;">
            <p style="color:#64748b;font-size:15px;margin-bottom:12px;">No featured products currently selected.</p>
            <a href="{{ route('portfolio') }}" class="fpc-view-all-btn" style="display:inline-flex;">View All Products &rarr;</a>
        </div>
        @endif
    </div>
</section>

<!-- =============== PROCESS =============== -->
<section class="section" style="background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%)">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge" style="background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.15)">
                <i class="fas fa-route"></i> {{ setting('home_process_badge', 'Our Process') }}
            </div>
            <h2 class="section-title" style="color:white">{!! setting('home_process_title', 'How We <span>Deliver Excellence</span>') !!}</h2>
            <p class="section-subtitle" style="color:rgba(255,255,255,0.65)">{{ setting('home_process_subtitle', 'Our proven 6-step process ensures every project is delivered on time, within budget, and exceeds expectations.') }}</p>
        </div>

        <div class="process-grid">
            @php
                $homeProcessSteps = json_decode(setting('home_process_steps', ''), true);
                if (!is_array($homeProcessSteps) || empty($homeProcessSteps)) {
                    $homeProcessSteps = [
                        ['number' => '1', 'icon' => 'fas fa-search', 'title' => 'Discovery', 'desc' => 'Understanding your goals, users, and technical requirements.'],
                        ['number' => '2', 'icon' => 'fas fa-pencil-ruler', 'title' => 'Strategy', 'desc' => 'Crafting the perfect technology roadmap and architecture plan.'],
                        ['number' => '3', 'icon' => 'fas fa-paint-brush', 'title' => 'Design', 'desc' => 'Beautiful, intuitive UI/UX designs approved by you.'],
                        ['number' => '4', 'icon' => 'fas fa-code', 'title' => 'Develop', 'desc' => 'Agile development with weekly demos and transparent progress.'],
                        ['number' => '5', 'icon' => 'fas fa-vial', 'title' => 'QA Testing', 'desc' => 'Comprehensive Quality Assurance testing for security & performance.'],
                        ['number' => '6', 'icon' => 'fas fa-rocket', 'title' => 'Launch & Support', 'desc' => 'Smooth deployment with ongoing maintenance and growth support.'],
                    ];
                }
            @endphp
            @foreach($homeProcessSteps as $i => $step)
            <div class="process-step" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="process-number">{{ $step['number'] ?? ($step[0] ?? '') }}</div>
                <div style="width:1px;height:30px;background:rgba(255,255,255,0.15);margin-bottom:16px"></div>
                <div style="width:52px;height:52px;background:rgba(255,255,255,0.07);border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:14px">
                    <i class="{{ $step['icon'] ?? ($step[1] ?? '') }}" style="color:rgba(255,255,255,0.7);font-size:20px"></i>
                </div>
                <h4 style="color:white;font-size:15px;margin-bottom:8px">{{ $step['title'] ?? ($step[2] ?? '') }}</h4>
                <p style="color:rgba(255,255,255,0.5);font-size:12.5px;line-height:1.6">{{ $step['desc'] ?? ($step[3] ?? '') }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =============== TESTIMONIALS =============== -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge"><i class="fas fa-quote-left"></i> {{ setting('home_testimonials_badge', 'Client Stories') }}</div>
            <h2 class="section-title">{!! setting('home_testimonials_title', 'Trusted by <span>Industry Leaders</span>') !!}</h2>
        </div>
        <div class="swiper testimonials-swiper">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="rating">
                            @for($i=0; $i<5; $i++) <i class="fas fa-star" style="color:#fbbf24"></i> @endfor
                        </div>
                        <p class="testimonial-text">"{{ \Illuminate\Support\Str::limit($testimonial->content, 160, '...') }}"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">{{ strtoupper(substr($testimonial->client_name, 0, 1)) }}</div>
                            <div>
                                <div class="author-name">{{ $testimonial->client_name }}</div>
                                <div class="author-role">{{ $testimonial->client_designation }} @if($testimonial->client_company)— {{ $testimonial->client_company }}@endif</div>
                                @if($testimonial->testimonial_source === 'student-college')
                                    <div style="margin-top:6px;display:inline-flex;align-items:center;padding:4px 10px;border-radius:999px;background:rgba(255,255,255,0.12);color:#0f172a;font-size:11px;font-weight:700">Student / College</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination testimonials-pagination" style="position:relative;margin-top:30px"></div>
        </div>

        <div style="text-align:center;margin-top:30px" data-aos="fade-up">
            <a href="{{ setting('home_testimonials_button_url', url('/testimonials')) }}" class="btn btn-blue">
                {{ setting('home_testimonials_button_text', 'Know More') }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- =============== TEAM =============== -->
<section class="section" style="background:#f8fafc">
    <div class="container">
       <div class="section-header" data-aos="fade-up">
            <div class="section-badge"><i class="fas fa-users"></i> Pioneers of Progress</div>
            <h2 class="section-title">{!! setting('home_team_title', 'Leading <span>Beyond Boundaries</span> with Purpose') !!}</h2>
        </div>

        <div class="team-grid">
            @foreach($team->take(4) as $index => $member)
            <a href="{{ route('team.show', $member) }}" 
               style="background:white;border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow-sm);border:1px solid rgba(0,0,0,0.05);transition:all 0.3s;text-align:center;display:block;text-decoration:none;color:inherit"
               data-aos="fade-up" data-aos-delay="{{ $index * 80 }}"
               onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='var(--shadow-xl)'"
               onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'">

                <div style="width:198px;height:198px;background:#fff;border-radius:50%;margin:0 auto 16px;padding:8px;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 26px rgba(0,0,0,0.12)">
                    <div style="width:100%;height:100%;background:var(--gradient);border-radius:50%;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                        @if($member->photo)
                        <img src="{{ media_url($member->photo) }}" alt="{{ $member->name }}" 
                             style="width:100%;height:100%;object-fit:cover">
                        @else
                        <div style="display:flex;align-items:center;justify-content:center;height:100%;font-size:60px;opacity:0.3">&#128100;</div>
                        @endif
                    </div>
                </div>

                <div style="padding:20px">
                    <h4 style="font-size:15px;margin-bottom:4px;color:var(--dark)">{{ $member->name }}</h4>
                    <p style="font-size:13px;color:var(--primary);font-weight:600;margin-bottom:10px">{{ $member->designation }}</p>
                </div>

            </a>
            @endforeach
        </div>
    </div>
</section><!-- =============== FUTURISTIC BLOG PREVIEW SECTION (WHITE THEME) =============== -->
<section class="futuristic-blog-section section" id="insights">
    <style>
        .futuristic-blog-section {
            position: relative;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 50%, #f0f7ff 100%);
            padding: clamp(70px, 9vh, 110px) 0;
            overflow: hidden;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .f-blog-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 15% 20%, rgba(37, 99, 235, 0.06) 0%, transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(6, 182, 212, 0.07) 0%, transparent 45%);
            pointer-events: none;
            z-index: 1;
        }

        .f-blog-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.04) 1px, transparent 1px);
            background-size: 36px 36px;
            mask-image: radial-gradient(circle at 50% 50%, black 50%, transparent 95%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 50%, transparent 95%);
            pointer-events: none;
            z-index: 1;
        }

        .futuristic-blog-section .container {
            position: relative;
            z-index: 2;
        }

        /* 3-Column Section Header */
        .f-blog-section-header-wrap {
            display: grid;
            grid-template-columns: minmax(130px, 1fr) auto minmax(130px, 1fr);
            align-items: flex-end;
            margin-bottom: 38px;
            gap: 24px;
        }

        .f-blog-header-left {
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            margin-bottom: 6px;
        }

        .f-blog-header-center {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 680px;
            margin: 0 auto;
        }

        .f-blog-section-title {
            font-size: clamp(28px, 3.2vw, 44px);
            font-weight: 850;
            line-height: 1.2;
            letter-spacing: -0.025em;
            color: #0f172a;
            margin-bottom: 12px;
            text-shadow: none !important;
            text-align: center;
        }

        .f-blog-section-desc {
            margin: 0 auto;
            max-width: 620px;
            color: #64748b;
            font-size: 15px;
            line-height: 1.65;
            text-align: center;
        }

        .f-blog-header-right {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            margin-bottom: 6px;
        }

        .f-blog-view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff !important;
            padding: 12px 26px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 25px rgba(37, 99, 235, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
        }
        .f-blog-view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.5), 0 0 20px rgba(6, 182, 212, 0.3);
            color: #ffffff;
        }

        .f-blog-nav-arrows {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .f-blog-nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            color: #0284c7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
            font-size: 15px;
        }
        .f-blog-nav-btn:hover {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.35);
            transform: translateY(-2px);
        }
        .f-blog-nav-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 992px) {
            .f-blog-section-header-wrap {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 28px;
            }
            .f-blog-header-center {
                grid-column: 1 / -1;
                order: 1;
            }
            .f-blog-header-left {
                grid-column: 1;
                order: 2;
                justify-content: flex-start;
                margin-bottom: 0;
            }
            .f-blog-header-right {
                grid-column: 2;
                order: 2;
                justify-content: flex-end;
                margin-bottom: 0;
            }
        }

        .f-blog-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 420px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(0, 0, 0, 0.03);
            cursor: pointer;
        }

        .f-blog-card:hover {
            transform: translateY(-8px) scale(1.015);
            border-color: #0284c7;
            box-shadow: 
                0 22px 50px -10px rgba(14, 165, 233, 0.2),
                0 0 25px rgba(56, 189, 248, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .f-blog-preview-bay {
            position: relative;
            height: 190px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }

        .f-blog-circuit-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(14, 165, 233, 0.08) 1.5px, transparent 1.5px);
            background-size: 16px 16px;
            pointer-events: none;
        }

        .f-blog-img-wrap {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;
            z-index: 2;
        }

        .f-blog-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .f-blog-card:hover .f-blog-img {
            transform: scale(1.08);
        }

        .f-blog-icon-bay {
            width: 76px;
            height: 76px;
            border-radius: 20px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border: 1.5px solid rgba(14, 165, 233, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #0284c7;
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.2);
            position: relative;
            z-index: 2;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, background 0.3s ease, color 0.3s ease;
        }

        .f-blog-card:hover .f-blog-icon-bay {
            transform: scale(1.1) rotate(4deg);
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.35);
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
        }

        /* Reticles */
        .f-blog-corner {
            position: absolute;
            width: 10px;
            height: 10px;
            border-color: #0284c7;
            border-style: solid;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 4;
        }
        .f-blog-card:hover .f-blog-corner {
            opacity: 0.85;
        }
        .f-blog-corner-tl { top: 8px; left: 8px; border-width: 1.5px 0 0 1.5px; }
        .f-blog-corner-tr { top: 8px; right: 8px; border-width: 1.5px 1.5px 0 0; }
        .f-blog-corner-bl { bottom: 8px; left: 8px; border-width: 0 0 1.5px 1.5px; }
        .f-blog-corner-br { bottom: 8px; right: 8px; border-width: 0 1.5px 1.5px 0; }

        /* Category Tag */
        .f-blog-cat-badge {
            position: absolute;
            top: 12px;
            left: 12px;
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
            z-index: 5;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .f-blog-cat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #0284c7;
            box-shadow: 0 0 6px #0284c7;
        }

        /* Time Badge */
        .f-blog-time-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 3.5px 9px;
            border-radius: 6px;
            font-size: 10.5px;
            font-weight: 600;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 5;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .f-blog-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
            background: #ffffff;
        }

        .f-blog-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 8px;
            transition: color 0.2s ease;
        }
        .f-blog-card:hover .f-blog-title {
            color: #0284c7;
        }

        .f-blog-excerpt {
            color: #64748b;
            font-size: 13.5px;
            line-height: 1.6;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .f-blog-footer {
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .f-blog-date {
            font-size: 11.5px;
            color: #64748b;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .f-blog-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0284c7;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .f-blog-action-btn i {
            transition: transform 0.2s ease;
        }
        .f-blog-card:hover .f-blog-action-btn {
            color: #1d4ed8;
        }
        .f-blog-card:hover .f-blog-action-btn i {
            transform: translateX(4px);
        }
    </style>

    <div class="f-blog-bg"></div>
    <div class="f-blog-grid-mesh"></div>

    <div class="container">
        <!-- Section Header (Left: Arrows, Center: Title & Content, Right: View All) -->
        <div class="f-blog-section-header-wrap" data-aos="fade-up">
            <!-- Left: < > Navigation Arrows -->
            <div class="f-blog-header-left">
                <div class="f-blog-nav-arrows">
                    <button type="button" class="f-blog-nav-btn f-blog-prev" aria-label="Previous Articles" title="Previous"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="f-blog-nav-btn f-blog-next" aria-label="Next Articles" title="Next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <!-- Center: HUD Beacon, Title & Description -->
            <div class="f-blog-header-center">
                <div class="f-white-hud-badge">
                    <span class="f-white-radar-dot"></span>
                    <span class="f-white-badge-subtitle">{{ setting('home_blog_badge', 'LATEST INSIGHTS') }}</span>
                    <span class="f-white-badge-divider"></span>
                    <span class="f-white-badge-tag"><i class="fas fa-bolt"></i> TECH & INNOVATION</span>
                </div>
                <h2 class="f-blog-section-title">
                    {!! setting('home_blog_title', 'Stay Ahead With Our <span class="f-white-gradient-text">Tech Insights</span>') !!}
                </h2>
                <p class="f-blog-section-desc">
                    {{ setting('home_blog_subtitle', 'Explore expert perspectives, technical deep-dives, and digital transformation guides from our certified specialists.') }}
                </p>
            </div>

            <!-- Right: View All Articles Button -->
            <div class="f-blog-header-right">
                <a href="{{ setting('home_blog_button_url', route('blog')) }}" class="f-blog-view-all-btn">
                    <span>{{ setting('home_blog_button_text', 'View All Articles') }}</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Continuous Scroller for Blog / Insights (Instant hover freeze, smooth loop) -->
        @if($latestBlogs->count() > 0)
        <div class="futuristic-scroller-viewport" id="blogScroller" data-aos="fade-up" data-aos-delay="100">
            <div class="futuristic-scroller-track">
                @php
                    $slideBlogs = $latestBlogs;
                    if ($slideBlogs->count() > 0 && $slideBlogs->count() < 8) {
                        $slideBlogs = $slideBlogs->concat($latestBlogs)->concat($latestBlogs);
                    }
                @endphp
                @foreach($slideBlogs as $index => $post)
                @php
                    // Smart dynamic icon detection if image is not uploaded
                    $catName = strtolower($post->category ? $post->category->name : '');
                    $postTitle = strtolower($post->title);

                    if (str_contains($catName, 'cyber') || str_contains($catName, 'security') || str_contains($postTitle, 'security') || str_contains($postTitle, 'accreditation') || str_contains($postTitle, 'quality')) {
                        $postIcon = 'fas fa-shield-halved';
                    } elseif (str_contains($catName, 'cloud') || str_contains($postTitle, 'cloud') || str_contains($postTitle, 'aws') || str_contains($postTitle, 'azure') || str_contains($postTitle, 'gcp')) {
                        $postIcon = 'fas fa-cloud';
                    } elseif (str_contains($catName, 'ai') || str_contains($catName, 'artificial') || str_contains($postTitle, 'ai') || str_contains($postTitle, 'intelligence')) {
                        $postIcon = 'fas fa-brain';
                    } elseif (str_contains($catName, 'school') || str_contains($catName, 'student') || str_contains($postTitle, 'school') || str_contains($postTitle, 'student') || str_contains($postTitle, 'education')) {
                        $postIcon = 'fas fa-graduation-cap';
                    } elseif (str_contains($catName, 'app') || str_contains($catName, 'mobile')) {
                        $postIcon = 'fas fa-mobile-screen-button';
                    } elseif (str_contains($catName, 'tech') || str_contains($postTitle, 'tech')) {
                        $postIcon = 'fas fa-microchip';
                    } else {
                        $postIcon = 'fas fa-newspaper';
                    }
                @endphp
                <div class="futuristic-scroller-item">
                    <div class="f-blog-card" onclick="location.href='{{ route('blog.show', $post->slug) }}'">
                        <!-- Top Preview Bay (Image OR 3D Icon Bay) -->
                        <div class="f-blog-preview-bay">
                            <div class="f-blog-circuit-pattern"></div>
                            <div class="f-blog-corner f-blog-corner-tl"></div>
                            <div class="f-blog-corner f-blog-corner-tr"></div>
                            <div class="f-blog-corner f-blog-corner-bl"></div>
                            <div class="f-blog-corner f-blog-corner-br"></div>

                            @if($post->category)
                            <div class="f-blog-cat-badge">
                                <span class="f-blog-cat-dot"></span>
                                <span>{{ $post->category->name }}</span>
                            </div>
                            @endif

                            <div class="f-blog-time-badge">
                                <i class="far fa-clock"></i> {{ $post->reading_time ?? 5 }} min read
                            </div>

                            @if($post->featured_image)
                            <div class="f-blog-img-wrap">
                                <img src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}" class="f-blog-img">
                            </div>
                            @else
                            <div class="f-blog-icon-bay">
                                <i class="{{ $postIcon }}"></i>
                            </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="f-blog-body">
                            <div>
                                <h3 class="f-blog-title">{{ $post->title }}</h3>
                                <p class="f-blog-excerpt">
                                    {{ Str::limit($post->excerpt, 110) }}
                                </p>
                            </div>

                            <div class="f-blog-footer">
                                <span class="f-blog-date">
                                    <i class="fas fa-calendar-alt" style="color:#0284c7"></i> {{ $post->published_at?->format('M d, Y') ?? date('M d, Y') }}
                                </span>
                                <a href="{{ route('blog.show', $post->slug) }}" class="f-blog-action-btn" onclick="event.stopPropagation()">
                                    <span>Read Article</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div style="text-align:center;padding:40px 20px;background:#ffffff;border-radius:16px;border:1px dashed #cbd5e1;margin-top:20px;">
            <p style="color:#64748b;font-size:15px;margin-bottom:12px;">No featured articles currently selected.</p>
            <a href="{{ route('blog') }}" class="f-blog-view-all-btn" style="display:inline-flex;">View All Articles &rarr;</a>
        </div>
        @endif
    </div>
</section>

<!-- =============== CTA =============== -->
<section class="cta-section" data-aos="fade-up">
    <div style="position:absolute;inset:0;overflow:hidden">
        <div style="position:absolute;top:-50%;left:-20%;width:600px;height:600px;background:rgba(255,255,255,0.03);border-radius:50%"></div>
        <div style="position:absolute;bottom:-30%;right:-10%;width:400px;height:400px;background:rgba(255,255,255,0.03);border-radius:50%"></div>
    </div>
    <div class="container" style="position:relative;z-index:1">
        <div data-aos="zoom-in">
            <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:20px">
                {{ setting('home_cta_badge', 'Start Your Project Today') }}
            </div>
            <h2>{!! setting('home_cta_title', 'Ready to Transform Your <br>Business with Technology?') !!}</h2>
            <p>{{ setting('home_cta_body', 'Get a free consultation with our experts. No obligations, no commitments — just great advice tailored to your needs.') }}</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
                <a href="{{ setting('home_cta_btn1_url', route('contact')) }}" class="btn" style="background:white;color:var(--primary);padding:16px 36px;font-size:15px;box-shadow:0 8px 30px rgba(0,0,0,0.2)">
                    <i class="fas fa-comments"></i> {{ setting('home_cta_btn1_text', 'Demo') }}
                </a>
                <a href="{{ setting('home_cta_btn2_url', route('portfolio')) }}" class="btn btn-outline-white" style="padding:16px 36px;font-size:15px">
                    <i class="fas fa-eye"></i> {{ setting('home_cta_btn2_text', 'View Our Work') }}
                </a>
            </div>
            <p style="margin-top:20px;font-size:13px;color:rgba(255,255,255,0.6)">
                <i class="fas fa-phone"></i> {{ setting('home_cta_phone_line', 'Or call us:') }} <a href="tel:{{ setting('contact_phone') }}" style="color:white;font-weight:700">{{ setting('contact_phone') }}</a>
            </p>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
// Hero Swiper
const contentSwiper = new Swiper('.hero-content-swiper', {
    loop: true,
    speed: 1000,
    effect: 'fade',
    fadeEffect: { crossFade: true },
    slidesPerView: 1,
    slidesPerGroup: 1,
    centeredSlides: false,
    autoHeight: false,
    watchSlidesProgress: true
});

const heroSwiper = new Swiper('.hero-swiper', {
    loop: true,
    speed: 1000,
    autoplay: { delay: 6000 },
    effect: 'fade',
    fadeEffect: { crossFade: true },
    slidesPerView: 1,
    slidesPerGroup: 1,
    centeredSlides: false,
    observer: true,
    observeParents: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: { el: '.hero-pagination', clickable: true }
});

heroSwiper.controller.control = contentSwiper;
contentSwiper.controller.control = heroSwiper;

const heroImage = document.getElementById('heroImage');
const heroLightbox = document.getElementById('heroLightbox');
const heroLightboxImg = document.getElementById('heroLightboxImg');
const openHeroImage = () => {
    if (!heroImage || !heroImage.src || !heroLightbox || !heroLightboxImg) return;
    heroLightboxImg.src = heroImage.src;
    heroLightbox.classList.add('open');
};
const closeHeroImage = (event) => {
    if (!heroLightbox) return;
    if (event && event.target && event.target !== heroLightbox) return;
    heroLightbox.classList.remove('open');
};
const updateHeroImage = () => {
    if (!heroImage) return;
    const activeSlide = document.querySelector('.hero-content-swiper .swiper-slide-active');
    const img = activeSlide ? activeSlide.getAttribute('data-hero-image') : null;
    if (img) heroImage.src = img;
};
contentSwiper.on('slideChangeTransitionStart', updateHeroImage);
heroSwiper.on('slideChangeTransitionStart', updateHeroImage);
updateHeroImage();

// =========================================================================
// Ultra-Smooth Continuous Marquee Engine (Instant Freeze on Hover & Instant Resume)
// =========================================================================
function initContinuousMarquee(viewportId, prevBtnSelector, nextBtnSelector, baseSpeed = 0.85) {
    const viewport = document.getElementById(viewportId);
    if (!viewport) return;
    const track = viewport.querySelector('.futuristic-scroller-track');
    if (!track) return;

    let isPaused = false;
    let isDragging = false;
    let startX = 0;
    let startScrollLeft = 0;
    let hasDragged = false;
    let lastTime = performance.now();

    // Instant pause when mouse enters the viewport or any child card
    viewport.addEventListener('mouseenter', () => {
        isPaused = true;
    }, { passive: true });

    // Instant resume when mouse leaves the viewport
    viewport.addEventListener('mouseleave', () => {
        if (!isDragging) {
            isPaused = false;
        }
    }, { passive: true });

    // Touch support for mobile devices
    viewport.addEventListener('touchstart', () => {
        isPaused = true;
    }, { passive: true });

    viewport.addEventListener('touchend', () => {
        setTimeout(() => {
            if (!viewport.matches(':hover')) {
                isPaused = false;
            }
        }, 800);
    }, { passive: true });

    // Mouse drag support
    viewport.addEventListener('mousedown', (e) => {
        isDragging = true;
        hasDragged = false;
        isPaused = true;
        startX = e.pageX - viewport.offsetLeft;
        startScrollLeft = viewport.scrollLeft;
        viewport.style.cursor = 'grabbing';
    });

    window.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        const x = e.pageX - viewport.offsetLeft;
        const walk = (x - startX);
        if (Math.abs(walk) > 5) {
            hasDragged = true;
        }
        viewport.scrollLeft = startScrollLeft - walk;

        const halfWidth = track.scrollWidth / 2;
        if (halfWidth > 0) {
            if (viewport.scrollLeft >= halfWidth) {
                viewport.scrollLeft -= halfWidth;
                startScrollLeft -= halfWidth;
            } else if (viewport.scrollLeft <= 0) {
                viewport.scrollLeft += halfWidth;
                startScrollLeft += halfWidth;
            }
        }
    });

    window.addEventListener('mouseup', () => {
        if (isDragging) {
            isDragging = false;
            viewport.style.cursor = 'grab';
            if (!viewport.matches(':hover')) {
                isPaused = false;
            }
        }
    });

    // Prevent accidental navigation when user was dragging
    viewport.addEventListener('click', (e) => {
        if (hasDragged) {
            e.preventDefault();
            e.stopPropagation();
            hasDragged = false;
        }
    }, true);

    // Arrow controls (< >)
    const prevBtn = document.querySelector(prevBtnSelector);
    const nextBtn = document.querySelector(nextBtnSelector);

    if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            isPaused = true;
            viewport.scrollBy({ left: -380, behavior: 'smooth' });
            setTimeout(() => {
                if (!viewport.matches(':hover') && !isDragging) {
                    isPaused = false;
                }
            }, 650);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            isPaused = true;
            viewport.scrollBy({ left: 380, behavior: 'smooth' });
            setTimeout(() => {
                if (!viewport.matches(':hover') && !isDragging) {
                    isPaused = false;
                }
            }, 650);
        });
    }

    // High performance RAF ticker loop
    function step(currentTime) {
        const delta = Math.min((currentTime - lastTime) / 16.667, 2);
        lastTime = currentTime;

        if (!isPaused && !isDragging) {
            viewport.scrollLeft += baseSpeed * delta;
            const halfWidth = track.scrollWidth / 2;
            if (halfWidth > 0 && viewport.scrollLeft >= halfWidth) {
                viewport.scrollLeft -= halfWidth;
            } else if (viewport.scrollLeft <= 0) {
                viewport.scrollLeft += halfWidth;
            }
        }

        requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
}

// Initialize Continuous Marquee for Services, Products, and Blog
initContinuousMarquee('servicesScroller', '.fsc-prev', '.fsc-next', 0.85);
initContinuousMarquee('productsScroller', '.fpc-prev', '.fpc-next', 0.85);
initContinuousMarquee('blogScroller', '.f-blog-prev', '.f-blog-next', 0.85);

// Testimonials Swiper
new Swiper('.testimonials-swiper', {
    slidesPerView: 1,
    slidesPerGroup: 1,
    spaceBetween: 24,
    loop: true,
    autoplay: { delay: 5000 },
    observer: true,
    observeParents: true,
    pagination: { el: '.testimonials-pagination', clickable: true },
    breakpoints: {
        640: { slidesPerView: 2 },
        1024: { slidesPerView: 3 }
    }
});

// FAQ Toggle
function toggleFaq(btn) {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('i');
    const isOpen = content.style.maxHeight !== '0px' && content.style.maxHeight !== '';

    document.querySelectorAll('.faq-content').forEach(c => c.style.maxHeight = '0');
    document.querySelectorAll('.faq-icon').forEach(i => i.style.transform = '');

    if (!isOpen) {
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.style.transform = 'rotate(180deg)';
    }
}

// Animated Stat Counter
const statCounters = document.querySelectorAll('.f-stat-counter');
if (statCounters.length > 0) {
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-target'), 10) || 0;
                let current = 0;
                const duration = 1600;
                const stepTime = 20;
                const increment = Math.max(1, Math.ceil(target / (duration / stepTime)));
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        el.textContent = target;
                        clearInterval(timer);
                    } else {
                        el.textContent = current;
                    }
                }, stepTime);
                
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.2 });

    statCounters.forEach(c => observer.observe(c));
}
</script>
@endsection
