@extends('layouts.app')

@section('title', 'Admin Portal Login - ' . setting('site_name', 'Rescom'))

@section('head')
    <!-- Google Fonts for Futuristic Console -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        /* ===== ONE SCREEN VIEWPORT LOCK (DESKTOP & LAPTOP) ===== */
        @media (min-height: 550px) and (min-width: 1024px) {
            html, body {
                height: 100vh !important;
                max-height: 100vh !important;
                overflow: hidden !important;
            }
        }

        body.detail-hero-light {
            display: flex !important;
            flex-direction: column !important;
            height: 100vh !important;
            max-height: 100vh !important;
            min-height: 100vh !important;
            background-color: #f8fafc !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }

        /* Topbar & Header Relative Flow */
        body.detail-hero-light .topbar {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            z-index: 50 !important;
            flex-shrink: 0 !important;
            height: 36px !important;
            padding: 0 16px !important;
        }

        body.detail-hero-light .header {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            z-index: 40 !important;
            flex-shrink: 0 !important;
            background: rgba(255, 255, 255, 0.94) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border-bottom: 1px solid rgba(226, 232, 240, 0.85) !important;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03) !important;
            padding: 10px 0 !important;
        }

        body.detail-hero-light .header .nav-link {
            color: #1e293b !important;
            font-weight: 600 !important;
            padding: 6px 12px !important;
            font-size: 13.5px !important;
        }
        body.detail-hero-light .header .nav-link:hover,
        body.detail-hero-light .header .nav-link.active {
            color: #0284c7 !important;
            background: rgba(2, 132, 199, 0.08) !important;
        }
        body.detail-hero-light .header .logo-tagline {
            color: #64748b !important;
        }
        body.detail-hero-light .header .nav-search-btn i {
            color: #334155 !important;
        }
        body.detail-hero-light .header .mobile-search-btn,
        body.detail-hero-light .header .mobile-toggle {
            color: #0f172a !important;
            background: rgba(15, 23, 42, 0.06) !important;
        }

        body.detail-hero-light .main-content {
            flex: 1 1 auto !important;
            display: flex !important;
            flex-direction: column !important;
            min-height: 0 !important;
            overflow: hidden !important;
        }

        /* ===== COMPACT FOOTER BOTTOM BAR ===== */
        body.detail-hero-light #mainFooter .footer-grid,
        body.detail-hero-light #mainFooter .footer-about,
        body.detail-hero-light #mainFooter .footer-newsletter {
            display: none !important;
        }

        body.detail-hero-light #mainFooter {
            flex-shrink: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            background: rgba(255, 255, 255, 0.94) !important;
            backdrop-filter: blur(16px) !important;
            border-top: 1px solid rgba(226, 232, 240, 0.85) !important;
            position: relative !important;
            z-index: 20 !important;
        }

        body.detail-hero-light #mainFooter .footer-container {
            padding: 0 24px !important;
            max-width: 1280px !important;
        }

        body.detail-hero-light #mainFooter .footer-bottom {
            padding: 7px 0 !important;
            margin: 0 !important;
            border-top: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 16px !important;
            flex-wrap: nowrap !important;
        }

        body.detail-hero-light #mainFooter .footer-copyright {
            color: #64748b !important;
            font-size: 11.5px !important;
            white-space: nowrap !important;
        }

        body.detail-hero-light #mainFooter .footer-bottom-links {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            flex-wrap: nowrap !important;
        }

        body.detail-hero-light #mainFooter .footer-bottom-links a {
            color: #64748b !important;
            font-size: 11px !important;
            white-space: nowrap !important;
            transition: color 0.15s ease;
        }

        body.detail-hero-light #mainFooter .footer-bottom-links a:hover {
            color: #1d4ed8 !important;
        }

        /* Hide floaters on admin login screen */
        body.detail-hero-light .knr-chatbot,
        body.detail-hero-light .whatsapp-float,
        body.detail-hero-light .back-to-top {
            display: none !important;
        }

        /* ===== FUTURISTIC WHITE THEME LOGIN SECTION ===== */
        .futuristic-auth-section {
            position: relative;
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
            background-color: #f8fafc;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            min-height: 0;
        }

        /* Ambient White Canvas Background */
        .f-login-canvas {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
            background: 
                radial-gradient(circle at 12% 18%, rgba(56, 189, 248, 0.16) 0%, transparent 45%),
                radial-gradient(circle at 88% 22%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 50% 92%, rgba(37, 99, 235, 0.08) 0%, transparent 55%),
                linear-gradient(180deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
        }

        /* Cyber Matrix Grid */
        .f-cyber-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.07) 1px, transparent 1px);
            background-size: 36px 36px;
            mask-image: radial-gradient(circle at 50% 50%, black 45%, transparent 95%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 45%, transparent 95%);
        }

        /* Glowing Energy Nodes */
        .f-energy-node {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.65;
            animation: fOrbFloat 14s ease-in-out infinite alternate;
        }

        .f-node-1 {
            width: 400px;
            height: 400px;
            background: rgba(56, 189, 248, 0.2);
            top: -5%;
            left: -5%;
        }

        .f-node-2 {
            width: 420px;
            height: 420px;
            background: rgba(99, 102, 241, 0.15);
            bottom: -10%;
            right: -5%;
            animation-delay: -6s;
        }

        @keyframes fOrbFloat {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 20px) scale(1.08); }
        }

        /* Scanning Laser Beam */
        .f-laser-beam {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, rgba(56, 189, 248, 0.75) 50%, transparent 100%);
            box-shadow: 0 0 12px rgba(56, 189, 248, 0.75);
            opacity: 0.35;
            animation: fLaserScan 9s linear infinite;
        }

        @keyframes fLaserScan {
            0% { top: 0; opacity: 0; }
            15% { opacity: 0.5; }
            85% { opacity: 0.5; }
            100% { top: 100%; opacity: 0; }
        }

        /* ===== UNIFIED OUTER CONSOLE CARD ===== */
        .f-main-stage {
            position: relative;
            z-index: 10;
            max-width: 1140px;
            width: 100%;
            margin: 0 auto;
        }

        .f-outer-card {
            position: relative;
            background: rgba(255, 255, 255, 0.84);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 26px;
            padding: 22px 28px;
            box-shadow: 0 20px 50px -10px rgba(37, 99, 235, 0.08), 0 8px 24px -5px rgba(14, 165, 233, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .f-outer-card-glow {
            position: absolute;
            inset: -3px;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.28) 0%, rgba(99, 102, 241, 0.22) 100%);
            border-radius: 28px;
            filter: blur(14px);
            opacity: 0.5;
            z-index: -1;
            pointer-events: none;
        }

        .f-stage-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 32px;
            align-items: center;
            width: 100%;
        }

        /* ===== LEFT TELEMETRY / HERO PANE ===== */
        .f-hero-pane {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding-right: 8px;
        }

        .f-hud-tag-wrap {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 999px;
            padding: 3px 10px;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
            width: fit-content;
        }

        .f-hud-shield {
            color: #2563eb;
            font-size: 11px;
        }

        .f-hud-text {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            color: #0d2c6c;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .f-hero-title {
            font-size: clamp(22px, 2.4vw, 30px);
            font-weight: 900;
            color: #0a1b39;
            line-height: 1.15;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .f-gradient-text {
            background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 60%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .f-hero-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.45;
            max-width: 480px;
            margin: 0;
        }

        /* Feature Telemetry Cards */
        .f-telemetry-grid {
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-top: 2px;
        }

        .f-telemetry-card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 7px 12px;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.02);
        }

        .f-telemetry-card:hover {
            background: #ffffff;
            border-color: #93c5fd;
            transform: translateX(3px);
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.06);
        }

        .f-telemetry-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .f-icon-blue { background: #e0edff; color: #2563eb; }
        .f-icon-teal { background: #ccfbf1; color: #0d9488; }
        .f-icon-indigo { background: #e0e7ff; color: #4f46e5; }

        .f-telemetry-content {
            flex: 1;
            min-width: 0;
        }

        .f-telemetry-title {
            font-size: 12.5px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }

        .f-telemetry-subtitle {
            font-size: 11px;
            color: #64748b;
            margin-top: 1px;
        }

        /* Live System Status Strip */
        .f-status-strip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 9px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            color: #475569;
            width: fit-content;
        }

        .f-status-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .f-status-dot-green {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.25);
            animation: fPulseDot 2s infinite;
        }

        @keyframes fPulseDot {
            0% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5); }
            70% { transform: scale(1); box-shadow: 0 0 0 4px rgba(34, 197, 94, 0); }
            100% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }

        /* ===== RIGHT LOGIN CARD CONSOLE ===== */
        .f-login-card-wrap {
            position: relative;
            width: 100%;
            max-width: 390px;
            margin: 0 auto;
        }

        .f-card-glow-backdrop {
            position: absolute;
            inset: -3px;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.35) 0%, rgba(99, 102, 241, 0.25) 100%);
            border-radius: 22px;
            filter: blur(14px);
            opacity: 0.55;
            z-index: 1;
        }

        .f-login-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(24px);
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            padding: 20px 22px 18px 22px;
            box-shadow: 0 14px 36px -10px rgba(37, 99, 235, 0.1), 0 6px 20px -5px rgba(14, 165, 233, 0.05);
        }

        /* Card Header & Orbiting Brand Ring */
        .f-card-header {
            text-align: center;
            margin-bottom: 12px;
            position: relative;
        }

        .f-orbit-wrap {
            position: relative;
            width: 46px;
            height: 46px;
            margin: 0 auto 6px auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .f-orbit-ring {
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 1.5px dashed rgba(56, 189, 248, 0.65);
            animation: fOrbitSpin 14s linear infinite;
        }

        .f-orbit-ring-2 {
            position: absolute;
            inset: 1px;
            border-radius: 50%;
            border: 1px solid rgba(37, 99, 235, 0.25);
        }

        @keyframes fOrbitSpin {
            to { transform: rotate(360deg); }
        }

        .f-orbit-center {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.06);
            padding: 3px;
        }

        .f-orbit-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
        }

        .f-orbit-logo-fallback {
            font-size: 13px;
            font-weight: 900;
            color: #1d4ed8;
        }

        .f-card-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.4px;
            margin-bottom: 1px;
        }

        .f-card-subtitle {
            font-size: 11.5px;
            color: #64748b;
            font-weight: 500;
            margin: 0;
        }

        /* Error / Notice Alerts */
        .f-alert-box {
            display: flex;
            align-items: flex-start;
            gap: 7px;
            padding: 7px 10px;
            border-radius: 9px;
            background: #fef2f2;
            border: 1.5px solid #fecaca;
            color: #991b1b;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.35;
            animation: fAlertShake 0.4s ease;
        }

        @keyframes fAlertShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }

        .f-alert-box i {
            font-size: 12px;
            color: #ef4444;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* Form Controls */
        .f-form-group {
            margin-bottom: 9px;
        }

        .f-form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 3px;
        }

        .f-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .f-input-icon {
            position: absolute;
            left: 11px;
            color: #94a3b8;
            font-size: 12px;
            pointer-events: none;
            transition: color 0.2s ease;
            z-index: 2;
        }

        .f-input-field {
            width: 100%;
            padding: 8px 10px 8px 32px;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            font-size: 12.5px;
            font-family: inherit;
            font-weight: 500;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            outline: none;
        }

        .f-input-field:hover {
            border-color: #cbd5e1;
            background: #ffffff;
        }

        .f-input-field:focus {
            background: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .f-toggle-password-btn {
            position: absolute;
            right: 8px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 12px;
            padding: 3px 5px;
            border-radius: 4px;
            transition: color 0.15s ease, background 0.15s ease;
            z-index: 2;
        }

        .f-toggle-password-btn:hover {
            color: #2563eb;
            background: #eff6ff;
        }

        /* Form Field Errors Display Below Input */
        .field-error,
        .f-form-group .field-error {
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
            width: 100% !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            color: #dc2626 !important;
            margin-top: 4px !important;
            margin-bottom: 2px !important;
            line-height: 1.3 !important;
            clear: both !important;
        }

        .field-error i {
            color: #dc2626 !important;
            font-size: 11px !important;
            flex-shrink: 0 !important;
        }

        /* reCAPTCHA Box */
        .f-recaptcha-box {
            display: flex;
            justify-content: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            padding: 4px 0;
            margin-bottom: 8px;
            overflow: hidden;
        }

        .g-recaptcha {
            transform: scale(0.8);
            transform-origin: center center;
            margin: -6px 0;
        }

        /* Options Row */
        .f-options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 11px;
        }

        .f-custom-checkbox {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            user-select: none;
            font-weight: 600;
            color: #475569;
        }

        .f-custom-checkbox input[type="checkbox"] {
            width: 13px;
            height: 13px;
            border-radius: 3px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        /* High-Energy CTA Submit Button */
        .f-btn-submit {
            position: relative;
            width: 100%;
            padding: 9px 16px;
            background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 100%);
            color: #ffffff;
            border: none;
            border-radius: 9px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.2px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            box-shadow: 0 5px 18px rgba(37, 99, 235, 0.24);
            overflow: hidden;
            text-decoration: none;
        }

        .f-btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .f-btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(2, 132, 199, 0.3);
            color: #ffffff;
        }

        .f-btn-submit:hover::after {
            transform: translateX(100%);
        }

        .f-btn-submit:active {
            transform: translateY(0);
        }

        .f-btn-submit i {
            font-size: 11px;
            transition: transform 0.2s ease;
        }

        .f-btn-submit:hover i {
            transform: translateX(3px);
        }

        /* Security Disclaimer Box */
        .f-security-footer-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-top: 8px;
            padding: 5px 8px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 600;
            color: #166534;
            text-align: center;
        }

        .f-security-footer-box i {
            color: #15803d;
            font-size: 11px;
        }

        /* ===== RESPONSIVENESS & MOBILE LAYOUT ===== */
        @media (max-width: 1024px) {
            body.detail-hero-light {
                height: auto !important;
                max-height: none !important;
                overflow-y: auto !important;
            }
            .futuristic-auth-section {
                padding: 24px 16px;
                height: auto !important;
                min-height: auto !important;
            }
            .f-outer-card {
                padding: 20px 16px;
                border-radius: 20px;
            }
            .f-stage-grid {
                display: flex !important;
                flex-direction: column !important;
                gap: 24px;
            }

            /* LOGIN CARD COMES ON TOP IN MOBILE SCREEN */
            .f-login-card-wrap {
                order: 1 !important;
                max-width: 100%;
                width: 100%;
            }

            /* TELEMETRY COMES BELOW LOGIN CARD IN MOBILE SCREEN */
            .f-hero-pane {
                order: 2 !important;
                text-align: center;
                align-items: center;
                padding-right: 0;
                padding-top: 16px;
                border-top: 1px dashed #e2e8f0;
                width: 100%;
            }
            .f-hero-desc {
                margin: 0 auto;
            }
            .f-telemetry-grid {
                display: flex !important;
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }
            .f-status-strip {
                margin: 0 auto;
            }
        }

        @media (max-width: 640px) {
            .futuristic-auth-section {
                padding: 16px 12px;
            }
            .f-outer-card {
                padding: 16px 12px;
                border-radius: 18px;
            }
            .f-login-card {
                padding: 18px 14px;
                border-radius: 16px;
            }
            .f-card-title {
                font-size: 17px;
            }
            .g-recaptcha {
                transform: scale(0.75);
            }
            body.detail-hero-light #mainFooter .footer-bottom {
                flex-direction: column !important;
                gap: 6px !important;
                text-align: center !important;
            }
            body.detail-hero-light #mainFooter .footer-bottom-links {
                justify-content: center !important;
                flex-wrap: wrap !important;
            }
        }
    </style>
