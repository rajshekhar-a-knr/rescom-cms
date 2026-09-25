@extends('layouts.app')

@section('title', 'Request Product Demo - Live Enterprise Sandboxes | Rescom')
@section('meta_description', 'Experience Rescom products in live sandbox environments. Request instant demo credentials, explore dashboards and workflows, and find the perfect enterprise solution.')

@section('content')
@php
    $productCount = $products->count();
    $categories = $products->pluck('category')->filter()->unique()->values();
    $hasDemoRequestErrors = $errors->has('full_name')
        || $errors->has('email')
        || $errors->has('phone')
        || $errors->has('organization');
@endphp

<!-- =============== FUTURISTIC DEMO HERO (DARK CYBER THEME) =============== -->
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

        /* Hero Container */
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

        .f-hero-wide-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 100%;
            padding: 0 clamp(20px, 5vw, 90px);
            margin: 0 auto;
        }

        /* HUD Live Beacon Badge */
        .f-hud-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 18px;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(56, 189, 248, 0.25);
            border-radius: 999px;
            backdrop-filter: blur(12px);
            margin-bottom: 22px;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.15);
        }
        .f-radar-dot {
            width: 8px;
            height: 8px;
            background: #38bdf8;
            border-radius: 50%;
            box-shadow: 0 0 10px #38bdf8;
            animation: fRadarPulse 2s infinite;
        }
        @keyframes fRadarPulse {
            0% { box-shadow: 0 0 0 0 rgba(56, 189, 248, 0.7); }
            70% { box-shadow: 0 0 0 8px rgba(56, 189, 248, 0); }
            100% { box-shadow: 0 0 0 0 rgba(56, 189, 248, 0); }
        }
        .f-badge-subtitle {
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #38bdf8;
            font-family: 'Space Grotesk', -apple-system, sans-serif;
        }
        .f-badge-divider {
            width: 1px;
            height: 12px;
            background: rgba(255, 255, 255, 0.2);
        }
        .f-badge-tag {
            font-size: 11.5px;
            font-weight: 600;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Headline & Paragraph */
        .f-hero-title {
            font-size: clamp(34px, 5.2vw, 62px);
            font-weight: 900;
            line-height: 1.12;
            letter-spacing: -0.035em;
            color: #ffffff;
            margin-bottom: 20px;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }
        .f-gradient-text {
            background: linear-gradient(135deg, #38bdf8 0%, #818cf8 50%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .f-hero-desc {
            font-size: clamp(15.5px, 1.8vw, 18px);
            line-height: 1.7;
            color: #cbd5e1;
            max-width: 880px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 32px;
            font-weight: 400;
        }

        /* Hero Telemetry Pill Bar */
        .f-catalog-stats {
            display: inline-flex;
            align-items: center;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            padding: 8px 24px;
            backdrop-filter: blur(12px);
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 25px;
        }
        .f-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            color: #94a3b8;
        }
        .f-stat-val {
            font-weight: 800;
            color: #38bdf8;
            font-size: 14px;
        }
        .f-stat-sep {
            width: 1px;
            height: 14px;
            background: rgba(255, 255, 255, 0.15);
        }

        /* Hero Quick Action Buttons */
        .f-hero-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }
        .f-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff !important;
            padding: 13px 28px;
            border-radius: 12px;
            font-size: 14.5px;
            font-weight: 750;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(2, 132, 199, 0.35);
            transition: all 0.3s ease;
        }
        .f-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(2, 132, 199, 0.5);
        }
        .f-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff !important;
            padding: 13px 26px;
            border-radius: 12px;
            font-size: 14.5px;
            font-weight: 700;
            text-decoration: none;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .f-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.16);
            border-color: #38bdf8;
            transform: translateY(-2px);
        }

        /* ===== FULL-WIDTH ADVANCED BODY SECTION ===== */
        .futuristic-demo-section {
            width: 100%;
            background: #f8fafc;
            padding: clamp(50px, 7vw, 90px) 0;
            position: relative;
            overflow: hidden;
        }
        .f-demo-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.035) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }
        .f-wide-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 clamp(20px, 4.5vw, 80px);
            position: relative;
            z-index: 2;
        }

        /* 4-Column Feature Highlights Ribbon */
        .f-demo-ribbon {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: clamp(16px, 2vw, 28px);
            margin-bottom: 50px;
            width: 100%;
        }
        @media (max-width: 1024px) {
            .f-demo-ribbon {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 640px) {
            .f-demo-ribbon {
                grid-template-columns: 1fr;
            }
        }
        .f-ribbon-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .f-ribbon-card:hover {
            transform: translateY(-4px);
            border-color: #38bdf8;
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.12);
        }
        .f-ribbon-icon-bay {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.1) 0%, rgba(56, 189, 248, 0.15) 100%);
            border: 1px solid rgba(56, 189, 248, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #0284c7;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }
        .f-ribbon-card:hover .f-ribbon-icon-bay {
            background: #0284c7;
            color: #ffffff;
            transform: scale(1.06) rotate(5deg);
        }
        .f-ribbon-title {
            font-size: 14.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 3px;
        }
        .f-ribbon-desc {
            font-size: 12.5px;
            color: #64748b;
            line-height: 1.4;
        }

        /* Filter Section Header */
        .f-catalog-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }
        .f-catalog-heading {
            font-size: clamp(24px, 3.2vw, 36px);
            font-weight: 850;
            color: #0f172a;
            letter-spacing: -0.02em;
            margin: 0;
        }
        .f-catalog-subheading {
            font-size: 14.5px;
            color: #64748b;
            margin-top: 6px;
        }

        /* Filter Pills */
        .f-filter-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            background: #ffffff;
            padding: 6px;
            border-radius: 999px;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        }
        .f-filter-btn {
            background: transparent;
            border: none;
            padding: 8px 18px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 750;
            color: #64748b;
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .f-filter-btn:hover {
            color: #0284c7;
            background: rgba(2, 132, 199, 0.08);
        }
        .f-filter-btn.active {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
        }

        /* Demo Product Cards Grid */
        .f-demo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 28px;
            margin-bottom: 60px;
        }
        @media (max-width: 640px) {
            .f-demo-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ===== FUTURISTIC WHITE PRODUCT CARD (MATCHING PORTFOLIO) ===== */
        .f-demo-card {
            position: relative;
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.9);
            border-radius: 22px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(0, 0, 0, 0.03);
        }
        .f-demo-card:hover {
            transform: translateY(-8px) scale(1.015);
            border-color: #0284c7;
            box-shadow: 
                0 22px 50px -10px rgba(14, 165, 233, 0.2),
                0 0 25px rgba(56, 189, 248, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        /* Top Display Bay with Circuit Grid */
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
            background-image: radial-gradient(rgba(14, 165, 233, 0.09) 1.5px, transparent 1.5px);
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
        .f-demo-card:hover .f-card-img {
            transform: scale(1.08);
            filter: drop-shadow(0 6px 16px rgba(37, 99, 235, 0.15));
        }
        .f-media-fallback-icon {
            font-size: 55px;
            color: #0284c7;
            opacity: 0.35;
            transition: transform 0.4s ease;
            position: relative;
            z-index: 2;
        }
        .f-demo-card:hover .f-media-fallback-icon {
            transform: scale(1.1) rotate(5deg);
            opacity: 0.7;
        }

        /* Badges */
        .f-card-cat-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(14, 165, 233, 0.35);
            color: #0369a1;
            padding: 4px 12px;
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
            gap: 6px;
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
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            border: 1px solid rgba(254, 215, 170, 0.4);
            color: #ffffff;
            padding: 4px 11px;
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

        /* Target Reticle Corners on Hover */
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
        .f-demo-card:hover .f-card-corner {
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
            font-size: 19px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 8px;
            transition: color 0.2s ease;
        }
        .f-demo-card:hover .f-card-title {
            color: #0284c7;
        }
        .f-card-client {
            font-size: 12.5px;
            font-weight: 650;
            color: #0284c7;
            margin-bottom: 12px;
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

        /* Tech / Feature Chips */
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
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .f-demo-card:hover .f-card-chip {
            background: #e0f2fe;
            border-color: #bae6fd;
            color: #0369a1;
        }

        /* 3 Action Buttons in 1 Clean Row */
        .f-card-actions-row {
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            margin-top: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 7px;
            align-items: stretch;
            width: 100%;
        }
        .f-btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 10px 4px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 750;
            line-height: 1.2;
            text-decoration: none;
            border: 1.5px solid transparent;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            text-align: center;
            min-width: 0;
            white-space: nowrap;
        }
        .f-btn-action span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .f-btn-action i {
            font-size: 11px;
            flex-shrink: 0;
        }

        /* 1. Request Demo (Primary Blue Cyber Button) */
        .f-btn-action-primary {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff !important;
            border: none;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.32);
        }
        .f-btn-action-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.48);
            background: linear-gradient(135deg, #0369a1 0%, #1d4ed8 100%);
        }

        /* 2. Presentation (Executive Dark Deck Button) */
        .f-btn-action-deck {
            background: #0f172a;
            color: #ffffff !important;
            border: 1px solid rgba(56, 189, 248, 0.35);
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12);
        }
        .f-btn-action-deck i {
            color: #38bdf8;
        }
        .f-btn-action-deck:hover {
            transform: translateY(-2px);
            background: #1e293b;
            border-color: #38bdf8;
            color: #38bdf8 !important;
            box-shadow: 0 6px 20px rgba(56, 189, 248, 0.28);
        }

        /* 3. Direct / Live Portal (Clean Crystal Button) */
        .f-btn-action-portal {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            color: #0f172a !important;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        }
        .f-btn-action-portal i {
            color: #0284c7;
        }
        .f-btn-action-portal:hover {
            transform: translateY(-2px);
            background: #f0fdf4;
            border-color: #10b981;
            color: #047857 !important;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.2);
        }
        .f-btn-action-portal:hover i {
            color: #10b981;
        }

        @media (max-width: 480px) {
            .f-card-actions-row {
                grid-template-columns: repeat(3, 1fr);
                gap: 5px;
            }
            .f-btn-action {
                padding: 9px 3px;
                font-size: 10.5px;
                gap: 3px;
            }
        }
        @media (max-width: 380px) {
            .f-card-actions-row {
                grid-template-columns: 1fr;
                gap: 6px;
            }
            .f-btn-action {
                padding: 10px 8px;
                font-size: 12px;
            }
        }

        /* 3-Step Demo Architecture Roadmap */
        .f-steps-section {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 28px;
            padding: clamp(30px, 4vw, 48px);
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.04);
            margin-bottom: 50px;
        }
        .f-steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 30px;
        }
        @media (max-width: 900px) {
            .f-steps-grid {
                grid-template-columns: 1fr;
            }
        }
        .f-step-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 20px;
            padding: 26px;
            position: relative;
            transition: all 0.3s ease;
        }
        .f-step-card:hover {
            border-color: #0284c7;
            background: #ffffff;
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.1);
        }
        .f-step-num {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 850;
            font-size: 15px;
            margin-bottom: 16px;
        }
        .f-step-title {
            font-size: 17px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .f-step-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        /* ===== FUTURISTIC MODALS ===== */
        .f-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .f-modal-overlay.open {
            display: flex;
        }
        .f-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(6, 11, 24, 0.8);
            backdrop-filter: blur(12px);
        }
        .f-modal-window {
            position: relative;
            z-index: 2;
            width: min(560px, 100%);
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 28px;
            padding: clamp(28px, 4vw, 40px);
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.35);
            max-height: calc(100vh - 40px);
            overflow-y: auto;
        }
        .f-modal-close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 50%;
            background: #f1f5f9;
            color: #0f172a;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .f-modal-close-btn:hover {
            background: #e2e8f0;
            transform: rotate(90deg);
        }
        .f-modal-icon-bay {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.12) 0%, rgba(56, 189, 248, 0.2) 100%);
            border: 1px solid rgba(56, 189, 248, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #0284c7;
            margin-bottom: 18px;
        }
        .f-modal-title {
            font-size: 24px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .f-modal-subtitle {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .f-modal-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 16px;
        }
        @media (max-width: 580px) {
            .f-modal-grid-2 {
                grid-template-columns: 1fr;
            }
        }
        .f-modal-group {
            margin-bottom: 16px;
        }
        .f-modal-label {
            display: block;
            font-size: 13px;
            font-weight: 750;
            color: #1e293b;
            margin-bottom: 6px;
        }
        .f-modal-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            font-size: 14px;
            color: #0f172a;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s ease;
        }
        .f-modal-input:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 3.5px rgba(14, 165, 233, 0.15);
        }

        .f-modal-submit-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 60%, #06b6d4 100%);
            color: #ffffff !important;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35);
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .f-modal-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(37, 99, 235, 0.5);
        }

        /* Cinematic Video Modal */
        .f-video-modal-window {
            position: relative;
            z-index: 2;
            width: min(1000px, 100%);
            background: #020617;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 32px 100px rgba(0, 0, 0, 0.6);
        }
        .f-video-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: #0f172a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .f-video-modal-title {
            font-size: 17px;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .f-video-modal-close {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #ffffff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }
        .f-video-modal-close:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        .f-video-modal-player {
            width: 100%;
            max-height: min(70vh, 600px);
            display: block;
            background: #000000;
        }

        /* Presentation Deck Modal */
        .f-presentation-modal-window {
            position: relative;
            z-index: 2;
            width: min(940px, 100%);
            background: #0b1329;
            border: 1.5px solid rgba(56, 189, 248, 0.35);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 32px 100px rgba(0, 0, 0, 0.75), 0 0 50px rgba(14, 165, 233, 0.15);
            color: #ffffff;
            animation: fModalPop 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
        }
        .f-presentation-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 26px;
            background: #0f172a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .f-presentation-title-group {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .f-presentation-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(56, 189, 248, 0.15);
            border: 1px solid rgba(56, 189, 248, 0.35);
            color: #38bdf8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .f-presentation-title {
            font-size: 19px;
            font-weight: 800;
            margin: 0;
            color: #ffffff;
            line-height: 1.25;
        }
        .f-presentation-category {
            font-size: 11px;
            font-weight: 800;
            color: #38bdf8;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 2px;
        }
        .f-presentation-body {
            padding: 26px;
            max-height: 75vh;
            overflow-y: auto;
        }
        .f-deck-stage {
            background: #020617;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 24px;
            position: relative;
            margin-bottom: 22px;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        .f-deck-slide-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .f-deck-tab {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.75);
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 750;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .f-deck-tab:hover, .f-deck-tab.active {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            border-color: #38bdf8;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
        }
        .f-deck-slide-panel {
            display: none;
        }
        .f-deck-slide-panel.active {
            display: block;
            animation: fFadeIn 0.3s ease;
        }
        .f-deck-slide-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            color: #38bdf8;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .f-deck-slide-title {
            font-size: 22px;
            font-weight: 850;
            color: #ffffff;
            margin: 0 0 12px;
            line-height: 1.3;
        }
        .f-deck-slide-desc {
            font-size: 15px;
            color: #94a3b8;
            line-height: 1.65;
            margin-bottom: 20px;
        }
        .f-deck-features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 14px;
        }
        .f-deck-feature-item {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 650;
            color: #e2e8f0;
        }
        .f-deck-metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-top: 16px;
        }
        @media (max-width: 640px) {
            .f-deck-metrics-grid {
                grid-template-columns: 1fr;
            }
        }
        .f-deck-metric-box {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 14px;
            padding: 16px;
            text-align: center;
        }
        .f-deck-metric-val {
            font-size: 24px;
            font-weight: 900;
            color: #38bdf8;
            line-height: 1;
            margin-bottom: 6px;
        }
        .f-deck-metric-label {
            font-size: 12px;
            color: #94a3b8;
            font-weight: 600;
        }
        .f-presentation-footer-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .f-presentation-btn-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
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
            <span class="f-badge-subtitle">LIVE DEMO LABS & PLATFORM SANDBOX</span>
            <span class="f-badge-divider"></span>
            <span class="f-badge-tag"><i class="fas fa-bolt"></i> INSTANT CREDENTIAL PROVISIONING</span>
        </div>

        <!-- Headline -->
        <h1 class="f-hero-title" data-aos="fade-up">
            Experience Next-Gen <span class="f-gradient-text">Software Platforms in Action</span>
        </h1>

        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            Test-drive our enterprise solutions in isolated live sandboxes. Explore production-grade dashboards, automated workflows, and administrative consoles before making your strategic investment.
        </p>

        <!-- Catalog Telemetry Capsule -->
        <div class="f-catalog-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="f-stat-item">
                <span class="f-stat-val">{{ $productCount }}+</span>
                <span>Demo Suites Available</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">&lt; 60s</span>
                <span>Automated Delivery</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">100%</span>
                <span>Isolated Sandbox Security</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">Zero</span>
                <span>Commitment Required</span>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="f-hero-actions" data-aos="fade-up" data-aos-delay="300">
            <a href="#demoCatalog" class="f-btn-primary">
                <span>Explore Demo Suites</span>
                <i class="fas fa-arrow-down"></i>
            </a>
            <a href="{{ route('contact') }}" class="f-btn-secondary">
                <i class="fas fa-headset"></i>
                <span>Talk to Technical Lead</span>
            </a>
        </div>
    </div>
