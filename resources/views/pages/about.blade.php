@extends('layouts.app')
@section('title', setting('about_meta_title', 'About Rescom - Premier Real Estate & Construction Leadership'))
@section('meta_description', setting('about_meta_description', 'Learn about Rescom - premier residential & commercial real estate advisory, architectural design, structural engineering, and building maintenance in Bengaluru.'))

@section('content')
<!-- =============== FUTURISTIC ABOUT HERO (DARK CYBER THEME - FULL WIDTH) =============== -->
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

        /* ===== FULL SCREEN WIDTH LAYOUT SYSTEM ===== */
        .futuristic-page-hero {
            position: relative;
            background: #060b18;
            padding-top: clamp(140px, 17vh, 185px);
            padding-bottom: clamp(60px, 8vh, 90px);
            color: #ffffff;
            overflow: hidden;
            text-align: center;
            width: 100%;
        }
        .has-topbar .futuristic-page-hero {
            padding-top: clamp(165px, 20vh, 210px);
        }

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
        .f-orb-left { width: 450px; height: 450px; background: rgba(37, 99, 235, 0.25); top: 10%; left: -5%; }
        .f-orb-right { width: 500px; height: 500px; background: rgba(147, 51, 234, 0.22); top: 15%; right: -5%; animation-delay: -3s; }

        @keyframes fOrbPulseDark {
            0% { transform: scale(1) translateY(0); opacity: 0.5; }
            100% { transform: scale(1.15) translateY(-20px); opacity: 0.7; }
        }

        .f-hero-wide-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 100%;
            padding: 0 clamp(20px, 4.5vw, 80px);
            margin: 0 auto;
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

        .f-hero-title {
            font-size: clamp(32px, 4.5vw, 56px);
            font-weight: 850;
            line-height: 1.15;
            letter-spacing: -0.025em;
            color: #ffffff;
            margin-bottom: 16px;
            text-shadow: none !important;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        .f-gradient-text {
            background: linear-gradient(135deg, #ffffff 10%, #bae6fd 40%, #38bdf8 70%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline;
        }

        .f-hero-desc {
            font-size: clamp(15px, 1.2vw, 18px);
            color: #94a3b8;
            line-height: 1.75;
            max-width: 860px;
            margin: 0 auto 28px auto;
        }

        /* Telemetry Stats Strip */
        .f-catalog-stats {
            display: inline-flex;
            align-items: center;
            gap: 24px;
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(56, 189, 248, 0.25);
            padding: 10px 28px;
            border-radius: 999px;
            backdrop-filter: blur(12px);
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

        /* ===== COMMON FULL-WIDTH UTILITIES ===== */
        .f-wide-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 clamp(20px, 4.5vw, 80px);
            position: relative;
            z-index: 2;
            box-sizing: border-box;
        }

        .f-section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f0f9ff;
            border: 1px solid rgba(14, 165, 233, 0.3);
            color: #0369a1;
            padding: 5px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 750;
            margin-bottom: 12px;
        }
        .f-section-title {
            font-size: clamp(26px, 3.2vw, 40px);
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 24px;
            line-height: 1.2;
        }

        /* ===== SECTION 1: WHO WE ARE (WHITE CYBER - FULL WIDTH) ===== */
        .f-about-section {
            position: relative;
            background: #ffffff;
            padding: clamp(60px, 8vh, 90px) 0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }
        .f-who-grid {
            display: grid;
            grid-template-columns: 1.25fr 0.75fr;
            gap: clamp(32px, 4vw, 64px);
            align-items: center;
        }
        @media (max-width: 960px) {
            .f-who-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }
        .f-who-pills {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 24px;
        }
        .f-who-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
        }
        .f-who-pill i { color: #0284c7; }

        .f-highlight-card {
            background: linear-gradient(135deg, #070d1d 0%, #0c1a30 100%);
            border: 1.5px solid rgba(56, 189, 248, 0.25);
            border-radius: 24px;
            padding: clamp(28px, 3vw, 40px);
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(7, 13, 29, 0.35);
        }
        .f-highlight-glow {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            background: rgba(14, 165, 233, 0.35);
            border-radius: 50%;
            filter: blur(45px);
            pointer-events: none;
        }
        .f-highlight-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(56, 189, 248, 0.15);
            border: 1px solid rgba(56, 189, 248, 0.35);
            color: #38bdf8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .f-highlight-title {
            font-size: 21px;
            font-weight: 850;
            color: #ffffff;
            margin-bottom: 12px;
        }
        .f-highlight-body {
            font-size: 15px;
            line-height: 1.75;
            color: #94a3b8;
        }

        /* ===== SECTION 2: STORY & VALUES ===== */
        .f-story-section {
            position: relative;
            background: #f8fafc;
            padding: clamp(60px, 8vh, 100px) 0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }
        .f-story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(32px, 4vw, 64px);
            align-items: start;
        }
        @media (max-width: 960px) {
            .f-story-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
        .f-story-p {
            font-size: 16px;
            line-height: 1.85;
            color: #475569;
            margin-bottom: 20px;
        }

        .f-values-wrap {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 24px;
            padding: clamp(24px, 3vw, 36px);
            box-shadow: 0 10px 35px rgba(15, 23, 42, 0.04);
        }
        .f-values-heading {
            font-size: 22px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .f-value-item {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f1f5f9;
        }
        .f-value-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        .f-value-icon-bay {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #f0f9ff;
            border: 1px solid rgba(14, 165, 233, 0.25);
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }
        .f-value-title {
            font-size: 16.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .f-value-desc {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        /* ===== SECTION 3: VISION & MISSION ===== */
        .f-vision-section {
            background: #ffffff;
            padding: clamp(60px, 8vh, 90px) 0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }
        .f-vision-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(20px, 2.5vw, 32px);
            margin-bottom: 36px;
        }
        @media (max-width: 768px) {
            .f-vision-grid {
                grid-template-columns: 1fr;
            }
        }
        .f-vision-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            padding: clamp(24px, 3vw, 36px);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .f-vision-card:hover {
            transform: translateY(-4px);
            border-color: #0284c7;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.1);
        }
        .f-vision-title {
            font-size: 20px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .f-vision-title i { color: #0284c7; }
        .f-vision-text {
            font-size: 15px;
            line-height: 1.75;
            color: #475569;
            margin: 0;
        }

        /* ===== SECTION 4: STATS BAR (FULL WIDTH) ===== */
        .f-stats-bar-section {
            background: linear-gradient(135deg, #070d1d 0%, #0c1a30 100%);
            border-top: 1px solid rgba(56, 189, 248, 0.2);
            border-bottom: 1px solid rgba(56, 189, 248, 0.2);
            padding: 54px 0;
            color: #ffffff;
            width: 100%;
        }
        .f-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: clamp(24px, 3vw, 48px);
            text-align: center;
        }
        .f-stat-number {
            font-size: clamp(34px, 4vw, 52px);
            font-weight: 900;
            color: #38bdf8;
            line-height: 1;
            margin-bottom: 8px;
            display: block;
        }
        .f-stat-label-text {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        /* ==========================================================================
           SECTION 5: HIGHLIGHTED RESCOM CORPORATE PRESENTATION SHOWCASE (FUTURISTIC THEME)
           ========================================================================== */
        .f-presentation-section {
            position: relative;
            background: linear-gradient(180deg, #050b1a 0%, #08122c 50%, #040816 100%);
            padding: clamp(70px, 9vh, 120px) 0;
            color: #ffffff;
            overflow: hidden;
            border-top: 1px solid rgba(56, 189, 248, 0.25);
            border-bottom: 1px solid rgba(56, 189, 248, 0.25);
            width: 100%;
        }
        .f-pres-bg-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(56, 189, 248, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
            pointer-events: none;
            z-index: 1;
        }
        .f-pres-orb-1 {
            position: absolute;
            top: 20%;
            left: -100px;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(0, 240, 255, 0.18) 0%, transparent 70%);
            filter: blur(60px);
            pointer-events: none;
            z-index: 1;
            animation: fPresOrb 10s ease-in-out infinite alternate;
        }
        .f-pres-orb-2 {
            position: absolute;
            bottom: 10%;
            right: -80px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.22) 0%, transparent 70%);
            filter: blur(70px);
            pointer-events: none;
            z-index: 1;
            animation: fPresOrb 12s ease-in-out infinite alternate-reverse;
        }
        @keyframes fPresOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, -30px) scale(1.15); }
        }

        .f-pres-layout {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: clamp(36px, 4.5vw, 64px);
            align-items: center;
            position: relative;
            z-index: 2;
        }
        @media (max-width: 1024px) {
            .f-pres-layout {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        .f-pres-badge-beacon {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(12, 22, 50, 0.85);
            border: 1px solid rgba(0, 240, 255, 0.4);
            padding: 7px 20px;
            border-radius: 999px;
            margin-bottom: 20px;
            backdrop-filter: blur(14px);
            box-shadow: 0 0 25px rgba(0, 240, 255, 0.2);
        }
        .f-pres-badge-title {
            font-size: 11.5px;
            font-weight: 850;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: #e0f2fe;
        }
        .f-pres-badge-tag {
            font-size: 11px;
            font-weight: 750;
            color: #00f0ff;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .f-pres-heading {
            font-size: clamp(28px, 3.6vw, 46px);
            font-weight: 850;
            line-height: 1.2;
            color: #ffffff;
            margin-bottom: 18px;
            letter-spacing: -0.02em;
        }
        .f-pres-desc {
            font-size: clamp(15px, 1.15vw, 17px);
            color: #94a3b8;
            line-height: 1.75;
            margin-bottom: 28px;
        }

        .f-pres-pills-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 30px;
        }
        @media (max-width: 600px) {
            .f-pres-pills-grid {
                grid-template-columns: 1fr;
            }
        }
        .f-pres-pill-item {
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }
        .f-pres-pill-item:hover {
            border-color: #00f0ff;
            background: rgba(15, 23, 42, 0.9);
            transform: translateX(4px);
            box-shadow: 0 4px 20px rgba(0, 240, 255, 0.15);
        }
        .f-pres-pill-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(0, 240, 255, 0.15);
            border: 1px solid rgba(0, 240, 255, 0.35);
            color: #00f0ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        .f-pres-pill-title {
            font-size: 13.5px;
            font-weight: 750;
            color: #f1f5f9;
        }
        .f-pres-pill-sub {
            font-size: 11.5px;
            color: #94a3b8;
        }

        .f-pres-stats-row {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }
        .f-pres-stat-badge {
            background: rgba(6, 182, 212, 0.12);
            border: 1px solid rgba(6, 182, 212, 0.3);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            color: #38bdf8;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .f-pres-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .f-pres-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #00f0ff 0%, #0284c7 60%, #4f46e5 100%);
            color: #040714 !important;
            padding: 14px 32px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 0 30px rgba(0, 240, 255, 0.4), 0 8px 25px rgba(2, 132, 199, 0.4);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            letter-spacing: 0.2px;
        }
        .f-pres-btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 0 45px rgba(0, 240, 255, 0.6), 0 12px 35px rgba(2, 132, 199, 0.5);
            color: #000000 !important;
        }
        .f-pres-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(15, 23, 42, 0.7);
            border: 1.5px solid rgba(56, 189, 248, 0.4);
            color: #ffffff !important;
            padding: 13.5px 26px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 750;
            text-decoration: none;
            backdrop-filter: blur(12px);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .f-pres-btn-secondary:hover {
            background: rgba(56, 189, 248, 0.18);
            border-color: #00f0ff;
            color: #00f0ff !important;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(56, 189, 248, 0.2);
        }

        /* Holographic Preview Card (Right Column) */
        .f-pres-hud-card {
            background: linear-gradient(145deg, rgba(10, 18, 42, 0.85) 0%, rgba(6, 12, 28, 0.95) 100%);
            border: 1.5px solid rgba(0, 240, 255, 0.35);
            border-radius: 24px;
            padding: 24px;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 0 40px rgba(0, 240, 255, 0.15);
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            display: block;
            color: inherit;
        }
        .f-pres-hud-card:hover {
            transform: translateY(-6px) scale(1.01);
            border-color: #00f0ff;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.8), 0 0 60px rgba(0, 240, 255, 0.3);
        }

        /* Cyber Crosshairs */
        .f-hud-cross {
            position: absolute;
            width: 14px;
            height: 14px;
            pointer-events: none;
            z-index: 5;
        }
        .f-hud-cross.tl { top: 12px; left: 12px; border-top: 2px solid #00f0ff; border-left: 2px solid #00f0ff; }
        .f-hud-cross.tr { top: 12px; right: 12px; border-top: 2px solid #00f0ff; border-right: 2px solid #00f0ff; }
        .f-hud-cross.bl { bottom: 12px; left: 12px; border-bottom: 2px solid #00f0ff; border-left: 2px solid #00f0ff; }
        .f-hud-cross.br { bottom: 12px; right: 12px; border-bottom: 2px solid #00f0ff; border-right: 2px solid #00f0ff; }

        .f-hud-top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 11.5px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .f-hud-status-live {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #00f0ff;
        }
        .f-hud-live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #00f0ff;
            box-shadow: 0 0 8px #00f0ff;
            animation: fRadarWaveDark 1.8s infinite;
        }

        .f-pres-visual-stage {
            position: relative;
            background: radial-gradient(circle at 50% 50%, rgba(14, 165, 233, 0.15) 0%, rgba(4, 7, 20, 0.95) 75%);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 18px;
            padding: 40px 24px;
            text-align: center;
            overflow: hidden;
        }
        .f-pres-orbit-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 220px;
            height: 220px;
            border-radius: 50%;
            border: 1.5px dashed rgba(0, 240, 255, 0.35);
            animation: rotatePresOrbit 25s linear infinite;
            pointer-events: none;
        }
        @keyframes rotatePresOrbit {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .f-pres-center-logo {
            position: relative;
            width: 110px;
            height: 110px;
            margin: 0 auto 20px auto;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            box-shadow: 0 0 35px rgba(0, 240, 255, 0.5), 0 10px 30px rgba(0, 0, 0, 0.8);
            z-index: 3;
        }
        .f-pres-center-logo img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .f-pres-stage-title {
            font-size: 19px;
            font-weight: 850;
            color: #ffffff;
            margin-bottom: 6px;
            position: relative;
            z-index: 3;
        }
        .f-pres-stage-sub {
            font-size: 13px;
            color: #38bdf8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 16px;
            position: relative;
            z-index: 3;
        }

        .f-pres-hover-overlay {
            position: absolute;
            inset: 0;
            background: rgba(4, 8, 24, 0.88);
            backdrop-filter: blur(6px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 10;
            border-radius: 18px;
        }
        .f-pres-hud-card:hover .f-pres-hover-overlay {
            opacity: 1;
        }
        .f-pres-play-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00f0ff, #0284c7);
            color: #040714;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 0 30px rgba(0, 240, 255, 0.7);
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        .f-pres-hud-card:hover .f-pres-play-circle {
            transform: scale(1.1);
        }
        .f-pres-hover-text {
            font-size: 14px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        /* ===== INTERACTIVE PRESENTATION MODAL ===== */
        .f-pres-modal {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 20, 0.94);
            backdrop-filter: blur(24px);
            z-index: 99999;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 20px;
            box-sizing: border-box;
        }
        .f-pres-modal.is-open {
            display: flex;
            flex-direction: column;
            opacity: 1;
        }
        .f-pres-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 14px;
            margin-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }
        .f-pres-modal-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 17px;
            font-weight: 800;
        }
        .f-pres-modal-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .f-pres-modal-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .f-pres-modal-btn:hover {
            background: #00f0ff;
            color: #040714;
            border-color: #00f0ff;
        }
        .f-pres-modal-close {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #f87171;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s ease;
        }
        .f-pres-modal-close:hover {
            background: #ef4444;
            color: #ffffff;
        }
        .f-pres-modal-body {
            flex: 1;
            width: 100%;
            height: 100%;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(56, 189, 248, 0.3);
            background: #040714;
            position: relative;
        }
        .f-pres-iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 16px;
        }

        /* ===== SECTION 6: TEAM SECTION (FULL WIDTH) ===== */
        .f-team-section {
            background: #f8fafc;
            padding: clamp(60px, 8vh, 100px) 0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }
        .f-team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: clamp(20px, 2.5vw, 32px);
        }

        .f-team-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.03);
            text-align: center;
            text-decoration: none;
            color: inherit;
            display: block;
            padding: 28px 20px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .f-team-card:hover {
            transform: translateY(-8px);
            border-color: #0284c7;
            box-shadow: 0 16px 35px rgba(14, 165, 233, 0.15);
        }
        .f-team-avatar-bay {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            margin: 0 auto 16px auto;
            padding: 6px;
            background: #ffffff;
            border: 2px solid rgba(14, 165, 233, 0.3);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .f-team-avatar-bay img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .f-team-card:hover .f-team-avatar-bay img {
            transform: scale(1.08);
        }
        .f-team-name {
            font-size: 17px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .f-team-role {
            font-size: 13.5px;
            color: #0284c7;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .f-team-bio {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        /* ===== SECTION 7: WHY CHOOSE US (FULL WIDTH) ===== */
        .f-advantage-section {
            background: #ffffff;
            padding: clamp(60px, 8vh, 100px) 0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }
        .f-advantage-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: clamp(20px, 2.5vw, 32px);
        }
        .f-advantage-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .f-advantage-card:hover {
            transform: translateY(-5px);
            border-color: #0284c7;
            background: #ffffff;
            box-shadow: 0 14px 35px rgba(14, 165, 233, 0.12);
        }
        .f-advantage-icon-bay {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 18px;
        }
        .f-advantage-title {
            font-size: 18px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 10px;
        }
        .f-advantage-desc {
            font-size: 14px;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        /* ===== SECTION 8: TRUSTED CLIENTS (FULL WIDTH) ===== */
        .f-trust-section {
            background: #f8fafc;
            padding: clamp(50px, 7vh, 80px) 0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }
        .f-trust-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }
        .f-trust-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 18px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);
            transition: all 0.25s ease;
        }
        .f-trust-card:hover {
            transform: translateY(-3px);
            border-color: #0284c7;
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.12);
        }
        .f-trust-logo {
            height: 28px;
            max-width: 70px;
            object-fit: contain;
            flex-shrink: 0;
        }
        .f-trust-name {
            font-size: 13.5px;
            font-weight: 700;
            color: #334155;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ===== BOTTOM CTA BANNER (FULL WIDTH) ===== */
        .futuristic-cta-banner {
            position: relative;
            background: linear-gradient(180deg, #f8fafc 0%, #f0f7ff 100%);
            padding: clamp(60px, 8vh, 100px) 0;
            color: #0f172a;
            overflow: hidden;
            text-align: center;
            width: 100%;
        }
        .f-cta-box {
            position: relative;
            z-index: 2;
            max-width: 1100px;
            margin: 0 auto;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.9);
            padding: clamp(36px, 5vw, 60px) clamp(24px, 4vw, 48px);
            border-radius: 28px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08), 0 0 30px rgba(14, 165, 233, 0.1);
        }
        .f-cta-title {
            font-size: clamp(26px, 3.5vw, 40px);
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 14px;
        }
        .f-cta-desc {
            color: #64748b;
            font-size: 16.5px;
            line-height: 1.7;
            margin-bottom: 32px;
            max-width: 680px;
            margin-left: auto;
            margin-right: auto;
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

    <div class="f-hero-wide-container">
        <!-- Live HUD Beacon -->
        <div class="f-hud-badge" data-aos="fade-down">
            <span class="f-radar-dot"></span>
            <span class="f-badge-subtitle">REAL ESTATE & INFRASTRUCTURE</span>
            <span class="f-badge-divider"></span>
            <span class="f-badge-tag"><i class="fas fa-building"></i> {{ $about?->hero_badge ?? 'RESCOM' }} · RERA VERIFIED</span>
        </div>

        <!-- Headline -->
        <h1 class="f-hero-title" data-aos="fade-up">
            {{ $about?->hero_title ?? 'Building Spaces & Delivering' }} <span class="f-gradient-text">{{ $about?->hero_highlight ?? 'Real Estate Excellence' }}</span>
        </h1>

        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            We are a dedicated team of real estate advisors, architects, structural engineers, and property managers delivering end-to-end residential and commercial property solutions.
        </p>

        <!-- Catalog Telemetry Capsule -->
        <div class="f-catalog-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="f-stat-item">
                <span class="f-stat-val">500+</span>
                <span>Properties Managed</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">100+</span>
                <span>Prime Projects</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">100%</span>
                <span>RERA Verified</span>
            </div>
        </div>
    </div>
</section>

<!-- =============== SECTION 1: WHO WE ARE (FULL WIDTH) =============== -->
<section class="f-about-section">
    <div class="f-wide-container">
        <div class="f-who-grid" data-aos="fade-up">
            <div>
                <div class="f-section-badge"><i class="fas fa-building"></i> Corporate Identity</div>
                <h2 class="f-section-title">Who We Are & What We Stand For</h2>
                <div style="font-size:16.5px;line-height:1.85;color:#475569">
                    {!! $about?->hero_subtitle ?? 'We are a dedicated team of real estate advisors, architects, structural engineers, and property managers delivering end-to-end residential and commercial property solutions across Bengaluru.' !!}
                </div>
                <div class="f-who-pills">
                    <div class="f-who-pill"><i class="fas fa-shield-halved"></i> 100% RERA Compliant</div>
                    <div class="f-who-pill"><i class="fas fa-city"></i> Prime Urban Corridors</div>
                    <div class="f-who-pill"><i class="fas fa-drafting-compass"></i> Architectural Design</div>
                    <div class="f-who-pill"><i class="fas fa-screwdriver-wrench"></i> Complete Property Care</div>
                </div>
            </div>

            <div>
                <div class="f-highlight-card">
                    <div class="f-highlight-glow"></div>
                    <div style="position:relative;z-index:2">
                        <div class="f-highlight-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="f-highlight-title">Experience You Can Trust</h3>
                        <p class="f-highlight-body">
                            {{ $about?->story_body_2 ?? 'We serve property buyers, investors, and developers with a consistent focus on quality, legal transparency, and measurable returns.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============== SECTION 2: OUR STORY & VALUES (FULL WIDTH) =============== -->
<section class="f-story-section">
    <div class="f-wide-container">
        <div class="f-story-grid">
            <!-- Left: Our Story -->
            <div data-aos="fade-right">
                <div class="f-section-badge"><i class="fas fa-flag"></i> {{ $about?->story_badge ?? 'Our Heritage' }}</div>
                <h2 class="f-section-title">
                    {{ $about?->story_title ?? 'From Visionary Foundations to a' }}
                    <span style="color:#0284c7">{{ $about?->story_highlight ?? 'Premier Real Estate Leader' }}</span>
                </h2>
                <p class="f-story-p">
                    {{ $about?->story_body_1 ?? 'Founded with a clear vision to redefine property development and management, Rescom delivers high-value residential, commercial, architectural, and maintenance solutions tailored to our clients\' unique aspirations.' }}
                </p>
                <p class="f-story-p">
                    {{ $about?->story_body_2 ?? 'Today, with experienced property consultants, certified structural engineers, and architects, we manage and deliver premier properties across key urban corridors with uncompromising legal transparency and craftsmanship.' }}
                </p>
            </div>

            <!-- Right: Core Values -->
            <div data-aos="fade-left">
                <div class="f-values-wrap">
                    <h3 class="f-values-heading">
                        <i class="fas fa-layer-group" style="color:#0284c7"></i>
                        <span>{{ $about?->values_title ?? 'Our Core Values' }}</span>
                    </h3>
                    @php
                        $values = $about?->values ?? [
                            ['icon' => 'fas fa-star','title' => 'Excellence First','desc' => 'We never compromise on quality. Every structural blueprint, property transaction, and maintenance service is held to the highest standard.'],
                            ['icon' => 'fas fa-handshake','title' => 'Client Partnership','desc' => 'We treat every property search, investment, and construction project as our own. Your satisfaction is our mission.'],
                            ['icon' => 'fas fa-drafting-compass','title' => 'Architectural Mastery','desc' => 'We integrate modern design principles, smart building technologies, and durable materials into every project.'],
                            ['icon' => 'fas fa-shield-alt','title' => 'Trust & Transparency','desc' => '100% clear titles, RERA compliance, realistic timelines, and full legal accountability.'],
                        ];
                    @endphp
                    @foreach($values as $value)
                    <div class="f-value-item">
                        <div class="f-value-icon-bay">
                            <i class="{{ $value['icon'] ?? 'fas fa-star' }}"></i>
                        </div>
                        <div>
                            <h4 class="f-value-title">{{ $value['title'] ?? '' }}</h4>
                            <p class="f-value-desc">{{ $value['desc'] ?? '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============== SECTION 3: VISION & MISSION (FULL WIDTH) =============== -->
<section class="f-vision-section">
    <div class="f-wide-container">
        <div class="f-section-badge"><i class="fas fa-compass"></i> Guiding Principles</div>
        <h2 class="f-section-title">What Guides Our Vision & Practice</h2>

        <div class="f-vision-grid" data-aos="fade-up">
            <div class="f-vision-card">
                <h3 class="f-vision-title">
                    <i class="fas fa-eye"></i>
                    <span>{{ $about?->vision_title ?? 'Our Strategic Vision' }}</span>
                </h3>
                <p class="f-vision-text">
                    {{ $about?->vision_body ?? 'To be the premier real estate and property development partner, creating sustainable residential communities, iconic commercial hubs, and world-class architectural spaces.' }}
                </p>
            </div>

            <div class="f-vision-card">
                <h3 class="f-vision-title">
                    <i class="fas fa-bullseye"></i>
                    <span>{{ $about?->mission_title ?? 'Our Mission Objective' }}</span>
                </h3>
                <p class="f-vision-text">
                    {{ $about?->mission_body ?? 'To provide clients with comprehensive real estate consulting, superior structural engineering, flawless architectural design, and reliable property maintenance services.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- =============== SECTION 4: ENTERPRISE STATS BAR (FULL WIDTH) =============== -->
<section class="f-stats-bar-section">
    <div class="f-wide-container">
        <div class="f-stats-grid">
            @foreach($stats as $stat)
            <div data-aos="fade-up">
                <span class="f-stat-number" data-count="{{ (int)$stat->value }}" data-suffix="{{ $stat->suffix }}">{{ $stat->value }}{{ $stat->suffix }}</span>
                <span class="f-stat-label-text">{{ $stat->title }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =============== SECTION 5: HIGHLIGHTED RESCOM CORPORATE PRESENTATION DECK =============== -->
<section class="f-presentation-section" id="presentation-deck">
    <div class="f-pres-bg-grid"></div>
    <div class="f-pres-orb-1"></div>
    <div class="f-pres-orb-2"></div>

    <div class="f-wide-container">
        <div class="f-pres-layout">
            <!-- Left Column: Presentation Overview & Feature Pills -->
            <div data-aos="fade-right">
                <div class="f-pres-badge-beacon">
                    <span class="f-radar-dot"></span>
                    <span class="f-pres-badge-title">OFFICIAL CORPORATE PRESENTATION</span>
                    <span class="f-badge-divider"></span>
                    <span class="f-pres-badge-tag"><i class="fas fa-sparkles"></i> 3D SLIDE ENGINE</span>
                </div>

                <h2 class="f-pres-heading">
                    Experience Rescom in Full Motion — <span class="f-gradient-text">Interactive Slide Deck</span>
                </h2>

                <p class="f-pres-desc">
                    Explore our unified digital ecosystem, multi-product architecture (EDXcore, MKTcore, RELcore, WEBcore, OPScore, LEAP & more), technology stacks, and enterprise roadmap in a full 3D interactive presentation environment.
                </p>

                <!-- 4 Cyber Feature Pills -->
                <div class="f-pres-pills-grid">
                    <div class="f-pres-pill-item">
                        <div class="f-pres-pill-icon"><i class="fas fa-cube"></i></div>
                        <div>
                            <div class="f-pres-pill-title">3D Space Canvas Engine</div>
                            <div class="f-pres-pill-sub">Realtime particle mesh & audio</div>
                        </div>
                    </div>

                    <div class="f-pres-pill-item">
                        <div class="f-pres-pill-icon"><i class="fas fa-layer-group"></i></div>
                        <div>
                            <div class="f-pres-pill-title">15+ Product Ecosystems</div>
                            <div class="f-pres-pill-sub">Interactive sandbox breakdowns</div>
                        </div>
                    </div>

                    <div class="f-pres-pill-item">
                        <div class="f-pres-pill-icon"><i class="fas fa-shield-halved"></i></div>
                        <div>
                            <div class="f-pres-pill-title">Zero-Trust Security</div>
                            <div class="f-pres-pill-sub">ISO 9001 certified architecture</div>
                        </div>
                    </div>

                    <div class="f-pres-pill-item">
                        <div class="f-pres-pill-icon"><i class="fas fa-chart-line"></i></div>
                        <div>
                            <div class="f-pres-pill-title">Global Vision & Scale</div>
                            <div class="f-pres-pill-sub">20+ Countries & Roadmap</div>
                        </div>
                    </div>
                </div>

                <!-- Telemetry Stats Strip -->
                <div class="f-pres-stats-row">
                    <div class="f-pres-stat-badge">
                        <i class="fas fa-laptop-code"></i>
                        <span>50+ Interactive Slides</span>
                    </div>
                    <div class="f-pres-stat-badge">
                        <i class="fas fa-expand"></i>
                        <span>Fullscreen HD & Touch</span>
                    </div>
                    <div class="f-pres-stat-badge">
                        <i class="fas fa-bolt"></i>
                        <span>Instant Loading</span>
                    </div>
                </div>

                <!-- CTA Actions -->
                <div class="f-pres-actions">
                    <a href="{{ route('presentation.show', 'rescom-presentation') }}" target="_blank" class="f-pres-btn-primary" id="launchPresentationBtn">
                        <i class="fas fa-desktop"></i>
                        <span>Launch Fullscreen Deck</span>
                        <i class="fas fa-arrow-up-right-from-square" style="font-size:13px"></i>
                    </a>

                    <button type="button" class="f-pres-btn-secondary" id="previewDeckBtn">
                        <i class="fas fa-circle-play"></i>
                        <span>Quick Interactive Preview</span>
                    </button>
                </div>
            </div>

            <!-- Right Column: Futuristic Holographic HUD Preview Mockup -->
            <div data-aos="fade-left">
                <a href="{{ route('presentation.show', 'rescom-presentation') }}" target="_blank" class="f-pres-hud-card" title="Click to Launch Full Interactive Presentation">
                    <span class="f-hud-cross tl"></span>
                    <span class="f-hud-cross tr"></span>
                    <span class="f-hud-cross bl"></span>
                    <span class="f-hud-cross br"></span>

                    <!-- Top HUD Status -->
                    <div class="f-hud-top-bar">
                        <div class="f-hud-status-live">
                            <span class="f-hud-live-dot"></span>
                            <span>DECK STATUS: ONLINE</span>
                        </div>
                        <div><span>FPS: 60</span> &bull; <span>DECK: V3.2</span></div>
                    </div>

                    <!-- Visual Stage Area -->
                    <div class="f-pres-visual-stage">
                        <div class="f-pres-orbit-ring"></div>

                        <!-- Central Illuminated Official Rescom Logo -->
                        <div class="f-pres-center-logo">
                            <img src="https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/KNR-WEBSITE_f817360c-0c15-4992-bc1b-4df24f071612_KNR-Logo.png" alt="Rescom">
                        </div>

                        <h3 class="f-pres-stage-title">RESCOM</h3>
                        <p class="f-pres-stage-sub">Global Digital Ecosystem &bull; Enterprise Deck</p>

                        <!-- Hover Overlay -->
                        <div class="f-pres-hover-overlay">
                            <div class="f-pres-play-circle">
                                <i class="fas fa-play" style="margin-left:3px"></i>
                            </div>
                            <span class="f-pres-hover-text">Click to Launch Live Interactive Presentation</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =============== INTERACTIVE PRESENTATION LIGHTBOX MODAL =============== -->
<div class="f-pres-modal" id="presentationModal" aria-hidden="true">
    <div class="f-pres-modal-header">
        <div class="f-pres-modal-title">
            <i class="fas fa-desktop" style="color:#00f0ff"></i>
            <span>Rescom — Corporate Interactive Presentation</span>
        </div>
        <div class="f-pres-modal-controls">
            <a href="{{ route('presentation.show', 'rescom-presentation') }}" target="_blank" class="f-pres-modal-btn" title="Open Fullscreen in New Window">
                <i class="fas fa-expand"></i>
                <span>Open Fullscreen</span>
            </a>
            <button type="button" class="f-pres-modal-close" id="closePresentationModal" aria-label="Close Preview">&times;</button>
        </div>
    </div>
    <div class="f-pres-modal-body">
        <iframe src="" data-src="{{ route('presentation.show', 'rescom-presentation') }}" class="f-pres-iframe" id="presIframe" title="Rescom Corporate Presentation"></iframe>
    </div>
</div>

<!-- =============== SECTION 6: LEADERSHIP TEAM (FULL WIDTH) =============== -->
<section class="f-team-section">
    <div class="f-wide-container">
        <div style="text-align:center;margin-bottom:44px" data-aos="fade-up">
            <div class="f-section-badge"><i class="fas fa-users"></i> Executive Leadership</div>
            <h2 class="f-section-title" style="margin-bottom:12px">The Leadership Team Behind Rescom</h2>
            <p style="color:#64748b;font-size:15px;max-width:640px;margin:0 auto">Experienced real estate leaders, architects, and structural engineering directors driving excellence across every property.</p>
        </div>

        <div class="f-team-grid">
            @foreach($team as $i => $member)
            @if($i == 0 || $i >= 4)
            <a href="{{ route('team.show', $member) }}" class="f-team-card" data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 80 }}">
                <div class="f-team-avatar-bay">
                    @if($member->photo)
                    <img src="{{ media_url($member->photo) }}" alt="{{ $member->name }}">
                    @else
                    <div style="font-size:50px;color:#0284c7;opacity:0.4"><i class="fas fa-user-tie"></i></div>
                    @endif
                </div>

                <h4 class="f-team-name">{{ $member->name }}</h4>
                <p class="f-team-role">{{ $member->designation }}</p>

                @if($member->bio)
                <p class="f-team-bio">{{ Str::limit($member->bio, 80) }}</p>
                @endif
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>

<!-- =============== SECTION 7: WHY CHOOSE RESCOM (FULL WIDTH) =============== -->
<section class="f-advantage-section">
    <div class="f-wide-container">
        <div style="margin-bottom:40px" data-aos="fade-up">
            <div class="f-section-badge"><i class="fas fa-trophy"></i> Strategic Advantage</div>
            <h2 class="f-section-title">Why Homeowners & Investors Choose Rescom</h2>
        </div>

        <div class="f-advantage-grid">
            @foreach([
                ['fas fa-certificate','#0284c7','RERA & Legal Compliance','100% verified property titles, statutory municipal approvals, and complete regulatory transparency on every project.'],
                ['fas fa-city','#10b981','Prime Commercial & Residential Hubs','Strategic property locations with high rental yields, seamless connectivity, and long-term capital appreciation.'],
                ['fas fa-drafting-compass','#f59e0b','Architectural & Structural Rigor','In-house certified architects and structural engineers delivering durable, aesthetically inspiring spaces.'],
                ['fas fa-screwdriver-wrench','#ef4444','Lifecycle Building Maintenance','Comprehensive post-handover facility care, preventive structural maintenance, and round-the-clock property management.'],
                ['fas fa-hand-holding-dollar','#8b5cf6','Transparent Value & Pricing','Clear financial structures, honest pricing without hidden costs, and competitive investment advisory.'],
                ['fas fa-handshake','#06b6d4','End-to-End Client Service','From initial site visits and legal vetting to interior design and key handover, we manage every detail seamlessly.'],
            ] as [$icon,$color,$title,$desc])
            <div class="f-advantage-card" data-aos="fade-up">
                <div class="f-advantage-icon-bay" style="background:{{ $color }}18;color:{{ $color }};border:1px solid {{ $color }}35">
                    <i class="{{ $icon }}"></i>
                </div>
                <h3 class="f-advantage-title">{{ $title }}</h3>
                <p class="f-advantage-desc">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =============== SECTION 8: TRUSTED CLIENTS (FULL WIDTH) =============== -->
<section class="f-trust-section">
    <div class="f-wide-container">
        <div style="margin-bottom:32px" data-aos="fade-up">
            <div class="f-section-badge"><i class="fas fa-handshake"></i> Verified Partnerships</div>
            <h2 class="f-section-title">Organizations That Trust Our Technology</h2>
        </div>

        <div class="f-trust-grid">
            @foreach($clients as $client)
            <div class="f-trust-card" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 6) * 50 }}">
                @if(!empty($client->logo))
                <img class="f-trust-logo" src="{{ media_url($client->logo) }}" alt="{{ $client->name }}">
                @else
                <div style="width:28px;height:28px;border-radius:6px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0">
                    <i class="fas fa-building"></i>
                </div>
                @endif

                @if(!empty($client->website_url))
                <a href="{{ $client->website_url }}" target="_blank" rel="noopener noreferrer" class="f-trust-name">{{ $client->name }}</a>
                @else
                <span class="f-trust-name">{{ $client->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =============== FUTURISTIC BOTTOM CTA BANNER (FULL WIDTH) =============== -->
<section class="futuristic-cta-banner" data-aos="fade-up">
    <div class="f-wide-container">
        <div class="f-cta-box">
            <h2 class="f-cta-title">Ready to Find Your Ideal Property or Build Your Next Project?</h2>
            <p class="f-cta-desc">
                Connect with our experienced property advisors, architects, and engineering consultants to turn your real estate vision into reality.
            </p>
            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
                <a href="{{ route('contact') }}" class="f-btn-primary">
                    <i class="fas fa-comments"></i>
                    <span>Book Free Consultation</span>
                </a>
                <a href="{{ route('portfolio') }}" class="f-btn-secondary">
                    <i class="fas fa-building"></i>
                    <span>Explore Properties</span>
                </a>
                <a href="{{ route('presentation.show', 'rescom-presentation') }}" target="_blank" class="f-btn-secondary" style="background:#070d1d;color:#38bdf8 !important;border-color:rgba(56,189,248,0.4)">
                    <i class="fas fa-desktop"></i>
                    <span>Launch Deck</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const previewBtn = document.getElementById('previewDeckBtn');
    const modal = document.getElementById('presentationModal');
    const closeBtn = document.getElementById('closePresentationModal');
    const iframe = document.getElementById('presIframe');

    if (previewBtn && modal && iframe) {
        previewBtn.addEventListener('click', () => {
            if (!iframe.src || iframe.src === 'about:blank' || iframe.src === window.location.href) {
                iframe.src = iframe.getAttribute('data-src');
            }
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        });

        const closeModal = () => {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        };

        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
});
</script>
@endsection
