{{-- resources/views/digital-card/show.blade.php --}}
@php
    $companyName = $member->company_name ?: setting('site_name', config('app.name'));
    $companyLogo = $member->companyLogoUrl() ?: setting('site_logo');
    $companyWebsite = $member->company_website ?: $member->region1_website ?: url('/');
    $cardPhone = $member->region1_phone ?: $member->phone ?: setting('contact_phone');
    $cardWhatsappRaw = $member->region1_whatsapp ?: $member->whatsapp ?: setting('whatsapp_number') ?: $cardPhone;
    $cardWhatsapp = preg_replace('/[^0-9]/', '', (string) $cardWhatsappRaw);
    $cardEmail = $member->region1_email ?: $member->email ?: setting('contact_email');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $member->name }} – {{ $companyName }}</title>

    {{-- SEO / OG --}}
    <meta name="description" content="{{ $member->tagline }}">
    <meta property="og:title"       content="{{ $member->name }} – {{ $member->designation }}">
    <meta property="og:description" content="{{ $member->tagline }}">
    <meta property="og:image"       content="{{ $member->photoUrl() }}">
    <meta property="og:url"         content="{{ $member->cardUrl() }}">
    <meta name="twitter:card"       content="summary_large_image">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    {{-- qrcode.js (CDN) for inline QR generation fallback --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    {{-- html2canvas + jsPDF for client-side PDF download --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        :root {
            --brand:   {{ $member->theme_color }};
            --accent:  {{ $member->accent_color }};
            --bg:      #f4f8ff;
            --surface: #ffffff;
            --card:    rgba(255,255,255,.94);
            --border:  rgba(15,23,42,.10);
            --text:    #0f172a;
            --muted:   #64748b;
            --soft:    #eef6ff;
            --shadow:  0 18px 45px rgba(15,23,42,.10);
            --radius:  16px;
            --font-head: 'Syne', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background:
                radial-gradient(circle at 15% 0%, rgba(14,132,201,.14), transparent 30%),
                radial-gradient(circle at 85% 8%, rgba(61,139,33,.10), transparent 28%),
                var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 15px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Layout wrapper ── */
        .dc-wrap {
            max-width: 480px;
            margin: 0 auto;
            min-height: 100dvh;
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #ffffff 0%, #f7fbff 55%, #ffffff 100%);
            box-shadow: 0 0 0 1px rgba(15,23,42,.05), 0 28px 80px rgba(15,23,42,.14);
        }
        @if($companyLogo)
        .dc-wrap::before {
            content: '';
            position: fixed;
            top: 138px;
            left: 50%;
            width: min(360px, 74vw);
            height: min(360px, 74vw);
            transform: translateX(-50%);
            background: url("{{ $companyLogo }}") center / contain no-repeat;
            opacity: .055;
            pointer-events: none;
            z-index: 0;
        }
        @endif
        .dc-wrap > * { position: relative; z-index: 1; }

        /* ── Banner ── */
        .dc-banner {
            width: 100%;
            height: 168px;
            background:
                radial-gradient(circle at -10% 10%, rgba(242,15,22,.12), transparent 34%),
                radial-gradient(circle at 95% -10%, rgba(61,139,33,.18), transparent 33%),
                linear-gradient(135deg, rgba(15,131,201,.16), rgba(42,114,247,.08));
            position: relative;
            overflow: hidden;
        }
        .dc-banner img {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: .85;
        }
        .dc-banner::after {
            content:'';
            position:absolute; inset:0;
            background: linear-gradient(to bottom, rgba(255,255,255,0) 35%, #ffffff 100%);
        }

        /* ── Download-top button ── */
        .dc-top-btn {
            position: absolute;
            top: 14px; right: 14px;
            z-index: 10;
            background: #ffffff;
            backdrop-filter: blur(8px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 7px 14px;
            color: var(--brand);
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: background .2s;
        }
        .dc-top-btn:hover { background: var(--brand); color: #fff; }

        /* ── Profile section ── */
        .dc-profile {
            padding: 0 20px;
            margin-top: -60px;
            position: relative;
            z-index: 2;
        }
        .dc-avatar {
            width: 110px; height: 110px;
            border-radius: 50%;
            border: 3px solid var(--accent);
            object-fit: cover;
            background: #ffffff;
            box-shadow: 0 0 0 6px #ffffff, var(--shadow);
        }
        .dc-name {
            font-family: var(--font-head);
            font-size: 26px;
            font-weight: 800;
            margin-top: 12px;
            letter-spacing: -.3px;
        }
        .dc-designation {
            color: var(--brand);
            font-size: 13px;
            font-weight: 500;
            letter-spacing: .3px;
            margin-top: 2px;
        }
        .dc-tagline {
            color: var(--muted);
            font-size: 13px;
            margin-top: 8px;
            font-style: italic;
            line-height: 1.5;
        }

        /* ── Social row ── */
        .dc-socials {
            display: flex;
            gap: 10px;
            margin-top: 18px;
            flex-wrap: wrap;
        }
        .dc-social-btn {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            font-family: var(--font-head);
            letter-spacing: .3px;
            text-decoration: none;
            border: 1.5px solid var(--border);
            transition: all .2s;
            color: var(--text);
            background: rgba(255,255,255,.82);
        }
        .dc-social-btn.linkedin { border-color:#0a66c2; }
        .dc-social-btn.linkedin:hover { background:#0a66c2; border-color:#0a66c2; }
        .dc-social-btn.whatsapp { border-color:#25d366; }
        .dc-social-btn.whatsapp:hover { background:#25d366; border-color:#25d366; }
        .dc-social-btn.instagram { border-color:#e1306c; }
        .dc-social-btn.instagram:hover { background:#e1306c; }
        .dc-social-btn.twitter { border-color:#1da1f2; }
        .dc-social-btn.twitter:hover { background:#1da1f2; }
        .dc-social-btn svg { flex-shrink: 0; }

        .dc-quick-contact {
            display: flex;
            gap: 12px;
            margin-top: 18px;
            flex-wrap: wrap;
        }
        .dc-quick-link {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: #ffffff;
            border: 1px solid var(--border);
            box-shadow: 0 10px 24px rgba(15,23,42,.10);
            transition: transform .18s ease, box-shadow .18s ease;
        }
        .dc-quick-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(15,23,42,.15);
        }
        .dc-quick-link.phone { color: #ef1b24; }
        .dc-quick-link.whatsapp { color: #0f9f4f; }
        .dc-quick-link.email { color: #0b7fc3; }

        /* ── Company logo ── */
        .dc-company {
            margin-top: 22px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .dc-company a { text-decoration: none; }
        .dc-company img {
            height: 42px;
            object-fit: contain;
            opacity: 1;
        }

        /* ── Action buttons row ── */
        .dc-actions {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin: 24px 20px 0;
        }
        .dc-action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 14px 8px;
            background: var(--card);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            border-radius: var(--radius);
            cursor: pointer;
            text-decoration: none;
            color: var(--text);
            font-size: 11px;
            font-family: var(--font-head);
            font-weight: 600;
            letter-spacing: .4px;
            transition: all .2s;
            position: relative;
            overflow: hidden;
        }
        .dc-action-btn::before {
            content:'';
            position:absolute; inset:0;
            background: linear-gradient(135deg, var(--accent), var(--brand));
            opacity: 0;
            transition: opacity .2s;
        }
        .dc-action-btn:hover::before { opacity: .15; }
        .dc-action-btn svg, .dc-action-btn span { position: relative; z-index: 1; }
        .dc-action-btn .icon-wrap {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: var(--soft);
            display: flex; align-items: center; justify-content: center;
            position: relative; z-index: 1;
        }
        .dc-action-btn:hover .icon-wrap {
            background: var(--accent);
            color: #fff;
        }

        /* ── Divider ── */
        .dc-divider {
            height: 1px;
            background: var(--border);
            margin: 28px 20px;
        }

        /* ── Contact regions ── */
        .dc-section { padding: 0 20px; margin-bottom: 28px; }
        .dc-section-title {
            font-family: var(--font-head);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 14px;
        }

        .dc-contact-region {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: var(--shadow);
        }
        .dc-region-label {
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        .dc-contact-row {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text);
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            transition: color .15s;
        }
        .dc-contact-row:last-child { border-bottom: none; padding-bottom: 0; }
        .dc-contact-row:hover { color: var(--accent); }
        .dc-contact-row .ci {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--soft);
            color: var(--brand);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .dc-contact-row--phone .ci { background: rgba(239,27,36,.10); color: #ef1b24; }
        .dc-contact-row--whatsapp .ci { background: rgba(37,211,102,.14); color: #0f9f4f; }
        .dc-contact-row--email .ci { background: rgba(47,157,235,.14); color: #0b7fc3; }

        /* ── Stats strip ── */
        .dc-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 10px;
            padding: 0 20px;
            margin-bottom: 28px;
        }
        .dc-stat {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px 10px;
            text-align: center;
            box-shadow: var(--shadow);
        }
        .dc-stat-val {
            font-family: var(--font-head);
            font-size: 22px;
            font-weight: 800;
            color: var(--accent);
            line-height: 1;
        }
        .dc-stat-key {
            font-size: 10px;
            color: var(--muted);
            margin-top: 4px;
            letter-spacing: .5px;
        }

        /* ── Skills pills ── */
        .dc-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .dc-skill-pill {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 500;
        }

        /* ── Services accordion ── */
        .dc-service-item {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 8px;
            box-shadow: var(--shadow);
        }
        .dc-service-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            cursor: pointer;
            font-family: var(--font-head);
            font-size: 14px;
            font-weight: 600;
            user-select: none;
        }
        .dc-service-header svg { transition: transform .25s; flex-shrink:0; }
        .dc-service-item.open .dc-service-header svg { transform: rotate(180deg); }
        .dc-service-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease;
        }
        .dc-service-item.open .dc-service-body { max-height: 600px; }
        .dc-service-body ul {
            padding: 0 16px 14px 16px;
            list-style: none;
        }
        .dc-service-body li {
            font-size: 13px;
            color: var(--muted);
            padding: 5px 0 5px 16px;
            position: relative;
            border-bottom: 1px solid var(--border);
        }
        .dc-service-body li:last-child { border-bottom: none; }
        .dc-service-body li::before {
            content: '›';
            position: absolute;
            left: 0;
            color: var(--accent);
            font-size: 16px;
            line-height: 1;
            top: 6px;
        }

        /* ── Why us / Mission ── */
        .dc-why-item {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px;
            margin-bottom: 10px;
            box-shadow: var(--shadow);
        }
        .dc-why-title {
            font-family: var(--font-head);
            font-size: 14px;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 6px;
        }
        .dc-why-desc { font-size: 13px; color: var(--muted); line-height: 1.6; }

        /* ── Share bottom bar ── */
        .dc-share-bar {
            position: sticky;
            bottom: 0;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(16px);
            border-top: 1px solid var(--border);
            padding: 12px 20px;
            display: flex;
            gap: 10px;
            z-index: 100;
        }
        .dc-share-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 12px;
            border-radius: 12px;
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .5px;
            cursor: pointer;
            border: none;
            transition: all .2s;
            text-decoration: none;
        }
        .dc-share-btn.primary {
            background: linear-gradient(135deg, var(--accent), var(--brand));
            color: #fff;
        }
        .dc-share-btn.primary:hover { filter: brightness(1.15); }
        .dc-share-btn.ghost {
            background: var(--card);
            border: 1px solid var(--border);
            color: var(--text);
        }
        .dc-share-btn.ghost:hover { border-color: var(--accent); color: var(--accent); }

        /* ── QR modal ── */
        .dc-modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(15,23,42,.42);
            backdrop-filter: blur(6px);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }
        .dc-modal-overlay.open { display: flex; }
        .dc-modal {
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: 0 30px 80px rgba(15,23,42,.22);
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            max-width: 320px;
            width: 90%;
            animation: scaleIn .2s ease;
        }
        @keyframes scaleIn {
            from { transform: scale(.9); opacity:0; }
            to   { transform: scale(1); opacity:1; }
        }
        .dc-modal-title {
            font-family: var(--font-head);
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 18px;
        }
        .dc-qr-img {
            width: 200px; height: 200px;
            border-radius: 12px;
            background: #fff;
            padding: 8px;
            margin: 0 auto 20px;
            display: block;
        }
        #qrcode-container canvas, #qrcode-container img {
            width: 200px !important; height: 200px !important;
        }
        .dc-modal-close {
            position: absolute;
            top: 12px; right: 16px;
            background: none;
            border: none;
            color: var(--muted);
            font-size: 22px;
            cursor: pointer;
            line-height: 1;
        }
        .dc-modal { position: relative; }
        .dc-modal-actions {
            display: flex; gap: 10px; margin-top: 4px;
        }
        .dc-modal-actions .dc-share-btn { font-size: 11px; padding: 10px; }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }

        /* ── Fade-in animation ── */
        .fade-in { opacity: 0; transform: translateY(16px); animation: fadeUp .5s ease forwards; }
        @keyframes fadeUp { to { opacity:1; transform:none; } }
        .fade-in:nth-child(1) { animation-delay:.05s }
        .fade-in:nth-child(2) { animation-delay:.1s }
        .fade-in:nth-child(3) { animation-delay:.15s }
        .fade-in:nth-child(4) { animation-delay:.2s }
        .fade-in:nth-child(5) { animation-delay:.25s }
    </style>
</head>
<body>

<div class="dc-wrap" id="card-root">

    {{-- ── Banner ── --}}
    <div class="dc-banner">
        @if($member->banner)
            <img src="{{ $member->bannerUrl() }}" alt="banner">
        @endif

        {{-- Download profile top-right button --}}
        <button class="dc-top-btn" onclick="downloadPDF()">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Save Card
        </button>
    </div>

    {{-- ── Profile ── --}}
    <div class="dc-profile fade-in">
        <img class="dc-avatar" src="{{ $member->photoUrl() }}" alt="{{ $member->name }}">
        <h1 class="dc-name">{{ $member->name }}</h1>
        <p class="dc-designation">{{ $member->designation }}</p>
        @if($member->tagline)
            <p class="dc-tagline">{{ $member->tagline }}</p>
        @endif

        @if($cardPhone || $cardWhatsapp || $cardEmail)
        <div class="dc-quick-contact" aria-label="Contact shortcuts">
            @if($cardPhone)
            <a href="tel:{{ $cardPhone }}" class="dc-quick-link phone" aria-label="Call {{ $member->name }}" title="Call">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.61 4.91 2 2 0 0 1 3.57 2.72h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.1a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17.5z"/></svg>
            </a>
            @endif

             @if($cardEmail)
            <a href="mailto:{{ $cardEmail }}" class="dc-quick-link email" aria-label="Email {{ $member->name }}" title="Email">
                <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </a>
            @endif
               
            @if($cardWhatsapp)
            <a href="https://wa.me/{{ $cardWhatsapp }}" target="_blank" rel="noopener" class="dc-quick-link whatsapp" aria-label="WhatsApp {{ $member->name }}" title="WhatsApp">
                <svg width="21" height="21" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
            </a>
            @endif
           
        </div>
        @endif

        {{-- Social buttons --}}
        <div class="dc-socials">
            @if($member->linkedin)
            <a href="{{ $member->linkedin }}" target="_blank" class="dc-social-btn linkedin">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                LinkedIn
            </a>
            @endif
            @if($member->whatsapp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}" target="_blank" class="dc-social-btn whatsapp">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                WhatsApp
            </a>
            @endif
            @if($member->instagram)
            <a href="{{ $member->instagram }}" target="_blank" class="dc-social-btn instagram">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor" stroke="none"/></svg>
                Instagram
            </a>
            @endif
            @if($member->twitter)
            <a href="{{ $member->twitter }}" target="_blank" class="dc-social-btn twitter">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                Twitter
            </a>
            @endif
        </div>

        {{-- Company logo --}}
        @if($companyLogo || $companyWebsite)
        <div class="dc-company">
            <a href="{{ $companyWebsite ?: '#' }}" target="_blank" rel="noopener">
                @if($companyLogo)
                    <img src="{{ $companyLogo }}" alt="{{ $companyName }}">
                @else
                    <span style="font-family:var(--font-head);font-weight:700;font-size:16px;">{{ $companyName }}</span>
                @endif
            </a>
        </div>
        @endif
    </div>

    {{-- ── Action Buttons ── --}}
    <div class="dc-actions fade-in">
        {{-- Save Contact (VCF) --}}
        <a href="{{ route('digital-card.vcf', $member->slug) }}" class="dc-action-btn">
            <div class="icon-wrap">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <span>Save Contact</span>
        </a>

        {{-- QR Code --}}
        <button class="dc-action-btn" onclick="openQrModal()">
            <div class="icon-wrap">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="4" height="4"/></svg>
            </div>
            <span>QR Code</span>
        </button>

        {{-- Download PDF --}}
        <button class="dc-action-btn" onclick="downloadPDF()">
            <div class="icon-wrap">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
            </div>
            <span>Download PDF</span>
        </button>
    </div>

    <div class="dc-divider"></div>

    {{-- ── Stats ── --}}
    @if($member->years_experience || $member->learners_count || $member->workshops_count || $member->countries_count)
    <div class="dc-stats fade-in">
        @if($member->years_experience)
        <div class="dc-stat">
            <div class="dc-stat-val">{{ $member->years_experience }}+</div>
            <div class="dc-stat-key">Years Exp.</div>
        </div>
        @endif
        @if($member->learners_count)
        <div class="dc-stat">
            <div class="dc-stat-val">{{ number_format($member->learners_count / 1000, 0) }}K+</div>
            <div class="dc-stat-key">Learners</div>
        </div>
        @endif
        @if($member->workshops_count)
        <div class="dc-stat">
            <div class="dc-stat-val">{{ $member->workshops_count }}+</div>
            <div class="dc-stat-key">Workshops</div>
        </div>
        @endif
        @if($member->countries_count)
        <div class="dc-stat">
            <div class="dc-stat-val">{{ $member->countries_count }}</div>
            <div class="dc-stat-key">Countries</div>
        </div>
        @endif
    </div>
    @endif

    {{-- ── Contact Regions ── --}}
    <div class="dc-section fade-in">
        <div class="dc-section-title">Contact</div>

        @if($cardPhone || $cardWhatsapp || $cardEmail || $member->region1_website)
        <div class="dc-contact-region">
            @if($member->region1_label)
                <div class="dc-region-label">{{ $member->region1_label }}</div>
            @endif
            @if($cardPhone)
            <a href="tel:{{ $cardPhone }}" class="dc-contact-row dc-contact-row--phone">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.61 4.91 2 2 0 0 1 3.57 2.72h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.1a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17.5z"/></svg>
                </div>
                {{ $cardPhone }}
            </a>
            @endif
            @if($cardWhatsapp)
            <a href="https://wa.me/{{ $cardWhatsapp }}" target="_blank" rel="noopener" class="dc-contact-row dc-contact-row--whatsapp">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                </div>
                {{ $cardWhatsappRaw }}
            </a>
            @endif
            @if($cardEmail)
            <a href="mailto:{{ $cardEmail }}" class="dc-contact-row dc-contact-row--email">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                {{ $cardEmail }}
            </a>
            @endif
            @if($member->region1_website)
            <a href="{{ $member->region1_website }}" target="_blank" class="dc-contact-row">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                {{ parse_url($member->region1_website, PHP_URL_HOST) }}
            </a>
            @endif
        </div>
        @endif

        @if($member->region2_label && ($member->region2_phone || $member->region2_email || $member->region2_website))
        <div class="dc-contact-region">
            <div class="dc-region-label">{{ $member->region2_label }}</div>
            @if($member->region2_phone)
            <a href="tel:{{ $member->region2_phone }}" class="dc-contact-row dc-contact-row--phone">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5 19.79 19.79 0 0 1 1.61 4.91 2 2 0 0 1 3.57 2.72h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.1a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17.5z"/></svg>
                </div>
                {{ $member->region2_phone }}
            </a>
            @endif
            @if($member->region2_whatsapp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->region2_whatsapp) }}" target="_blank" rel="noopener" class="dc-contact-row dc-contact-row--whatsapp">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                </div>
                {{ $member->region2_whatsapp }}
            </a>
            @endif
            @if($member->region2_email)
            <a href="mailto:{{ $member->region2_email }}" class="dc-contact-row dc-contact-row--email">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                {{ $member->region2_email }}
            </a>
            @endif
            @if($member->region2_website)
            <a href="{{ $member->region2_website }}" target="_blank" class="dc-contact-row">
                <div class="ci">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                {{ parse_url($member->region2_website, PHP_URL_HOST) }}
            </a>
            @endif
        </div>
        @endif
    </div>

    {{-- ── Top Skills ── --}}
    @if($member->top_skills)
    <div class="dc-section fade-in">
        <div class="dc-section-title">Top Skills</div>
        <div class="dc-skills">
            @foreach($member->top_skills as $skill)
            <div class="dc-skill-pill">{{ $skill }}</div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── Core Services ── --}}
    @if($member->core_services)
    <div class="dc-section fade-in">
        <div class="dc-section-title">Core Services</div>
        @foreach($member->core_services as $service)
        @php($serviceItems = is_array($service['items'] ?? null) ? $service['items'] : [])
        <div class="dc-service-item">
            <div class="dc-service-header" onclick="toggleService(this)">
                <span>{{ $service['title'] ?? 'Service' }}</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </div>
            <div class="dc-service-body">
                @if(count($serviceItems))
                <ul>
                    @foreach($serviceItems as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- ── Why Us ── --}}
    @if($member->why_us_points)
    <div class="dc-section fade-in">
        <div class="dc-section-title">Why {{ $member->company_name ?? $member->name }}?</div>
        @foreach($member->why_us_points as $point)
        <div class="dc-why-item">
            <div class="dc-why-title">{{ $point['title'] ?? 'Why choose us' }}</div>
            <div class="dc-why-desc">{{ $point['description'] ?? '' }}</div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- ── Mission & Vision ── --}}
    @if($member->mission_vision)
    <div class="dc-section fade-in">
        <div class="dc-section-title">Mission & Vision</div>
        @if(!empty($member->mission_vision['mission']))
        <div class="dc-why-item">
            <div class="dc-why-title">Mission</div>
            <div class="dc-why-desc">{{ $member->mission_vision['mission'] }}</div>
        </div>
        @endif
        @if(!empty($member->mission_vision['vision']))
        <div class="dc-why-item">
            <div class="dc-why-title">Vision</div>
            <div class="dc-why-desc">{{ $member->mission_vision['vision'] }}</div>
        </div>
        @endif
    </div>
    @endif

    {{-- bottom padding for sticky bar --}}
    <div style="height:80px;"></div>

    {{-- ── Sticky Share Bar ── --}}
    <div class="dc-share-bar">
        <button class="dc-share-btn ghost" onclick="openQrModal()" title="QR Code">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="4" height="4"/></svg>
            QR
        </button>
        <button class="dc-share-btn ghost" onclick="copyLink()" title="Copy link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
            Copy
        </button>
        <button class="dc-share-btn primary" onclick="nativeShare()" id="shareBtn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
            Share Card
        </button>
    </div>

</div>{{-- end dc-wrap --}}

{{-- ── QR Modal ── --}}
<div class="dc-modal-overlay" id="qrModal">
    <div class="dc-modal">
        <button class="dc-modal-close" onclick="closeQrModal()">×</button>
        <div class="dc-modal-title">Scan to Connect</div>
        <div id="qrcode-container" style="display:flex;justify-content:center;margin-bottom:20px;">
            @if($member->qrUrl())
                <img src="{{ $member->qrUrl() }}" class="dc-qr-img" alt="QR Code">
            @else
                <div id="qrcode-js" style="background:#fff;padding:8px;border-radius:12px;"></div>
            @endif
        </div>
        <p style="color:var(--muted);font-size:12px;margin-bottom:16px;">{{ $member->name }} · {{ $member->designation }}</p>
        <div class="dc-modal-actions">
            <button class="dc-share-btn ghost" style="font-size:11px;" onclick="downloadQR()">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download QR
            </button>
            <a href="{{ route('digital-card.vcf', $member->slug) }}" class="dc-share-btn primary" style="font-size:11px;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                Save Contact
            </a>
        </div>
    </div>
</div>

{{-- ── Toast ── --}}
<div id="toast" style="
    position:fixed; bottom:100px; left:50%; transform:translateX(-50%) translateY(20px);
    background:var(--card); border:1px solid var(--border);
    border-radius:50px; padding:10px 20px;
    font-size:13px; font-family:var(--font-head); font-weight:600;
    opacity:0; transition:all .3s; z-index:300; pointer-events:none;
    white-space:nowrap;
">Copied!</div>

<script>
const CARD_URL = @json($member->cardUrl());
const MEMBER_NAME = @json($member->name);
const MEMBER_TITLE = @json($member->designation);

// ── Service accordion ──────────────────────────────────────────
function toggleService(header) {
    const item = header.parentElement;
    item.classList.toggle('open');
}

// ── QR Modal ──────────────────────────────────────────────────
function openQrModal() {
    document.getElementById('qrModal').classList.add('open');

    // Generate inline QR if no server-side image
    const container = document.getElementById('qrcode-js');
    if (container && !container.hasChildNodes()) {
        new QRCode(container, {
            text: CARD_URL,
            width: 200,
            height: 200,
            colorDark: '#000000',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.H
        });
    }
}

function closeQrModal() {
    document.getElementById('qrModal').classList.remove('open');
}

// Close on backdrop click
document.getElementById('qrModal').addEventListener('click', function(e) {
    if (e.target === this) closeQrModal();
});

// ── Download QR ───────────────────────────────────────────────
function downloadQR() {
    @if($member->qrUrl())
        // Server-provided QR image
        const a = document.createElement('a');
        a.href = @json(route('digital-card.qr.png', $member->slug));
        a.download = @json(Str::slug($member->name) . '-qr.png');
        a.click();
    @else
        const canvas = document.querySelector('#qrcode-js canvas');
        if (canvas) {
            const a = document.createElement('a');
            a.href = canvas.toDataURL('image/png');
            a.download = '{{ Str::slug($member->name) }}-qr.png';
            a.click();
        }
    @endif
}

// ── Native Share API ──────────────────────────────────────────
async function nativeShare() {
    const shareData = {
        title: MEMBER_NAME + ' – ' + MEMBER_TITLE,
        text: 'Connect with ' + MEMBER_NAME + ' on ' + MEMBER_TITLE,
        url: CARD_URL,
    };
    if (navigator.share) {
        try { await navigator.share(shareData); }
        catch(e) { if (e.name !== 'AbortError') fallbackShare(); }
    } else {
        fallbackShare();
    }
}

function fallbackShare() {
    // Show a mini share sheet
    const platforms = [
        { label: 'WhatsApp',  url: 'https://wa.me/?text=' + encodeURIComponent(MEMBER_NAME + ' – ' + CARD_URL) },
        { label: 'LinkedIn',  url: 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(CARD_URL) },
        { label: 'Twitter/X', url: 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(MEMBER_NAME + ' ' + CARD_URL) },
        { label: 'Email',     url: 'mailto:?subject=' + encodeURIComponent('Connect with ' + MEMBER_NAME) + '&body=' + encodeURIComponent(CARD_URL) },
        { label: 'Telegram',  url: 'https://t.me/share/url?url=' + encodeURIComponent(CARD_URL) + '&text=' + encodeURIComponent(MEMBER_NAME) },
    ];
    // Build overlay
    const overlay = document.createElement('div');
    overlay.style.cssText='position:fixed;inset:0;background:rgba(15,23,42,.42);backdrop-filter:blur(6px);z-index:400;display:flex;align-items:flex-end;padding:20px;';
    const sheet = document.createElement('div');
    sheet.style.cssText='background:#ffffff;border:1px solid rgba(15,23,42,.10);border-radius:20px;padding:20px;width:100%;max-width:440px;margin:0 auto;box-shadow:0 30px 80px rgba(15,23,42,.22);';
    sheet.innerHTML = '<div style="font-family:Syne,sans-serif;font-weight:700;font-size:16px;margin-bottom:16px;color:#0f172a;">Share via</div>';
    platforms.forEach(p => {
        const btn = document.createElement('a');
        btn.href = p.url;
        btn.target = '_blank';
        btn.rel = 'noopener';
        btn.style.cssText = 'display:block;padding:13px 16px;border-radius:10px;border:1px solid rgba(15,23,42,.10);margin-bottom:8px;text-decoration:none;color:#0f172a;font-family:DM Sans,sans-serif;font-size:14px;transition:background .15s;';
        btn.textContent = p.label;
        btn.addEventListener('mouseenter', () => btn.style.background='rgba(14,132,201,.08)');
        btn.addEventListener('mouseleave', () => btn.style.background='');
        sheet.appendChild(btn);
    });
    const cancel = document.createElement('button');
    cancel.textContent = 'Cancel';
    cancel.style.cssText='display:block;width:100%;padding:13px;border-radius:10px;background:#eef6ff;border:none;color:#64748b;font-family:Syne,sans-serif;font-weight:600;font-size:14px;cursor:pointer;margin-top:4px;';
    cancel.onclick = () => document.body.removeChild(overlay);
    sheet.appendChild(cancel);
    overlay.appendChild(sheet);
    overlay.addEventListener('click', e => { if(e.target===overlay) document.body.removeChild(overlay); });
    document.body.appendChild(overlay);
}

// ── Copy link ─────────────────────────────────────────────────
async function copyLink() {
    try {
        await navigator.clipboard.writeText(CARD_URL);
        showToast('Link copied!');
    } catch(e) {
        // fallback
        const ta = document.createElement('textarea');
        ta.value = CARD_URL;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        showToast('Link copied!');
    }
}

// ── Download PDF (client-side via html2canvas + jsPDF) ────────
async function downloadPDF() {
    showToast('Generating PDF…');
    // Use server route for server-rendered PDF
    window.location.href = '{{ route("digital-card.pdf", $member->slug) }}';
}

// ── Toast ─────────────────────────────────────────────────────
function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.style.opacity = '1';
    t.style.transform = 'translateX(-50%) translateY(0)';
    setTimeout(() => {
        t.style.opacity = '0';
        t.style.transform = 'translateX(-50%) translateY(20px)';
    }, 2200);
}
</script>
</body>
</html>

