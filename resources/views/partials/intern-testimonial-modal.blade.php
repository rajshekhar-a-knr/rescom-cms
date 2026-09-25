@php
    $testimonialErrorFields = [
        'testimonial_intern_id',
        'testimonial_rating',
        'testimonial_content',
        'testimonial_captcha',
    ];
    $hasTestimonialErrors = collect($testimonialErrorFields)->contains(fn ($field) => $errors->has($field));
    $testimonialInterns = collect($testimonialInterns ?? []);
    $selectedIntern = $selectedIntern ?? null;
    $selectedInternId = old('testimonial_intern_id', optional($selectedIntern)->id);
    $testimonialRecaptchaSiteKey = recaptcha_site_key();
@endphp

@include('partials.recaptcha-script')

<div class="intern-testimonial-modal {{ $hasTestimonialErrors ? 'is-open' : '' }}" data-intern-testimonial-modal aria-hidden="{{ $hasTestimonialErrors ? 'false' : 'true' }}">
    <div class="intern-testimonial-modal__backdrop" data-intern-testimonial-close></div>
    <div class="intern-testimonial-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="internTestimonialTitle">
        <button type="button" class="intern-testimonial-modal__close" data-intern-testimonial-close aria-label="Close testimonial form">
            <i class="fas fa-times"></i>
        </button>
        <span class="section-kicker">Intern testimonial</span>
        <h2 id="internTestimonialTitle">Share your Rescom internship experience</h2>
        <p class="intern-testimonial-modal__subtitle">Your testimonial is saved for admin approval first, then it appears on the website.</p>

        <form method="POST" action="{{ route('internship.testimonials.store') }}" class="intern-testimonial-form">
            @csrf
            <div class="intern-testimonial-form__grid">
                <div class="form-group">
                    <label class="form-label">Intern *</label>
                    @if($selectedIntern)
                        <input type="hidden" name="testimonial_intern_id" value="{{ $selectedIntern->id }}">
                        <input type="text" class="form-control" value="{{ $selectedIntern->name }}" readonly>
                    @else
                        <select name="testimonial_intern_id" class="form-control" required>
                            <option value="">Select your name</option>
                            @foreach($testimonialInterns as $testimonialIntern)
                                <option value="{{ $testimonialIntern->id }}" {{ (string) $selectedInternId === (string) $testimonialIntern->id ? 'selected' : '' }}>
                                    {{ $testimonialIntern->name }}@if($testimonialIntern->college_name) - {{ $testimonialIntern->college_name }}@endif
                                </option>
                            @endforeach
                        </select>
                    @endif
                    @error('testimonial_intern_id')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Rating *</label>
                    <select name="testimonial_rating" class="form-control" required>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ (int) old('testimonial_rating', 5) === $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                        @endfor
                    </select>
                    @error('testimonial_rating')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Testimonial *</label>
                <textarea name="testimonial_content" class="form-control" rows="5" required minlength="20" maxlength="4000" placeholder="Write about your learning, mentors, projects, and Rescom experience.">{{ old('testimonial_content') }}</textarea>
                @error('testimonial_content')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group intern-testimonial-captcha">
                @if($testimonialRecaptchaSiteKey)
                    <div class="g-recaptcha" data-sitekey="{{ $testimonialRecaptchaSiteKey }}"></div>
                @else
                    <div class="field-error">reCAPTCHA is not configured. Please add keys in admin SEO settings.</div>
                @endif
                @error('testimonial_captcha')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary intern-testimonial-submit">
                <i class="fas fa-quote-left"></i>
                Submit testimonial
            </button>
        </form>
    </div>
</div>

<style>
    .intern-testimonial-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }
    .intern-testimonial-modal.is-open { display: flex; }
    .intern-testimonial-modal__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15,23,42,0.68);
        backdrop-filter: blur(10px);
    }
    .intern-testimonial-modal__dialog {
        position: relative;
        z-index: 1;
        width: min(100%, 760px);
        max-height: calc(100vh - 36px);
        overflow: auto;
        padding: 30px;
        border-radius: 30px;
        background: #fff;
        box-shadow: 0 34px 90px rgba(15,23,42,0.28);
        text-align: left;
    }
    .intern-testimonial-modal__close {
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
    .intern-testimonial-modal__dialog h2 {
        margin: 0 44px 8px 0;
        color: #0f172a;
        font-size: clamp(26px, 3vw, 38px);
        line-height: 1.15;
        letter-spacing: -0.03em;
    }
    .intern-testimonial-modal__subtitle {
        margin: 0 0 22px;
        color: #64748b;
        line-height: 1.7;
    }
    .intern-testimonial-form__grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 16px;
    }
    .intern-testimonial-submit {
        width: 100%;
        justify-content: center;
        margin-top: 4px;
        padding: 14px 20px;
        border-radius: 16px;
        font-weight: 800;
    }
    .intern-testimonial-captcha {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    @media (max-width: 768px) {
        .intern-testimonial-form__grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 520px) {
        .intern-testimonial-modal { padding: 10px; }
        .intern-testimonial-modal__dialog {
            padding: 24px 18px;
            border-radius: 24px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const testimonialModal = document.querySelector('[data-intern-testimonial-modal]');
    const testimonialButtons = Array.from(document.querySelectorAll('[data-intern-testimonial-open]'));
    const testimonialCloses = Array.from(document.querySelectorAll('[data-intern-testimonial-close]'));

    const openTestimonialModal = function () {
        if (!testimonialModal) return;
        testimonialModal.classList.add('is-open');
        testimonialModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };

    const closeTestimonialModal = function () {
        if (!testimonialModal) return;
        testimonialModal.classList.remove('is-open');
        testimonialModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    testimonialButtons.forEach((button) => button.addEventListener('click', openTestimonialModal));
    testimonialCloses.forEach((button) => button.addEventListener('click', closeTestimonialModal));

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeTestimonialModal();
        }
    });

    if (testimonialModal && testimonialModal.classList.contains('is-open')) {
        document.body.style.overflow = 'hidden';
    }

    @if(session('testimonial_success'))
        if (window.Swal) {
            Swal.fire({
                icon: 'success',
                title: 'Testimonial Submitted',
                text: @json(session('testimonial_success')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#0f4c81',
                timer: 3500,
                timerProgressBar: true
            });
        }
    @endif
});
</script>
