@extends('layouts.app')
@section('title', $service->meta_title ?? $service->title . ' - Enterprise Services | Rescom')
@section('meta_description', $service->meta_description ?? $service->short_description)

@section('content')
<!-- =============== ULTRA-PREMIUM SERVICE DETAIL PAGE =============== -->
<div class="service-detail-page">
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
        .service-detail-page {
            background: #f8fafc;
            color: #0f172a;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Full Screen Width Fluid Container */
        .s-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 clamp(16px, 3.5vw, 64px);
            box-sizing: border-box;
            position: relative;
            z-index: 2;
        }
        @media (max-width: 640px) {
            .s-container {
                padding: 0 14px;
            }
        }

        /* ===== HERO SECTION ===== */
        .s-hero-section {
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
        .has-topbar .s-hero-section {
            padding-top: clamp(140px, 18vh, 210px);
        }

        /* Ambient Glow & Grid Background */
        .s-hero-bg {
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
        .s-hero-grid {
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
        .s-hero-cockpit {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(0, 0.7fr);
            gap: clamp(24px, 3.5vw, 64px);
            align-items: center;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .s-hero-cockpit > div {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1024px) {
            .s-hero-cockpit {
                grid-template-columns: minmax(0, 1fr);
                gap: 32px;
            }
        }

        /* HUD Live Beacon Badge */
        .s-hud-badge {
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
            .s-hud-badge {
                padding: 6px 12px;
                gap: 6px;
                border-radius: 12px;
                margin-bottom: 14px;
            }
            .s-badge-divider {
                display: none;
            }
        }
        .s-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 10px #10b981;
            animation: sRadarPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            flex-shrink: 0;
        }
        @keyframes sRadarPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.35); }
        }
        .s-badge-subtitle {
            font-size: 11.5px;
            font-weight: 800;
            color: #f8fafc;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }
        .s-badge-divider {
            width: 1px;
            height: 10px;
            background: rgba(255, 255, 255, 0.25);
        }
        .s-badge-tag {
            font-size: 11px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.4px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Hero Typography */
        .s-hero-title {
            font-size: clamp(24px, 3.8vw, 52px);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.03em;
            color: #ffffff;
            margin-bottom: 18px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .s-hero-lead {
            font-size: clamp(14.5px, 1.15vw, 18px);
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 26px;
            font-weight: 400;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* Telemetry Pills Strip */
        .s-telemetry-strip {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 28px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .s-telemetry-pill {
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
        .s-telemetry-pill i {
            color: #38bdf8;
            font-size: 12px;
            flex-shrink: 0;
        }

        /* Hero Action Buttons */
        .s-hero-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .s-btn-primary {
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
        .s-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.6);
            color: #ffffff;
        }
        .s-btn-secondary {
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
        .s-btn-secondary:hover {
            background: rgba(30, 41, 59, 0.95);
            border-color: #38bdf8;
            color: #ffffff;
            transform: translateY(-2px);
        }
        .s-btn-secondary i {
            color: #38bdf8;
            flex-shrink: 0;
        }
        @media (max-width: 640px) {
            .s-hero-actions {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
            }
            .s-btn-primary, .s-btn-secondary {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
        }

        /* ===== HERO SPOTLIGHT CARD (RIGHT SIDE) ===== */
        .s-hero-spotlight {
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
        .s-hero-spotlight:hover {
            border-color: rgba(56, 189, 248, 0.55);
            transform: translateY(-4px);
        }
        .s-spotlight-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            box-sizing: border-box;
        }
        .s-window-dots {
            display: flex;
            gap: 6px;
        }
        .s-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        .s-dot-red { background: #ef4444; }
        .s-dot-yellow { background: #f59e0b; }
        .s-dot-green { background: #10b981; }

        .s-spotlight-badge {
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
        .s-spotlight-canvas {
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
        .s-spotlight-canvas::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.04) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
        }
        .s-spotlight-img {
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
        .s-hero-spotlight:hover .s-spotlight-img {
            transform: scale(1.04);
        }
        .s-spotlight-icon-fallback {
            width: 90px;
            height: 90px;
            border-radius: 22px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            position: relative;
            z-index: 2;
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.18);
        }

        .s-spotlight-footer {
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
        .s-specs-section {
            margin-top: -36px;
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 768px) {
            .s-specs-section {
                margin-top: 20px;
            }
        }
        .s-specs-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1024px) {
            .s-specs-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 576px) {
            .s-specs-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }
        }
        .s-spec-card {
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
        .s-spec-card:hover {
            transform: translateY(-4px);
            border-color: #0284c7;
            box-shadow: 0 14px 30px rgba(14, 165, 233, 0.12);
        }
        .s-spec-icon-box {
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
        .s-spec-card:hover .s-spec-icon-box {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
            transform: scale(1.06);
        }
        .s-spec-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #94a3b8;
            margin-bottom: 3px;
        }
        .s-spec-val {
            font-size: 14.5px;
            font-weight: 850;
            color: #0f172a;
            line-height: 1.3;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* ===== MAIN BODY CONTENT & SIDEBAR ===== */
        .s-body-section {
            padding: 40px 0 80px 0;
            position: relative;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .s-main-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 380px;
            gap: clamp(24px, 3vw, 50px);
            align-items: start;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .s-main-layout > div {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1100px) {
            .s-main-layout {
                grid-template-columns: minmax(0, 1fr) 340px;
                gap: 28px;
            }
        }
        @media (max-width: 960px) {
            .s-main-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 32px;
            }
        }

        /* Main Content Stage Card */
        .s-content-card {
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
            .s-content-card {
                padding: 20px 14px;
                border-radius: 18px;
            }
        }

        .s-card-header {
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
        .s-card-header-icon {
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
        .s-card-title {
            font-size: clamp(18px, 2.2vw, 22px);
            font-weight: 850;
            color: #0f172a;
            margin: 0;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* Rich Content Body */
        .s-rich-body {
            font-size: 16px;
            line-height: 1.85;
            color: #334155;
            word-break: break-word;
            overflow-wrap: anywhere;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .s-rich-body p {
            margin-bottom: 18px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .s-rich-body ul, .s-rich-body ol {
            margin: 0 0 20px 22px;
            padding: 0;
        }
        @media (max-width: 576px) {
            .s-rich-body ul, .s-rich-body ol {
                margin: 0 0 20px 16px;
            }
        }
        .s-rich-body li {
            margin-bottom: 8px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .s-rich-body img, .s-rich-body video, .s-rich-body iframe {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 12px;
            margin: 16px 0;
            box-sizing: border-box;
        }
        .s-rich-body table {
            display: block;
            width: 100% !important;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: 20px 0;
        }
        .s-rich-body pre, .s-rich-body code {
            max-width: 100%;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-all;
        }

        /* ===== CORE CAPABILITIES GRID ===== */
        .s-capabilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
            margin: 24px 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 576px) {
            .s-capabilities-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }
        }
        .s-capability-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            padding: 20px 18px;
            transition: all 0.3s ease;
            position: relative;
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        .s-capability-card:hover {
            background: #ffffff;
            border-color: #0284c7;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.1);
        }
        .s-capability-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .s-capability-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        .s-capability-title {
            font-size: 15.5px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .s-capability-text {
            font-size: 13.5px;
            line-height: 1.7;
            color: #64748b;
            margin: 0;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* ===== DELIVERY ROADMAP STEPS ===== */
        .s-roadmap-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-top: 24px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 992px) {
            .s-roadmap-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 576px) {
            .s-roadmap-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }
        }
        .s-roadmap-step {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            padding: 20px 16px;
            position: relative;
            transition: all 0.3s ease;
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        .s-roadmap-step:hover {
            border-color: #0284c7;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(2, 132, 199, 0.1);
        }
        .s-step-number {
            font-size: 11px;
            font-weight: 900;
            color: #0284c7;
            background: #e0f2fe;
            padding: 3px 9px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }
        .s-step-title {
            font-size: 15px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .s-step-desc {
            font-size: 13px;
            line-height: 1.6;
            color: #64748b;
            margin: 0;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* ===== TECH STACK PILLS ===== */
        .s-tech-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .s-tech-pill {
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
        .s-tech-pill:hover {
            border-color: #0284c7;
            background: #0284c7;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.25);
        }
        .s-tech-pill:hover i {
            color: #ffffff !important;
        }

        /* ===== SIDEBAR STYLING ===== */
        .s-sidebar-sticky {
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
            .s-sidebar-sticky {
                position: static;
            }
        }
        .s-sidebar-cta {
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
            .s-sidebar-cta {
                padding: 22px 16px;
                border-radius: 18px;
            }
        }
        .s-sidebar-cta-glow {
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
        .s-sidebar-cta-title {
            font-size: 21px;
            font-weight: 850;
            margin-bottom: 8px;
            color: #ffffff;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .s-sidebar-cta-desc {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 24px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .s-sidebar-trust-list {
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
        .s-sidebar-trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            word-break: break-word;
        }
        .s-sidebar-trust-item i {
            color: #10b981;
            font-size: 12px;
            flex-shrink: 0;
        }

        /* Related Services Card */
        .s-related-card {
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
            .s-related-card {
                padding: 20px 14px;
                border-radius: 18px;
            }
        }
        .s-related-title {
            font-size: 16.5px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .s-related-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .s-related-item {
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
        .s-related-item:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            transform: translateX(4px);
        }
        .s-related-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        .s-related-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
            flex: 1;
        }
        .s-related-name {
            font-size: 14px;
            font-weight: 750;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .s-related-cat {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <!-- =============== HERO SECTION =============== -->
    <section class="s-hero-section">
        <div class="s-hero-bg"></div>
        <div class="s-hero-grid"></div>

        <div class="s-container">
            <div class="s-hero-cockpit">
                <!-- Left Narrative -->
                <div>
                    <!-- Category & Status Badge -->
                    <div class="s-hud-badge">
                        <span class="s-radar-dot"></span>
                        <span class="s-badge-subtitle">{{ $service->category?->name ?? 'ENTERPRISE SERVICE' }}</span>
                        <span class="s-badge-divider"></span>
                        <span class="s-badge-tag"><i class="fas fa-check-shield"></i> PRODUCTION READY</span>
                    </div>

                    <!-- Title -->
                    <h1 class="s-hero-title">
                        {{ $service->title }}
                    </h1>

                    <!-- Lead Subtitle -->
                    <p class="s-hero-lead">
                        {{ $service->short_description }}
                    </p>

                    <!-- Telemetry Strip -->
                    <div class="s-telemetry-strip">
                        <div class="s-telemetry-pill">
                            <i class="fas fa-code-branch"></i> Custom Architecture
                        </div>
                        <div class="s-telemetry-pill">
                            <i class="fas fa-users-cog"></i> Dedicated Engineering Squad
                        </div>
                        <div class="s-telemetry-pill">
                            <i class="fas fa-cloud"></i> Cloud Native
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="s-hero-actions">
                        <a href="{{ route('contact') }}?service={{ urlencode($service->slug) }}" class="s-btn-primary">
                            <i class="fas fa-comments"></i>
                            <span>Request Service Consultation</span>
                        </a>
                        <a href="{{ route('services') }}" class="s-btn-secondary">
                            <i class="fas fa-th-large"></i>
                            <span>Explore All Services</span>
                        </a>
                        <a href="{{ route('contact') }}" class="s-btn-secondary" style="background:rgba(255,255,255,0.06);border-color:rgba(255,255,255,0.18)">
                            <i class="fas fa-phone-alt"></i>
                            <span>Get Direct Quote</span>
                        </a>
                    </div>
                </div>

                <!-- Right Spotlight Showcase -->
                <div>
                    <div class="s-hero-spotlight">
                        <div class="s-spotlight-topbar">
                            <div class="s-window-dots">
                                <span class="s-dot s-dot-red"></span>
                                <span class="s-dot s-dot-yellow"></span>
                                <span class="s-dot s-dot-green"></span>
                            </div>
                            <span class="s-spotlight-badge">
                                <i class="fas fa-certificate"></i> Verified Service Capability
                            </span>
                        </div>

                        <div class="s-spotlight-canvas">
                            @if($service->featured_image)
                            <img src="{{ media_url($service->featured_image) }}" alt="{{ $service->title }}" class="s-spotlight-img">
                            @elseif($service->icon)
                            <div class="s-spotlight-icon-fallback">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                            @else
                            <div class="s-spotlight-icon-fallback">
                                <i class="fas fa-cogs"></i>
                            </div>
                            @endif
                        </div>

                        <div class="s-spotlight-footer">
                            <span><i class="fas fa-check-circle" style="color:#10b981;margin-right:4px"></i> ISO 27001 Aligned</span>
                            <span>24/7 Dedicated Support SLA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== FLOATING SPECS BAR =============== -->
    <section class="s-specs-section">
        <div class="s-container">
            <div class="s-specs-grid">
                <div class="s-spec-card">
                    <div class="s-spec-icon-box"><i class="fas fa-layer-group"></i></div>
                    <div>
                        <div class="s-spec-label">Service Domain</div>
                        <div class="s-spec-val">{{ $service->category?->name ?? 'Technology Solutions' }}</div>
                    </div>
                </div>

                <div class="s-spec-card">
                    <div class="s-spec-icon-box"><i class="fas fa-cubes"></i></div>
                    <div>
                        <div class="s-spec-label">Architecture Model</div>
                        <div class="s-spec-val">Custom &amp; Cloud Native</div>
                    </div>
                </div>

                <div class="s-spec-card">
                    <div class="s-spec-icon-box"><i class="fas fa-tasks"></i></div>
                    <div>
                        <div class="s-spec-label">Delivery Framework</div>
                        <div class="s-spec-val">Agile CI/CD Sprints</div>
                    </div>
                </div>

                <div class="s-spec-card">
                    <div class="s-spec-icon-box"><i class="fas fa-shield-check"></i></div>
                    <div>
                        <div class="s-spec-label">Service Reliability</div>
                        <div class="s-spec-val" style="color:#0284c7">99.9% Uptime Guarantee</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== MAIN CONTENT & SIDEBAR =============== -->
    <section class="s-body-section">
        <div class="s-container">
            <div class="s-main-layout">
                <!-- Left Main Content Column -->
                <div>
                    <!-- Executive Service Overview Card -->
                    <div class="s-content-card">
                        <div class="s-card-header">
                            <div class="s-card-header-icon"><i class="fas fa-file-alt"></i></div>
                            <h2 class="s-card-title">Executive Service Overview</h2>
                        </div>

                        @if($service->description)
                        <div class="s-rich-body">
                            {!! $service->description !!}
                        </div>
                        @else
                        <div class="s-rich-body">
                            <p>{{ $service->short_description }}</p>
                        </div>
                        @endif

                        <!-- Features & Deliverables Matrix -->
                        @php
                            $serviceFeatures = is_array($service->features) 
                                ? $service->features 
                                : ((is_string($service->features) && $service->features !== '') 
                                    ? (json_decode($service->features, true) ?: array_map('trim', explode("\n", $service->features))) 
                                    : []);
                        @endphp

                        @if(!empty($serviceFeatures))
                        <div style="margin-top:36px">
                            <h3 style="font-size:19px;font-weight:850;color:#0f172a;margin-bottom:16px;display:flex;align-items:center;gap:8px">
                                <i class="fas fa-check-circle" style="color:#0284c7"></i> Key Capabilities &amp; Deliverables
                            </h3>
                            <div class="s-capabilities-grid">
                                @foreach($serviceFeatures as $idx => $feat)
                                <div class="s-capability-card">
                                    <div class="s-capability-header">
                                        <div class="s-capability-icon"><i class="fas fa-shield-alt"></i></div>
                                        <h4 class="s-capability-title">Deliverable {{ $idx + 1 }}</h4>
                                    </div>
                                    <p class="s-capability-text">{{ $feat }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Technology Stack Matrix -->
                        @php
                            $serviceTechs = is_array($service->technologies) 
                                ? $service->technologies 
                                : ((is_string($service->technologies) && $service->technologies !== '') 
                                    ? (json_decode($service->technologies, true) ?: array_map('trim', explode("\n", $service->technologies))) 
                                    : []);
                        @endphp

                        @if(!empty($serviceTechs))
                        <div style="margin-top:32px">
                            <h3 style="font-size:18px;font-weight:800;color:#0f172a;margin-bottom:14px;display:flex;align-items:center;gap:8px">
                                <i class="fas fa-layer-group" style="color:#0284c7"></i> Frameworks, Tools &amp; Architecture
                            </h3>
                            <div class="s-tech-grid">
                                @foreach($serviceTechs as $t)
                                <div class="s-tech-pill">
                                    <i class="fas fa-code" style="color:#0284c7"></i>
                                    <span>{{ $t }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Engagement Lifecycle & Roadmap -->
                        <div style="margin-top:40px;padding-top:32px;border-top:1.5px dashed #e2e8f0">
                            <h3 style="font-size:19px;font-weight:850;color:#0f172a;margin-bottom:6px;display:flex;align-items:center;gap:8px">
                                <i class="fas fa-project-diagram" style="color:#0284c7"></i> Delivery &amp; Execution Roadmap
                            </h3>
                            <p style="font-size:14px;color:#64748b;margin-bottom:20px">
                                Our end-to-end delivery framework ensures rapid time-to-market with zero compromise on enterprise security and scalability.
                            </p>
                            <div class="s-roadmap-grid">
                                <div class="s-roadmap-step">
                                    <span class="s-step-number">PHASE 01</span>
                                    <div class="s-step-title">Discovery &amp; Scope</div>
                                    <p class="s-step-desc">Requirements blueprint, architecture design, and sprint milestones.</p>
                                </div>
                                <div class="s-roadmap-step">
                                    <span class="s-step-number">PHASE 02</span>
                                    <div class="s-step-title">Agile Build</div>
                                    <p class="s-step-desc">Iterative engineering, code reviews, and continuous integration.</p>
                                </div>
                                <div class="s-roadmap-step">
                                    <span class="s-step-number">PHASE 03</span>
                                    <div class="s-step-title">Security &amp; QA</div>
                                    <p class="s-step-desc">Automated testing, penetration testing, and performance optimization.</p>
                                </div>
                                <div class="s-roadmap-step">
                                    <span class="s-step-number">PHASE 04</span>
                                    <div class="s-step-title">Deployment &amp; SLA</div>
                                    <p class="s-step-desc">Cloud rollout, 24/7 telemetry monitoring, and dedicated maintenance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Mission Control Sidebar -->
                <div>
                    <div class="s-sidebar-sticky">
                        <!-- CTA Card -->
                        <div class="s-sidebar-cta">
                            <div class="s-sidebar-cta-glow"></div>
                            <div style="position:relative;z-index:2">
                                <h3 class="s-sidebar-cta-title">Need {{ $service->title }}?</h3>
                                <p class="s-sidebar-cta-desc">
                                    Schedule a consultation with our principal solution architects to scope your technical requirements.
                                </p>
                                <a href="{{ route('contact') }}?service={{ urlencode($service->slug) }}" class="s-btn-primary" style="width:100%;justify-content:center;margin-bottom:12px">
                                    <i class="fas fa-comments"></i>
                                    <span>Request Consultation</span>
                                </a>
                                <a href="{{ route('services') }}" class="s-btn-secondary" style="width:100%;justify-content:center;background:rgba(255,255,255,0.06);border-color:rgba(255,255,255,0.15)">
                                    <i class="fas fa-th-large"></i>
                                    <span>View All Services</span>
                                </a>

                                <div class="s-sidebar-trust-list">
                                    <div class="s-sidebar-trust-item"><i class="fas fa-check-circle"></i> ISO 27001 Security Standard</div>
                                    <div class="s-sidebar-trust-item"><i class="fas fa-check-circle"></i> Strict SLA Guarantees</div>
                                    <div class="s-sidebar-trust-item"><i class="fas fa-check-circle"></i> NDA &amp; IP Protection</div>
                                </div>
                            </div>
                        </div>

                        <!-- Related Services -->
                        @if($related->count())
                        <div class="s-related-card">
                            <h4 class="s-related-title">
                                <i class="fas fa-network-wired" style="color:#0284c7"></i> Related Services
                            </h4>
                            <div class="s-related-list">
                                @foreach($related as $rel)
                                <a href="{{ route('services.show', $rel->slug) }}" class="s-related-item">
                                    <div class="s-related-icon">
                                        <i class="{{ $rel->icon ?: 'fas fa-cog' }}"></i>
                                    </div>
                                    <div class="s-related-info">
                                        <span class="s-related-name">{{ $rel->title }}</span>
                                        <span class="s-related-cat">{{ $rel->category?->name ?? 'Service' }}</span>
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
        <div class="s-container" style="position:relative;z-index:1;text-align:center">
            <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:20px">
                {{ setting('home_cta_badge', 'Start Your Project Today') }}
            </div>
            <h2>Ready To Scale With {{ $service->title }}?</h2>
            <p>Connect with our technical leads to architect and deliver your custom solution.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
                <a href="{{ route('contact') }}?service={{ urlencode($service->slug) }}" class="btn" style="background:white;color:var(--primary);padding:16px 36px;font-size:15px;box-shadow:0 8px 30px rgba(0,0,0,0.2)">
                    <i class="fas fa-comments"></i> Request Service Proposal
                </a>
                <a href="{{ route('services') }}" class="btn btn-outline-white" style="padding:16px 36px;font-size:15px">
                    <i class="fas fa-eye"></i> Explore Services
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
