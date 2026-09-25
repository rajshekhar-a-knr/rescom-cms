@extends('layouts.app')
@section('title','Internship')

@php
    $highlights = [
        ['icon' => 'fas fa-rocket', 'title' => 'Live project exposure', 'text' => 'Students see how ideas move from requirement to delivery.'],
        ['icon' => 'fas fa-chalkboard-teacher', 'title' => 'Mentor-led growth', 'text' => 'Guidance from working teams keeps learning practical and relevant.'],
        ['icon' => 'fas fa-award', 'title' => 'Portfolio-ready outcomes', 'text' => 'Interns build experience they can confidently present to colleges and recruiters.'],
        ['icon' => 'fas fa-network-wired', 'title' => 'Alumni momentum', 'text' => 'A strong talent network helps students stay connected after the program.'],
    ];

    $journey = [
        ['step' => '01', 'title' => 'Explore the program', 'text' => 'Review the internship showcase, current openings, and alumni profiles.'],
        ['step' => '02', 'title' => 'Connect with Rescom', 'text' => 'Reach out through the contact page to discuss fit, timelines, and expectations.'],
        ['step' => '03', 'title' => 'Learn by building', 'text' => 'Work with real teams, deliver tasks, and strengthen practical skills every week.'],
        ['step' => '04', 'title' => 'Move forward with confidence', 'text' => 'Complete the journey with experience, feedback, and a better career story.'],
    ];

    $trackCards = [
        ['label' => 'Live Projects', 'value' => 'Hands-on work', 'icon' => 'fas fa-laptop-code'],
        ['label' => 'Mentorship', 'value' => 'Team guidance', 'icon' => 'fas fa-user-graduate'],
        ['label' => 'Growth', 'value' => 'Skill building', 'icon' => 'fas fa-chart-line'],
    ];

    $applicationErrorFields = [
        'applicant_name',
        'applicant_email',
        'applicant_country_code',
        'applicant_phone',
        'cover_letter',
        'portfolio_url',
        'linkedin_url',
        'current_ctc',
        'expected_ctc',
        'notice_period',
        'resume',
        'career_captcha',
    ];
    $hasApplicationErrors = collect($applicationErrorFields)->contains(fn ($field) => $errors->has($field));
    $oldApplicationJobId = old('application_job_id');
    $recaptchaSiteKey = recaptcha_site_key();
@endphp

@section('content')
<section class="internship-hero">
    <div class="internship-hero__bg"></div>
    <div class="container internship-shell" style="margin-top: 60px;">
        <div class="internship-hero__grid">
            <div class="internship-hero__copy" data-aos="fade-up">
                <span class="internship-eyebrow">
                    <i class="fas fa-graduation-cap"></i>
                    Rescom Internship Program
                </span>
                <h1>
                    Build real skills with 
                    <!-- @if(setting('site_logo'))
                        <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Rescom') }}" class="internship-inline-logo">
                    @else
                        <span class="internship-inline-logo-text">{{ setting('site_name', 'Rescom') }}</span>
                    @endif -->
                    <span style="color:#e53935;">K</span><span style="color:#1e88e5;">N</span><span style="color:#43a047;">R</span> that values Every Student.
                </h1>
                <p>
                    Discover current and alumni interns contributing to meaningful work at Rescom.
                    This page is designed for colleges, students, and parents who want a clear,
                    inspiring view of the internship experience.
                </p>

                <div class="internship-hero__actions">
                    <a href="#internship-openings" class="btn btn-primary internship-btn">
                        <i class="fas fa-paper-plane"></i>
                        Apply for internship
                    </a>
                    <button type="button" class="btn internship-btn internship-btn--testimonial" data-intern-testimonial-open>
                        <i class="fas fa-quote-left"></i>
                        Fill testimonial
                    </button>
                    <a href="{{ route('contact') }}" class="btn internship-btn internship-btn--ghost">
                        <i class="fas fa-headset"></i>
                        Talk to Rescom
                    </a>
                </div>

                <div class="internship-metrics" aria-label="Internship counts">
                    <div class="internship-metric">
                        <strong>{{ $counts['current'] }}</strong>
                        <span>Current interns</span>
                    </div>
                    <div class="internship-metric">
                        <strong>{{ $counts['alumni'] }}</strong>
                        <span>Alumni interns</span>
                    </div>
                    <div class="internship-metric internship-metric--wide">
                        <strong>Industry-first</strong>
                        <span>Mentorship, live tasks, and portfolio-ready learning</span>
                    </div>
                </div>
            </div>

            <div class="internship-hero__visual" aria-hidden="true" data-aos="zoom-in">
                <div class="internship-visual__frame">
                    <div class="internship-visual__glow"></div>
                    <div class="internship-visual__badge">
                        <i class="fas fa-code"></i>
                    </div>

                    @foreach($trackCards as $index => $card)
                        <div class="internship-visual__card internship-visual__card--{{ $index + 1 }}">
                            <span>{{ $card['label'] }}</span>
                            <strong>{{ $card['value'] }}</strong>
                            <i class="{{ $card['icon'] }}"></i>
                        </div>
                    @endforeach

                    <div class="internship-visual__center">
                        <div class="internship-visual__ring">
                            <span><i class="bi bi-award-fill me-1"></i> Skill</span>
                            <span><i class="bi bi-mortarboard-fill me-1"></i> Upskill</span>
                            <span><i class="bi bi-arrow-clockwise me-1"></i> Reskill</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="internship-trustbar" data-aos="fade-up">
            <div class="internship-trustbar__item"><i class="fas fa-briefcase"></i> Modern engineering exposure</div>
            <div class="internship-trustbar__item"><i class="fas fa-users"></i> Student-friendly mentorship</div>
            <div class="internship-trustbar__item"><i class="fas fa-award"></i> Strong alumni network</div>
            <div class="internship-trustbar__item"><i class="fas fa-certificate"></i> Certificate-ready journey</div>
        </div>
    </div>
