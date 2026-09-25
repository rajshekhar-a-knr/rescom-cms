@extends('layouts.app')
@section('title', $job->title . ' - Careers | Rescom')
@php($recaptchaSiteKey = recaptcha_site_key())

@section('content')
@include('partials.recaptcha-script')

<!-- =============== ULTRA-ADVANCED FULL-WIDTH CAREER HERO =============== -->
<section class="futuristic-career-hero">
    <style>
        /* Header Contrast */
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

        /* Full Width Wide Hero Container */
        .futuristic-career-hero {
            position: relative;
            background: #040814;
            padding-top: clamp(140px, 17vh, 180px);
            padding-bottom: clamp(60px, 8vh, 90px);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 1px solid rgba(56, 189, 248, 0.15);
        }
        .has-topbar .futuristic-career-hero {
            padding-top: clamp(165px, 20vh, 205px);
        }

        .f-hero-bg-deep {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.28) 0%, transparent 45%),
                radial-gradient(circle at 90% 25%, rgba(147, 51, 234, 0.25) 0%, transparent 45%),
                radial-gradient(circle at 50% 90%, rgba(6, 182, 212, 0.2) 0%, transparent 50%),
                linear-gradient(180deg, #060b18 0%, #040711 100%);
            z-index: 1;
            pointer-events: none;
        }

        .f-cyber-grid-overlay {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(56, 189, 248, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.07) 1px, transparent 1px);
            background-size: 45px 45px;
            mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
            -webkit-mask-image: radial-gradient(circle at 50% 50%, black 40%, transparent 90%);
            z-index: 1;
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

        /* Hero Cockpit Layout */
        .f-hero-cockpit {
            display: grid;
            grid-template-columns: 1.25fr 0.75fr;
            gap: 40px;
            align-items: center;
        }
        @media (max-width: 1024px) {
            .f-hero-cockpit {
                grid-template-columns: 1fr;
                gap: 28px;
            }
        }

        .f-hud-badge {
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
        }
        .f-radar-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 10px #10b981;
            animation: fRadarPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes fRadarPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.35); }
        }
        .f-badge-subtitle {
            font-size: 11.5px;
            font-weight: 800;
            color: #f8fafc;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }
        .f-badge-divider {
            width: 1px;
            height: 10px;
            background: rgba(255, 255, 255, 0.25);
        }
        .f-badge-tag {
            font-size: 11px;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: 0.4px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .f-hero-title {
            font-size: clamp(32px, 3.8vw, 52px);
            font-weight: 900;
            line-height: 1.15;
            letter-spacing: -0.03em;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: none !important;
        }

        .f-job-meta-strip {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .f-job-pill-hero {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 7px 16px;
            border-radius: 9px;
            font-size: 13px;
            color: #e2e8f0;
            font-weight: 600;
            backdrop-filter: blur(8px);
        }
        .f-job-pill-hero i {
            color: #38bdf8;
        }

        /* Right Hero Telemetry Card */
        .f-hero-status-deck {
            background: rgba(15, 23, 42, 0.65);
            border: 1.5px solid rgba(56, 189, 248, 0.25);
            border-radius: 20px;
            padding: 24px 28px;
            backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        }
        .f-status-deck-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .f-status-deck-title {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: #38bdf8;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .f-status-deck-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
        .f-status-stat-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .f-status-stat-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .f-status-stat-val {
            font-size: 14.5px;
            font-weight: 800;
            color: #ffffff;
        }

        /* ===== MAIN BODY SECTION ===== */
        .futuristic-body-section {
            position: relative;
            background: #f8fafc;
            padding: clamp(50px, 7vh, 80px) 0 clamp(80px, 10vh, 120px) 0;
            overflow: hidden;
        }
        .f-body-grid-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(14, 165, 233, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.04) 1px, transparent 1px);
            background-size: 36px 36px;
            pointer-events: none;
        }

        .f-stage-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 48px;
            align-items: start;
        }
        @media (max-width: 1100px) {
            .f-stage-layout {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        .f-stage-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 24px;
            padding: clamp(26px, 4vw, 44px);
            box-shadow: 0 10px 35px rgba(15, 23, 42, 0.04);
            margin-bottom: 32px;
        }
        .f-deck-heading {
            font-size: 20px;
            font-weight: 850;
            color: #0f172a;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .f-deck-heading i { color: #0284c7; }

        .f-content-text {
            font-size: 16px;
            line-height: 1.85;
            color: #334155;
            white-space: pre-line;
        }

        .f-skills-matrix {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .f-skill-chip {
            background: #f0f9ff;
            border: 1.5px solid rgba(14, 165, 233, 0.3);
            color: #0369a1;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 700;
        }

        /* Application Form Card */
        .f-apply-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 24px;
            padding: clamp(26px, 4vw, 44px);
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.05);
        }
        .f-form-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 16px;
        }
        @media (max-width: 640px) {
            .f-form-grid-2 {
                grid-template-columns: 1fr;
            }
        }
        .f-form-group {
            margin-bottom: 16px;
        }
        .f-field-label {
            display: block;
            font-size: 13px;
            font-weight: 750;
            color: #1e293b;
            margin-bottom: 6px;
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

        /* Sidebar Styles */
        .f-mission-control-wrap {
            position: sticky;
            top: 110px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .f-sidebar-details-card {
            background: #ffffff;
            border: 1.5px solid rgba(226, 232, 240, 0.95);
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.04);
        }
        .f-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .f-detail-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
        }
        .f-detail-val {
            font-size: 13.5px;
            color: #0f172a;
            font-weight: 750;
        }

        .f-related-job-item {
            display: block;
            padding: 12px 14px;
            border-radius: 12px;
            text-decoration: none;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            margin-bottom: 8px;
            transition: all 0.25s ease;
        }
        .f-related-job-item:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
            transform: translateX(4px);
        }
        .f-related-job-title {
            font-size: 14px;
            font-weight: 750;
            color: #0f172a;
            margin-bottom: 3px;
        }
        .f-related-job-sub {
            font-size: 12px;
            color: #64748b;
        }
    </style>

    <div class="f-hero-bg-deep"></div>
    <div class="f-cyber-grid-overlay"></div>

    <div class="f-wide-container" data-aos="fade-up">
        <div class="f-hero-cockpit">
            <div>
                <div class="f-hud-badge">
                    <span class="f-radar-dot"></span>
                    <span class="f-badge-subtitle">{{ $job->department ?: 'ENGINEERING SQUAD' }}</span>
                    <span class="f-badge-divider"></span>
                    <span class="f-badge-tag"><i class="fas fa-briefcase"></i> OPEN ROLE</span>
                </div>

                <h1 class="f-hero-title">{{ $job->title }}</h1>

                <div class="f-job-meta-strip">
                    <span class="f-job-pill-hero"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                    <span class="f-job-pill-hero"><i class="fas fa-clock"></i> {{ str_replace('-',' ',ucfirst($job->job_type)) }}</span>
                    <span class="f-job-pill-hero"><i class="fas fa-user-graduate"></i> {{ $job->experience }}</span>
                    @if($job->salary_range)
                    <span class="f-job-pill-hero" style="border-color:rgba(251,191,36,0.4);color:#fde047"><i class="fas fa-money-bill-wave" style="color:#fde047"></i> {{ $job->salary_range }}</span>
                    @endif
                </div>
            </div>

            <div>
                <div class="f-hero-status-deck">
                    <div class="f-status-deck-header">
                        <span class="f-status-deck-title"><i class="fas fa-microchip"></i> Role Telemetry</span>
                        <div style="display:flex;align-items:center;gap:6px">
                            <span style="width:7px;height:7px;border-radius:50%;background:#10b981"></span>
                            <span style="font-size:11px;font-weight:700;color:#10b981">ACTIVE HIRING</span>
                        </div>
                    </div>
                    <div class="f-status-deck-grid">
                        <div class="f-status-stat-item">
                            <span class="f-status-stat-label">Department</span>
                            <span class="f-status-stat-val">{{ $job->department ?: 'General' }}</span>
                        </div>
                        <div class="f-status-stat-item">
                            <span class="f-status-stat-label">Work Model</span>
                            <span class="f-status-stat-val">Hybrid / Flexible</span>
                        </div>
                        <div class="f-status-stat-item">
                            <span class="f-status-stat-label">Vacancies</span>
                            <span class="f-status-stat-val">{{ $job->vacancies ?? 'Multiple' }}</span>
                        </div>
                        <div class="f-status-stat-item">
                            <span class="f-status-stat-label">Response Time</span>
                            <span class="f-status-stat-val">&lt; 48 Hours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============== FULL-WIDTH CAREER BODY SECTION =============== -->
