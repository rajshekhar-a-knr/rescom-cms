@extends('layouts.app')
@section('title', $project->meta_title ?? $project->title . ' - Products & Platforms | Rescom')
@section('meta_description', $project->meta_description ?? $project->short_description)

@section('content')
<!-- =============== ULTRA-PREMIUM PRODUCT SHOWCASE PAGE =============== -->
<div class="product-detail-page">
    <style>
        /* ===== HEADER CONTRAST FIX ===== */
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

        /* ===== GLOBAL PAGE WRAPPER ===== */
        .product-detail-page {
            background: #f8fafc;
            color: #0f172a;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Full Screen Width Fluid Container */
        .p-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 clamp(16px, 3.5vw, 64px);
            box-sizing: border-box;
            position: relative;
            z-index: 2;
        }
        @media (max-width: 640px) {
            .p-container {
                padding: 0 14px;
            }
        }

        /* ===== HERO SECTION ===== */
        .p-hero-section {
            position: relative;
            background: #050b18;
            padding-top: clamp(120px, 15vh, 185px);
            padding-bottom: clamp(60px, 8vh, 105px);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 1px solid rgba(56, 189, 248, 0.15);
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .has-topbar .p-hero-section {
            padding-top: clamp(140px, 18vh, 210px);
        }

        /* Ambient Glow & Grid Background */
        .p-hero-bg {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 15% 20%, rgba(37, 99, 235, 0.3) 0%, transparent 45%),
                radial-gradient(circle at 85% 25%, rgba(147, 51, 234, 0.25) 0%, transparent 45%),
                radial-gradient(circle at 50% 90%, rgba(6, 182, 212, 0.2) 0%, transparent 55%),
                linear-gradient(180deg, #070d1d 0%, #040711 100%);
            z-index: 1;
            pointer-events: none;
        }
        .p-hero-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(56, 189, 248, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.06) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
            z-index: 1;
            pointer-events: none;
        }

        /* Hero Cockpit Grid */
        .p-hero-cockpit {
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(0, 0.85fr);
            gap: clamp(24px, 3.5vw, 64px);
            align-items: center;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-hero-cockpit > div {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1024px) {
            .p-hero-cockpit {
                grid-template-columns: minmax(0, 1fr);
                gap: 32px;
            }
        }

        /* HUD Live Beacon Badge */
        .p-hud-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(56, 189, 248, 0.35);
            border-radius: 999px;
            padding: 6px 18px;
            margin-bottom: 20px;
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            max-width: 100%;
            flex-wrap: wrap;
            box-sizing: border-box;
        }
        @media (max-width: 576px) {
            .p-hud-badge {
                padding: 6px 12px;
                gap: 6px;
                border-radius: 12px;
                margin-bottom: 14px;
            }
            .p-badge-divider {
                display: none;
            }
        }
        .p-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 10px #10b981;
            animation: pRadarPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            flex-shrink: 0;
        }
        @keyframes pRadarPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.35); }
        }
        .p-badge-subtitle {
            font-size: 11.5px;
            font-weight: 800;
            color: #f8fafc;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }
        .p-badge-divider {
            width: 1px;
            height: 10px;
            background: rgba(255, 255, 255, 0.25);
        }
        .p-badge-tag {
            font-size: 11px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.4px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Hero Typography */
        .p-hero-title {
            font-size: clamp(24px, 3.8vw, 52px);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.03em;
            color: #ffffff;
            margin-bottom: 18px;
            text-shadow: none !important;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .p-hero-lead {
            font-size: clamp(14.5px, 1.15vw, 18px);
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 26px;
            font-weight: 400;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* Telemetry Pills Strip */
        .p-telemetry-strip {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 28px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-telemetry-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 7px 14px;
            border-radius: 10px;
            font-size: 12.5px;
            color: #e2e8f0;
            font-weight: 600;
            backdrop-filter: blur(8px);
            max-width: 100%;
            word-break: break-word;
            box-sizing: border-box;
        }
        .p-telemetry-pill i {
            color: #38bdf8;
            font-size: 12px;
            flex-shrink: 0;
        }

        /* Hero Action Buttons */
        .p-hero-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff !important;
            padding: 13px 24px;
            border-radius: 14px;
            font-size: 14.5px;
            font-weight: 750;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.45);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-sizing: border-box;
        }
        .p-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.6);
            color: #ffffff;
        }
        .p-btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: rgba(15, 23, 42, 0.85);
            border: 1.5px solid rgba(56, 189, 248, 0.4);
            color: #f8fafc !important;
            padding: 13px 22px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .p-btn-secondary:hover {
            background: rgba(30, 41, 59, 0.95);
            border-color: #38bdf8;
            color: #ffffff;
            transform: translateY(-2px);
        }
        .p-btn-secondary i {
            color: #38bdf8;
            flex-shrink: 0;
        }
        @media (max-width: 640px) {
            .p-hero-actions {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
            }
            .p-btn-primary, .p-btn-secondary {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
        }

        /* ===== HERO SPOTLIGHT CARD (RIGHT SIDE) ===== */
        .p-hero-spotlight {
            position: relative;
            background: rgba(15, 23, 42, 0.7);
            border: 1.5px solid rgba(56, 189, 248, 0.3);
            border-radius: 24px;
            padding: clamp(16px, 3vw, 24px);
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.15);
            transition: transform 0.4s ease, border-color 0.4s ease;
            width: 100%;
            box-sizing: border-box;
            max-width: 100%;
            overflow: hidden;
        }
        .p-hero-spotlight:hover {
            border-color: rgba(56, 189, 248, 0.55);
            transform: translateY(-4px);
        }
        .p-spotlight-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            box-sizing: border-box;
        }
        .p-window-dots {
            display: flex;
            gap: 6px;
        }
        .p-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        .p-dot-red { background: #ef4444; }
        .p-dot-yellow { background: #f59e0b; }
        .p-dot-green { background: #10b981; }

        .p-spotlight-badge {
            font-size: 11px;
            font-weight: 800;
            color: #38bdf8;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Spotlight Canvas */
        .p-spotlight-canvas {
            position: relative;
            background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f1f5f9 100%);
            border-radius: 18px;
            min-height: 180px;
            max-height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(16px, 3vw, 30px);
            overflow: hidden;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.06), 0 8px 24px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-sizing: border-box;
            width: 100%;
            max-width: 100%;
        }
        .p-spotlight-canvas::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.04) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
        }
        .p-spotlight-img {
            max-width: 90%;
            max-height: 180px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 24px rgba(0, 0, 0, 0.09));
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            z-index: 2;
        }
        .p-hero-spotlight:hover .p-spotlight-img {
            transform: scale(1.04);
        }
        .p-spotlight-fallback {
            font-size: 54px;
            color: #0284c7;
            position: relative;
            z-index: 2;
        }

        .p-spotlight-footer {
            margin-top: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11.5px;
            color: #94a3b8;
            font-weight: 600;
            flex-wrap: wrap;
            gap: 6px;
            width: 100%;
            box-sizing: border-box;
        }

        /* ===== FLOATING SPECS BAR ===== */
        .p-specs-section {
            margin-top: -36px;
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 768px) {
            .p-specs-section {
                margin-top: 20px;
            }
        }
        .p-specs-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1024px) {
            .p-specs-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 576px) {
            .p-specs-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }
        }
        .p-spec-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px 18px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.04);
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        .p-spec-card:hover {
            transform: translateY(-4px);
            border-color: #0284c7;
            box-shadow: 0 14px 30px rgba(14, 165, 233, 0.12);
        }
        .p-spec-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        .p-spec-card:hover .p-spec-icon-box {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
            transform: scale(1.06);
        }
        .p-spec-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #94a3b8;
            margin-bottom: 3px;
        }
        .p-spec-val {
            font-size: 14.5px;
            font-weight: 850;
            color: #0f172a;
            line-height: 1.3;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .p-spec-val a {
            color: #0284c7;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .p-spec-val a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        /* ===== MAIN BODY CONTENT & SIDEBAR ===== */
        .p-body-section {
            padding: 40px 0 80px 0;
            position: relative;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-main-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 380px;
            gap: clamp(24px, 3vw, 50px);
            align-items: start;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-main-layout > div {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1100px) {
            .p-main-layout {
                grid-template-columns: minmax(0, 1fr) 340px;
                gap: 28px;
            }
        }
        @media (max-width: 960px) {
            .p-main-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 32px;
            }
        }

        /* Main Content Stage Card */
        .p-content-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 22px;
            padding: clamp(18px, 3.5vw, 44px);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            margin-bottom: 32px;
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        @media (max-width: 640px) {
            .p-content-card {
                padding: 20px 14px;
                border-radius: 18px;
            }
        }

        .p-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 1.5px solid #f1f5f9;
            flex-wrap: wrap;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-card-header-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        .p-card-title {
            font-size: clamp(18px, 2.2vw, 22px);
            font-weight: 850;
            color: #0f172a;
            margin: 0;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* Rich Content Body */
        .p-rich-body {
            font-size: 16px;
            line-height: 1.85;
            color: #334155;
            word-break: break-word;
            overflow-wrap: anywhere;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-rich-body p {
            margin-bottom: 18px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .p-rich-body ul, .p-rich-body ol {
            margin: 0 0 20px 22px;
            padding: 0;
        }
        @media (max-width: 576px) {
            .p-rich-body ul, .p-rich-body ol {
                margin: 0 0 20px 16px;
            }
        }
        .p-rich-body li {
            margin-bottom: 8px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .p-rich-body img, .p-rich-body video, .p-rich-body iframe {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 12px;
            margin: 16px 0;
            box-sizing: border-box;
        }
        .p-rich-body table {
            display: block;
            width: 100% !important;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: 20px 0;
        }
        .p-rich-body pre, .p-rich-body code {
            max-width: 100%;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-all;
        }

        /* ===== CASE STUDY MATRIX (3 PODS) ===== */
        .p-casestudy-matrix {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin: 28px 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 900px) {
            .p-casestudy-matrix {
                grid-template-columns: minmax(0, 1fr);
                gap: 14px;
            }
        }
        .p-matrix-pod {
            border-radius: 18px;
            padding: 20px 18px;
            border: 1.5px solid;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        @media (max-width: 640px) {
            .p-matrix-pod {
                padding: 16px 14px;
                border-radius: 16px;
            }
        }
        .p-matrix-pod:hover {
            transform: translateY(-4px);
        }
        .p-pod-challenge {
            background: linear-gradient(145deg, #fff5f5 0%, #fffafa 100%);
            border-color: #fecaca;
        }
        .p-pod-solution {
            background: linear-gradient(145deg, #f0fdf4 0%, #f7fee7 100%);
            border-color: #bbf7d0;
        }
        .p-pod-results {
            background: linear-gradient(145deg, #f0f9ff 0%, #e0f2fe 100%);
            border-color: #bae6fd;
        }
        .p-pod-title-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15.5px;
            font-weight: 850;
            margin-bottom: 12px;
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-pod-challenge .p-pod-title-bar { color: #b91c1c; }
        .p-pod-solution .p-pod-title-bar { color: #15803d; }
        .p-pod-results .p-pod-title-bar { color: #0369a1; }
        .p-pod-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        .p-pod-challenge .p-pod-icon { background: #fee2e2; color: #dc2626; }
        .p-pod-solution .p-pod-icon { background: #dcfce7; color: #16a34a; }
        .p-pod-results .p-pod-icon { background: #e0f2fe; color: #0284c7; }
        .p-pod-text {
            font-size: 14px;
            line-height: 1.75;
            color: #334155;
            margin: 0;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* ===== ARCHITECTURE STACK CHIPS ===== */
        .p-tech-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-tech-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            color: #0f172a;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 700;
            transition: all 0.25s ease;
            max-width: 100%;
            word-break: break-word;
            box-sizing: border-box;
        }
        .p-tech-pill:hover {
            border-color: #0284c7;
            background: #0284c7;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.25);
        }
        .p-tech-pill:hover i {
            color: #ffffff !important;
        }

        /* ===== PLATFORM SCREENSHOTS & GALLERY ===== */
        .p-gallery-container {
            margin-top: 32px;
            padding-top: 28px;
            border-top: 1.5px dashed #e2e8f0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-gallery-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 576px) {
            .p-gallery-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }
        }
        .p-gallery-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .p-gallery-card:hover {
            transform: translateY(-5px);
            border-color: #0284c7;
            box-shadow: 0 16px 36px rgba(14, 165, 233, 0.16);
        }
        .p-gallery-thumb-bay {
            position: relative;
            height: 180px;
            background: #f8fafc;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            box-sizing: border-box;
        }
        .p-gallery-thumb-bay img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .p-gallery-card:hover .p-gallery-thumb-bay img {
            transform: scale(1.08);
        }
        .p-gallery-hover-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            opacity: 0;
            backdrop-filter: blur(3px);
            transition: opacity 0.3s ease;
        }
        .p-gallery-card:hover .p-gallery-hover-overlay {
            opacity: 1;
        }
        .p-gallery-zoom-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #0284c7;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.4);
            transform: scale(0.85);
            transition: transform 0.3s ease;
        }
        .p-gallery-card:hover .p-gallery-zoom-icon {
            transform: scale(1);
        }
        .p-gallery-card-foot {
            padding: 12px 16px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f1f5f9;
            width: 100%;
            box-sizing: border-box;
        }
        .p-gallery-card-num {
            font-size: 11.5px;
            font-weight: 800;
            color: #0284c7;
            background: #e0f2fe;
            padding: 2px 8px;
            border-radius: 6px;
            flex-shrink: 0;
        }
        .p-gallery-card-label {
            font-size: 13.5px;
            font-weight: 750;
            color: #1e293b;
        }

        /* ===== SIDEBAR STYLING ===== */
        .p-sidebar-sticky {
            position: sticky;
            top: 110px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }
        @media (max-width: 1024px) {
            .p-sidebar-sticky {
                position: static;
            }
        }
        .p-sidebar-cta {
            position: relative;
            background: linear-gradient(135deg, #070d1d 0%, #0c1a30 100%);
            border: 1.5px solid rgba(56, 189, 248, 0.3);
            border-radius: 22px;
            padding: clamp(20px, 3.5vw, 32px) clamp(16px, 3vw, 26px);
            color: #ffffff;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(7, 13, 29, 0.35);
            box-sizing: border-box;
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }
        @media (max-width: 640px) {
            .p-sidebar-cta {
                padding: 22px 16px;
                border-radius: 18px;
            }
        }
        .p-sidebar-cta-glow {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            background: rgba(14, 165, 233, 0.35);
            border-radius: 50%;
            filter: blur(45px);
            pointer-events: none;
        }
        .p-sidebar-cta-title {
            font-size: 21px;
            font-weight: 850;
            margin-bottom: 8px;
            color: #ffffff;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .p-sidebar-cta-desc {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 24px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .p-sidebar-trust-list {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            font-size: 12.5px;
            color: #94a3b8;
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
            box-sizing: border-box;
        }
        .p-sidebar-trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            word-break: break-word;
        }
        .p-sidebar-trust-item i {
            color: #10b981;
            font-size: 12px;
            flex-shrink: 0;
        }

        /* Related Products Card */
        .p-related-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 22px;
            padding: clamp(16px, 3vw, 24px);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);
            width: 100%;
            max-width: 100%;
            min-width: 0;
            box-sizing: border-box;
            overflow: hidden;
        }
        @media (max-width: 640px) {
            .p-related-card {
                padding: 20px 14px;
                border-radius: 18px;
            }
        }
        .p-related-title {
            font-size: 16.5px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .p-related-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .p-related-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            border-radius: 14px;
            text-decoration: none;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        .p-related-item:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            transform: translateX(4px);
        }
        .p-related-thumb {
            width: 46px;
            height: 40px;
            border-radius: 9px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .p-related-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
            flex: 1;
        }
        .p-related-name {
            font-size: 14px;
            font-weight: 750;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .p-related-cat {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ===== LIGHTBOX MODAL ===== */
        .p-lightbox-modal {
            position: fixed;
            inset: 0;
            z-index: 999999;
            background: rgba(4, 8, 20, 0.94);
            backdrop-filter: blur(14px);
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 16px;
            box-sizing: border-box;
        }
        .p-lightbox-modal.active {
            display: flex;
            opacity: 1;
        }
        .p-lightbox-content {
            position: relative;
            max-width: 92vw;
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }
        .p-lightbox-img-wrap {
            max-width: 100%;
            max-height: 78vh;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.15);
            background: #0b1329;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .p-lightbox-img {
            max-width: 100%;
            max-height: 78vh;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }
        .p-lightbox-footer {
            margin-top: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            color: #ffffff;
            flex-wrap: wrap;
            gap: 8px;
            box-sizing: border-box;
        }
        .p-lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
        }
        .p-lightbox-close:hover {
            background: #ef4444;
            border-color: #ef4444;
            transform: rotate(90deg);
        }
        .p-lightbox-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.85);
            border: 1.5px solid rgba(56, 189, 248, 0.4);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            z-index: 10;
        }
        .p-lightbox-nav-btn:hover {
            background: #0284c7;
            border-color: #38bdf8;
            transform: translateY(-50%) scale(1.1);
        }
        .p-lightbox-prev { left: 16px; }
        .p-lightbox-next { right: 16px; }
        @media (max-width: 768px) {
            .p-lightbox-nav-btn { width: 38px; height: 38px; font-size: 15px; }
            .p-lightbox-prev { left: 8px; }
            .p-lightbox-next { right: 8px; }
            .p-lightbox-close { top: 12px; right: 12px; width: 36px; height: 36px; font-size: 15px; }
        }
    </style>

    <!-- =============== HERO SECTION =============== -->
    <section class="p-hero-section">
        <div class="p-hero-bg"></div>
        <div class="p-hero-grid"></div>

        <div class="p-container">
            <!-- Hero Cockpit -->
            <div class="p-hero-cockpit">
                <!-- Left Narrative -->
                <div>
                    <!-- Category & Status Badge -->
                    <div class="p-hud-badge">
                        <span class="p-radar-dot"></span>
                        <span class="p-badge-subtitle">{{ $project->category?->name ?? 'ENTERPRISE PLATFORM' }}</span>
                        <span class="p-badge-divider"></span>
                        <span class="p-badge-tag"><i class="fas fa-bolt"></i> PRODUCTION DEPLOYED</span>
                    </div>

                    <!-- Title -->
                    <h1 class="p-hero-title">
                        {{ $project->title }}
                    </h1>

                    <!-- Subtitle -->
                    <p class="p-hero-lead">
                        {{ $project->short_description }}
                    </p>

                    <!-- Telemetry Pills -->
                    <div class="p-telemetry-strip">
                        @if($project->client_name)
                        <div class="p-telemetry-pill">
                            <i class="fas fa-building"></i> Client: {{ $project->client_name }}
                        </div>
                        @endif
                        @if($project->completion_date)
                        <div class="p-telemetry-pill">
                            <i class="fas fa-calendar-check"></i> Launched: {{ $project->completion_date->format('M Y') }}
                        </div>
                        @endif
                        <div class="p-telemetry-pill">
                            <i class="fas fa-cloud"></i> Cloud Native
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="p-hero-actions">
                        <a href="{{ route('contact') }}?product={{ urlencode($project->slug) }}" class="p-btn-primary">
                            <i class="fas fa-key"></i>
                            <span>Request Product Demo</span>
                        </a>
                        <a href="{{ route('presentation.show', $project->slug) }}" target="_blank" class="p-btn-secondary">
                            <i class="fas fa-desktop"></i>
                            <span>Interactive Presentation</span>
                        </a>
                        @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="p-btn-secondary">
                            <i class="fas fa-external-link-alt"></i>
                            <span>Live Platform</span>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Right Spotlight Showcase -->
                <div>
                    <div class="p-hero-spotlight">
                        <div class="p-spotlight-topbar">
                            <div class="p-window-dots">
                                <span class="p-dot p-dot-red"></span>
                                <span class="p-dot p-dot-yellow"></span>
                                <span class="p-dot p-dot-green"></span>
                            </div>
                            <span class="p-spotlight-badge">
                                <i class="fas fa-certificate"></i> Verified System Brand
                            </span>
                        </div>

                        <div class="p-spotlight-canvas">
                            @if($project->featured_image)
                            <img src="{{ media_url($project->featured_image) }}" alt="{{ $project->title }}" class="p-spotlight-img">
                            @else
                            <div class="p-spotlight-fallback">
                                <i class="fas fa-cubes"></i>
                            </div>
                            @endif
                        </div>

                        <div class="p-spotlight-footer">
                            <span><i class="fas fa-check-circle" style="color:#10b981;margin-right:4px"></i> Enterprise Ready</span>
                            <span>Scalable Architecture</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== FLOATING SPECS BAR =============== -->
    <section class="p-specs-section">
        <div class="p-container">
            <div class="p-specs-grid">
                <div class="p-spec-card">
                    <div class="p-spec-icon-box"><i class="fas fa-building"></i></div>
                    <div>
                        <div class="p-spec-label">Client / Partner</div>
                        <div class="p-spec-val">{{ $project->client_name ?? 'Enterprise Solution' }}</div>
                    </div>
                </div>

                <div class="p-spec-card">
                    <div class="p-spec-icon-box"><i class="fas fa-calendar-alt"></i></div>
                    <div>
                        <div class="p-spec-label">Release Date</div>
                        <div class="p-spec-val">{{ $project->completion_date ? $project->completion_date->format('M Y') : 'Active Product' }}</div>
                    </div>
                </div>

                <div class="p-spec-card">
                    <div class="p-spec-icon-box"><i class="fas fa-tags"></i></div>
                    <div>
                        <div class="p-spec-label">Product Sector</div>
                        <div class="p-spec-val">{{ $project->category?->name ?? 'Software Platform' }}</div>
                    </div>
                </div>

                <div class="p-spec-card">
                    <div class="p-spec-icon-box"><i class="fas fa-link"></i></div>
                    <div>
                        <div class="p-spec-label">Platform Access</div>
                        <div class="p-spec-val">
                            @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer">
                                <span>Open Platform</span>
                                <i class="fas fa-external-link-alt" style="font-size:11px"></i>
                            </a>
                            @else
                            <span style="color:#0284c7;font-weight:800">Private Instance</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== MAIN CONTENT & SIDEBAR =============== -->
    <section class="p-body-section">
        <div class="p-container">
            <div class="p-main-layout">
                <!-- Left Main Content Column -->
                <div>
                    <!-- Executive Overview Card -->
                    <div class="p-content-card">
                        <div class="p-card-header">
                            <div class="p-card-header-icon"><i class="fas fa-file-alt"></i></div>
                            <h2 class="p-card-title">Executive Platform Overview</h2>
                        </div>

                        @if($project->description)
                        <div class="p-rich-body">
                            {!! $project->description !!}
                        </div>
                        @else
                        <div class="p-rich-body">
                            <p>{{ $project->short_description }}</p>
                        </div>
                        @endif

                        <!-- Case Study Pods (Challenge, Solution, Results) -->
                        @if($project->challenge || $project->solution || $project->results)
                        <div class="p-casestudy-matrix">
                            @if($project->challenge)
                            <div class="p-matrix-pod p-pod-challenge">
                                <div class="p-pod-title-bar">
                                    <div class="p-pod-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                    <span>The Challenge</span>
                                </div>
                                <p class="p-pod-text">{{ $project->challenge }}</p>
                            </div>
                            @endif

                            @if($project->solution)
                            <div class="p-matrix-pod p-pod-solution">
                                <div class="p-pod-title-bar">
                                    <div class="p-pod-icon"><i class="fas fa-lightbulb"></i></div>
                                    <span>The Solution</span>
                                </div>
                                <p class="p-pod-text">{{ $project->solution }}</p>
                            </div>
                            @endif

                            @if($project->results)
                            <div class="p-matrix-pod p-pod-results">
                                <div class="p-pod-title-bar">
                                    <div class="p-pod-icon"><i class="fas fa-chart-line"></i></div>
                                    <span>Impact & Results</span>
                                </div>
                                <p class="p-pod-text">{{ $project->results }}</p>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Architecture & Features Matrix -->
                        @php
                            $projectTechnologies = is_array($project->technologies) 
                                ? $project->technologies 
                                : ((is_string($project->technologies) && $project->technologies !== '') 
                                    ? (json_decode($project->technologies, true) ?: array_map('trim', explode(',', $project->technologies))) 
                                    : []);
                        @endphp

                        @if(!empty($projectTechnologies))
                        <div style="margin-top:32px">
                            <h3 style="font-size:18px;font-weight:800;color:#0f172a;margin-bottom:14px;display:flex;align-items:center;gap:8px">
                                <i class="fas fa-layer-group" style="color:#0284c7"></i> Architecture Stack & Core Features
                            </h3>
                            <div class="p-tech-grid">
                                @foreach($projectTechnologies as $tech)
                                <div class="p-tech-pill">
                                    <i class="fas fa-check-circle" style="color:#0284c7"></i>
                                    <span>{{ $tech }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Platform Screenshots & Visual Gallery -->
                        @php
                            $projectGallery = is_array($project->gallery) 
                                ? $project->gallery 
                                : ((is_string($project->gallery) && $project->gallery !== '') 
                                    ? (json_decode($project->gallery, true) ?: []) 
                                    : []);
                        @endphp

                        @if(!empty($projectGallery))
                        <div class="p-gallery-container">
                            <div class="p-gallery-header">
                                <div>
                                    <div style="font-size:12px;font-weight:800;letter-spacing:0.8px;color:#0284c7;text-transform:uppercase;margin-bottom:3px">
                                        <i class="fas fa-camera-retro"></i> Visual Walkthrough
                                    </div>
                                    <h3 style="font-size:20px;font-weight:850;color:#0f172a;margin:0">
                                        Platform Interface & Screenshots
                                    </h3>
                                </div>
                                <span style="display:inline-flex;align-items:center;gap:6px;background:#e0f2fe;color:#0369a1;padding:6px 14px;border-radius:999px;font-size:12px;font-weight:750">
                                    <i class="fas fa-expand-arrows-alt"></i> Click to Zoom ({{ count($projectGallery) }} screens)
                                </span>
                            </div>

                            <div class="p-gallery-grid">
                                @foreach($projectGallery as $gIdx => $gImage)
                                <div class="p-gallery-card" onclick="openPortfolioLightbox({{ $gIdx }})" title="Click to view full screen">
                                    <div class="p-gallery-thumb-bay">
                                        <img src="{{ media_url($gImage) }}" alt="{{ $project->title }} screenshot {{ $gIdx + 1 }}" loading="lazy">
                                        <div class="p-gallery-hover-overlay">
                                            <div class="p-gallery-zoom-icon">
                                                <i class="fas fa-search-plus"></i>
                                            </div>
                                            <span style="color:#ffffff;font-size:11.5px;font-weight:700;text-transform:uppercase">View Fullscreen</span>
                                        </div>
                                    </div>
                                    <div class="p-gallery-card-foot">
                                        <span class="p-gallery-card-num">#{{ sprintf('%02d', $gIdx + 1) }}</span>
                                        <span class="p-gallery-card-label">Screen {{ $gIdx + 1 }}</span>
                                        <i class="fas fa-expand" style="margin-left:auto;color:#94a3b8;font-size:11px"></i>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right Mission Control Sidebar -->
                <div>
                    <div class="p-sidebar-sticky">
                        <!-- CTA Card -->
                        <div class="p-sidebar-cta">
                            <div class="p-sidebar-cta-glow"></div>
                            <div style="position:relative;z-index:2">
                                <h3 class="p-sidebar-cta-title">Need a Similar Platform?</h3>
                                <p class="p-sidebar-cta-desc">
                                    We design, engineer, and deploy mission-critical software solutions tailored to your organization's exact workflows.
                                </p>
                                <a href="{{ route('contact') }}?product={{ urlencode($project->slug) }}" class="p-btn-primary" style="width:100%;justify-content:center;margin-bottom:12px">
                                    <i class="fas fa-key"></i>
                                    <span>Request Live Demo</span>
                                </a>
                                <a href="{{ route('presentation.show', $project->slug) }}" target="_blank" class="p-btn-secondary" style="width:100%;justify-content:center;margin-bottom:12px">
                                    <i class="fas fa-desktop"></i>
                                    <span>Interactive Presentation</span>
                                </a>
                                <a href="{{ route('portfolio') }}" class="p-btn-secondary" style="width:100%;justify-content:center;background:rgba(255,255,255,0.06);border-color:rgba(255,255,255,0.15)">
                                    <i class="fas fa-th-large"></i>
                                    <span>Browse All Platforms</span>
                                </a>

                                <div class="p-sidebar-trust-list">
                                    <div class="p-sidebar-trust-item"><i class="fas fa-check-circle"></i> Custom Architecture Design</div>
                                    <div class="p-sidebar-trust-item"><i class="fas fa-check-circle"></i> Enterprise Grade Security</div>
                                    <div class="p-sidebar-trust-item"><i class="fas fa-check-circle"></i> Rapid Production Deployment</div>
                                </div>
                            </div>
                        </div>

                        <!-- Related Platforms -->
                        @if($related->count())
                        <div class="p-related-card">
                            <h4 class="p-related-title">
                                <i class="fas fa-network-wired" style="color:#0284c7"></i> Related Platforms
                            </h4>
                            <div class="p-related-list">
                                @foreach($related as $rel)
                                <a href="{{ route('portfolio.show', $rel->slug) }}" class="p-related-item">
                                    @if($rel->featured_image)
                                    <img src="{{ media_url($rel->featured_image) }}" alt="{{ $rel->title }}" class="p-related-thumb">
                                    @else
                                    <div class="p-related-thumb" style="display:flex;align-items:center;justify-content:center;background:#e0f2fe;color:#0284c7">
                                        <i class="fas fa-cubes"></i>
                                    </div>
                                    @endif
                                    <div class="p-related-info">
                                        <span class="p-related-name">{{ $rel->title }}</span>
                                        <span class="p-related-cat">{{ $rel->category?->name ?? 'Platform' }}</span>
                                    </div>
                                    <i class="fas fa-arrow-right" style="margin-left:auto;color:#94a3b8;font-size:11px"></i>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== CLOSING CTA SECTION =============== -->
    <section class="cta-section" style="width:100%">
        <div class="p-container" style="position:relative;z-index:1;text-align:center">
            <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:20px">
                {{ setting('home_cta_badge', 'Start Your Project Today') }}
            </div>
            <h2>Have An Idea Like {{ $project->title }}?</h2>
            <p>Talk with our engineering specialists to design and launch your next high-impact platform.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
                <a href="{{ route('contact') }}?product={{ urlencode($project->slug) }}" class="btn" style="background:white;color:var(--primary);padding:16px 36px;font-size:15px;box-shadow:0 8px 30px rgba(0,0,0,0.2)">
                    <i class="fas fa-comments"></i> Request Product Demo
                </a>
                <a href="{{ route('portfolio') }}" class="btn btn-outline-white" style="padding:16px 36px;font-size:15px">
                    <i class="fas fa-eye"></i> Explore Portfolio
                </a>
            </div>
        </div>
    </section>

    <!-- =============== INTERACTIVE LIGHTBOX MODAL =============== -->
    @if(!empty($projectGallery))
    <div id="portfolioLightboxModal" class="p-lightbox-modal" onclick="handleLightboxBackdropClick(event)">
        <div class="p-lightbox-close" onclick="closePortfolioLightbox()" title="Close (Esc)">
            <i class="fas fa-times"></i>
        </div>
        <div class="p-lightbox-nav-btn p-lightbox-prev" onclick="prevPortfolioLightbox(event)" title="Previous (Left Arrow)">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="p-lightbox-nav-btn p-lightbox-next" onclick="nextPortfolioLightbox(event)" title="Next (Right Arrow)">
            <i class="fas fa-chevron-right"></i>
        </div>

        <div class="p-lightbox-content">
            <div class="p-lightbox-img-wrap">
                <img id="portfolioLightboxImg" src="" alt="Screenshot Full View" class="p-lightbox-img">
            </div>
            <div class="p-lightbox-footer">
                <div style="font-size:13.5px;font-weight:700;color:#94a3b8">
                    Screenshot <span id="portfolioLightboxCurrent" style="color:#38bdf8;font-weight:800">1</span> of <span id="portfolioLightboxTotal">{{ count($projectGallery) }}</span>
                </div>
                <div style="font-size:12px;color:#94a3b8;font-weight:600">
                    <i class="fas fa-keyboard"></i> Use arrow keys to navigate &bull; Esc to exit
                </div>
            </div>
        </div>
    </div>

    <script>
        const portfolioGalleryItems = @json(array_map(fn($img) => media_url($img), $projectGallery));
        let currentLightboxIndex = 0;

        function openPortfolioLightbox(index) {
            if (!portfolioGalleryItems || !portfolioGalleryItems.length) return;
            currentLightboxIndex = (index >= 0 && index < portfolioGalleryItems.length) ? index : 0;
            updateLightboxDisplay();
            const modal = document.getElementById('portfolioLightboxModal');
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closePortfolioLightbox() {
            const modal = document.getElementById('portfolioLightboxModal');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        function updateLightboxDisplay() {
            const img = document.getElementById('portfolioLightboxImg');
            const currentCounter = document.getElementById('portfolioLightboxCurrent');
            if (img && portfolioGalleryItems[currentLightboxIndex]) {
                img.src = portfolioGalleryItems[currentLightboxIndex];
            }
            if (currentCounter) {
                currentCounter.textContent = currentLightboxIndex + 1;
            }
        }

        function prevPortfolioLightbox(e) {
            if (e) e.stopPropagation();
            currentLightboxIndex = (currentLightboxIndex - 1 + portfolioGalleryItems.length) % portfolioGalleryItems.length;
            updateLightboxDisplay();
        }

        function nextPortfolioLightbox(e) {
            if (e) e.stopPropagation();
            currentLightboxIndex = (currentLightboxIndex + 1) % portfolioGalleryItems.length;
            updateLightboxDisplay();
        }

        function handleLightboxBackdropClick(e) {
            if (e.target.id === 'portfolioLightboxModal' || e.target.classList.contains('p-lightbox-content')) {
                closePortfolioLightbox();
            }
        }

        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('portfolioLightboxModal');
            if (!modal || !modal.classList.contains('active')) return;
            if (e.key === 'Escape') closePortfolioLightbox();
            if (e.key === 'ArrowLeft') prevPortfolioLightbox(null);
            if (e.key === 'ArrowRight') nextPortfolioLightbox(null);
        });
    </script>
    @endif
</div>
@endsection