@endsection

@section('content')
<section class="futuristic-auth-section" id="adminLoginSection">
    <!-- Futuristic Ambient Canvas Layers -->
    <div class="f-login-canvas" aria-hidden="true">
        <div class="f-cyber-grid"></div>
        <div class="f-energy-node f-node-1"></div>
        <div class="f-energy-node f-node-2"></div>
        <div class="f-laser-beam"></div>
    </div>

    <!-- Main Dual-Pane Console Stage with Outer Card -->
    <div class="f-main-stage">
        <div class="f-outer-card">
            <div class="f-outer-card-glow" aria-hidden="true"></div>

            <div class="f-stage-grid">
                
                <!-- Left Hero / Telemetry Pane -->
                <div class="f-hero-pane">
                    <div class="f-hud-tag-wrap">
                        <i class="fa-solid fa-shield-halved f-hud-shield"></i>
                        <span class="f-hud-text">ENTERPRISE GOVERNANCE // SECURE GATEWAY</span>
                    </div>

                    <h1 class="f-hero-title">
                        Unified Command & <br>
                        <span class="f-gradient-text">Control Architecture</span>
                    </h1>

                    <p class="f-hero-desc">
                        Centralized administrator gateway for real-time website configuration, service catalog orchestration, and security telemetry.
                    </p>

                    <!-- Security / Telemetry Feature Cards -->
                    <div class="f-telemetry-grid">
                        <div class="f-telemetry-card">
                            <div class="f-telemetry-icon-box f-icon-blue">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div class="f-telemetry-content">
                                <div class="f-telemetry-title">Hardened TLS Security</div>
                                <div class="f-telemetry-subtitle">256-Bit cryptographic token defense & CSRF barrier</div>
                            </div>
                        </div>

                        <div class="f-telemetry-card">
                            <div class="f-telemetry-icon-box f-icon-teal">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                            <div class="f-telemetry-content">
                                <div class="f-telemetry-title">Granular Role Governance</div>
                                <div class="f-telemetry-subtitle">Multi-tier role permissions and strict session validation</div>
                            </div>
                        </div>

                        <div class="f-telemetry-card">
                            <div class="f-telemetry-icon-box f-icon-indigo">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="f-telemetry-content">
                                <div class="f-telemetry-title">Audit Log & Intrusion Telemetry</div>
                                <div class="f-telemetry-subtitle">Real-time IP geo-tracking and automated incident logging</div>
                            </div>
                        </div>
                    </div>

                    <!-- Live Metrics Strip -->
                    <div class="f-status-strip">
                        <div class="f-status-item">
                            <span class="f-status-dot-green"></span>
                            <span>NODE: ONLINE</span>
                        </div>
                        <span>/</span>
                        <div class="f-status-item">
                            <span>LATENCY: &lt; 15ms</span>
                        </div>
                        <span>/</span>
                        <div class="f-status-item">
                            <span>DEFENSE: ACTIVE</span>
                        </div>
                    </div>
                </div>

                <!-- Right Glassmorphic Login Console -->
                <div class="f-login-card-wrap">
                    <div class="f-card-glow-backdrop" aria-hidden="true"></div>

                    <div class="f-login-card">
                        <!-- Header with Orbital Ring -->
                        <div class="f-card-header">
                            <div class="f-orbit-wrap">
                                <div class="f-orbit-ring"></div>
                                <div class="f-orbit-ring-2"></div>
                                <div class="f-orbit-center">
                                    @if(setting('site_logo'))
                                        <img src="{{ setting('site_logo') }}" alt="Logo" class="f-orbit-logo-img">
                                    @else
                                        <span class="f-orbit-logo-fallback">Rescom</span>
                                    @endif
                                </div>
                            </div>
                            <h2 class="f-card-title">Sign In to Portal</h2>
                            <p class="f-card-subtitle">Enter your credentials to access the admin system</p>
                        </div>

                        <!-- Alerts -->
                        @if($errors->any())
                        <div class="f-alert-box">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                        @endif

                        @if(!empty($login_error))
                        <div class="f-alert-box">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>{{ $login_error }}</span>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="f-alert-box">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ route('admin.login.post') }}" method="POST" id="adminLoginForm">
                            @csrf

                            <!-- Email Field -->
                            <div class="f-form-group">
                                <label for="email" class="f-form-label">
                                    <span>Email Address</span>
                                </label>
                                <div class="f-input-wrapper">
                                    <i class="fa-solid fa-envelope f-input-icon"></i>
                                    <input type="email" id="email" name="email" class="f-input-field"
                                           value="{{ old('email', $login_email ?? '') }}"
                                           placeholder="admin@rescom.in"
                                           required autocomplete="email" autofocus>
                                </div>
                                @if(!empty($email_error))
                                    <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $email_error }}</div>
                                @endif
                                @error('email')
                                    <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="f-form-group">
                                <label for="password" class="f-form-label">
                                    <span>Password</span>
                                </label>
                                <div class="f-input-wrapper">
                                    <i class="fa-solid fa-shield-halved f-input-icon"></i>
                                    <input type="password" id="password" name="password" class="f-input-field"
                                           placeholder="••••••••••••"
                                           required autocomplete="current-password">
                                    <button type="button" class="f-toggle-password-btn" id="togglePasswordBtn" aria-label="Toggle password visibility">
                                        <i class="fa-solid fa-eye" id="passIcon"></i>
                                    </button>
                                </div>
                                @if(!empty($password_error))
                                    <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $password_error }}</div>
                                @endif
                                @error('password')
                                    <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Google reCAPTCHA -->
                            <div class="f-form-group">
                                <div class="f-recaptcha-box">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                </div>
                                @if(!empty($captcha_error))
                                    <div class="field-error" style="justify-content:center"><i class="fa-solid fa-circle-exclamation"></i> {{ $captcha_error }}</div>
                                @endif
                                @error('g-recaptcha-response')
                                    <div class="field-error" style="justify-content:center"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="f-options-row">
                                <label class="f-custom-checkbox">
                                    <input type="checkbox" name="remember" id="remember" value="1">
                                    <span>Remember session</span>
                                </label>
                                <span style="font-size:10.5px;color:#94a3b8;font-weight:600">Encrypted 256-bit</span>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="f-btn-submit" id="submitBtn">
                                <span>Authenticate & Sign In</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>

                        <!-- Security Badge Notice -->
                        <div class="f-security-footer-box">
                            <i class="fa-solid fa-shield-check"></i>
                            <span>Protected by Real-Time Telemetry & Audit Guard.</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Password Visibility Toggle & Interactive Submit Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const passInput = document.getElementById('password');
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passIcon = document.getElementById('passIcon');

        if (toggleBtn && passInput && passIcon) {
            toggleBtn.addEventListener('click', () => {
                const isPass = passInput.type === 'password';
                passInput.type = isPass ? 'text' : 'password';
                passIcon.className = isPass ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
            });
        }

        const form = document.getElementById('adminLoginForm');
        const submitBtn = document.getElementById('submitBtn');
        if (form && submitBtn) {
            form.addEventListener('submit', () => {
                submitBtn.style.opacity = '0.85';
                submitBtn.innerHTML = '<span>Verifying Credentials...</span> <i class="fa-solid fa-circle-notch fa-spin"></i>';
            });
        }
    });
</script>
@endsection