</section>

<!-- =============== FULL-WIDTH ADVANCED BODY SECTION =============== -->
<section class="futuristic-demo-section" id="demoCatalog">
    <div class="f-demo-grid-mesh"></div>

    <div class="f-wide-container">
        <!-- 4-Column Feature Highlights Ribbon -->
        <div class="f-demo-ribbon" data-aos="fade-up">
            <div class="f-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fas fa-desktop"></i></div>
                <div>
                    <div class="f-ribbon-title">Live Sandbox Access</div>
                    <div class="f-ribbon-desc">Pre-populated with production-like datasets for hands-on evaluation.</div>
                </div>
            </div>

            <div class="f-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fas fa-key"></i></div>
                <div>
                    <div class="f-ribbon-title">Instant Credentials</div>
                    <div class="f-ribbon-desc">Direct automated login tokens securely transmitted to your inbox.</div>
                </div>
            </div>

            <div class="f-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fas fa-shield-halved"></i></div>
                <div>
                    <div class="f-ribbon-title">Secure & Isolated</div>
                    <div class="f-ribbon-desc">Isolated multi-tenant sandboxes guarded with enterprise encryption.</div>
                </div>
            </div>

            <div class="f-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fas fa-user-astronaut"></i></div>
                <div>
                    <div class="f-ribbon-title">Architect Support</div>
                    <div class="f-ribbon-desc">Option to schedule 1-on-1 technical walkthroughs with solution leads.</div>
                </div>
            </div>
        </div>

        <!-- Notifications & Flash Messages -->
        @if(session('demo_success'))
            <div class="alert alert-success" style="background:#f0fdf4;border:1.5px solid #86efac;color:#166534;padding:16px 22px;border-radius:16px;margin-bottom:30px;display:flex;align-items:center;gap:12px;font-weight:750" data-aos="fade-up">
                <i class="fas fa-check-circle" style="font-size:22px;color:#16a34a"></i>
                <span>{{ session('demo_success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error" style="background:#fef2f2;border:1.5px solid #fca5a5;color:#991b1b;padding:16px 22px;border-radius:16px;margin-bottom:30px;display:flex;align-items:center;gap:12px;font-weight:750" data-aos="fade-up">
                <i class="fas fa-exclamation-triangle" style="font-size:22px;color:#dc2626"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Catalog Header & Dynamic Filters -->
        <div class="f-catalog-header" data-aos="fade-up">
            <div>
                <h2 class="f-catalog-heading">Select a Platform to Test-Drive</h2>
                <p class="f-catalog-subheading">Choose any active enterprise platform below to receive instant sandbox login details.</p>
            </div>

            @if($categories->count() > 1)
            <div class="f-filter-pills">
                <button type="button" class="f-filter-btn active" data-filter="all">All Suites ({{ $productCount }})</button>
                @foreach($categories as $cat)
                <button type="button" class="f-filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Demo Products Grid -->
        @if($products->count())
            <div class="f-demo-grid" data-aos="fade-up">
                @foreach($products as $product)
                    <article class="f-demo-card" data-category="{{ Str::slug($product->category ?: 'general') }}">
                        <!-- Top Preview Bay (Matching Portfolio card with dot grid) -->
                        <div class="f-card-preview-bay">
                            <div class="f-card-circuit"></div>

                            <!-- Target Corners for futuristic interactive hover -->
                            <span class="f-card-corner f-corner-tl"></span>
                            <span class="f-card-corner f-corner-tr"></span>
                            <span class="f-card-corner f-corner-bl"></span>
                            <span class="f-card-corner f-corner-br"></span>

                            <!-- Category Pill Badge -->
                            <div class="f-card-cat-badge">
                                <span class="f-cat-dot"></span>
                                <span>{{ $product->category ?: 'Ed-tech' }}</span>
                            </div>

                            <!-- Featured / Live Badge -->
                            <div class="f-card-featured-badge">
                                <i class="fas fa-star" style="font-size:10px"></i> <span>Featured</span>
                            </div>

                            @if($product->image)
                                <img src="{{ media_url($product->image) }}" alt="{{ $product->title }}" class="f-card-img">
                            @else
                                <div class="f-media-fallback-icon"><i class="fas fa-cubes"></i></div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="f-card-body">
                            <div>
                                <h3 class="f-card-title">{{ $product->title }}</h3>

                                <div class="f-card-client">
                                    <i class="fas fa-building"></i>
                                    <span>Top Leading solutions</span>
                                </div>

                                <p class="f-card-desc">{{ $product->short_description ?: 'A comprehensive enterprise digital platform connecting users, administrators, and stakeholders through a centralized digital ecosystem.' }}</p>

                                @if(!empty($product->features))
                                    <div class="f-card-chips">
                                        @foreach(array_slice($product->features, 0, 4) as $feature)
                                            <span class="f-card-chip">{{ $feature }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="f-card-actions-row">
                                <!-- 1. Request Demo -->
                                <button type="button"
                                        class="f-btn-action f-btn-action-primary"
                                        data-demo-open
                                        data-action="{{ route('demo-products.request', $product) }}"
                                        data-title="{{ $product->title }}"
                                        data-description="{{ $product->short_description ?: 'Enter your details below to receive instant sandbox access keys for ' . $product->title . '.' }}"
                                        title="Request Instant Demo Credentials">
                                    <i class="fas fa-key"></i>
                                    <span>Request Demo</span>
                                </button>

                                <!-- 2. Presentation (Interactive Slide Deck) -->
                                <a href="{{ route('presentation.show', $product->slug) }}"
                                   target="_blank"
                                   class="f-btn-action f-btn-action-deck"
                                   title="Launch Full-Screen Interactive Presentation">
                                    <i class="fas fa-desktop"></i>
                                    <span>Presentation</span>
                                </a>

                                <!-- 3. Direct Portal / Live Sandbox -->
                                @if($product->demo_url)
                                    <a href="{{ $product->demo_url }}" class="f-btn-action f-btn-action-portal" target="_blank" rel="noopener noreferrer" title="Launch Direct Sandbox Portal">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>Direct Portal</span>
                                    </a>
                                @else
                                    <button type="button"
                                            class="f-btn-action f-btn-action-portal"
                                            data-demo-open
                                            data-action="{{ route('demo-products.request', $product) }}"
                                            data-title="{{ $product->title }}"
                                            data-description="{{ $product->short_description ?: 'Access instant live sandbox keys for ' . $product->title . '.' }}"
                                            title="Launch Live Sandbox Access">
                                        <i class="fas fa-rocket"></i>
                                        <span>Live Portal</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="f-steps-section" style="text-align:center;padding:60px 20px" data-aos="fade-up">
                <div style="width:64px;height:64px;border-radius:20px;background:rgba(2,132,199,0.1);color:#0284c7;display:inline-flex;align-items:center;justify-content:center;font-size:28px;margin-bottom:18px">
                    <i class="fas fa-server"></i>
                </div>
                <h3 style="font-size:22px;font-weight:850;color:#0f172a;margin-bottom:8px">No Live Sandboxes Currently Provisioned</h3>
                <p style="color:#64748b;max-width:550px;margin:0 auto 24px">Our engineers are updating the platform demo suites. You can request a personalized walkthrough directly from our solutions architects.</p>
                <a href="{{ route('contact') }}" class="f-btn-primary" style="display:inline-flex">
                    <i class="fas fa-headset"></i>
                    <span>Contact Solutions Architect</span>
                </a>
            </div>
        @endif

        <!-- 3-Step Demo Architecture Roadmap -->
        <div class="f-steps-section" data-aos="fade-up">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:6px">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(2,132,199,0.1);color:#0284c7;display:flex;align-items:center;justify-content:center;font-size:16px">
                    <i class="fas fa-network-wired"></i>
                </div>
                <h3 style="font-size:20px;font-weight:850;color:#0f172a;margin:0">How Our Enterprise Demo Pipeline Works</h3>
            </div>
            <p style="color:#64748b;font-size:14px;margin:0">A frictionless 3-step evaluation journey designed for technical decision makers.</p>

            <div class="f-steps-grid">
                <div class="f-step-card">
                    <div class="f-step-num">01</div>
                    <h4 class="f-step-title">Select Platform Suite</h4>
                    <p class="f-step-desc">Pick the relevant platform from our catalog based on your industry, scale, and operational requirements.</p>
                </div>

                <div class="f-step-card">
                    <div class="f-step-num">02</div>
                    <h4 class="f-step-title">Instant Token Delivery</h4>
                    <p class="f-step-desc">Our automated provisioning pipeline generates dedicated credentials and transmits them directly to your business email.</p>
                </div>

                <div class="f-step-card">
                    <div class="f-step-num">03</div>
                    <h4 class="f-step-title">Explore & Collaborate</h4>
                    <p class="f-step-desc">Access live dashboards, test capabilities with mock data, and collaborate with our technical team on custom deployment.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============== FUTURISTIC DEMO REQUEST MODAL =============== -->
<div class="f-modal-overlay {{ $hasDemoRequestErrors ? 'open' : '' }}" id="demoRequestModal" aria-hidden="{{ $hasDemoRequestErrors ? 'false' : 'true' }}">
    <div class="f-modal-backdrop" data-demo-close></div>
    <div class="f-modal-window" role="dialog" aria-modal="true" aria-labelledby="demoModalTitle">
        <button type="button" class="f-modal-close-btn" data-demo-close aria-label="Close">&times;</button>
        
        <div class="f-modal-icon-bay">
            <i class="fas fa-fingerprint"></i>
        </div>

        <h3 class="f-modal-title" id="demoModalTitle">Request Demo Access</h3>
        <p class="f-modal-subtitle" id="demoModalCopy">Provide your business email and organization details to receive instant automated credentials.</p>

        <form method="POST" id="demoRequestForm">
            @csrf

            <div class="f-modal-group">
                <label class="f-modal-label">Full Name *</label>
                <input type="text" name="full_name" class="f-modal-input" placeholder="e.g. Sarah Connor" value="{{ old('full_name') }}" required maxlength="255">
                @error('full_name')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="f-modal-grid-2">
                <div>
                    <label class="f-modal-label">Business Email *</label>
                    <input type="email" name="email" class="f-modal-input" placeholder="sarah@enterprise.com" value="{{ old('email') }}" required maxlength="255">
                    @error('email')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="f-modal-label">Phone Number *</label>
                    <input type="tel" name="phone" class="f-modal-input" placeholder="+91 98459 19158" value="{{ old('phone') }}" required maxlength="40">
                    @error('phone')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="f-modal-group">
                <label class="f-modal-label">Organization / Enterprise *</label>
                <input type="text" name="organization" class="f-modal-input" placeholder="Company or Institution name" value="{{ old('organization') }}" required maxlength="255">
                @error('organization')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="f-modal-submit-btn" id="demoSubmitBtn">
                <i class="fas fa-paper-plane"></i>
                <span>Transmit Demo Credentials</span>
            </button>

            <div style="display:flex;align-items:center;justify-content:center;gap:8px;font-size:12px;color:#64748b;margin-top:16px">
                <i class="fas fa-shield-check" style="color:#10b981"></i>
                <span>256-Bit Encrypted · Zero Spam Policy · Instant Delivery</span>
            </div>
        </form>
    </div>
</div>

<!-- =============== EXECUTIVE PRODUCT PRESENTATION MODAL =============== -->
<div class="f-modal-overlay" id="demoPresentationModal" aria-hidden="true">
    <div class="f-modal-backdrop" data-presentation-close></div>
    <div class="f-presentation-modal-window" role="dialog" aria-modal="true" aria-labelledby="presentationModalTitle">
        <!-- Modal Header -->
        <div class="f-presentation-header">
            <div class="f-presentation-title-group">
                <div class="f-presentation-icon">
                    <i class="fas fa-desktop"></i>
                </div>
                <div>
                    <div class="f-presentation-category" id="presentationModalCategory">Enterprise Platform</div>
                    <h3 class="f-presentation-title" id="presentationModalTitle">Product Presentation & Deck</h3>
                </div>
            </div>
            <button type="button" class="f-video-modal-close" data-presentation-close aria-label="Close presentation">&times;</button>
        </div>

        <!-- Modal Body & Interactive Deck Stage -->
        <div class="f-presentation-body">
            <div class="f-deck-stage">
                <!-- Slide Tabs -->
                <div class="f-deck-slide-tabs" role="tablist">
                    <button type="button" class="f-deck-tab active" data-deck-tab="overview">
                        <i class="fas fa-layer-group"></i> 1. Executive Summary
                    </button>
                    <button type="button" class="f-deck-tab" data-deck-tab="modules">
                        <i class="fas fa-cubes"></i> 2. Core Modules & Capabilities
                    </button>
                    <button type="button" class="f-deck-tab" data-deck-tab="security">
                        <i class="fas fa-shield-halved"></i> 3. Cloud Security & Scale
                    </button>
                    <button type="button" class="f-deck-tab" data-deck-tab="roi">
                        <i class="fas fa-chart-line"></i> 4. Business Impact & ROI
                    </button>
                    <button type="button" class="f-deck-tab" data-deck-tab="video" id="presentationVideoTabBtn" style="display:none">
                        <i class="fas fa-play-circle"></i> 5. Video Walkthrough
                    </button>
                </div>

                <!-- Slide 1: Executive Summary -->
                <div class="f-deck-slide-panel active" id="deckPanelOverview">
                    <div class="f-deck-slide-header">
                        <i class="fas fa-sparkles"></i> <span>Platform Overview</span>
                    </div>
                    <h4 class="f-deck-slide-title" id="deckOverviewTitle">Next-Gen Enterprise Engine</h4>
                    <p class="f-deck-slide-desc" id="deckOverviewDesc">Comprehensive enterprise digital platform built for scale, reliability, and automated operational efficiency.</p>
                    
                    <div class="f-deck-metrics-grid">
                        <div class="f-deck-metric-box">
                            <div class="f-deck-metric-val">100%</div>
                            <div class="f-deck-metric-label">Cloud-Native Architecture</div>
                        </div>
                        <div class="f-deck-metric-box">
                            <div class="f-deck-metric-val">&lt; 1.2s</div>
                            <div class="f-deck-metric-label">Sub-second Latency SLA</div>
                        </div>
                        <div class="f-deck-metric-box">
                            <div class="f-deck-metric-val">99.9%</div>
                            <div class="f-deck-metric-label">Enterprise High Availability</div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Core Modules & Features -->
                <div class="f-deck-slide-panel" id="deckPanelModules">
                    <div class="f-deck-slide-header">
                        <i class="fas fa-cubes"></i> <span>Key Capabilities & Functional Units</span>
                    </div>
                    <h4 class="f-deck-slide-title">Modular Engineering & Capabilities</h4>
                    <p class="f-deck-slide-desc">Designed with decoupled services and modern micro-frontends to integrate seamlessly into existing enterprise workflows.</p>
                    
                    <div class="f-deck-features-grid" id="deckFeaturesContainer">
                        <!-- Populated dynamically -->
                    </div>
                </div>

                <!-- Slide 3: Cloud Security & Scale -->
                <div class="f-deck-slide-panel" id="deckPanelSecurity">
                    <div class="f-deck-slide-header">
                        <i class="fas fa-lock"></i> <span>Enterprise Governance & Privacy</span>
                    </div>
                    <h4 class="f-deck-slide-title">Mission-Critical Security & Isolation</h4>
                    <p class="f-deck-slide-desc">Built upon industry gold-standard data protection protocols with zero-trust network boundaries.</p>
                    
                    <div class="f-deck-features-grid">
                        <div class="f-deck-feature-item">
                            <i class="fas fa-shield-check" style="color:#10b981;font-size:16px"></i>
                            <span>256-bit AES Data Encryption (Rest & Transit)</span>
                        </div>
                        <div class="f-deck-feature-item">
                            <i class="fas fa-user-shield" style="color:#10b981;font-size:16px"></i>
                            <span>Granular Role-Based Access Control (RBAC)</span>
                        </div>
                        <div class="f-deck-feature-item">
                            <i class="fas fa-database" style="color:#10b981;font-size:16px"></i>
                            <span>Automated Continuous Cloud Backups</span>
                        </div>
                        <div class="f-deck-feature-item">
                            <i class="fas fa-globe" style="color:#10b981;font-size:16px"></i>
                            <span>Global CDN & Edge Compute Acceleration</span>
                        </div>
                    </div>
                </div>

                <!-- Slide 4: Business ROI -->
                <div class="f-deck-slide-panel" id="deckPanelRoi">
                    <div class="f-deck-slide-header">
                        <i class="fas fa-chart-line"></i> <span>Measurable Strategic Outcomes</span>
                    </div>
                    <h4 class="f-deck-slide-title">Accelerate Productivity & Reduce Costs</h4>
                    <p class="f-deck-slide-desc">Organizations leveraging this platform report rapid return on investment and significant operational streamlining.</p>
                    
                    <div class="f-deck-metrics-grid">
                        <div class="f-deck-metric-box">
                            <div class="f-deck-metric-val">45%</div>
                            <div class="f-deck-metric-label">Reduction in Manual Overhead</div>
                        </div>
                        <div class="f-deck-metric-box">
                            <div class="f-deck-metric-val">3x</div>
                            <div class="f-deck-metric-label">Faster Workflow Execution</div>
                        </div>
                        <div class="f-deck-metric-box">
                            <div class="f-deck-metric-val">24/7</div>
                            <div class="f-deck-metric-label">Autonomous Data Syncing</div>
                        </div>
                    </div>
                </div>

                <!-- Slide 5: Video Walkthrough -->
                <div class="f-deck-slide-panel" id="deckPanelVideo">
                    <div class="f-deck-slide-header">
                        <i class="fas fa-video"></i> <span>Product Video Walkthrough</span>
                    </div>
                    <video id="presentationDeckVideo" class="f-video-modal-player" style="border-radius:14px;max-height:360px" controls playsinline preload="metadata"></video>
                </div>
            </div>

            <!-- Footer Action Group -->
            <div class="f-presentation-footer-actions">
                <div style="font-size:13px;color:#94a3b8;display:flex;align-items:center;gap:6px">
                    <i class="fas fa-info-circle" style="color:#38bdf8"></i>
                    <span>Need a custom architecture or RFP presentation?</span>
                </div>
                <div class="f-presentation-btn-group">
                    <a href="#" id="presentationPortfolioBtn" class="f-btn-secondary" style="padding:10px 18px;font-size:13px" target="_blank">
                        <i class="fas fa-file-lines"></i>
                        <span>Full Case Study</span>
                    </a>
                    <a href="#" id="presentationDirectPortalBtn" class="f-btn-secondary" style="padding:10px 18px;font-size:13px;display:none" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Launch Portal</span>
                    </a>
                    <button type="button" class="f-btn-primary" id="presentationSwitchDemoBtn" style="padding:10px 20px;font-size:13px">
                        <i class="fas fa-key"></i>
                        <span>Request Demo Access</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =============== CINEMATIC VIDEO PREVIEW MODAL =============== -->
<div class="f-modal-overlay" id="demoVideoModal" aria-hidden="true">
    <div class="f-modal-backdrop" data-demo-video-close></div>
    <div class="f-video-modal-window" role="dialog" aria-modal="true" aria-labelledby="demoVideoTitle">
        <div class="f-video-modal-header">
            <h3 class="f-video-modal-title" id="demoVideoTitle">
                <i class="fas fa-play-circle" style="color:#38bdf8"></i>
                <span>Product Preview</span>
            </h3>
            <button type="button" class="f-video-modal-close" data-demo-video-close aria-label="Close preview video">&times;</button>
        </div>
        <video id="demoPreviewVideo" class="f-video-modal-player" controls playsinline preload="metadata"></video>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Demo Request Modal Elements
    const modal = document.getElementById('demoRequestModal');
    const form = document.getElementById('demoRequestForm');
    const title = document.getElementById('demoModalTitle');
    const copy = document.getElementById('demoModalCopy');
    const firstInput = form ? form.querySelector('input[name="full_name"]') : null;
    const submitBtn = document.getElementById('demoSubmitBtn');

    // Presentation Modal Elements
    const presentationModal = document.getElementById('demoPresentationModal');
    const presTitle = document.getElementById('presentationModalTitle');
    const presCategory = document.getElementById('presentationModalCategory');
    const deckOverviewTitle = document.getElementById('deckOverviewTitle');
    const deckOverviewDesc = document.getElementById('deckOverviewDesc');
    const deckFeaturesContainer = document.getElementById('deckFeaturesContainer');
    const presVideoTabBtn = document.getElementById('presentationVideoTabBtn');
    const presDeckVideo = document.getElementById('presentationDeckVideo');
    const presPortfolioBtn = document.getElementById('presentationPortfolioBtn');
    const presDirectPortalBtn = document.getElementById('presentationDirectPortalBtn');
    const presSwitchDemoBtn = document.getElementById('presentationSwitchDemoBtn');
    let currentPresentationData = null;

    // Video Modal Elements
    const videoModal = document.getElementById('demoVideoModal');
    const videoTitle = document.getElementById('demoVideoTitle');
    const videoPlayer = document.getElementById('demoPreviewVideo');

    // Filter Buttons
    const filterBtns = document.querySelectorAll('.f-filter-btn');
    const productCards = document.querySelectorAll('.f-demo-card');

    // Category Filtering
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;
            productCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    if (!modal || !form) return;

    @if($hasDemoRequestErrors)
    document.body.style.overflow = 'hidden';
    @endif

    // Open Request Credentials Modal
    const openModal = (button) => {
        if (presentationModal && presentationModal.classList.contains('open')) {
            closePresentationModal();
        }
        form.action = button.dataset.action;
        title.textContent = `Request ${button.dataset.title} Credentials`;
        copy.textContent = button.dataset.description || `Enter your details to receive instant automated credentials for ${button.dataset.title}.`;
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(() => firstInput && firstInput.focus(), 80);
    };

    const closeModal = () => {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    document.querySelectorAll('[data-demo-open]').forEach((button) => {
        button.addEventListener('click', () => openModal(button));
    });

    modal.querySelectorAll('[data-demo-close]').forEach((button) => {
        button.addEventListener('click', closeModal);
    });

    // ===== Presentation Modal Logic =====
    const openPresentationModal = (button) => {
        if (!presentationModal) return;
        currentPresentationData = button.dataset;

        if (presTitle) presTitle.textContent = `${button.dataset.title} – Deck & Presentation`;
        if (presCategory) presCategory.textContent = button.dataset.category || 'Enterprise Platform';
        if (deckOverviewTitle) deckOverviewTitle.textContent = button.dataset.title;
        if (deckOverviewDesc) deckOverviewDesc.textContent = button.dataset.desc || 'Comprehensive enterprise digital platform built for scale, reliability, and automated operational efficiency.';

        // Features list
        if (deckFeaturesContainer) {
            deckFeaturesContainer.innerHTML = '';
            let features = [];
            try {
                features = JSON.parse(button.dataset.features || '[]');
            } catch (e) {
                features = [];
            }
            if (features.length === 0) {
                features = ['Cloud-Native Architecture', 'Role-Based Access Management', 'Real-Time Analytics Dashboard', 'Encrypted Data Storage'];
            }
            features.forEach(f => {
                const item = document.createElement('div');
                item.className = 'f-deck-feature-item';
                item.innerHTML = `<i class="fas fa-check-circle" style="color:#38bdf8;font-size:15px;flex-shrink:0"></i> <span>${f}</span>`;
                deckFeaturesContainer.appendChild(item);
            });
        }

        // Video Tab Setup
        if (button.dataset.video) {
            if (presVideoTabBtn) presVideoTabBtn.style.display = 'inline-flex';
            if (presDeckVideo) presDeckVideo.src = button.dataset.video;
        } else {
            if (presVideoTabBtn) presVideoTabBtn.style.display = 'none';
            if (presDeckVideo) {
                presDeckVideo.pause();
                presDeckVideo.removeAttribute('src');
            }
        }

        // Portfolio Button link
        if (presPortfolioBtn) {
            presPortfolioBtn.href = button.dataset.portfolioUrl || '#';
        }

        // Direct Portal Button link
        if (presDirectPortalBtn) {
            if (button.dataset.demoUrl) {
                presDirectPortalBtn.href = button.dataset.demoUrl;
                presDirectPortalBtn.style.display = 'inline-flex';
            } else {
                presDirectPortalBtn.style.display = 'none';
            }
        }

        // Reset to first tab
        switchDeckTab('overview');

        presentationModal.classList.add('open');
        presentationModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };

    const closePresentationModal = () => {
        if (!presentationModal) return;
        if (presDeckVideo) {
            presDeckVideo.pause();
            presDeckVideo.removeAttribute('src');
            presDeckVideo.load();
        }
        presentationModal.classList.remove('open');
        presentationModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = modal.classList.contains('open') ? 'hidden' : '';
    };

    const switchDeckTab = (tabName) => {
        if (!presentationModal) return;
        const tabs = presentationModal.querySelectorAll('.f-deck-tab');
        const panels = presentationModal.querySelectorAll('.f-deck-slide-panel');

        tabs.forEach(t => t.classList.toggle('active', t.dataset.deckTab === tabName));

        panels.forEach(p => {
            p.classList.remove('active');
        });

        const targetPanel = {
            'overview': 'deckPanelOverview',
            'modules': 'deckPanelModules',
            'security': 'deckPanelSecurity',
            'roi': 'deckPanelRoi',
            'video': 'deckPanelVideo',
        }[tabName];

        if (targetPanel) {
            const el = document.getElementById(targetPanel);
            if (el) el.classList.add('active');
            if (tabName === 'video' && presDeckVideo && presDeckVideo.src) {
                presDeckVideo.play().catch(() => {});
            } else if (presDeckVideo) {
                presDeckVideo.pause();
            }
        }
    };

    document.querySelectorAll('[data-presentation-open]').forEach((button) => {
        button.addEventListener('click', () => openPresentationModal(button));
    });

    if (presentationModal) {
        presentationModal.querySelectorAll('[data-presentation-close]').forEach((button) => {
            button.addEventListener('click', closePresentationModal);
        });

        presentationModal.querySelectorAll('.f-deck-tab').forEach(tab => {
            tab.addEventListener('click', () => switchDeckTab(tab.dataset.deckTab));
        });

        if (presSwitchDemoBtn) {
            presSwitchDemoBtn.addEventListener('click', () => {
                if (currentPresentationData) {
                    openModal({
                        dataset: {
                            action: currentPresentationData.action,
                            title: currentPresentationData.title,
                            description: currentPresentationData.desc,
                        }
                    });
                }
            });
        }
    }

    // Open Video Modal
    const openVideoModal = (button) => {
        if (!videoModal || !videoPlayer || !button.dataset.video) return;
        if (videoTitle) {
            videoTitle.innerHTML = `<i class="fas fa-play-circle" style="color:#38bdf8"></i> <span>${button.dataset.title || 'Product'} Preview</span>`;
        }
        videoPlayer.src = button.dataset.video;
        videoModal.classList.add('open');
        videoModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        videoPlayer.play().catch(() => {});
    };

    const closeVideoModal = () => {
        if (!videoModal || !videoPlayer) return;
        videoPlayer.pause();
        videoPlayer.removeAttribute('src');
        videoPlayer.load();
        videoModal.classList.remove('open');
        videoModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = (modal.classList.contains('open') || (presentationModal && presentationModal.classList.contains('open'))) ? 'hidden' : '';
    };

    document.querySelectorAll('[data-demo-video-open]').forEach((button) => {
        button.addEventListener('click', () => openVideoModal(button));
    });

    if (videoModal) {
        videoModal.querySelectorAll('[data-demo-video-close]').forEach((button) => {
            button.addEventListener('click', closeVideoModal);
        });
    }

    // Escape Key Handler
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            if (videoModal && videoModal.classList.contains('open')) {
                closeVideoModal();
            } else if (presentationModal && presentationModal.classList.contains('open')) {
                closePresentationModal();
            } else if (modal && modal.classList.contains('open')) {
                closeModal();
            }
        }
    });

    // Form submit loading state
    form.addEventListener('submit', () => {
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Provisioning Sandbox Credentials...';
            submitBtn.disabled = true;
        }
    });
});
</script>
@endsection
