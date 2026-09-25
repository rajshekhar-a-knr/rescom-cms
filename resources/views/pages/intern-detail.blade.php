@extends('layouts.app')
@section('title', $intern->name . ' - Internship')
@php
    $certificateCaptchaSiteKey = recaptcha_site_key();
    $hasCertificateErrors = $errors->has('certificate_email') || $errors->has('certificate_captcha');
@endphp

@section('content')
<section class="team-single">
    <div class="team-single__bg"></div>
    <div class="container" style="margin-top: 80px;">
        <div class="team-single__card">
            <div class="team-single__media">
                @if($intern->photo)
                    <img src="{{ media_url($intern->photo) }}" alt="{{ $intern->name }}">
                @else
                    <div class="team-single__placeholder">&#128100;</div>
                @endif
            </div>

            <div class="team-single__body">
                <h1>{{ $intern->name }}</h1>
                <p class="team-single__role">{{ $intern->designation }}</p>

                <div class="team-single__meta">
                    @if($intern->department)
                        <span class="pill pill--primary">{{ $intern->department->name }}</span>
                    @endif
                    @if($intern->college_name)
                        <span class="pill pill--soft">{{ $intern->college_name }}</span>
                    @endif
                    @if($intern->experience_years)
                        <span class="pill pill--success">{{ $intern->experience_years }}+ Years Experience</span>
                    @endif
                </div>

                <div class="intern-details-grid">
                    @if($intern->college_name)
                        <div class="intern-details-item">
                            <span>College Name</span>
                            <strong>{{ $intern->college_name }}</strong>
                        </div>
                    @endif
                    @if($intern->college_guide)
                        <div class="intern-details-item">
                            <span>College Guide</span>
                            <strong>{{ $intern->college_guide }}</strong>
                        </div>
                    @endif
                    @if($intern->knr_guide)
                        <div class="intern-details-item">
                            <span>Rescom Guide</span>
                            <strong>{{ $intern->knr_guide }}</strong>
                        </div>
                    @endif
                </div>

                @if(is_array($intern->skills) && count($intern->skills))
                    <div class="team-single__skills">
                        @foreach($intern->skills as $skill)
                            <span class="pill pill--soft">{{ $skill }}</span>
                        @endforeach
                    </div>
                @endif

                @if($intern->bio)
                    <p class="team-single__bio">{{ $intern->bio }}</p>
                @endif

                <div class="team-single__actions">
                    <button type="button" class="team-single__link team-single__link--testimonial" data-intern-testimonial-open>
                        <i class="fas fa-quote-left"></i> Fill Testimonial
                    </button>
                    @if($intern->intern_type === 'alumni' && $intern->certificate && $intern->certificate_token)
                        <button type="button" class="team-single__link team-single__link--download" onclick="openCertificateModal()">
                            <i class="fas fa-download"></i> Download Certificate
                        </button>
                    @endif
                </div>

                @if($intern->testimonials && $intern->testimonials->isNotEmpty())
                    <div class="intern-testimonials-section">
                        <div class="intern-testimonials-section__header">
                            <span class="section-kicker">Student testimonials</span>
                            <h2>What {{ $intern->name }} say about this internship</h2>
                        </div>

                        <div class="intern-testimonials-grid">
                            @foreach($intern->testimonials as $testimonial)
                                <article class="intern-testimonial-card">
                                    <div class="intern-testimonial-card__top">
                                        <div class="intern-testimonial-card__avatar">
                                            @if($testimonial->client_photo)
                                                <img src="{{ media_url($testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}">
                                            @else
                                                <span>{{ strtoupper(substr($testimonial->client_name ?? 'S', 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <h3>{{ $testimonial->client_name }}</h3>
                                            <p>{{ $testimonial->client_designation }}@if($testimonial->client_company) • {{ $testimonial->client_company }}@endif</p>
                                            <div class="intern-testimonial-card__stars" aria-label="{{ $testimonial->rating ?? 5 }} star rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= ($testimonial->rating ?? 5) ? 'active' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    @if($testimonial->project_type || $testimonial->testimonial_source)
                                        <div class="intern-testimonial-card__meta">
                                            @if($testimonial->project_type)
                                                <span>{{ $testimonial->project_type }}</span>
                                            @endif
                                            @if($testimonial->testimonial_source === 'student-college')
                                                <span>Student / College</span>
                                            @endif
                                        </div>
                                    @endif

                                    <p class="intern-testimonial-card__content">“{{ $testimonial->content }}”</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($hasCertificateErrors)
                    <div class="certificate-inline-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $errors->first('certificate_email') ?: $errors->first('certificate_captcha') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@if($intern->intern_type === 'alumni' && $intern->certificate && $intern->certificate_token)
<div id="certificateModal" class="certificate-modal {{ $hasCertificateErrors ? 'open' : '' }}" aria-hidden="true">
    <div class="certificate-modal__backdrop" onclick="closeCertificateModal(event)"></div>
    <div class="certificate-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="certificateModalTitle">
        <button type="button" class="certificate-modal__close" aria-label="Close" onclick="closeCertificateModal()">&times;</button>
        <div class="certificate-modal__icon">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h3 id="certificateModalTitle">Verify your Rescom email</h3>
        <p>Please enter the email address registered with Rescom to download your certificate.</p>

        @if($hasCertificateErrors)
            <div class="certificate-modal__error">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first('certificate_email') ?: $errors->first('certificate_captcha') }}
            </div>
        @endif

        <form method="POST" action="{{ route('internship.certificate.verify', ['intern' => $intern, 'token' => $intern->certificate_token]) }}" class="certificate-modal__form">
            @csrf
            <div class="certificate-modal__field">
                <label for="certificate_email">Registered email</label>
                <input type="email"
                       id="certificate_email"
                       name="certificate_email"
                       value="{{ old('certificate_email') }}"
                       placeholder="Enter your Rescom registered email"
                       required>
            </div>
            <div class="certificate-modal__captcha">
                @if($certificateCaptchaSiteKey)
                    <div class="g-recaptcha" data-sitekey="{{ $certificateCaptchaSiteKey }}"></div>
                @else
                    <div class="certificate-modal__error" style="margin-bottom:0">
                        <i class="fas fa-exclamation-circle"></i>
                        reCAPTCHA is not configured. Please add the site and secret keys in admin SEO settings.
                    </div>
                @endif
                @error('certificate_captcha')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="certificate-modal__submit">
                <i class="fas fa-download"></i>
                Verify & Download
            </button>
        </form>
    </div>
</div>
@endif

@include('partials.intern-testimonial-modal', ['selectedIntern' => $intern])

<style>
    .team-single {
        position: relative;
        padding: 120px 0 90px;
        background: #f8fafc;
        overflow: hidden;
    }
    .team-single__bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 15% 20%, rgba(14,165,233,0.18), transparent 55%),
                    radial-gradient(circle at 85% 10%, rgba(59,130,246,0.16), transparent 55%),
                    linear-gradient(180deg, rgba(15,23,42,0.02), rgba(15,23,42,0));
        pointer-events: none;
    }
    .team-single__card {
        position: relative;
        z-index: 1;
        background: #ffffff;
        border-radius: 28px;
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 35px 70px rgba(15,23,42,0.14);
        overflow: hidden;
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        justify-items: center;
        text-align: center;
    }
    .team-single__media {
        width: 100%;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 36px 20px 0;
    }
    .team-single__media img {
        width: min(300px, 68vw);
        height: min(300px, 68vw);
        border-radius: 50%;
        object-fit: cover;
        border: 8px solid rgba(255,255,255,0.9);
        box-shadow: 0 18px 45px rgba(15,23,42,0.25);
        background: #fff;
    }
    .team-single__placeholder {
        width: min(280px, 65vw);
        height: min(280px, 65vw);
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        color: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 90px;
    }
    .team-single__body {
        width: 100%;
        padding: 26px 34px 34px;
        text-align: center;
        color: #0f172a;
    }
    .team-single__body h1 { font-size: 30px; margin-bottom: 6px; }
    .team-single__role { font-size: 16px; font-weight: 600; color: #0f4c81; margin-bottom: 14px; }
    .team-single__meta { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-bottom: 16px; }
    .intern-details-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin: 0 0 18px;
    }
    .intern-details-item {
        padding: 14px 16px;
        border-radius: 18px;
        background: #f8fbff;
        border: 1px solid rgba(15,23,42,0.08);
        text-align: left;
    }
    .intern-details-item span {
        display: block;
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 6px;
    }
    .intern-details-item strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        line-height: 1.5;
    }
    .team-single__bio { color: #0f172a; line-height: 1.7; font-size: 15px; margin-bottom: 18px; }
    .team-single__skills { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-bottom: 20px; }
    .pill { font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 999px; border: 1px solid transparent; display: inline-flex; align-items: center; gap: 6px; }
    .pill--primary { color: #0f4c81; background: #eff6ff; border-color: #dbeafe; }
    .pill--success { color: #166534; background: #ecfdf3; border-color: #bbf7d0; }
    .pill--soft { color: #1d4ed8; background: #eff6ff; border-color: #dbeafe; font-weight: 600; }
    .team-single__actions { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center; margin-top: 4px; }
    .team-single__link { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 999px; background: #2a72f7 ; color: #fff; text-decoration: none; font-size: 13px; font-weight: 600; }
    .team-single__link--download { border: 0; cursor: pointer; }
    .team-single__link--testimonial { border: 0; cursor: pointer; background: linear-gradient(135deg, #0f4c81, #1e88e5); box-shadow: 0 14px 28px rgba(37,99,235,0.18); }
    .team-single__icon { width: 36px; height: 36px; border-radius: 50%; background: #2a72f7 ; color:#eff6ff; display: inline-flex; align-items: center; justify-content: center; }
    .team-single__icon:hover { background: #0400ff ; color: #fff; transform: translateY(-5px); }
    .team-single__link:hover { background: #5b015e ; color: #fff; transform: translateY(-5px); }
    .intern-testimonials-section {
        width: 100%;
        margin-top: 28px;
        padding-top: 26px;
        border-top: 1px solid rgba(15,23,42,0.08);
    }
    .intern-testimonials-section__header {
        margin-bottom: 18px;
    }
    .intern-testimonials-section__header .section-kicker {
        display: inline-flex;
        margin-bottom: 8px;
    }
    .intern-testimonials-section__header h2 {
        font-size: 22px;
        color: #0f172a;
        margin-bottom: 8px;
    }
    .intern-testimonials-section__header p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
    }
    .intern-testimonials-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }
    .intern-testimonial-card {
        background: #f8fbff;
        border: 1px solid rgba(15,23,42,0.08);
        border-radius: 22px;
        padding: 20px;
        text-align: left;
        box-shadow: 0 16px 30px rgba(15,23,42,0.06);
    }
    .intern-testimonial-card__top {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 12px;
    }
    .intern-testimonial-card__avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 800;
    }
    .intern-testimonial-card__avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .intern-testimonial-card__top h3 {
        font-size: 17px;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .intern-testimonial-card__top p {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 8px;
    }
    .intern-testimonial-card__stars {
        display: flex;
        gap: 4px;
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
        margin-bottom: 10px;
    }
    .intern-testimonial-card__meta span {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
    }
    .intern-testimonial-card__content {
        color: #0f172a;
        font-size: 14px;
        line-height: 1.8;
        margin: 0;
    }
    .certificate-inline-error {
        margin-top: 18px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        border-radius: 14px;
        background: #fff1f2;
        color: #b91c1c;
        font-size: 14px;
        font-weight: 600;
        border: 1px solid #fecdd3;
    }
    .certificate-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 22px;
    }
    .certificate-modal.open {
        display: flex;
    }
    .certificate-modal__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15,23,42,0.72);
        backdrop-filter: blur(4px);
    }
    .certificate-modal__dialog {
        position: relative;
        z-index: 1;
        width: min(100%, 520px);
        background: #fff;
        border-radius: 28px;
        padding: 28px;
        box-shadow: 0 30px 80px rgba(15,23,42,0.35);
        text-align: center;
    }
    .certificate-modal__close {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 0;
        background: #eff6ff;
        color: #0f4c81;
        cursor: pointer;
        font-size: 22px;
        line-height: 1;
    }
    .certificate-modal__icon {
        width: 66px;
        height: 66px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 24px;
        box-shadow: 0 18px 40px rgba(37,99,235,0.24);
    }
    .certificate-modal__dialog h3 {
        font-size: 24px;
        color: #0f172a;
        margin-bottom: 8px;
    }
    .certificate-modal__dialog p {
        color: #64748b;
        line-height: 1.7;
        margin-bottom: 18px;
    }
    .certificate-modal__error {
        margin-bottom: 16px;
        padding: 12px 14px;
        border-radius: 14px;
        background: #fff1f2;
        color: #b91c1c;
        border: 1px solid #fecdd3;
        display: flex;
        align-items: center;
        gap: 8px;
        text-align: left;
    }
    .certificate-modal__form {
        display: grid;
        gap: 14px;
        text-align: left;
    }
    .certificate-modal__field label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }
    .certificate-modal__field input {
        width: 100%;
        border-radius: 14px;
        border: 1px solid rgba(15,23,42,0.14);
        padding: 14px 16px;
        font-size: 15px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }
    .certificate-modal__field input:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0 4px rgba(30,136,229,0.10);
    }
    .certificate-modal__captcha {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        min-height: 78px;
    }
    .certificate-modal__submit {
        border: 0;
        border-radius: 14px;
        padding: 14px 18px;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        color: #fff;
        font-weight: 800;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 16px 32px rgba(37,99,235,0.20);
    }
    .certificate-modal__submit:hover {
        transform: translateY(-1px);
    }
    @media (max-width: 900px) {
        .team-single { padding: 110px 0 70px; }
        .team-single__body { padding: 22px 24px 30px; }
        .team-single__body h1 { font-size: 26px; }
        .intern-details-grid { grid-template-columns: 1fr; }
        .intern-testimonials-grid { grid-template-columns: 1fr; }
        .certificate-modal__dialog { padding: 24px 20px; }
    }
    @media (max-width: 520px) {
        .team-single { padding: 100px 0 60px; }
        .team-single__media { padding: 28px 16px 0; }
        .team-single__media img { width: min(230px, 70vw); height: min(230px, 70vw); }
        .certificate-modal__captcha .g-recaptcha {
            transform: scale(0.86);
            transform-origin: center;
        }
    }
</style>

<script>
function openCertificateModal() {
    const modal = document.getElementById('certificateModal');
    if (!modal) return;
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    const input = modal.querySelector('input[name="certificate_email"]');
    if (input) {
        setTimeout(() => input.focus(), 50);
    }
}

function closeCertificateModal(event) {
    if (event && event.target && !event.target.classList.contains('certificate-modal__backdrop') && !event.target.classList.contains('certificate-modal__close')) {
        return;
    }
    const modal = document.getElementById('certificateModal');
    if (!modal) return;
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
}

document.addEventListener('DOMContentLoaded', function () {
    @if($hasCertificateErrors)
        openCertificateModal();
    @endif
});
</script>

@endsection
