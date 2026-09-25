@extends('layouts.app')

@section('title', setting('contact_meta_title') ?: 'Contact Us - Get Free Consultation | Rescom')
@section('meta_description', setting('contact_meta_description') ?: 'Contact Rescom for a free consultation. We are available Mon-Sat 9AM-7PM IST. Call, email or fill the form and we will respond within 24 hours.')
@php($recaptchaSiteKey = recaptcha_site_key())

@section('content')
@include('partials.recaptcha-script')

<!-- =============== FUTURISTIC CONTACT HERO (DARK CYBER THEME) =============== -->
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
            padding: 0 clamp(20px, 4.5vw, 80px);
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
            font-size: clamp(32px, 5vw, 54px);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.03em;
            color: #ffffff;
            margin-bottom: 18px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }
        .f-gradient-text {
            background: linear-gradient(135deg, #38bdf8 0%, #818cf8 50%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .f-hero-desc {
            font-size: clamp(15px, 2vw, 17.5px);
            line-height: 1.65;
            color: #cbd5e1;
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 30px;
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

        /* ===== FULL-WIDTH BODY SECTION ===== */
        .futuristic-contact-section {
            width: 100%;
            background: #f8fafc;
            padding: clamp(50px, 7vw, 90px) 0;
            position: relative;
            overflow: hidden;
        }
        .f-contact-grid-mesh {
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

        /* 4-Column Quick Contact Telemetry Ribbon */
        .f-contact-ribbon {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 45px;
        }
        @media (max-width: 1024px) {
            .f-contact-ribbon {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 640px) {
            .f-contact-ribbon {
                grid-template-columns: 1fr;
            }
        }
        .f-contact-ribbon-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none;
            color: inherit;
        }
        .f-contact-ribbon-card:hover {
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
        .f-contact-ribbon-card:hover .f-ribbon-icon-bay {
            background: #0284c7;
            color: #ffffff;
            transform: scale(1.06) rotate(5deg);
        }
        .f-ribbon-label {
            font-size: 11.5px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748b;
            margin-bottom: 3px;
        }
        .f-ribbon-val {
            font-size: 15px;
            font-weight: 800;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* 2-Column Main Stage Layout */
        .f-contact-stage-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: clamp(24px, 4vw, 44px);
            align-items: start;
        }
        @media (max-width: 1024px) {
            .f-contact-stage-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Office Deck */
        .f-offices-wrap {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .f-office-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.04);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .f-office-card:hover {
            border-color: #0284c7;
            box-shadow: 0 16px 40px rgba(14, 165, 233, 0.1);
        }
        .f-office-image-bay {
            width: 100%;
            height: 180px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
            background: #0f172a;
        }
        .f-office-image-bay img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .f-office-card:hover .f-office-image-bay img {
            transform: scale(1.05);
        }
        .f-office-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }
        .f-office-icon-bay {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(2, 132, 199, 0.1);
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }
        .f-office-title {
            font-size: 19px;
            font-weight: 850;
            color: #0f172a;
            margin: 0;
        }
        .f-office-city {
            font-size: 13px;
            color: #0284c7;
            font-weight: 700;
        }
        .f-office-address {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 20px;
            white-space: pre-line;
        }
        .f-office-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .f-office-phone-link, .f-office-map-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 750;
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .f-office-phone-link {
            background: #f1f5f9;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }
        .f-office-phone-link:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .f-office-map-link {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
        }
        .f-office-map-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.45);
        }

        /* Global Digital Presence / Social Hub */
        .f-connect-card {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border: 1.5px solid rgba(56, 189, 248, 0.25);
            border-radius: 24px;
            padding: 28px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(15, 23, 42, 0.2);
        }
        .f-connect-glow {
            position: absolute;
            top: -30px;
            right: -30px;
            width: 140px;
            height: 140px;
            background: rgba(14, 165, 233, 0.3);
            border-radius: 50%;
            filter: blur(40px);
            pointer-events: none;
        }
        .f-connect-title {
            font-size: 18px;
            font-weight: 850;
            margin-bottom: 8px;
            color: #ffffff;
        }
        .f-connect-desc {
            font-size: 13.5px;
            color: #94a3b8;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .f-connect-socials {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .f-social-chip {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .f-social-chip:hover {
            background: #0284c7;
            border-color: #38bdf8;
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(14, 165, 233, 0.4);
        }

        /* Futuristic Form Stage */
        .f-form-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 24px;
            padding: clamp(28px, 4vw, 44px);
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(0, 0, 0, 0.02);
            position: relative;
        }
        .f-form-header {
            margin-bottom: 28px;
        }
        .f-form-title {
            font-size: 24px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .f-form-subtitle {
            font-size: 14.5px;
            color: #64748b;
        }

        .f-form-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 18px;
        }
        @media (max-width: 640px) {
            .f-form-grid-2 {
                grid-template-columns: 1fr;
            }
        }
        .f-form-group {
            margin-bottom: 18px;
        }
        .f-field-label {
            display: block;
            font-size: 13px;
            font-weight: 750;
            color: #1e293b;
            margin-bottom: 7px;
        }
        .f-form-input, .f-form-select, .f-form-textarea {
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
        .f-form-input:focus, .f-form-select:focus, .f-form-textarea:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 3.5px rgba(14, 165, 233, 0.15);
        }
        .f-form-textarea {
            resize: vertical;
            line-height: 1.6;
        }

        .f-phone-row {
            display: grid;
            grid-template-columns: 110px 1fr;
            gap: 8px;
        }

        .f-submit-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 60%, #06b6d4 100%);
            color: #ffffff !important;
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35);
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .f-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(37, 99, 235, 0.5);
        }

        .f-trust-footnote {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 12.5px;
            color: #64748b;
            margin-top: 16px;
            text-align: center;
        }
        .f-trust-footnote i {
            color: #10b981;
        }

        .f-map-embed-frame {
            position: relative;
            width: 100%;
            height: 420px;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #f1f5f9;
        }
        .f-map-embed-frame iframe {
            width: 100% !important;
            height: 100% !important;
            border: 0 !important;
            display: block;
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
            <span class="f-badge-subtitle">{{ setting('contact_hero_badge') ?: 'CONNECT WITH OUR ARCHITECTS' }}</span>
            <span class="f-badge-divider"></span>
            <span class="f-badge-tag"><i class="fas fa-headset"></i> RAPID RESPONSE 24/7</span>
        </div>

        <!-- Headline -->
        <h1 class="f-hero-title" data-aos="fade-up">
            {!! setting('contact_hero_title') ?: 'Let\'s Engineer Something <span class="f-gradient-text">Exceptional Together</span>' !!}
        </h1>

        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            {{ setting('contact_hero_subtitle') ?: 'Consult directly with our certified technical leads. Tell us about your project vision, system requirements, and timeline for an actionable roadmap.' }}
        </p>

        <!-- Catalog Telemetry Capsule -->
        <div class="f-catalog-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="f-stat-item">
                <span class="f-stat-val">&lt; 24h</span>
                <span>Response SLA</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">100%</span>
                <span>Strict NDA Protection</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">Free</span>
                <span>Architecture Review</span>
            </div>
        </div>
    </div>
</section>

<!-- =============== FULL-WIDTH ADVANCED BODY SECTION =============== -->
<section class="futuristic-contact-section">
    <div class="f-contact-grid-mesh"></div>

    <div class="f-wide-container">
        <!-- 4-Column Quick Contact Telemetry Ribbon -->
        <div class="f-contact-ribbon" data-aos="fade-up">
            <a href="tel:{{ setting('contact_phone') ?: '+91 98459 19158' }}" class="f-contact-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fas fa-phone-alt"></i></div>
                <div>
                    <div class="f-ribbon-label">{{ setting('contact_card_call_label') ?: 'Voice Telemetry' }}</div>
                    <div class="f-ribbon-val">{{ setting('contact_phone') ?: '+91 98459 19158' }}</div>
                </div>
            </a>

            <a href="mailto:{{ setting('contact_email') ?: 'contact@rescom.in' }}" class="f-contact-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fas fa-envelope"></i></div>
                <div>
                    <div class="f-ribbon-label">{{ setting('contact_card_email_label') ?: 'Electronic Mail' }}</div>
                    <div class="f-ribbon-val">{{ setting('contact_email') ?: 'contact@rescom.in' }}</div>
                </div>
            </a>

            <div class="f-contact-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="f-ribbon-label">{{ setting('contact_card_hours_label') ?: 'Operations Hours' }}</div>
                    <div class="f-ribbon-val">{{ setting('business_hours') ?: 'Mon - Sat: 9AM - 7PM IST' }}</div>
                </div>
            </div>

            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', setting('contact_card_whatsapp_value') ?: (setting('whatsapp_number') ?: '919845919158')) }}" target="_blank" class="f-contact-ribbon-card">
                <div class="f-ribbon-icon-bay"><i class="fab fa-whatsapp"></i></div>
                <div>
                    <div class="f-ribbon-label">{{ setting('contact_card_whatsapp_label') ?: 'Instant Messenger' }}</div>
                    <div class="f-ribbon-val">{{ setting('contact_card_whatsapp_value') ?: 'Chat on WhatsApp' }}</div>
                </div>
            </a>
        </div>

        <!-- 2-Column Stage Layout -->
        <div class="f-contact-stage-grid">
            <!-- Left Info Deck: Office Locations & Global Connect -->
            <div class="f-offices-wrap" data-aos="fade-right">
                <div>
                    <h3 style="font-size:22px;font-weight:850;color:#0f172a;margin-bottom:20px;display:flex;align-items:center;gap:10px">
                        <i class="fas fa-building" style="color:#0284c7"></i>
                        <span>{{ setting('contact_office_title') ?: 'Corporate Office Locations' }}</span>
                    </h3>

                    <div style="display:flex;flex-direction:column;gap:20px">
                        @foreach($officeCards as $office)
                        <div class="f-office-card">
                            @if(!empty($office['image']))
                            <div class="f-office-image-bay">
                                <img src="{{ $office['image'] }}" alt="{{ $office['title'] }}">
                            </div>
                            @endif

                            <div class="f-office-header">
                                <div class="f-office-icon-bay">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="f-office-title">{{ $office['title'] }}</h4>
                                    <span class="f-office-city">{{ $office['city'] }}</span>
                                </div>
                            </div>

                            <p class="f-office-address">{{ $office['address'] }}</p>

                            <div class="f-office-actions">
                                @if(!empty($office['phone']))
                                <a href="tel:{{ $office['phone'] }}" class="f-office-phone-link">
                                    <i class="fas fa-phone"></i> {{ $office['phone'] }}
                                </a>
                                @endif

                                @if(!empty($office['directions']))
                                <a href="{{ $office['directions'] }}" target="_blank" rel="noopener noreferrer" class="f-office-map-link">
                                    <i class="fas fa-directions"></i> {{ $directionsText ?: 'Get Directions' }}
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Global Social Connect -->
                <?php
                    $socialPlatforms = [
                        ['key' => 'social_facebook',  'icon' => 'fab fa-facebook-f',  'label' => 'Facebook'],
                        ['key' => 'social_twitter',   'icon' => 'fab fa-x-twitter',   'label' => 'Twitter / X'],
                        ['key' => 'social_linkedin',  'icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'],
                        ['key' => 'social_instagram', 'icon' => 'fab fa-instagram',   'label' => 'Instagram'],
                        ['key' => 'social_youtube',   'icon' => 'fab fa-youtube',     'label' => 'YouTube'],
                        ['key' => 'social_github',    'icon' => 'fab fa-github',      'label' => 'GitHub'],
                    ];
                    $activeSocials = [];
                    foreach ($socialPlatforms as $platform) {
                        $url = setting($platform['key']);
                        if (!empty($url) && trim($url) !== '') {
                            $activeSocials[] = [
                                'icon' => $platform['icon'],
                                'label' => $platform['label'],
                                'url' => trim($url),
                            ];
                        }
                    }
                ?>

                @if(count($activeSocials) > 0)
                <div class="f-connect-card">
                    <div class="f-connect-glow"></div>
                    <div style="position:relative;z-index:2">
                        <h4 class="f-connect-title"><i class="fas fa-globe" style="color:#38bdf8;margin-right:8px"></i> {{ setting('contact_social_title') ?: 'Global Digital Presence' }}</h4>
                        <p class="f-connect-desc">{{ setting('contact_social_desc') ?: 'Connect directly with our engineering channels, developer repositories, and executive updates.' }}</p>
                        <div class="f-connect-socials">
                            @foreach($activeSocials as $social)
                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="f-social-chip" title="{{ $social['label'] }}" aria-label="{{ $social['label'] }}">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Contact Form Card -->
            <div data-aos="fade-left">
                <div class="f-form-card">
                    <div class="f-form-header">
                        <h3 class="f-form-title">{{ setting('contact_form_title') ?: 'Send Us a Direct Inquiry' }}</h3>
                        <p class="f-form-subtitle">{{ setting('contact_form_subtitle') ?: 'Fill in your specifications below. Our certified technical architects will review and respond promptly.' }}</p>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success" style="background:#f0fdf4;border:1.5px solid #86efac;color:#166534;padding:16px 20px;border-radius:14px;margin-bottom:24px;display:flex;align-items:center;gap:10px;font-weight:700">
                        <i class="fas fa-check-circle" style="font-size:20px;color:#16a34a"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
                        @csrf

                        <div class="f-form-grid-2">
                            <div>
                                <label class="f-field-label">Full Name *</label>
                                <input type="text" name="name" class="f-form-input" placeholder="e.g. John Doe" value="{{ old('name') }}" required maxlength="255">
                                @error('name')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="f-field-label">Business Email *</label>
                                <input type="email" name="email" class="f-form-input" placeholder="john@company.com" value="{{ old('email') }}" required maxlength="255">
                                @error('email')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="f-form-grid-2">
                            <div>
                                <label class="f-field-label">Phone Number</label>
                                <div class="f-phone-row">
                                    <select name="country_code" class="f-form-select" data-digits-source>
                                        @foreach([
                                            ['+91','India',10],
                                            ['+1','USA/Canada',10],
                                            ['+44','UK',10],
                                            ['+61','Australia',9],
                                            ['+971','UAE',9],
                                        ] as [$code,$label,$digits])
                                            <option value="{{ $code }}" data-digits="{{ $digits }}" {{ old('country_code', '+91')===$code ? 'selected' : '' }}>
                                                {{ $code }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="tel" name="phone" class="f-form-input" placeholder="98459 19158" value="{{ old('phone') }}" maxlength="25" inputmode="tel" data-min-digits="10" data-country-selector>
                                </div>
                                @error('country_code')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                                @error('phone')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="f-field-label">Company / Organization</label>
                                <input type="text" name="company" class="f-form-input" placeholder="Your Enterprise" value="{{ old('company') }}" maxlength="255">
                                @error('company')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="f-form-grid-2">
                            <div>
                                <label class="f-field-label">Service Interested In</label>
                                <select name="service_interested" class="f-form-select">
                                    <option value="">Select a service domain...</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->title }}" {{ old('service_interested', $selectedServiceTitle ?? '') == $service->title ? 'selected' : '' }}>{{ $service->title }}</option>
                                    @endforeach
                                    <option value="Other">Other Custom Engineering</option>
                                </select>
                                @error('service_interested')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="f-field-label">Product Interested In</label>
                                <select name="product_interested" class="f-form-select">
                                    <option value="">Select a product platform...</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->title }}" {{ old('product_interested', $selectedProductTitle ?? '') == $product->title ? 'selected' : '' }}>{{ $product->title }}</option>
                                    @endforeach
                                    <option value="Other">Other / Not Sure</option>
                                </select>
                                @error('product_interested')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="f-form-group">
                            <label class="f-field-label">Inquiry Subject</label>
                            <input type="text" name="subject" class="f-form-input" placeholder="Brief summary of your inquiry" value="{{ old('subject') }}" maxlength="500">
                            @error('subject')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-form-group">
                            <label class="f-field-label">Project Scope & Requirements *</label>
                            <textarea name="message" class="f-form-textarea" rows="5" placeholder="Describe your technical requirements, goals, target timeline, and operational scale..." required minlength="20" maxlength="4000">{{ old('message') }}</textarea>
                            @error('message')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-form-group" style="display:flex;flex-direction:column;align-items:center;gap:8px">
                            @if($recaptchaSiteKey)
                                <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
                            @else
                                <div class="field-error" style="color:#64748b;font-size:12px">reCAPTCHA verification ready.</div>
                            @endif
                            @error('contact_captcha')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="f-submit-btn" id="submitBtn">
                            <i class="fas fa-paper-plane"></i>
                            <span>{{ setting('contact_form_submit_text') ?: 'Transmit Inquiry' }}</span>
                        </button>

                        <div class="f-trust-footnote">
                            <i class="fas fa-shield-check"></i>
                            <span>{{ setting('contact_form_privacy_text') ?: 'Enterprise Privacy Protected · Strict NDA Standard' }}</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(setting('contact_map_embed_url'))
        <!-- Full-Width Interactive Global Map Section -->
        <div style="margin-top:45px" data-aos="fade-up">
            <div style="background:#ffffff;border:1.5px solid rgba(226,232,240,0.95);border-radius:24px;padding:clamp(20px, 3vw, 32px);box-shadow:0 12px 40px rgba(15,23,42,0.05);overflow:hidden">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:10px">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div style="width:42px;height:42px;border-radius:12px;background:rgba(2,132,199,0.1);color:#0284c7;display:flex;align-items:center;justify-content:center;font-size:18px">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div>
                            <h4 style="font-size:18px;font-weight:850;color:#0f172a;margin:0">Interactive Global Map Navigation</h4>
                            <span style="font-size:13px;color:#64748b">Live GPS Navigation & Satellite Facility Telemetry</span>
                        </div>
                    </div>
                </div>
                <div class="f-map-embed-frame">
                    {!! setting('contact_map_embed_url') !!}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
document.getElementById('contactForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Transmitting Inquiry...';
    btn.disabled = true;
});
</script>
@endsection