</section>

<section class="internship-section internship-section--soft">
    <div class="container">
        <div class="section-heading" data-aos="fade-up">
            <span class="section-kicker">Why Rescom internships stand out</span>
            <h2>A polished learning experience for students</h2>
            <p>
                We built this page to feel credible, energetic, and easy to scan. It explains the experience clearly
                while making the student stories feel premium and approachable.
            </p>
        </div>

        <div class="internship-highlights">
            @foreach($highlights as $highlight)
                <article class="internship-highlight" data-aos="fade-up">
                    <div class="internship-highlight__icon">
                        <i class="{{ $highlight['icon'] }}"></i>
                    </div>
                    <h3>{{ $highlight['title'] }}</h3>
                    <p>{{ $highlight['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="internship-section">
    <div class="container">
        <div class="section-heading section-heading--compact" data-aos="fade-up">
            <span class="section-kicker">Intern journey</span>
            <h2>How the internship experience feels from start to finish</h2>
        </div>

        <div class="internship-journey">
            @foreach($journey as $item)
                <article class="journey-step" data-aos="fade-up">
                    <div class="journey-step__number">{{ $item['step'] }}</div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="internship-section internship-section--list" id="interns-list">
    <div class="container">
        <div class="section-heading section-heading--compact" data-aos="fade-up">
            <span class="section-kicker">Intern showcase</span>
            <h2>Meet current and alumni interns</h2>
            <p>Switch between active interns and alumni to see the people representing Rescom's internship culture.</p>
            <button type="button" class="btn btn-primary internship-btn internship-section-testimonial-btn" data-intern-testimonial-open>
                <i class="fas fa-quote-left"></i>
                Submit your testimonial
            </button>
        </div>

        <div class="internship-tabs" data-aos="fade-up" data-internship-tabs data-default-type="{{ $type }}">
            <button type="button" class="tab-pill {{ $type === 'current' ? 'active' : '' }}" data-intern-tab="current">
                <i class="fas fa-user-graduate"></i>
                <span>Current Interns</span>
                <strong>{{ $counts['current'] }}</strong>
            </button>
            <button type="button" class="tab-pill {{ $type === 'alumni' ? 'active' : '' }}" data-intern-tab="alumni">
                <i class="fas fa-award"></i>
                <span>Alumni Interns</span>
                <strong>{{ $counts['alumni'] }}</strong>
            </button>
        </div>

        <div class="internship-panels">
            <div class="internship-panel {{ $type === 'current' ? 'active' : '' }}" data-intern-panel="current">
                @if($currentInterns->isEmpty())
                    <div class="internship-empty" data-aos="fade-up">
                        <div class="internship-empty__icon"><i class="fas fa-users"></i></div>
                        <h3>No current interns found.</h3>
                        <p>We're still building this section. Please check back soon or contact Rescom for internship updates.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary internship-btn internship-empty__btn">
                            <i class="fas fa-headset"></i>
                            Contact us
                        </a>
                    </div>
                @else
                    <div class="internship-grid">
                        @foreach($currentInterns as $i => $intern)
                            <a href="{{ route('internship.show', $intern) }}"
                               class="internship-card"
                               data-aos="fade-up"
                               data-aos-delay="{{ ($i % 4) * 80 }}">
                                <div class="internship-card__topline"></div>
                                <div class="internship-card__type">
                                    Current Intern
                                </div>
                                <div class="internship-avatar">
                                    <div class="internship-avatar__inner">
                                        @if($intern->photo)
                                            <img src="{{ media_url($intern->photo) }}" alt="{{ $intern->name }}">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="internship-card__body">
                                    <h3>{{ $intern->name }}</h3>
                                    <p class="internship-card__role">{{ $intern->designation }}</p>
  <p class="internship-card__bio">{{ Str::words($intern->bio ?? 'A driven intern contributing to meaningful work at Rescom.', 18, ' ....') }}</p>

                                    @if(is_array($intern->skills) && count($intern->skills))
                                        <div class="internship-card__skills">
                                            @foreach(array_slice($intern->skills, 0, 3) as $skill)
                                                <span>{{ trim($skill) }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- <div class="internship-card__footer">
                                    <span>View profile</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div> -->
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="internship-panel {{ $type === 'alumni' ? 'active' : '' }}" data-intern-panel="alumni">
                @if($alumniInterns->isEmpty())
                    <div class="internship-empty" data-aos="fade-up">
                        <div class="internship-empty__icon"><i class="fas fa-award"></i></div>
                        <h3>No alumni interns found.</h3>
                        <p>We're still building this section. Please check back soon or contact Rescom for internship updates.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary internship-btn internship-empty__btn">
                            <i class="fas fa-headset"></i>
                            Contact us
                        </a>
                    </div>
                @else
                    <div class="internship-grid">
                        @foreach($alumniInterns as $i => $intern)
                            <a href="{{ route('internship.show', $intern) }}"
                               class="internship-card"
                               data-aos="fade-up"
                               data-aos-delay="{{ ($i % 4) * 80 }}">
                                <div class="internship-card__topline"></div>
                                <div class="internship-card__type">
                                    Alumni Intern
                                </div>
                                <div class="internship-avatar">
                                    <div class="internship-avatar__inner">
                                        @if($intern->photo)
                                            <img src="{{ media_url($intern->photo) }}" alt="{{ $intern->name }}">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="internship-card__body">
                                    <h3>{{ $intern->name }}</h3>
                                    <p class="internship-card__role">{{ $intern->designation }}</p>
                                    <p class="internship-card__bio">{{ Str::limit($intern->bio ?? 'A driven intern contributing to meaningful work at Rescom.', 110) }}</p>

                                    <!-- @if(is_array($intern->skills) && count($intern->skills))
                                        <div class="internship-card__skills">
                                            @foreach(array_slice($intern->skills, 0, 3) as $skill)
                                                <span>{{ trim($skill) }}</span>
                                            @endforeach
                                        </div>
                                    @endif -->
                                </div>

                                <!-- <div class="internship-card__footer">
                                    <span>View profile</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div> -->
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


<section class="internship-section internship-openings-section" id="internship-openings">
    <div class="container">
        <div class="section-heading section-heading--compact" data-aos="fade-up">
            <span class="section-kicker">Open internship careers</span>
            <h2>Choose an internship and apply right here</h2>
            <p>All internship roles published from the Careers module appear here automatically, so students can discover the right opening and submit their resume without leaving this page.</p>
        </div>

        @if(session('success'))
            <div class="internship-alert internship-alert--success" data-aos="fade-up">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($hasApplicationErrors)
            <div class="internship-alert internship-alert--error" data-aos="fade-up">
                <i class="fas fa-circle-exclamation"></i>
                <span>Please correct the highlighted fields and submit your internship application again.</span>
            </div>
        @endif

        @if($internshipJobs->isEmpty())
            <div class="internship-empty internship-openings-empty" data-aos="fade-up">
                <div class="internship-empty__icon"><i class="fas fa-briefcase"></i></div>
                <h3>No internship openings right now.</h3>
                <p>Internship careers added in the admin Careers module will appear here automatically. Students can still contact Rescom for upcoming batches.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary internship-btn internship-empty__btn">
                    <i class="fas fa-headset"></i>
                    Contact Rescom
                </a>
            </div>
        @else
            <div class="internship-openings-grid">
                @foreach($internshipJobs as $job)
                    <article class="internship-opening-card" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                        <div class="internship-opening-card__badge">
                            <i class="fas fa-graduation-cap"></i>
                            Internship
                        </div>
                        <h3>{{ $job->title }}</h3>
                        <div class="internship-opening-card__meta">
                            @if($job->department)
                                <span><i class="fas fa-layer-group"></i> {{ $job->department }}</span>
                            @endif
                            @if($job->location)
                                <span><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                            @endif
                            @if($job->job_type)
                                <span><i class="fas fa-clock"></i> {{ str_replace('-', ' ', ucfirst($job->job_type)) }}</span>
                            @endif
                            @if($job->experience)
                                <span><i class="fas fa-user-graduate"></i> {{ $job->experience }}</span>
                            @endif
                        </div>
                        @if($job->description)
                            <p>{{ Str::limit(strip_tags($job->description), 150) }}</p>
                        @endif
                        @if(is_array($job->skills_required) && count($job->skills_required))
                            <div class="internship-opening-card__skills">
                                @foreach(array_slice($job->skills_required, 0, 5) as $skill)
                                    <span>{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="internship-opening-card__footer">
                            <div>
                                @if($job->vacancies)
                                    <strong>{{ $job->vacancies }}</strong>
                                    <span>{{ $job->vacancies > 1 ? 'Open seats' : 'Open seat' }}</span>
                                @else
                                    <strong>Apply</strong>
                                    <span>Now open</span>
                                @endif
                            </div>
                            <button type="button"
                                    class="btn btn-primary internship-btn internship-opening-card__apply"
                                    data-application-open
                                    data-job-id="{{ $job->id }}"
                                    data-job-title="{{ $job->title }}"
                                    data-action="{{ route('careers.apply', $job->id) }}">
                                <i class="fas fa-paper-plane"></i>
                                Apply now
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="internship-apply-modal {{ $hasApplicationErrors ? 'is-open' : '' }}" data-application-modal aria-hidden="{{ $hasApplicationErrors ? 'false' : 'true' }}">
                <div class="internship-apply-modal__backdrop" data-application-close></div>
                <div class="internship-apply-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="internshipApplyTitle">
                    <button type="button" class="internship-apply-modal__close" data-application-close aria-label="Close application form">
                        <i class="fas fa-times"></i>
                    </button>
                    <span class="section-kicker">Internship application</span>
                    <h2 id="internshipApplyTitle">Apply for Internship</h2>
                    <p class="internship-apply-modal__subtitle">Share your details and resume. Rescom will review your application and get back to you soon.</p>

                    <form method="POST" enctype="multipart/form-data" data-application-form id="internshipApplyForm">
                        @csrf
                        <input type="hidden" name="application_job_id" value="{{ $oldApplicationJobId }}" data-application-job-id>

                        <div class="internship-apply-form__grid">
                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="applicant_name" class="form-control" required maxlength="255" pattern="[A-Za-z\s\.'\-]+" title="Please use letters only." value="{{ old('applicant_name') }}">
                                @error('applicant_name')<div class="field-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" name="applicant_email" class="form-control" required maxlength="255" value="{{ old('applicant_email') }}">
                                @error('applicant_email')<div class="field-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <div class="internship-phone-grid">
                                    <select name="applicant_country_code" class="form-control" data-digits-source>
                                        @foreach([
                                            ['+91','India',10],
                                            ['+1','USA/Canada',10],
                                            ['+44','UK',10],
                                            ['+61','Australia',9],
                                            ['+971','UAE',9],
                                        ] as [$code,$label,$digits])
                                            <option value="{{ $code }}" data-digits="{{ $digits }}" {{ old('applicant_country_code', '+91')===$code ? 'selected' : '' }}>
                                                {{ $code }} {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="tel" name="applicant_phone" class="form-control" maxlength="20" inputmode="tel" pattern="[0-9\s\+\-\(\)]+" title="Please use numbers only." value="{{ old('applicant_phone') }}" data-country-selector>
                                </div>
                                @error('applicant_country_code')<div class="field-error">{{ $message }}</div>@enderror
                                @error('applicant_phone')<div class="field-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">LinkedIn URL</label>
                                <input type="url" name="linkedin_url" class="form-control" maxlength="255" value="{{ old('linkedin_url') }}">
                                @error('linkedin_url')<div class="field-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Portfolio / GitHub URL</label>
                            <input type="url" name="portfolio_url" class="form-control" maxlength="255" value="{{ old('portfolio_url') }}">
                            @error('portfolio_url')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Why do you want this internship?</label>
                            <textarea name="cover_letter" class="form-control" rows="4" maxlength="3000" placeholder="Tell us about your skills, college, projects, and interest in Rescom.">{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Resume / CV * (PDF, DOC, DOCX)</label>
                            <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                            @error('resume')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group" style="display:flex;flex-direction:column;align-items:center;gap:8px">
                            @if($recaptchaSiteKey)
                                <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
                            @else
                                <div class="field-error">reCAPTCHA is not configured. Please add keys in admin SEO settings.</div>
                            @endif
                            @error('career_captcha')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary internship-btn internship-apply-submit" data-application-submit>
                            <i class="fas fa-paper-plane"></i>
                            Submit internship application
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</section>



@if(isset($internTestimonials) && $internTestimonials->isNotEmpty())
<section class="internship-section internship-section--testimonials">
    <div class="container">
        <div class="section-heading section-heading--compact" data-aos="fade-up">
            <span class="section-kicker">Intern testimonials</span>
            <h2>What Interns say about Rescom</h2>
        </div>

        <div class="swiper interns-testimonials-swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                @foreach($internTestimonials as $testimonial)
                    <div class="swiper-slide" style="height:auto">
                        <article class="intern-testimonial-card">
                            <div class="intern-testimonial-card__top">
                                <div class="intern-testimonial-card__avatar">
                                    @if($testimonial->client_photo)
                                        <img src="{{ media_url($testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}">
                                    @else
                                        <span>{{ strtoupper(substr($testimonial->client_name ?? 'I', 0, 1)) }}</span>
                                    @endif
                                </div>

                                <div>
                                    <h3>{{ $testimonial->client_name }}</h3>
                                    <p>
                                        {{ $testimonial->client_designation }}
                                        @if($testimonial->client_company)
                                            • {{ $testimonial->client_company }}
                                        @endif
                                    </p>
                                    @if($testimonial->intern)
                                        <div class="intern-testimonial-card__badge">
                                            Linked to {{ $testimonial->intern->name }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="intern-testimonial-card__stars" aria-label="{{ $testimonial->rating ?? 5 }} star rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= ($testimonial->rating ?? 5) ? 'active' : '' }}"></i>
                                @endfor
                            </div>

                            @if($testimonial->project_type)
                                <div class="intern-testimonial-card__meta">
                                    <span>{{ $testimonial->project_type }}</span>
                                </div>
                            @endif

                            <p class="intern-testimonial-card__content">
                                "{{ \Illuminate\Support\Str::words($testimonial->content, 28, ' ....') }}"
                            </p>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination interns-testimonials-pagination" style="position:relative;margin-top:26px"></div>
        </div>
    </div>
</section>
@endif

<section class="internship-section internship-cta">
    <div class="container">
        <div class="internship-cta__panel" data-aos="fade-up">
            <div>
                <span class="section-kicker1">For colleges & students</span>
                <h2>Looking for an internship experience that feels credible and exciting?</h2>
                <p>
                    Rescom’s internship program is built to showcase practical learning, strong mentorship,
                    and a professional environment students can be proud to present.
                </p>
            </div>
            <div class="internship-cta__actions">
                <button type="button" class="btn internship-btn internship-btn--testimonial internship-btn--testimonial-light" data-intern-testimonial-open>
                    <i class="fas fa-quote-left"></i>
                    Fill testimonial
                </button>
                <a href="{{ route('contact') }}" class="btn btn-primary internship-btn">
                    <i class="fas fa-paper-plane"></i>
                    Start a conversation
                </a>
                <a href="#interns-list" class="btn internship-btn internship-btn--ghost">
                    <i class="fas fa-users"></i>
                    View interns
                </a>
            </div>
        </div>
    </div>
</section>

@include('partials.intern-testimonial-modal', ['testimonialInterns' => $testimonialInterns])

<style>
    .internship-hero {
        position: relative;
        overflow: hidden;
        padding: 132px 0 54px;
        background:
            radial-gradient(circle at 15% 20%, rgba(59,130,246,0.18), transparent 28%),
            radial-gradient(circle at 85% 10%, rgba(37,99,235,0.16), transparent 32%),
            radial-gradient(circle at 90% 82%, rgba(14,165,233,0.16), transparent 20%),
            linear-gradient(180deg, #f4f9ff 0%, #eef5ff 42%, #f8fbff 100%);
    }

    .internship-hero__bg::before,
    .internship-hero__bg::after {
        content: '';
        position: absolute;
        inset: auto;
        border-radius: 50%;
        filter: blur(10px);
        pointer-events: none;
    }

    .internship-hero__bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .internship-hero__bg::before {
        width: 280px;
        height: 280px;
        right: -90px;
        top: 80px;
        background: rgba(37,99,235,0.10);
    }

    .internship-hero__bg::after {
        width: 220px;
        height: 220px;
        left: -70px;
        bottom: 60px;
        background: rgba(14,165,233,0.12);
    }

    .internship-shell {
        position: relative;
        z-index: 1;
    }

    .internship-hero__grid {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(340px, 0.95fr);
        gap: 44px;
        align-items: center;
    }

    .internship-hero__copy {
        max-width: 760px;
    }

    .internship-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 999px;
        background: rgba(37,99,235,0.10);
        border: 1px solid rgba(37,99,235,0.14);
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .internship-hero h1 {
        margin: 0 0 18px;
        color: #0f172a;
        font-size: clamp(44px, 5.6vw, 76px);
        line-height: .95;
        letter-spacing: -0.04em;
    }

    .internship-inline-logo {
        display: inline-block;
        height: 1.05em;
        width: auto;
        vertical-align: -0.1em;
        margin: 0 8px;
        object-fit: contain;
    }

    .internship-inline-logo-text {
        display: inline-block;
        margin: 0 8px;
        color: #0f4c81;
        font-weight: 900;
        letter-spacing: -0.03em;
    }

    .internship-hero__copy p {
        margin: 0;
        max-width: 700px;
        color: #334155;
        font-size: 18px;
        line-height: 1.8;
    }

    .internship-hero__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
    }

    .internship-btn {
        padding: 14px 20px;
        border-radius: 16px;
        font-weight: 800;
        box-shadow: 0 16px 32px rgba(37,99,235,0.16);
    }

    .internship-btn--ghost {
        background: rgba(255,255,255,0.78);
        color: #0f172a;
        border: 1px solid rgba(15,23,42,0.08);
    }

    .internship-btn--ghost:hover {
        background: rgba(255,255,255,0.96);
        color: #0f172a;
    }

    .internship-btn--testimonial {
        border: 1px solid rgba(37,99,235,0.18);
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        color: #fff;
        cursor: pointer;
    }

    .internship-btn--testimonial:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 18px 38px rgba(37,99,235,0.22);
    }

    .internship-btn--testimonial-light {
        background: rgba(255,255,255,0.96);
        color: #0f4c81;
        border-color: rgba(255,255,255,0.44);
    }

    .internship-btn--testimonial-light:hover {
        background: #fff;
        color: #0f4c81;
    }

    .internship-section-testimonial-btn {
        margin-top: 18px;
    }

    .internship-metrics {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 30px;
    }

    .internship-metric {
        padding: 18px 18px 16px;
        border-radius: 22px;
        background: rgba(255,255,255,0.82);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 18px 42px rgba(15,23,42,0.08);
        min-height: 112px;
    }

    .internship-metric strong {
        display: block;
        color: #1d4ed8;
        font-size: 30px;
        line-height: 1;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .internship-metric span {
        display: block;
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 700;
    }

    .internship-metric--wide {
        grid-column: span 1;
    }

    .internship-hero__visual {
        min-height: 520px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .internship-visual__frame {
        position: relative;
        width: min(100%, 640px);
        min-height: 440px;
        border-radius: 36px;
        background: linear-gradient(135deg, #0f4c81 0%, #1672d3 54%, #1e88e5 100%);
        box-shadow: 0 36px 90px rgba(37,99,235,0.24);
        overflow: hidden;
        padding: 26px;
    }

    .internship-visual__frame::before {
        content: '';
        position: absolute;
        inset: 16px;
        border-radius: 28px;
        border: 1px solid rgba(255,255,255,0.18);
    }

    .internship-visual__glow {
        position: absolute;
        inset: auto auto 26px 26px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        filter: blur(10px);
    }

    .internship-visual__badge {
        position: absolute;
        top: 34px;
        left: 34px;
        width: 88px;
        height: 88px;
        border-radius: 26px;
        display: grid;
        place-items: center;
        background: rgba(255,255,255,0.96);
        color: #0f4c81;
        font-size: 34px;
        box-shadow: 0 18px 36px rgba(15,23,42,0.18);
    }

    .internship-visual__center {
        position: absolute;
        inset: 0;
        display: grid;
        place-items: center;
        pointer-events: none;
    }

    .internship-visual__ring {
        width: 240px;
        height: 240px;
        border-radius: 50%;
        border: 1px dashed rgba(255,255,255,0.24);
        display: grid;
        place-items: center;
        text-align: center;
        color: rgba(255,255,255,0.92);
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
        background: rgba(255,255,255,0.06);
        box-shadow: inset 0 0 0 18px rgba(255,255,255,0.04);
    }

    .internship-visual__ring span {
        display: block;
        font-size: 22px;
        line-height: 1.1;
    }

    .internship-visual__card {
        position: absolute;
        width: 210px;
        padding: 18px 18px 16px;
        border-radius: 22px;
        background: rgba(255,255,255,0.94);
        box-shadow: 0 20px 48px rgba(15,23,42,0.18);
    }

    .internship-visual__card span {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .internship-visual__card strong {
        display: block;
        margin-top: 6px;
        color: #0f172a;
        font-size: 18px;
        line-height: 1.3;
    }

    .internship-visual__card i {
        position: absolute;
        right: 16px;
        top: 16px;
        color: #1d4ed8;
        opacity: .28;
        font-size: 22px;
    }

    .internship-visual__card--1 { right: 28px; top: 58px; }
    .internship-visual__card--2 { left: 32px; bottom: 92px; }
    .internship-visual__card--3 { right: 40px; bottom: 36px; }

    .internship-trustbar {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-top: 24px;
    }

    .internship-trustbar__item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 16px;
        border-radius: 18px;
        background: rgba(255,255,255,0.78);
        border: 1px solid rgba(15,23,42,0.08);
        color: #0f172a;
        font-weight: 700;
        box-shadow: 0 12px 28px rgba(15,23,42,0.06);
    }

    .internship-trustbar__item i {
        color: #2563eb;
    }

    .internship-section {
        padding: 70px 0;
    }

    .internship-section--soft {
        background: linear-gradient(180deg, rgba(248,250,252,0.76), rgba(239,246,255,0.52));
    }

    .internship-section--list {
        padding-top: 36px;
    }

    .section-heading {
        max-width: 840px;
        margin-bottom: 28px;
    }

    .section-heading--compact {
        margin-bottom: 22px;
    }

    .section-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #770371;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .16em;
        text-transform: uppercase;
    }

    .section-kicker1 {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #ffffff;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .16em;
        text-transform: uppercase;
    }


    .section-heading h2 {
        margin: 0;
        color: #0f172a;
        font-size: clamp(28px, 3vw, 46px);
        line-height: 1.12;
        letter-spacing: -0.03em;
    }

    .section-heading p {
        margin: 12px 0 0;
        color: #475569;
        font-size: 16px;
        line-height: 1.8;
        max-width: 760px;
    }

    .internship-highlights {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .internship-highlight {
        position: relative;
        padding: 24px;
        border-radius: 26px;
        background: rgba(255,255,255,0.84);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 18px 44px rgba(15,23,42,0.07);
    }

    .internship-highlight__icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, rgba(37,99,235,0.10), rgba(14,165,233,0.14));
        color: #1d4ed8;
        font-size: 22px;
        margin-bottom: 16px;
    }

    .internship-highlight h3 {
        margin: 0 0 10px;
        color: #0f172a;
        font-size: 20px;
    }

    .internship-highlight p {
        margin: 0;
        color: #526173;
        line-height: 1.75;
        font-size: 14px;
    }

    .internship-journey {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .journey-step {
        padding: 24px;
        border-radius: 24px;
        background: linear-gradient(180deg, #ffffff, #f8fbff);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 16px 36px rgba(15,23,42,0.06);
    }

    .journey-step__number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        border-radius: 18px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 16px;
    }

    .journey-step h3 {
        margin: 0 0 10px;
        color: #0f172a;
        font-size: 18px;
    }

    .journey-step p {
        margin: 0;
        color: #526173;
        line-height: 1.75;
        font-size: 14px;
    }

    .internship-openings-section {
        background:
            radial-gradient(circle at 8% 10%, rgba(37,99,235,0.10), transparent 28%),
            radial-gradient(circle at 92% 88%, rgba(34,197,94,0.10), transparent 24%),
            linear-gradient(180deg, #ffffff, #f8fbff);
    }

    .internship-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 14px 16px;
        border-radius: 18px;
        margin-bottom: 18px;
        font-weight: 800;
        line-height: 1.5;
    }

    .internship-alert--success {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .internship-alert--error {
        background: #fff7ed;
        color: #9a3412;
        border: 1px solid #fed7aa;
    }

    .internship-openings-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .internship-opening-card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        padding: 26px;
        border-radius: 30px;
        overflow: hidden;
        background: rgba(255,255,255,0.94);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 24px 70px rgba(15,23,42,0.08);
    }

    .internship-opening-card::before {
        content: '';
        position: absolute;
        inset: 0 0 auto;
        height: 8px;
        background: linear-gradient(90deg, #0f4c81, #1e88e5, #22c55e);
    }

    .internship-opening-card__badge {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .internship-opening-card h3 {
        margin: 0 0 14px;
        color: #0f172a;
        font-size: 24px;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }

    .internship-opening-card__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 16px;
    }

    .internship-opening-card__meta span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 999px;
        background: #f8fafc;
        color: #475569;
        border: 1px solid rgba(15,23,42,0.07);
        font-size: 12px;
        font-weight: 800;
    }

    .internship-opening-card__meta i {
        color: #2563eb;
    }

    .internship-opening-card p {
        margin: 0 0 18px;
        color: #526173;
        line-height: 1.75;
        font-size: 14px;
    }

    .internship-opening-card__skills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: auto 0 20px;
    }

    .internship-opening-card__skills span {
        padding: 7px 10px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #047857;
        font-size: 11px;
        font-weight: 900;
    }

    .internship-opening-card__footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding-top: 18px;
        border-top: 1px solid rgba(15,23,42,0.07);
    }

    .internship-opening-card__footer strong,
    .internship-opening-card__footer span {
        display: block;
    }

    .internship-opening-card__footer strong {
        color: #0f172a;
        font-size: 22px;
        font-weight: 900;
        line-height: 1;
    }

    .internship-opening-card__footer span {
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
        margin-top: 4px;
    }

    .internship-opening-card__apply {
        white-space: nowrap;
        box-shadow: none;
    }

    .internship-apply-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }

    .internship-apply-modal.is-open {
        display: flex;
    }

    .internship-apply-modal__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15,23,42,0.66);
        backdrop-filter: blur(10px);
    }

    .internship-apply-modal__dialog {
        position: relative;
        z-index: 1;
        width: min(100%, 820px);
        max-height: calc(100vh - 36px);
        overflow: auto;
        padding: 30px;
        border-radius: 30px;
        background: #fff;
        box-shadow: 0 34px 90px rgba(15,23,42,0.28);
    }

    .internship-apply-modal__close {
        position: absolute;
        top: 18px;
        right: 18px;
        width: 42px;
        height: 42px;
        border: 0;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: #f1f5f9;
        color: #0f172a;
        cursor: pointer;
    }

    .internship-apply-modal__dialog h2 {
        margin: 0 44px 8px 0;
        color: #0f172a;
        font-size: clamp(26px, 3vw, 38px);
        line-height: 1.15;
        letter-spacing: -0.03em;
    }

    .internship-apply-modal__subtitle {
        margin: 0 0 22px;
        color: #64748b;
        line-height: 1.7;
    }

    .internship-apply-form__grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .internship-phone-grid {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 8px;
    }

    .internship-apply-submit {
        width: 100%;
        justify-content: center;
        margin-top: 4px;
    }

    .internship-tabs {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin: 12px 0 30px;
    }

    .tab-pill {
        appearance: none;
        border: 1px solid rgba(15,23,42,0.08);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 18px;
        border-radius: 999px;
        background: rgba(255,255,255,0.88);
        color: #0f172a;
        text-decoration: none;
        font: inherit;
        font-weight: 800;
        box-shadow: 0 12px 28px rgba(15,23,42,0.06);
    }

    .tab-pill strong {
        min-width: 28px;
        height: 28px;
        border-radius: 999px;
        display: inline-grid;
        place-items: center;
        background: #e2e8f0;
        color: #0f172a;
        font-size: 13px;
    }

    .tab-pill.active {
        border-color: rgba(37,99,235,0.30);
        background: linear-gradient(135deg, #eff6ff, #ffffff);
        color: #1d4ed8;
        box-shadow: 0 16px 36px rgba(37,99,235,0.12);
    }

    .tab-pill.active strong {
        background: #2563eb;
        color: #fff;
    }

    .internship-panels {
        display: grid;
    }

    .internship-panel {
        display: none;
    }

    .internship-panel.active {
        display: block;
    }

    .internship-empty {
        max-width: 640px;
        margin: 38px auto 0;
        padding: 48px 30px;
        border-radius: 30px;
        background: rgba(255,255,255,0.90);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 24px 70px rgba(15,23,42,0.08);
        text-align: center;
    }

    .internship-empty__icon {
        width: 82px;
        height: 82px;
        border-radius: 26px;
        margin: 0 auto 18px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        color: #2563eb;
        font-size: 30px;
    }

    .internship-empty h3 {
        margin: 0 0 12px;
        color: #0f172a;
        font-size: 28px;
    }

    .internship-empty p {
        margin: 0;
        color: #64748b;
        line-height: 1.75;
    }

    .internship-empty__btn {
        margin-top: 22px;
    }

    .internship-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .internship-card {
        position: relative;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        border-radius: 28px;
        overflow: hidden;
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 18px 44px rgba(15,23,42,0.09);
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        min-height: 100%;
    }

    .internship-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 28px 70px rgba(37,99,235,0.16);
        border-color: rgba(37,99,235,0.24);
        color: inherit;
    }

    .internship-card__topline {
        height: 8px;
        background: linear-gradient(90deg, #0f4c81, #1e88e5, #22c55e);
    }

    .internship-card__type {
        position: absolute;
        top: 18px;
        right: 18px;
        z-index: 2;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(15,23,42,0.78);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .internship-avatar {
        margin: 24px auto 0;
        width: clamp(132px, 15vw, 178px);
        height: clamp(132px, 15vw, 178px);
        padding: 8px;
        border-radius: 50%;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        box-shadow: 0 18px 34px rgba(15,23,42,0.10);
    }

    .internship-avatar__inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        overflow: hidden;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        color: rgba(255,255,255,0.85);
        font-size: 58px;
    }

    .internship-avatar__inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .internship-card__body {
        padding: 22px 22px 18px;
        text-align: center;
        flex: 1 1 auto;
    }

    .internship-card h3 {
        margin: 0 0 6px;
        color: #0f172a;
        font-size: 20px;
        font-weight: 900;
    }

    .internship-card__role {
        margin: 0 0 12px;
        color: #1d4ed8;
        font-size: 14px;
        font-weight: 800;
    }

    .internship-card__bio {
        margin: 0 0 16px;
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
        min-height: 62px;
    }

    .internship-card__skills {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
    }

    .internship-card__skills span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 10px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1e40af;
        font-size: 11px;
        font-weight: 800;
    }

    .internship-card__footer {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 16px 20px 20px;
        color: #2563eb;
        font-weight: 900;
        border-top: 1px solid rgba(15,23,42,0.06);
    }

    .internship-section--testimonials {
        padding-top: 24px;
    }

    .intern-testimonial-card {
        height: 100%;
        padding: 24px;
        border-radius: 28px;
        background: rgba(255,255,255,0.94);
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 18px 44px rgba(15,23,42,0.08);
    }

    .intern-testimonial-card__top {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 14px;
    }

    .intern-testimonial-card__avatar {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 800;
        box-shadow: 0 12px 24px rgba(37,99,235,0.18);
    }

    .intern-testimonial-card__avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .intern-testimonial-card__top h3 {
        margin: 0 0 4px;
        color: #0f172a;
        font-size: 18px;
        font-weight: 900;
    }

    .intern-testimonial-card__top p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
    }

    .intern-testimonial-card__badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 999px;
        margin-top: 8px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .intern-testimonial-card__stars {
        display: flex;
        gap: 4px;
        margin-bottom: 12px;
    }

    .intern-testimonial-card__stars i {
        color: #cbd5e1;
        font-size: 13px;
    }

    .intern-testimonial-card__stars i.active {
        color: #f59e0b;
    }

    .intern-testimonial-card__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
    }

    .intern-testimonial-card__meta span {
        display: inline-flex;
        align-items: center;
        padding: 7px 11px;
        border-radius: 999px;
        background: #f8fafc;
        border: 1px solid rgba(15,23,42,0.08);
        color: #0f172a;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .intern-testimonial-card__content {
        margin: 0;
        color: #334155;
        font-size: 14px;
        line-height: 1.85;
    }

    .internship-cta {
        padding-top: 8px;
    }

    .internship-cta__panel {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 30px 32px;
        border-radius: 30px;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        color: #fff;
        box-shadow: 0 26px 70px rgba(37,99,235,0.22);
    }

    .internship-cta__panel h2 {
        margin: 6px 0 10px;
        font-size: clamp(26px, 2.8vw, 42px);
        line-height: 1.12;
        letter-spacing: -0.03em;
    }

    .internship-cta__panel p {
        margin: 0;
        max-width: 780px;
        color: rgba(255,255,255,0.88);
        line-height: 1.8;
    }

    .internship-cta__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: flex-end;
        min-width: 280px;
    }

    .internship-cta .internship-btn--ghost {
        background: rgba(255,255,255,0.16);
        color: #fff;
        border-color: rgba(255,255,255,0.22);
    }

    .internship-cta .internship-btn--ghost:hover {
        background: rgba(255,255,255,0.24);
        color: #fff;
    }

    @media (max-width: 1200px) {
        .internship-grid,
        .internship-openings-grid,
        .internship-highlights,
        .internship-journey {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .internship-hero__grid {
            grid-template-columns: 1fr;
        }

        .internship-hero__visual {
            min-height: 420px;
        }

        .internship-trustbar {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .internship-hero {
            padding: 110px 0 42px;
        }

        .internship-section {
            padding: 58px 0;
        }

        .internship-hero__copy p,
        .section-heading p,
        .internship-cta__panel p {
            font-size: 15px;
        }

        .internship-metrics,
        .internship-grid,
        .internship-openings-grid,
        .internship-highlights,
        .internship-journey,
        .internship-trustbar {
            grid-template-columns: 1fr;
        }

        .internship-hero__visual {
            min-height: 360px;
        }

        .internship-visual__frame {
            min-height: 360px;
        }

        .internship-visual__card {
            width: 180px;
            padding: 15px 15px 14px;
        }

        .internship-visual__card--1 { right: 18px; top: 24px; }
        .internship-visual__card--2 { left: 18px; bottom: 80px; }
        .internship-visual__card--3 { right: 18px; bottom: 24px; }

        .internship-visual__ring {
            width: 190px;
            height: 190px;
        }

        .internship-visual__ring span {
            font-size: 16px;
        }

        .internship-cta__panel {
            padding: 26px 20px;
            flex-direction: column;
            align-items: flex-start;
        }

        .internship-cta__actions {
            width: 100%;
            min-width: 0;
            justify-content: flex-start;
        }

        .internship-card__bio {
            min-height: 0;
        }

        .internship-opening-card__footer,
        .internship-apply-form__grid {
            grid-template-columns: 1fr;
        }

        .internship-opening-card__footer {
            align-items: stretch;
            flex-direction: column;
        }

        .internship-opening-card__apply {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 520px) {
        .internship-hero h1 {
            font-size: 38px;
        }

        .internship-hero__actions,
        .internship-cta__actions {
            flex-direction: column;
        }

        .internship-btn {
            width: 100%;
            justify-content: center;
        }

        .internship-visual__frame {
            border-radius: 28px;
            padding: 18px;
        }

        .internship-visual__badge {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            font-size: 26px;
        }

        .internship-visual__card {
            width: 168px;
        }

        .internship-trustbar__item {
            padding: 12px 14px;
            font-size: 14px;
        }

        .internship-empty {
            padding: 36px 20px;
        }

        .internship-apply-modal {
            padding: 10px;
        }

        .internship-apply-modal__dialog {
            padding: 24px 18px;
            border-radius: 24px;
        }

        .internship-phone-grid {
            grid-template-columns: 1fr;
        }

        .intern-testimonial-card {
            padding: 20px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelector('[data-internship-tabs]');
    if (tabs) {
        const tabButtons = Array.from(tabs.querySelectorAll('[data-intern-tab]'));
        const panels = Array.from(document.querySelectorAll('[data-intern-panel]'));

        const activateTab = function (type) {
            tabButtons.forEach((button) => {
                const isActive = button.dataset.internTab === type;
                button.classList.toggle('active', isActive);
                button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });

            panels.forEach((panel) => {
                const isActive = panel.dataset.internPanel === type;
                panel.classList.toggle('active', isActive);
            });
        };

        tabButtons.forEach((button) => {
            button.addEventListener('click', function () {
                activateTab(button.dataset.internTab);
            });
        });

        activateTab(tabs.dataset.defaultType || 'current');
    }

    const applicationModal = document.querySelector('[data-application-modal]');
    const applicationForm = document.querySelector('[data-application-form]');
    const applicationTitle = document.getElementById('internshipApplyTitle');
    const applicationJobInput = document.querySelector('[data-application-job-id]');
    const applicationSubmit = document.querySelector('[data-application-submit]');
    const applicationButtons = Array.from(document.querySelectorAll('[data-application-open]'));
    const oldApplicationJobId = @json((string) $oldApplicationJobId);

    const openApplicationModal = function (button) {
        if (!applicationModal || !applicationForm || !button) return;

        applicationForm.action = button.dataset.action || '';
        if (applicationTitle) {
            applicationTitle.textContent = 'Apply for ' + (button.dataset.jobTitle || 'Internship');
        }
        if (applicationJobInput) {
            applicationJobInput.value = button.dataset.jobId || '';
        }
        applicationModal.classList.add('is-open');
        applicationModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };

    const closeApplicationModal = function () {
        if (!applicationModal) return;
        applicationModal.classList.remove('is-open');
        applicationModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    applicationButtons.forEach((button) => {
        button.addEventListener('click', () => openApplicationModal(button));
    });

    document.querySelectorAll('[data-application-close]').forEach((button) => {
        button.addEventListener('click', closeApplicationModal);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeApplicationModal();
        }
    });

    const selectedApplicationButton = oldApplicationJobId
        ? applicationButtons.find((button) => button.dataset.jobId === oldApplicationJobId)
        : applicationButtons[0];

    if (applicationModal && applicationModal.classList.contains('is-open')) {
        openApplicationModal(selectedApplicationButton || applicationButtons[0]);
    } else if (applicationForm && selectedApplicationButton) {
        applicationForm.action = selectedApplicationButton.dataset.action || '';
        if (applicationJobInput) {
            applicationJobInput.value = selectedApplicationButton.dataset.jobId || '';
        }
    }

    if (applicationForm && applicationSubmit) {
        applicationForm.addEventListener('submit', () => {
            applicationSubmit.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            applicationSubmit.disabled = true;
        });
    }

    const testimonialSwiperEl = document.querySelector('.interns-testimonials-swiper');
    if (testimonialSwiperEl && window.Swiper) {
        new Swiper('.interns-testimonials-swiper', {
            loop: true,
            spaceBetween: 20,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false
            },
            speed: 700,
            grabCursor: true,
            allowTouchMove: true,
            pagination: {
                el: '.interns-testimonials-pagination',
                clickable: true
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 3
                }
            }
        });
    }
});
</script>
@endsection
