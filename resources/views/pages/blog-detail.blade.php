@extends('layouts.app')
@section('title', $post->meta_title ?? $post->title . ' - Tech Insights | Rescom')
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('content')
<!-- =============== ULTRA-PREMIUM BLOG DETAIL PAGE =============== -->
<div class="blog-detail-page">
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
        .blog-detail-page {
            background: #f8fafc;
            color: #0f172a;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Full Screen Width Fluid Container */
        .b-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 clamp(16px, 3.5vw, 64px);
            box-sizing: border-box;
            position: relative;
            z-index: 2;
        }
        @media (max-width: 640px) {
            .b-container {
                padding: 0 14px;
            }
        }

        /* ===== HERO SECTION ===== */
        .b-hero-section {
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
        .has-topbar .b-hero-section {
            padding-top: clamp(140px, 18vh, 210px);
        }

        /* Ambient Glow & Grid Background */
        .b-hero-bg {
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
        .b-hero-grid {
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
        .b-hero-cockpit {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(0, 0.7fr);
            gap: clamp(24px, 3.5vw, 64px);
            align-items: center;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .b-hero-cockpit > div {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1024px) {
            .b-hero-cockpit {
                grid-template-columns: minmax(0, 1fr);
                gap: 32px;
            }
        }

        /* HUD Live Beacon Badge */
        .b-hud-badge {
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
            .b-hud-badge {
                padding: 6px 12px;
                gap: 6px;
                border-radius: 12px;
                margin-bottom: 14px;
            }
            .b-badge-divider {
                display: none;
            }
        }
        .b-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 10px #10b981;
            animation: bRadarPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            flex-shrink: 0;
        }
        @keyframes bRadarPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.35); }
        }
        .b-badge-subtitle {
            font-size: 11.5px;
            font-weight: 800;
            color: #f8fafc;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }
        .b-badge-divider {
            width: 1px;
            height: 10px;
            background: rgba(255, 255, 255, 0.25);
        }
        .b-badge-tag {
            font-size: 11px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.4px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Hero Typography */
        .b-hero-title {
            font-size: clamp(24px, 3.5vw, 48px);
            font-weight: 900;
            line-height: 1.18;
            letter-spacing: -0.03em;
            color: #ffffff;
            margin-bottom: 18px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .b-hero-lead {
            font-size: clamp(14.5px, 1.15vw, 18px);
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 24px;
            font-weight: 400;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* Author & Meta Capsule Strip */
        .b-meta-strip {
            display: flex;
            align-items: center;
            gap: 8px 10px;
            flex-wrap: wrap;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .b-author-capsule {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 4px 14px 4px 4px;
            border-radius: 999px;
            backdrop-filter: blur(8px);
            max-width: 100%;
            box-sizing: border-box;
        }
        .b-author-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #0284c7);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            flex-shrink: 0;
        }
        .b-author-name {
            font-size: 12.5px;
            font-weight: 700;
            color: #f8fafc;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .b-meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 12px;
            color: #e2e8f0;
            font-weight: 600;
            backdrop-filter: blur(8px);
            max-width: 100%;
            word-break: break-word;
            box-sizing: border-box;
        }
        .b-meta-pill i {
            color: #38bdf8;
            font-size: 11px;
            flex-shrink: 0;
        }

        /* ===== HERO SPOTLIGHT CARD (RIGHT SIDE) ===== */
        .b-hero-spotlight {
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
        .b-hero-spotlight:hover {
            border-color: rgba(56, 189, 248, 0.55);
            transform: translateY(-4px);
        }
        .b-spotlight-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            box-sizing: border-box;
        }
        .b-window-dots {
            display: flex;
            gap: 6px;
        }
        .b-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        .b-dot-red { background: #ef4444; }
        .b-dot-yellow { background: #f59e0b; }
        .b-dot-green { background: #10b981; }

        .b-spotlight-badge {
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
        .b-spotlight-canvas {
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
        .b-spotlight-canvas::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.04) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
        }
        .b-spotlight-img {
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
        .b-hero-spotlight:hover .b-spotlight-img {
            transform: scale(1.04);
        }
        .b-spotlight-fallback {
            font-size: 54px;
            color: #0284c7;
            position: relative;
            z-index: 2;
        }

        .b-spotlight-footer {
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
        .b-specs-section {
            margin-top: -36px;
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 768px) {
            .b-specs-section {
                margin-top: 20px;
            }
        }
        .b-specs-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1024px) {
            .b-specs-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 576px) {
            .b-specs-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }
        }
        .b-spec-card {
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
        .b-spec-card:hover {
            transform: translateY(-4px);
            border-color: #0284c7;
            box-shadow: 0 14px 30px rgba(14, 165, 233, 0.12);
        }
        .b-spec-icon-box {
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
        .b-spec-card:hover .b-spec-icon-box {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
            transform: scale(1.06);
        }
        .b-spec-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #94a3b8;
            margin-bottom: 3px;
        }
        .b-spec-val {
            font-size: 14.5px;
            font-weight: 850;
            color: #0f172a;
            line-height: 1.3;
            word-break: break-word;
            overflow-wrap: anywhere;
        }

        /* ===== MAIN BODY CONTENT & SIDEBAR ===== */
        .b-body-section {
            padding: 40px 0 80px 0;
            position: relative;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .b-main-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 380px;
            gap: clamp(24px, 3vw, 50px);
            align-items: start;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .b-main-layout > div {
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 1100px) {
            .b-main-layout {
                grid-template-columns: minmax(0, 1fr) 340px;
                gap: 28px;
            }
        }
        @media (max-width: 960px) {
            .b-main-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 32px;
            }
        }

        /* Main Article Card */
        .b-content-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 22px;
            padding: clamp(18px, 3.5vw, 46px);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
            margin-bottom: 32px;
            min-width: 0;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow: hidden;
        }
        @media (max-width: 640px) {
            .b-content-card {
                padding: 20px 14px;
                border-radius: 18px;
            }
        }

        /* Rich Article Typography */
        .b-article-body {
            font-size: 16.5px;
            line-height: 1.85;
            color: #334155;
            word-break: break-word;
            overflow-wrap: anywhere;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .b-article-body p {
            margin-bottom: 20px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .b-article-body h2 {
            font-size: clamp(20px, 2.5vw, 24px);
            font-weight: 850;
            color: #0f172a;
            margin: 32px 0 14px;
            line-height: 1.3;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .b-article-body h3 {
            font-size: clamp(18px, 2.2vw, 20px);
            font-weight: 800;
            color: #0f172a;
            margin: 26px 0 12px;
            line-height: 1.35;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .b-article-body ul, .b-article-body ol {
            margin: 0 0 22px 22px;
            padding: 0;
        }
        @media (max-width: 576px) {
            .b-article-body ul, .b-article-body ol {
                margin: 0 0 20px 16px;
            }
        }
        .b-article-body li {
            margin-bottom: 10px;
            line-height: 1.75;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .b-article-body blockquote {
            margin: 24px 0;
            padding: 16px 22px;
            background: #f8fafc;
            border-left: 4px solid #0284c7;
            border-radius: 0 14px 14px 0;
            font-style: italic;
            font-size: 16.5px;
            color: #1e293b;
            word-break: break-word;
            overflow-wrap: anywhere;
            box-sizing: border-box;
        }
        .b-article-body img, .b-article-body video, .b-article-body iframe {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 14px;
            margin: 20px 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            box-sizing: border-box;
        }
        .b-article-body table {
            display: block;
            width: 100% !important;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: 20px 0;
        }
        .b-article-body pre, .b-article-body code {
            max-width: 100%;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-all;
        }

        /* Article Tags Matrix */
        .b-tags-wrap {
            margin-top: 32px;
            padding-top: 22px;
            border-top: 1.5px dashed #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .b-tag-badge {
            background: #f1f5f9;
            color: #475569;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
            max-width: 100%;
            word-break: break-word;
            box-sizing: border-box;
        }
        .b-tag-badge:hover {
            background: #0284c7;
            color: #ffffff;
        }

        /* Share & Author Card */
        .b-share-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 26px;
            padding: 16px 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 576px) {
            .b-share-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                padding: 14px;
            }
        }
        .b-share-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            text-decoration: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }
        .b-share-btn:hover {
            background: #0284c7;
            border-color: #0284c7;
            color: #ffffff;
        }

        /* Author Profile Box */
        .b-author-profile {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 28px;
            padding: 22px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1.5px solid #bae6fd;
            border-radius: 18px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        @media (max-width: 576px) {
            .b-author-profile {
                flex-direction: column;
                text-align: center;
                gap: 14px;
                padding: 18px 14px;
            }
        }
        .b-profile-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #0284c7);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 900;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        /* ===== SIDEBAR STYLING ===== */
        .b-sidebar-sticky {
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
            .b-sidebar-sticky {
                position: static;
            }
        }
        .b-sidebar-cta {
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
            .b-sidebar-cta {
                padding: 22px 16px;
                border-radius: 18px;
            }
        }
        .b-sidebar-cta-glow {
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

        /* Related Posts Card */
        .b-related-card {
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
            .b-related-card {
                padding: 20px 14px;
                border-radius: 18px;
            }
        }
        .b-related-title {
            font-size: 16.5px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .b-related-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            box-sizing: border-box;
        }
        .b-related-item {
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
        .b-related-item:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            transform: translateX(4px);
        }
        .b-related-thumb {
            width: 52px;
            height: 44px;
            border-radius: 9px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .b-related-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
            flex: 1;
        }
        .b-related-name {
            font-size: 14px;
            font-weight: 750;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .b-related-date {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <!-- =============== HERO SECTION =============== -->
    <section class="b-hero-section">
        <div class="b-hero-bg"></div>
        <div class="b-hero-grid"></div>

        <div class="b-container">
            <div class="b-hero-cockpit">
                <!-- Left Narrative -->
                <div>
                    <!-- Category & Status Badge -->
                    <div class="b-hud-badge">
                        <span class="b-radar-dot"></span>
                        <span class="b-badge-subtitle">{{ $post->category?->name ?? 'TECH INTELLIGENCE' }}</span>
                        <span class="b-badge-divider"></span>
                        <span class="b-badge-tag"><i class="fas fa-lightbulb"></i> EXPERT INSIGHT</span>
                    </div>

                    <!-- Title -->
                    <h1 class="b-hero-title">
                        {{ $post->title }}
                    </h1>

                    <!-- Excerpt -->
                    @if($post->excerpt)
                    <p class="b-hero-lead">
                        {{ $post->excerpt }}
                    </p>
                    @endif

                    <!-- Author & Meta Strip -->
                    <div class="b-meta-strip">
                        <div class="b-author-capsule">
                            <div class="b-author-avatar">
                                {{ strtoupper(substr($post->author?->name ?? 'Rescom', 0, 1)) }}
                            </div>
                            <span class="b-author-name">{{ $post->author?->name ?? 'Rescom Engineering Team' }}</span>
                        </div>

                        <div class="b-meta-pill">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="b-meta-pill">
                            <i class="fas fa-clock"></i>
                            <span>{{ $post->reading_time ?? reading_time($post->content) }} min read</span>
                        </div>

                        @if($post->views)
                        <div class="b-meta-pill">
                            <i class="fas fa-eye"></i>
                            <span>{{ number_format($post->views) }} views</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right Spotlight Showcase -->
                <div>
                    <div class="b-hero-spotlight">
                        <div class="b-spotlight-topbar">
                            <div class="b-window-dots">
                                <span class="b-dot b-dot-red"></span>
                                <span class="b-dot b-dot-yellow"></span>
                                <span class="b-dot b-dot-green"></span>
                            </div>
                            <span class="b-spotlight-badge">
                                <i class="fas fa-bookmark"></i> Featured Publication
                            </span>
                        </div>

                        <div class="b-spotlight-canvas">
                            @if($post->featured_image)
                            <img src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}" class="b-spotlight-img">
                            @else
                            <div class="b-spotlight-fallback">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            @endif
                        </div>

                        <div class="b-spotlight-footer">
                            <span><i class="fas fa-check-circle" style="color:#10b981;margin-right:4px"></i> Verified Technical Content</span>
                            <span>Rescom Publications</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== FLOATING SPECS BAR =============== -->
    <section class="b-specs-section">
        <div class="b-container">
            <div class="b-specs-grid">
                <div class="b-spec-card">
                    <div class="b-spec-icon-box"><i class="fas fa-folder-open"></i></div>
                    <div>
                        <div class="b-spec-label">Domain &amp; Sector</div>
                        <div class="b-spec-val">{{ $post->category?->name ?? 'General Tech' }}</div>
                    </div>
                </div>

                <div class="b-spec-card">
                    <div class="b-spec-icon-box"><i class="fas fa-stopwatch"></i></div>
                    <div>
                        <div class="b-spec-label">Reading Time</div>
                        <div class="b-spec-val">{{ $post->reading_time ?? reading_time($post->content) }} Minutes</div>
                    </div>
                </div>

                <div class="b-spec-card">
                    <div class="b-spec-icon-box"><i class="fas fa-user-edit"></i></div>
                    <div>
                        <div class="b-spec-label">Author</div>
                        <div class="b-spec-val">{{ $post->author?->name ?? 'Rescom Specialist' }}</div>
                    </div>
                </div>

                <div class="b-spec-card">
                    <div class="b-spec-icon-box"><i class="fas fa-share-alt"></i></div>
                    <div>
                        <div class="b-spec-label">Published On</div>
                        <div class="b-spec-val" style="color:#0284c7">
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== MAIN CONTENT & SIDEBAR =============== -->
    <section class="b-body-section">
        <div class="b-container">
            <div class="b-main-layout">
                <!-- Left Main Article Column -->
                <div>
                    <article class="b-content-card">
                        <!-- Article Rich Body -->
                        <div class="b-article-body">
                            {!! $post->content !!}
                        </div>

                        <!-- Tags Matrix -->
                        @if($post->tags && $post->tags->count())
                        <div class="b-tags-wrap">
                            <span style="font-size:13px;font-weight:800;color:#64748b"><i class="fas fa-tags"></i> Topics:</span>
                            @foreach($post->tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" class="b-tag-badge">
                                #{{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                        @endif

                        <!-- Social Share Bar -->
                        <div class="b-share-bar">
                            <span style="font-size:14px;font-weight:800;color:#0f172a">
                                <i class="fas fa-share-nodes" style="color:#0284c7"></i> Share This Insight:
                            </span>
                            <div style="display:flex;gap:8px;flex-wrap:wrap">
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer" class="b-share-btn">
                                    <i class="fab fa-x-twitter"></i> <span>X / Twitter</span>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="b-share-btn">
                                    <i class="fab fa-linkedin-in" style="color:#0284c7"></i> <span>LinkedIn</span>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="b-share-btn">
                                    <i class="fab fa-whatsapp" style="color:#22c55e"></i> <span>WhatsApp</span>
                                </a>
                            </div>
                        </div>

                        <!-- Author Profile Box -->
                        <div class="b-author-profile">
                            <div class="b-profile-avatar">
                                {{ strtoupper(substr($post->author?->name ?? 'Rescom', 0, 1)) }}
                            </div>
                            <div>
                                <h4 style="font-size:17px;font-weight:850;color:#0f172a;margin:0 0 4px">
                                    {{ $post->author?->name ?? 'Rescom Engineering & Editorial Team' }}
                                </h4>
                                <p style="font-size:13.5px;color:#475569;margin:0;line-height:1.6">
                                    Author at Rescom specializing in enterprise architecture, digital transformation, and modern engineering platforms.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Right Mission Control Sidebar -->
                <div>
                    <div class="b-sidebar-sticky">
                        <!-- CTA Card -->
                        <div class="b-sidebar-cta">
                            <div class="b-sidebar-cta-glow"></div>
                            <div style="position:relative;z-index:2">
                                <h3 style="font-size:21px;font-weight:850;margin-bottom:8px;color:#ffffff">Scale Your Engineering</h3>
                                <p style="color:#94a3b8;font-size:14px;line-height:1.6;margin-bottom:22px">
                                    Need dedicated technical architects to build custom SaaS or mobile platforms for your business?
                                </p>
                                <a href="{{ route('contact') }}" class="btn" style="width:100%;justify-content:center;background:linear-gradient(135deg,#2563eb,#0284c7);color:#ffffff;padding:13px 20px;border-radius:12px;font-weight:750;text-decoration:none;box-shadow:0 6px 20px rgba(37,99,235,0.4);display:flex;align-items:center;gap:8px;margin-bottom:10px">
                                    <i class="fas fa-comments"></i>
                                    <span>Speak With An Architect</span>
                                </a>
                                <a href="{{ route('portfolio') }}" style="width:100%;justify-content:center;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.18);color:#ffffff;padding:11px 18px;border-radius:12px;font-size:13.5px;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:8px">
                                    <i class="fas fa-th-large"></i>
                                    <span>Explore Products &amp; Platforms</span>
                                </a>
                            </div>
                        </div>

                        <!-- Related Articles -->
                        @if($related->count())
                        <div class="b-related-card">
                            <h4 class="b-related-title">
                                <i class="fas fa-book-reader" style="color:#0284c7"></i> Related Insights
                            </h4>
                            <div class="b-related-list">
                                @foreach($related as $rel)
                                <a href="{{ route('blog.show', $rel->slug) }}" class="b-related-item">
                                    @if($rel->featured_image)
                                    <img src="{{ media_url($rel->featured_image) }}" alt="{{ $rel->title }}" class="b-related-thumb">
                                    @else
                                    <div class="b-related-thumb" style="display:flex;align-items:center;justify-content:center;background:#e0f2fe;color:#0284c7">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                    @endif
                                    <div class="b-related-info">
                                        <span class="b-related-name">{{ $rel->title }}</span>
                                        <span class="b-related-date">{{ $rel->published_at ? $rel->published_at->format('M d, Y') : $rel->created_at->format('M d, Y') }}</span>
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
        <div class="b-container" style="position:relative;z-index:1;text-align:center">
            <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:20px">
                {{ setting('home_cta_badge', 'Stay Ahead With Rescom') }}
            </div>
            <h2>Looking To Buy, Lease, or Build Your Next Property?</h2>
            <p>Our real estate specialists and architectural consultants are ready to guide your next property investment.</p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
                <a href="{{ route('contact') }}" class="btn" style="background:white;color:var(--primary);padding:16px 36px;font-size:15px;box-shadow:0 8px 30px rgba(0,0,0,0.2)">
                    <i class="fas fa-calendar-check"></i> Book Free Consultation
                </a>
                <a href="{{ route('blog') }}" class="btn btn-outline-white" style="padding:16px 36px;font-size:15px">
                    <i class="fas fa-eye"></i> Explore All Articles
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
