@extends('layouts.app')
@section('title', 'Careers at Rescom - Join Our Engineering Squads')
@section('meta_description', 'Build your career at Rescom. We offer high-impact engineering opportunities in web development, mobile platforms, cloud architecture, AI/ML, and system design.')

@section('content')
<!-- =============== FUTURISTIC CAREERS HERO (DARK CYBER THEME) =============== -->
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

        /* Telemetry Stats Strip */
        .f-catalog-stats {
            display: inline-flex;
            align-items: center;
            gap: 24px;
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(56, 189, 248, 0.25);
            padding: 10px 26px;
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

        /* ===== CULTURE & BENEFITS SECTION (WHITE THEME) ===== */
        .f-benefits-section {
            background: #ffffff;
            padding: clamp(50px, 7vh, 80px) 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .f-wide-container {
            width: 100%;
            max-width: 1680px;
            margin: 0 auto;
            padding: 0 clamp(20px, 4vw, 64px);
            position: relative;
            z-index: 2;
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
            font-size: clamp(24px, 3vw, 36px);
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 36px;
        }

        .f-benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }
        .f-benefit-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            padding: 26px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .f-benefit-card:hover {
            transform: translateY(-5px);
            border-color: #0284c7;
            background: #ffffff;
            box-shadow: 0 14px 35px rgba(14, 165, 233, 0.12);
        }
        .f-benefit-icon-bay {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .f-benefit-card:hover .f-benefit-icon-bay {
            transform: scale(1.1) rotate(5deg);
        }
        .f-benefit-title {
            font-size: 16.5px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .f-benefit-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.65;
            margin: 0;
        }

        /* ===== DEPARTMENT FILTER MATRIX ===== */
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
            cursor: pointer;
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

        /* ===== JOB OPENINGS SECTION ===== */
        .f-jobs-section {
            position: relative;
            background: #f8fafc;
            padding: clamp(50px, 7vh, 80px) 0 clamp(80px, 10vh, 120px) 0;
            color: #0f172a;
            min-height: 500px;
        }
        .f-jobs-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.035) 1px, transparent 1px);
            background-size: 36px 36px;
            pointer-events: none;
        }

        .f-dept-block {
            margin-bottom: 48px;
        }
        .f-dept-heading {
            font-size: 20px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .f-dept-count-badge {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff;
            font-size: 12px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 8px;
        }

        .f-job-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 20px;
            padding: 26px 30px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
        }
        .f-job-card:hover {
            transform: translateX(6px);
            border-color: #0284c7;
            box-shadow: 0 14px 35px rgba(14, 165, 233, 0.12);
        }

        .f-corner-reticle {
            position: absolute;
            width: 12px;
            height: 12px;
            border-color: #0284c7;
            border-style: solid;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .f-job-card:hover .f-corner-reticle { opacity: 0.9; }
        .f-reticle-tl { top: 8px; left: 8px; border-width: 2px 0 0 2px; }
        .f-reticle-tr { top: 8px; right: 8px; border-width: 2px 2px 0 0; }
        .f-reticle-bl { bottom: 8px; left: 8px; border-width: 0 0 2px 2px; }
        .f-reticle-br { bottom: 8px; right: 8px; border-width: 0 2px 2px 0; }

        .f-job-title {
            font-size: 18.5px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 10px;
            transition: color 0.2s ease;
        }
        .f-job-card:hover .f-job-title {
            color: #0284c7;
        }
        .f-job-tags-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .f-job-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 4px 11px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }
        .f-job-pill i { color: #0284c7; }
        .f-job-pill-salary {
            background: #fef3c7;
            border-color: #fde68a;
            color: #92400e;
        }
        .f-job-pill-salary i { color: #d97706; }

        .f-job-apply-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            color: #ffffff !important;
            padding: 11px 22px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 750;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
            transition: all 0.25s ease;
            flex-shrink: 0;
        }
        .f-job-card:hover .f-job-apply-btn {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(37, 99, 235, 0.5);
        }

        /* ===== BOTTOM CTA BANNER ===== */
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
    </style>

    <div class="f-hero-bg"></div>
    <div class="f-cyber-grid"></div>
    <div class="f-energy-orb f-orb-left"></div>
    <div class="f-energy-orb f-orb-right"></div>

    <div class="container">
        <!-- Live HUD Beacon -->
        <div class="f-hud-badge" data-aos="fade-down">
            <span class="f-radar-dot"></span>
            <span class="f-badge-subtitle">TALENT & ENGINEERING ECOSYSTEM</span>
            <span class="f-badge-divider"></span>
            <span class="f-badge-tag"><i class="fas fa-users"></i> ACTIVE HIRING 2026</span>
        </div>

        <!-- Headline -->
        <h1 class="f-hero-title" data-aos="fade-up">
            Build The Next Generation of <span class="f-gradient-text">Enterprise Technology</span>
        </h1>

        <p class="f-hero-desc" data-aos="fade-up" data-aos-delay="100">
            Join high-velocity engineering squads building mission-critical software, AI systems, and cloud infrastructure for top global brands.
        </p>

        <!-- Catalog Telemetry Capsule -->
        <div class="f-catalog-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="f-stat-item">
                <span class="f-stat-val">{{ $jobs->count() }}</span>
                <span>Open Positions</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">{{ count($departments ?? []) }}</span>
                <span>Squad Domains</span>
            </div>
            <div class="f-stat-sep"></div>
            <div class="f-stat-item">
                <span class="f-stat-val">Hybrid</span>
                <span>Flexible Culture</span>
            </div>
        </div>
    </div>
</section>

<!-- =============== WHY JOIN US / CULTURE BENEFITS =============== -->
<section class="f-benefits-section">
    <div class="f-wide-container">
        <div data-aos="fade-up">
            <div class="f-section-badge"><i class="fas fa-heart"></i> Life At Rescom</div>
            <h2 class="f-section-title">More Than a Job — <span style="color:#0284c7">An Engineering Community</span></h2>
        </div>

        <div class="f-benefits-grid">
            @foreach($benefits as $benefit)
            @php
                $icon = $benefit->icon ?: 'fas fa-star';
                $color = $benefit->color ?: '#0284c7';
            @endphp
            <div class="f-benefit-card" data-aos="fade-up">
                <div class="f-benefit-icon-bay" style="background:{{ $color }}18;color:{{ $color }};border:1px solid {{ $color }}35">
                    <i class="{{ $icon }}"></i>
                </div>
                <h4 class="f-benefit-title">{{ $benefit->title }}</h4>
                <p class="f-benefit-desc">{{ $benefit->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =============== DEPARTMENT FILTER MATRIX =============== -->
<div class="f-filter-strip">
    <div class="f-wide-container">
        <div class="f-filter-container">
            <a href="{{ route('careers') }}" class="f-filter-btn {{ !$activeDepartment ? 'active' : '' }}" data-careers-filter="all">
                <i class="fas fa-layer-group" style="font-size:12px"></i>
                <span>All Roles</span>
                <span class="f-filter-count">{{ $jobs->count() }}</span>
            </a>
            @foreach($departments ?? [] as $dept)
            @php($deptKey = \Illuminate\Support\Str::slug($dept))
            <a href="{{ route('careers', ['department' => $dept]) }}" class="f-filter-btn {{ $activeDepartment === $dept ? 'active' : '' }}" data-careers-filter="{{ $deptKey }}">
                <span>{{ $dept }}</span>
                <span class="f-filter-count">{{ $departmentCounts[$dept] ?? 0 }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- =============== OPEN POSITIONS STAGE =============== -->
<section class="f-jobs-section">
    <div class="f-jobs-grid-mesh"></div>

    <div class="f-wide-container">
        @if($jobs->count())
        @foreach($grouped as $department => $deptJobs)
        @php($departmentKey = \Illuminate\Support\Str::slug($department ?: 'general'))
        <div class="f-dept-block" data-careers-department="{{ $departmentKey }}" data-aos="fade-up">
            <h3 class="f-dept-heading">
                <span class="f-dept-count-badge">{{ $deptJobs->count() }}</span>
                <span>{{ $department ?: 'Core Engineering' }}</span>
            </h3>

            <div>
                @foreach($deptJobs as $job)
                <a href="{{ route('careers.show', $job->slug) }}" class="f-job-card">
                    <div class="f-corner-reticle f-reticle-tl"></div>
                    <div class="f-corner-reticle f-reticle-tr"></div>
                    <div class="f-corner-reticle f-reticle-bl"></div>
                    <div class="f-corner-reticle f-reticle-br"></div>

                    <div>
                        <h4 class="f-job-title">{{ $job->title }}</h4>
                        <div class="f-job-tags-row">
                            <span class="f-job-pill"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                            <span class="f-job-pill"><i class="fas fa-briefcase"></i> {{ str_replace('-',' ',ucfirst($job->job_type)) }}</span>
                            <span class="f-job-pill"><i class="fas fa-clock"></i> {{ $job->experience }}</span>
                            @if($job->salary_range)
                            <span class="f-job-pill f-job-pill-salary"><i class="fas fa-money-bill-wave"></i> {{ $job->salary_range }}</span>
                            @endif
                        </div>
                    </div>

                    <span class="f-job-apply-btn">
                        <span>Apply For Role</span>
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach

        @else
        <div style="text-align:center;padding:60px 24px;background:#ffffff;border-radius:24px;border:1.5px solid #e2e8f0;max-width:700px;margin:0 auto" data-aos="fade-up">
            <div style="width:72px;height:72px;border-radius:20px;background:#e0f2fe;color:#0284c7;display:flex;align-items:center;justify-content:center;font-size:32px;margin:0 auto 16px auto">
                <i class="fas fa-search"></i>
            </div>
            <h3 style="font-size:22px;font-weight:850;color:#0f172a;margin-bottom:8px">No Open Positions In This Domain</h3>
            <p style="color:#64748b;font-size:14.5px;line-height:1.6;margin-bottom:24px">We are continuously expanding our squads. Submit an open application and our talent leads will reach out when a match opens.</p>
            <a href="mailto:careers@rescom.in" class="f-btn-primary">
                <i class="fas fa-paper-plane"></i> Send Open Application
            </a>
        </div>
        @endif
    </div>
</section>

<!-- =============== FUTURISTIC BOTTOM CTA BANNER =============== -->
<section class="futuristic-cta-banner" data-aos="fade-up">
    <div class="container">
        <div class="f-cta-box">
            <h2 class="f-cta-title">Don't See Your Exact Role?</h2>
            <p class="f-cta-desc">
                We are always seeking exceptional engineers, system architects, and technical minds. Transmit your portfolio and let's start a conversation.
            </p>
            <a href="mailto:careers@rescom.in" class="f-btn-primary">
                <i class="fas fa-envelope"></i> Send General Application
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = Array.from(document.querySelectorAll('[data-careers-filter]'));
    const departmentSections = Array.from(document.querySelectorAll('[data-careers-department]'));

    if (!filterButtons.length || !departmentSections.length) return;

    const slugify = (value) => (value || '')
        .toString()
        .trim()
        .toLowerCase()
        .replace(/&/g, 'and')
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');

    const getActiveFilterFromUrl = () => {
        const params = new URLSearchParams(window.location.search);
        const department = params.get('department');
        return department ? slugify(department) : 'all';
    };

    const updateButtons = (activeFilter) => {
        filterButtons.forEach((button) => {
            const isActive = button.dataset.careersFilter === activeFilter;
            button.classList.toggle('active', isActive);
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
    };

    const updateSections = (activeFilter) => {
        departmentSections.forEach((section) => {
            const matches = activeFilter === 'all' || section.dataset.careersDepartment === activeFilter;
            section.style.display = matches ? '' : 'none';
        });
    };

    const syncUrl = (activeFilter) => {
        const nextUrl = new URL(window.location.href);
        if (activeFilter === 'all') {
            nextUrl.searchParams.delete('department');
        } else {
            nextUrl.searchParams.set('department', activeFilter);
        }
        window.history.pushState({ department: activeFilter }, '', nextUrl);
    };

    const applyFilter = (activeFilter, shouldUpdateUrl = false) => {
        const normalized = activeFilter ? slugify(activeFilter) : 'all';
        updateButtons(normalized);
        updateSections(normalized);
        if (shouldUpdateUrl) {
            syncUrl(normalized);
        }
    };

    filterButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            applyFilter(button.dataset.careersFilter || 'all', true);
        });
    });

    window.addEventListener('popstate', () => {
        applyFilter(getActiveFilterFromUrl(), false);
    });

    applyFilter(getActiveFilterFromUrl(), false);
});
</script>
@endsection
