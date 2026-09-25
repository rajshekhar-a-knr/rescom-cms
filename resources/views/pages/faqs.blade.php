@extends('layouts.app')

@section('title', 'FAQs')

@section('content')
<div class="page-hero">
    <div class="container">
        <div class="section-badge" style="background:rgba(255,255,255,0.1);color:white;border-color:rgba(255,255,255,0.2);margin-bottom:16px">
            <i class="fas fa-question-circle"></i> FAQs
        </div>
        <h1>Answers To Common Questions</h1>
        <p>Everything you need to know about our services and process.</p>
</div>
</div>

@include('partials.resources-tabs', ['activeKey' => 'faqs'])

<!-- Filter -->
<div class="tabs-shell" style="border-top:1px solid #e2e8f0">
    <div class="container">
        <div class="tab-bar">
            <a href="{{ route('faqs.page') }}" class="tab-pill {{ !request('category') ? 'active' : '' }}">All Questions</a>
            @foreach($categories ?? [] as $cat)
            <a href="{{ route('faqs.page', ['category' => $cat->category]) }}" class="tab-pill {{ request('category') === $cat->category ? 'active' : '' }}">
                {{ $cat->category }}
                <span class="tab-count">{{ $cat->total }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

<section class="section resource-section" style="padding-top:24px">
    <div class="container1">
        <div class="faq-list">
            @foreach($faqs as $faq)
            @php $faqId = 'faq-' . $loop->index; @endphp
            <div class="faq-item-wrap" data-aos="fade-up">
                <button class="faq-item" type="button" onclick="toggleFaqItem(this)"
                        aria-expanded="false" aria-controls="{{ $faqId }}">
                    <span class="faq-item-left">
                        <span class="faq-icon"><i class="fas fa-question"></i></span>
                        <span class="faq-question">{{ $faq->question }}</span>
                    </span>
                    <span class="faq-toggle" aria-hidden="true">
                        <i class="fas fa-plus"></i>
                    </span>
                </button>
                <div class="faq-answer" id="{{ $faqId }}">
                    {!! nl2br(e($faq->answer)) !!}
                </div>
            </div>
            @endforeach

            @if($faqs->isEmpty())
                <div class="resource-empty" data-aos="fade-up">
                    <i class="fas fa-question-circle"></i>
                    <h3>No FAQs yet</h3>
                    <p>We will publish answers shortly.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    function toggleFaqItem(btn) {
        const answer = btn.nextElementSibling;
        if (!answer) return;
        const isOpen = btn.classList.toggle('open');
        btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        const icon = btn.querySelector('.faq-toggle i');
        if (icon) icon.classList.toggle('fa-minus', isOpen);
        if (icon) icon.classList.toggle('fa-plus', !isOpen);
        answer.style.maxHeight = isOpen ? answer.scrollHeight + 'px' : '';
    }
</script>
@endsection

