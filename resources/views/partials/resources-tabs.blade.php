@php
    $resourceTabs = [
        ['key' => 'events', 'label' => 'Events', 'url' => route('events')],
        ['key' => 'gallery', 'label' => 'Gallery', 'url' => route('gallery')],
        ['key' => 'blogs', 'label' => 'Blogs', 'url' => route('blog')],
        ['key' => 'testimonials', 'label' => 'Testimonials', 'url' => route('testimonials')],
        ['key' => 'faqs', 'label' => 'FAQs', 'url' => route('faqs.page')],
    ];
    $activeKey = $activeKey ?? 'events';
@endphp

<style>
    .tabs-shell { background:linear-gradient(180deg,#f8fafc 0%, #ffffff 100%); padding:22px 0; border-bottom:1px solid #e2e8f0; }
    .tab-bar { display:flex; gap:10px; flex-wrap:wrap; justify-content:center; }
    .tab-pill {
        padding:10px 16px; border-radius:999px; font-size:13px; font-weight:700;
        background:#ffffff; color:#475569; border:1px solid #e2e8f0; text-decoration:none;
        box-shadow:0 4px 14px rgba(15,23,42,0.06); transition:all 0.25s ease;
        display:inline-flex; align-items:center; gap:8px;
    }
    .tab-pill:hover { transform:translateY(-2px); border-color:#93c5fd; color:#1d4ed8; box-shadow:0 10px 24px rgba(37,99,235,0.12); }
    .tab-pill.active {
        background:var(--gradient); color:#fff; border-color:transparent;
        box-shadow:0 12px 26px rgba(37,99,235,0.25);
    }
    .tab-pill .tab-count { background:rgba(0,0,0,0.08); color:inherit; padding:1px 8px; border-radius:999px; font-size:11px; font-weight:700; }
    .tab-pill.active .tab-count { background:rgba(255,255,255,0.2); }
    @media (max-width: 768px) {
        .tab-bar { flex-wrap:nowrap; overflow-x:auto; justify-content:flex-start; padding:0 12px; }
        .tab-bar::-webkit-scrollbar { display:none; }
        .tab-pill { white-space:nowrap; }
    }
</style>

<div class="tabs-shell">
    <div class="container">
        <div class="tab-bar">
            @foreach($resourceTabs as $tab)
            <a href="{{ $tab['url'] }}" class="tab-pill {{ $activeKey === $tab['key'] ? 'active' : '' }}">
                {{ $tab['label'] }}
            </a>
            @endforeach
        </div>
    </div>
</div>
