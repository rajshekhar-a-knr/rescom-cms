@extends('layouts.app')
@section('title', 'Knowledge Hub & Tech Insights - Expert Articles | Rescom')
@section('meta_description', 'Stay ahead with Rescom Knowledge Hub. Expert technical insights, architectural blueprints, cloud strategies, cybersecurity best practices, and enterprise engineering.')

@section('content')
<!-- =============== FUTURISTIC BLOG HERO (DARK CYBER THEME) =============== -->
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

        /* ===== FUTURISTIC HERO & WHITE CARDS STYLES ===== */
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
            padding: 6px 18px;
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
            text-shadow: none !important;
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
            max-width: 720px;
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
            padding: 22px 0;
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

        /* ===== MAIN BLOG SECTION (WHITE THEME & WIDE CONTAINER) ===== */
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

        .f-wide-container {
            width: 100%;
            max-width: 1680px;
            margin: 0 auto;
            padding: 0 clamp(20px, 4vw, 64px);
            position: relative;
            z-index: 2;
        }

        /* 2-Column Wide Layout (Articles 1fr + Sticky Sidebar 380px) */
        .f-blog-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 44px;
            align-items: start;
        }
        @media (max-width: 1200px) {
            .f-blog-layout {
                grid-template-columns: 1fr 340px;
                gap: 32px;
            }
        }
        @media (max-width: 960px) {
            .f-blog-layout {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        /* Blog Articles Grid (2 Columns on Desktop) */
        .f-articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 28px;
        }
        @media (max-width: 640px) {
            .f-articles-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Futuristic White Blog Card */
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
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .f-article-card:hover {
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
            height: 220px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
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
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            z-index: 2;
        }
        .f-article-card:hover .f-card-img {
            transform: scale(1.08);
        }

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
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, background 0.3s ease, color 0.3s ease;
            position: relative;
            z-index: 2;
        }
        .f-article-card:hover .f-blog-icon-bay {
            transform: scale(1.1) rotate(4deg);
            box-shadow: 0 14px 34px rgba(14, 165, 233, 0.38);
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
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
        .f-card-cat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #0284c7;
            box-shadow: 0 0 6px #0284c7;
        }

        .f-card-read-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #f8fafc;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            backdrop-filter: blur(8px);
            z-index: 3;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Target Corner Reticles */
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
        .f-article-card:hover .f-card-corner {
            opacity: 0.85;
        }
        .f-corner-tl { top: 10px; left: 10px; border-width: 2px 0 0 2px; }
        .f-corner-tr { top: 10px; right: 10px; border-width: 2px 2px 0 0; }
        .f-corner-bl { bottom: 10px; left: 10px; border-width: 0 0 2px 2px; }
        .f-corner-br { bottom: 10px; right: 10px; border-width: 0 2px 2px 0; }

        /* Card Content Bay */
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
        .f-article-card:hover .f-card-title {
            color: #0284c7;
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

        /* Card Bottom Telemetry & CTA */
        .f-card-footer {
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .f-author-capsule {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .f-author-avatar-sm {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #0284c7);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
        }
        .f-author-name-sm {
            font-size: 12.5px;
            font-weight: 700;
            color: #475569;
        }

        .f-card-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0284c7;
            font-size: 13.5px;
            font-weight: 750;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .f-card-link i {
            transition: transform 0.2s ease;
        }
        .f-article-card:hover .f-card-link {
            color: #1d4ed8;
        }
        .f-article-card:hover .f-card-link i {
            transform: translateX(4px);
        }

        /* ===== FUTURISTIC SIDEBAR (MISSION CONTROL) ===== */
        .f-sidebar-wrap {
            position: sticky;
            top: 110px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Search Card */
        .f-sidebar-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);
        }
        .f-sidebar-title {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .f-sidebar-title i {
            color: #0284c7;
        }

        .f-search-form {
            display: flex;
            gap: 8px;
        }
        .f-search-input {
            flex: 1;
            padding: 11px 16px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            font-size: 13.5px;
            color: #0f172a;
            outline: none;
            transition: all 0.2s ease;
        }
        .f-search-input:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
        }
        .f-search-btn {
            background: linear-gradient(135deg, #2563eb, #0284c7);
            color: #ffffff;
            border: none;
            padding: 0 16px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        .f-search-btn:hover {
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
            transform: translateY(-1px);
        }

        /* Categories List in Sidebar */
        .f-sidebar-cat-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .f-sidebar-cat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: #334155;
            font-size: 13.5px;
            font-weight: 600;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .f-sidebar-cat-item:hover, .f-sidebar-cat-item.active {
            background: #f0f9ff;
            border-color: #bae6fd;
            color: #0284c7;
            transform: translateX(4px);
        }
        .f-sidebar-cat-badge {
            background: #e2e8f0;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 999px;
        }
        .f-sidebar-cat-item:hover .f-sidebar-cat-badge {
            background: #0284c7;
            color: #ffffff;
        }

        /* Recent Posts List in Sidebar */
        .f-sidebar-recent-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .f-sidebar-recent-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 12px;
            text-decoration: none;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .f-sidebar-recent-item:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            transform: translateX(4px);
        }
        .f-sidebar-recent-thumb {
            width: 48px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        .f-sidebar-recent-icon {
            width: 48px;
            height: 40px;
            border-radius: 8px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        .f-sidebar-recent-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .f-sidebar-recent-title {
            font-size: 13px;
            font-weight: 750;
            color: #1e293b;
            line-height: 1.35;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .f-sidebar-recent-date {
            font-size: 11.5px;
            color: #94a3b8;
        }

        /* Tags Matrix */
        .f-sidebar-tags-matrix {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .f-sidebar-tag-chip {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 4px 11px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .f-sidebar-tag-chip:hover {
            background: #0284c7;
            border-color: #0284c7;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* Newsletter Cyber Card */
        .f-sidebar-cta {
            position: relative;
            background: linear-gradient(135deg, #070d1d 0%, #0c1a30 100%);
            border: 1.5px solid rgba(56, 189, 248, 0.25);
            border-radius: 20px;
            padding: 28px 24px;
            color: #ffffff;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(7, 13, 29, 0.3);
            text-align: center;
        }
        .f-sidebar-cta-glow {
            position: absolute;
            top: -30px;
            right: -30px;
            width: 140px;
            height: 140px;
            background: rgba(14, 165, 233, 0.35);
            border-radius: 50%;
            filter: blur(40px);
            pointer-events: none;
        }
        .f-sidebar-cta-title {
            font-size: 18px;
            font-weight: 850;
            margin-bottom: 6px;
            color: #ffffff;
        }
        .f-sidebar-cta-desc {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.55;
            margin-bottom: 18px;
        }
        .f-newsletter-input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            font-size: 13px;
            margin-bottom: 10px;
            outline: none;
        }
        .f-newsletter-input::placeholder { color: rgba(255, 255, 255, 0.5); }
        .f-newsletter-btn {
            width: 100%;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
            border: none;
            padding: 11px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 750;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            transition: all 0.25s ease;
        }
        .f-newsletter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(37, 99, 235, 0.55);
        }

        /* ===== FUTURISTIC PAGINATION ===== */
        .f-pagination-wrap {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
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

        /* ===== FUTURISTIC BOTTOM CTA BANNER ===== */
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
    </style>

    <div class="f-hero-bg"></div>
    <div class="f-cyber-grid"></div>
    <div class="f-energy-orb f-orb-left"></div>
    <div class="f-energy-orb f-orb-right"></div>

    <div class="container">
        <!-- Live HUD Beacon -->
        <div class="f-hud-badge" data-aos="fade-down">
            <span class="f-radar-dot"></span>
            <span class="f-badge-subtitle">KNOWLEDGE & ENGINEERING HUB</span>
            <span class="f-badge-divider"></span>
            <span class="f-badge-tag"><i class="fas fa-bolt"></i> 2026 TECH INSIGHTS</span>
        </div>

        <!-- Headline -->
        <h1 class="f-hero-title" data-aos="fade-up">
            Tech Insights That <span class="f-gradient-text">Drive Innovation & Scale</span>
        </h1>

        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            Expert technical analysis, architectural blueprints, cloud strategies, cybersecurity best practices, and enterprise engineering.
        </p>

        <!-- Catalog Telemetry Capsule -->
        <div class="f-catalog-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="f-stat-item">
                <span class="f-stat-val">{{ method_exists($posts, 'total') ? $posts->total() : $posts->count() }}</span>
                <span>Published Insights</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">{{ $categories->count() ?? '6+' }}</span>
                <span>Subject Domains</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">100%</span>
                <span>Peer-Reviewed</span>
            </div>
        </div>
    </div>
</section>

@include('partials.resources-tabs', ['activeKey' => 'blogs'])

<!-- =============== CATEGORY FILTER MATRIX =============== -->
<div class="f-filter-strip">
    <div class="container">
        <div class="f-filter-container">
            <a href="{{ route('blog') }}" class="f-filter-btn {{ !request('category') && !request('search') ? 'active' : '' }}">
                <i class="fas fa-layer-group" style="font-size:12px"></i>
                <span>All Insights</span>
                <span class="f-filter-count">{{ \App\Models\BlogPost::where('status', 'published')->count() }}</span>
            </a>
            @foreach($categories->filter(fn($c) => (int) ($c->posts_count ?? 0) > 0) as $cat)
            <a href="{{ route('blog', ['category' => $cat->slug]) }}" class="f-filter-btn {{ request('category') === $cat->slug ? 'active' : '' }}">
                <span>{{ $cat->name }}</span>
                <span class="f-filter-count">{{ $cat->posts_count }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- =============== MAIN BLOG CONTENT SECTION =============== -->
<section class="futuristic-blog-section">
    <div class="f-blog-grid-mesh"></div>

    <div class="f-wide-container">
        <div class="f-blog-layout">
            <!-- Left Articles Main Column -->
            <div>
                @if(request('search'))
                <div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;background:#ffffff;padding:14px 20px;border-radius:14px;border:1.5px solid #e2e8f0">
                    <span style="font-size:14px;color:#334155;font-weight:600">
                        Showing results for: <strong style="color:#0284c7">"{{ request('search') }}"</strong>
                    </span>
                    <a href="{{ route('blog') }}" style="font-size:12.5px;color:#ef4444;text-decoration:none;font-weight:700">
                        <i class="fas fa-times"></i> Clear Search
                    </a>
                </div>
                @endif

                @if($posts->count())
                <div class="f-articles-grid">
                    @foreach($posts as $i => $post)
                    @php
                        // Dynamic icon fallback logic
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
                    <article class="f-article-card" data-aos="fade-up" data-aos-delay="{{ ($i % 2) * 80 }}"
                             onclick="location.href='{{ route('blog.show', $post->slug) }}'">
                        <!-- Top Display Bay -->
                        <div class="f-card-preview-bay">
                            <div class="f-card-circuit"></div>
                            <div class="f-card-corner f-corner-tl"></div>
                            <div class="f-card-corner f-corner-tr"></div>
                            <div class="f-card-corner f-corner-bl"></div>
                            <div class="f-card-corner f-corner-br"></div>

                            @if($post->category)
                            <div class="f-card-cat-badge">
                                <span class="f-card-cat-dot"></span>
                                <span>{{ $post->category->name }}</span>
                            </div>
                            @endif

                            <div class="f-card-read-badge">
                                <i class="fas fa-clock"></i> {{ $post->reading_time ?? 5 }} min read
                            </div>

                            @if($post->featured_image)
                            <img src="{{ media_url($post->featured_image) }}" alt="{{ $post->title }}" class="f-card-img">
                            @else
                            <div class="f-blog-icon-bay">
                                <i class="{{ $postIcon }}"></i>
                            </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="f-card-body">
                            <div>
                                <h3 class="f-card-title">{{ $post->title }}</h3>
                                <p class="f-card-desc">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}</p>
                            </div>

                            <div class="f-card-footer">
                                <div class="f-author-capsule">
                                    <div class="f-author-avatar-sm">
                                        {{ strtoupper(substr($post->author?->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <span class="f-author-name-sm">{{ $post->author?->name ?? 'Rescom Editorial' }}</span>
                                </div>
                                <span class="f-card-link">
                                    <span>Read Insight</span>
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if(method_exists($posts, 'hasPages') && $posts->hasPages())
                <div class="f-pagination-wrap">
                    <div class="f-pagination">
                        {{-- Previous Page Link --}}
                        @if ($posts->onFirstPage())
                            <span class="f-page-btn disabled"><i class="fas fa-chevron-left"></i></span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}" class="f-page-btn"><i class="fas fa-chevron-left"></i></a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($posts->getUrlRange(max(1, $posts->currentPage() - 2), min($posts->lastPage(), $posts->currentPage() + 2)) as $page => $url)
                            @if ($page == $posts->currentPage())
                                <span class="f-page-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="f-page-btn">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}" class="f-page-btn"><i class="fas fa-chevron-right"></i></a>
                        @else
                            <span class="f-page-btn disabled"><i class="fas fa-chevron-right"></i></span>
                        @endif
                    </div>
                    <div class="f-page-summary">
                        Showing {{ $posts->firstItem() ?? 0 }}–{{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }} published insights
                    </div>
                </div>
                @endif

                @else
                <div style="background:#ffffff;border:1.5px solid #e2e8f0;border-radius:20px;padding:60px 24px;text-align:center">
                    <div style="width:72px;height:72px;border-radius:20px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;font-size:30px;margin:0 auto 16px auto">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 style="font-size:20px;font-weight:800;color:#0f172a;margin-bottom:8px">No Articles Found</h3>
                    <p style="color:#64748b;font-size:14px;max-width:440px;margin:0 auto 20px auto">We could not find any insights matching your active search criteria. Try a different term or explore our full knowledge archive.</p>
                    <a href="{{ route('blog') }}" class="f-btn-primary" style="padding:10px 24px;font-size:13.5px">
                        <span>View All Insights</span>
                    </a>
                </div>
                @endif
            </div>

            <!-- Right Mission Control Sidebar -->
            <div>
                <div class="f-sidebar-wrap">
                    <!-- Search Widget -->
                    <div class="f-sidebar-card" data-aos="fade-up">
                        <h4 class="f-sidebar-title">
                            <i class="fas fa-search"></i> Search Knowledge Base
                        </h4>
                        <form action="{{ route('blog') }}" method="GET" class="f-search-form">
                            @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search topics, keywords..." class="f-search-input">
                            <button type="submit" class="f-search-btn" title="Search">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Trending Domains / Categories -->
                    <div class="f-sidebar-card" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="f-sidebar-title">
                            <i class="fas fa-layer-group"></i> Knowledge Domains
                        </h4>
                        <div class="f-sidebar-cat-list">
                            @foreach($categories as $cat)
                            <a href="{{ route('blog', ['category' => $cat->slug]) }}" class="f-sidebar-cat-item {{ request('category') === $cat->slug ? 'active' : '' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="f-sidebar-cat-badge">{{ $cat->posts_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Tech Insights -->
                    @if(isset($recentPosts) && $recentPosts->count())
                    <div class="f-sidebar-card" data-aos="fade-up" data-aos-delay="150">
                        <h4 class="f-sidebar-title">
                            <i class="fas fa-clock"></i> Recent Tech Insights
                        </h4>
                        <div class="f-sidebar-recent-list">
                            @foreach($recentPosts as $rp)
                            @php
                                $rCat = strtolower($rp->category ? $rp->category->name : '');
                                $rTitle = strtolower($rp->title);

                                if (str_contains($rCat, 'cyber') || str_contains($rCat, 'security') || str_contains($rTitle, 'security')) {
                                    $rIcon = 'fas fa-shield-halved';
                                } elseif (str_contains($rCat, 'cloud') || str_contains($rTitle, 'cloud')) {
                                    $rIcon = 'fas fa-cloud';
                                } elseif (str_contains($rCat, 'ai') || str_contains($rTitle, 'ai')) {
                                    $rIcon = 'fas fa-brain';
                                } else {
                                    $rIcon = 'fas fa-newspaper';
                                }
                            @endphp
                            <a href="{{ route('blog.show', $rp->slug) }}" class="f-sidebar-recent-item">
                                @if($rp->featured_image)
                                <img src="{{ media_url($rp->featured_image) }}" alt="{{ $rp->title }}" class="f-sidebar-recent-thumb">
                                @else
                                <div class="f-sidebar-recent-icon">
                                    <i class="{{ $rIcon }}"></i>
                                </div>
                                @endif
                                <div class="f-sidebar-recent-info">
                                    <span class="f-sidebar-recent-title">{{ $rp->title }}</span>
                                    <span class="f-sidebar-recent-date"><i class="far fa-calendar-alt"></i> {{ $rp->published_at?->format('M d, Y') ?? date('M d, Y') }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Popular Tags Matrix -->
                    @if(isset($tags) && $tags->count())
                    <div class="f-sidebar-card" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="f-sidebar-title">
                            <i class="fas fa-tags"></i> Trending Tags
                        </h4>
                        <div class="f-sidebar-tags-matrix">
                            @foreach($tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" class="f-sidebar-tag-chip">
                                #{{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Newsletter Cyber Deck -->
                    <div class="f-sidebar-cta" data-aos="fade-up" data-aos-delay="250">
                        <div class="f-sidebar-cta-glow"></div>
                        <div style="position:relative;z-index:2">
                            <div style="width:48px;height:48px;border-radius:14px;background:rgba(56,189,248,0.15);border:1px solid rgba(56,189,248,0.3);color:#38bdf8;display:flex;align-items:center;justify-content:center;font-size:20px;margin:0 auto 12px auto">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <h4 class="f-sidebar-cta-title">Weekly Engineering Digest</h4>
                            <p class="f-sidebar-cta-desc">
                                Join 5,000+ technology leaders receiving our weekly analysis on modern cloud, cybersecurity, and software architecture.
                            </p>
                            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                                @csrf
                                <input type="text" name="newsletter_website" value="" autocomplete="off" tabindex="-1" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0">
                                <input type="hidden" name="newsletter_started_at" value="{{ time() }}">
                                <input type="email" name="email" placeholder="Enter your business email..." required class="f-newsletter-input">
                                <button type="submit" class="f-newsletter-btn">
                                    <i class="fas fa-bolt"></i> Subscribe Free
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============== FUTURISTIC BOTTOM CTA BANNER =============== -->
<section class="futuristic-cta-banner" data-aos="fade-up">
    <div class="container">
        <div class="f-cta-box">
            <h2 class="f-cta-title">Need Custom Software or Cloud Architecture?</h2>
            <p class="f-cta-desc">
                Partner with our multidisciplinary engineering squads to build and scale mission-critical digital systems with enterprise guarantees.
            </p>
            <div class="f-cta-actions">
                <a href="{{ route('contact') }}" class="f-btn-primary">
                    <i class="fas fa-comments"></i>
                    <span>Consult Our Architects</span>
                </a>
                <a href="{{ route('portfolio') }}" class="f-btn-secondary">
                    <i class="fas fa-layer-group"></i>
                    <span>Explore Products</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