<section class="futuristic-body-section">
    <div class="f-body-grid-mesh"></div>

    <div class="f-wide-container">
        <div class="f-stage-layout">
            <!-- Main Content -->
            <div>
                @if($job->description)
                <div class="f-stage-card" data-aos="fade-up">
                    <h2 class="f-deck-heading"><i class="fas fa-info-circle"></i> About This Opportunity</h2>
                    <p class="f-content-text">{{ $job->description }}</p>
                </div>
                @endif

                @if($job->responsibilities)
                <div class="f-stage-card" data-aos="fade-up">
                    <h2 class="f-deck-heading"><i class="fas fa-tasks"></i> Key Responsibilities</h2>
                    <div class="f-content-text">{{ $job->responsibilities }}</div>
                </div>
                @endif

                @if($job->requirements)
                <div class="f-stage-card" data-aos="fade-up">
                    <h2 class="f-deck-heading"><i class="fas fa-clipboard-check"></i> Candidate Requirements</h2>
                    <div class="f-content-text">{{ $job->requirements }}</div>
                </div>
                @endif

                @if($job->skills_required && count($job->skills_required) > 0)
                <div class="f-stage-card" data-aos="fade-up">
                    <h2 class="f-deck-heading"><i class="fas fa-layer-group"></i> Required Tech Stack & Skills</h2>
                    <div class="f-skills-matrix">
                        @foreach($job->skills_required as $skill)
                        <span class="f-skill-chip">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($job->benefits)
                <div class="f-stage-card" data-aos="fade-up">
                    <h2 class="f-deck-heading"><i class="fas fa-gift"></i> Compensation & Squad Benefits</h2>
                    <div class="f-content-text">{{ $job->benefits }}</div>
                </div>
                @endif

                <!-- Application Form -->
                <div id="apply" class="f-apply-card" data-aos="fade-up">
                    <h2 class="f-deck-heading" style="margin-bottom:6px"><i class="fas fa-paper-plane"></i> Apply For This Role</h2>
                    <p style="color:#64748b;margin-bottom:26px;font-size:14.5px">Transmit your candidacy. Our technical hiring leads will review and respond within 48 hours.</p>

                    @if(session('success'))
                    <div class="alert alert-success" style="background:#f0fdf4;border:1.5px solid #86efac;color:#166534;padding:16px 20px;border-radius:14px;margin-bottom:24px;display:flex;align-items:center;gap:10px;font-weight:700">
                        <i class="fas fa-check-circle" style="font-size:20px;color:#16a34a"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="{{ route('careers.apply', $job->id) }}" method="POST" enctype="multipart/form-data" id="careerApplyForm">
                        @csrf
                        <div class="f-form-grid-2">
                            <div>
                                <label class="f-field-label">Full Legal Name *</label>
                                <input type="text" name="applicant_name" class="f-form-input" required maxlength="255" value="{{ old('applicant_name') }}" placeholder="John Doe">
                                @error('applicant_name')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="f-field-label">Email Address *</label>
                                <input type="email" name="applicant_email" class="f-form-input" required maxlength="255" value="{{ old('applicant_email') }}" placeholder="john@example.com">
                                @error('applicant_email')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="f-form-grid-2">
                            <div>
                                <label class="f-field-label">Phone Number</label>
                                <div style="display:grid;grid-template-columns:110px 1fr;gap:8px">
                                    <select name="applicant_country_code" class="f-form-select" data-digits-source>
                                        @foreach([
                                            ['+91','India',10],
                                            ['+1','USA/Canada',10],
                                            ['+44','UK',10],
                                            ['+61','Australia',9],
                                            ['+971','UAE',9],
                                        ] as [$code,$label,$digits])
                                            <option value="{{ $code }}" data-digits="{{ $digits }}" {{ old('applicant_country_code', '+91')===$code ? 'selected' : '' }}>
                                                {{ $code }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="tel" name="applicant_phone" class="f-form-input" maxlength="20" inputmode="tel" value="{{ old('applicant_phone') }}" placeholder="98459 19158" data-country-selector>
                                </div>
                                @error('applicant_country_code')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                                @error('applicant_phone')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="f-field-label">LinkedIn Profile URL</label>
                                <input type="url" name="linkedin_url" class="f-form-input" maxlength="255" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/username">
                                @error('linkedin_url')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="f-form-grid-2">
                            <div>
                                <label class="f-field-label">Current Compensation (CTC)</label>
                                <input type="text" name="current_ctc" class="f-form-input" maxlength="100" placeholder="e.g. ₹8 LPA" value="{{ old('current_ctc') }}">
                                @error('current_ctc')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="f-field-label">Expected Compensation (CTC)</label>
                                <input type="text" name="expected_ctc" class="f-form-input" maxlength="100" placeholder="e.g. ₹12 LPA" value="{{ old('expected_ctc') }}">
                                @error('expected_ctc')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="f-form-grid-2">
                            <div>
                                <label class="f-field-label">Notice Period</label>
                                <input type="text" name="notice_period" class="f-form-input" maxlength="100" placeholder="e.g. Immediate / 30 Days" value="{{ old('notice_period') }}">
                                @error('notice_period')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                            <div>
                                <label class="f-field-label">Portfolio / GitHub URL (Optional)</label>
                                <input type="url" name="portfolio_url" class="f-form-input" maxlength="255" value="{{ old('portfolio_url') }}" placeholder="https://github.com/username">
                                @error('portfolio_url')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="f-form-group">
                            <label class="f-field-label">Resume / Curriculum Vitae * (PDF, DOC, DOCX)</label>
                            <input type="file" name="resume" class="f-form-input" accept=".pdf,.doc,.docx" required>
                            @error('resume')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-form-group">
                            <label class="f-field-label">Cover Note / Brief Intro</label>
                            <textarea name="cover_letter" class="f-form-textarea" rows="4" maxlength="3000" placeholder="Tell us about key systems you've architected or why you'd be a great match for this role...">{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-form-group" style="display:flex;flex-direction:column;align-items:center;gap:8px">
                            @if($recaptchaSiteKey)
                                <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
                            @else
                                <div class="field-error" style="color:#64748b;font-size:12px">reCAPTCHA verification ready.</div>
                            @endif
                            @error('career_captcha')<div class="field-error" style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="f-submit-btn" id="careerSubmitBtn">
                            <i class="fas fa-paper-plane"></i>
                            <span>Transmit Application</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sticky Sidebar -->
            <div>
                <div class="f-mission-control-wrap">
                    <div class="f-sidebar-details-card" data-aos="fade-up">
                        <h4 style="font-size:17px;font-weight:850;color:#0f172a;margin-bottom:16px;display:flex;align-items:center;gap:8px">
                            <i class="fas fa-clipboard-list" style="color:#0284c7"></i>
                            <span>Role Specifications</span>
                        </h4>

                        <div class="f-detail-row">
                            <span class="f-detail-label">Department</span>
                            <span class="f-detail-val">{{ $job->department ?: 'General' }}</span>
                        </div>
                        <div class="f-detail-row">
                            <span class="f-detail-label">Location</span>
                            <span class="f-detail-val">{{ $job->location }}</span>
                        </div>
                        <div class="f-detail-row">
                            <span class="f-detail-label">Employment Type</span>
                            <span class="f-detail-val">{{ str_replace('-',' ',ucfirst($job->job_type)) }}</span>
                        </div>
                        <div class="f-detail-row">
                            <span class="f-detail-label">Experience</span>
                            <span class="f-detail-val">{{ $job->experience }}</span>
                        </div>
                        @if($job->salary_range)
                        <div class="f-detail-row">
                            <span class="f-detail-label">Salary Band</span>
                            <span class="f-detail-val" style="color:#0284c7">{{ $job->salary_range }}</span>
                        </div>
                        @endif
                        @if($job->vacancies)
                        <div class="f-detail-row">
                            <span class="f-detail-label">Open Positions</span>
                            <span class="f-detail-val">{{ $job->vacancies }}</span>
                        </div>
                        @endif
                        @if($job->deadline)
                        <div class="f-detail-row">
                            <span class="f-detail-label">Apply Deadline</span>
                            <span class="f-detail-val">{{ $job->deadline->format('M d, Y') }}</span>
                        </div>
                        @endif

                        <a href="#apply" class="f-submit-btn" style="margin-top:20px;text-decoration:none">
                            <i class="fas fa-paper-plane"></i>
                            <span>Apply Now</span>
                        </a>
                    </div>

                    @if($related->count())
                    <div class="f-sidebar-details-card" data-aos="fade-up" data-aos-delay="100">
                        <h4 style="font-size:16px;font-weight:850;color:#0f172a;margin-bottom:14px;display:flex;align-items:center;gap:8px">
                            <i class="fas fa-briefcase" style="color:#0284c7"></i>
                            <span>Other Open Positions</span>
                        </h4>

                        @foreach($related as $r)
                        <a href="{{ route('careers.show', $r->slug) }}" class="f-related-job-item">
                            <div class="f-related-job-title">{{ $r->title }}</div>
                            <div class="f-related-job-sub">{{ $r->location }} · {{ str_replace('-',' ',ucfirst($r->job_type)) }}</div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
const careerForm = document.getElementById('careerApplyForm');
const careerSubmitBtn = document.getElementById('careerSubmitBtn');
if (careerForm && careerSubmitBtn) {
    careerForm.addEventListener('submit', () => {
        careerSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Transmitting Application...';
        careerSubmitBtn.disabled = true;
    });
}
</script>
@endsection
