<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ setting('site_name', 'Rescom') }} Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" href="{{ setting('site_favicon') ?: setting('site_logo') ?: asset('favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ setting('site_favicon') ?: setting('site_logo') ?: asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <style>
        .field-error { color: #dc2626; font-size: 12px; margin-top: 6px; }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-main {
            flex: 1 0 auto;
        }

        /* ===== MODERN SIDEBAR HEADER ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: #ffffff;
            border-right: 1px solid #edf2f9;
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 24px rgba(15, 23, 42, 0.03);
        }

        .sidebar-header {
            flex-shrink: 0;
            background: #ffffff;
        }

        .sidebar-top-brand {
            padding: 10px 14px 2px 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-webcore-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .sidebar-webcore-logo-top {
            height: 23px;
            max-height: 23px;
            width: auto;
            max-width: 105px;
            object-fit: contain;
            display: block;
        }

        .sidebar-dotted-divider {
            border-top: 1px dashed #dbe5f2;
            margin: 7px 14px 8px 14px;
        }

        .sidebar-client-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 14px 9px 14px;
            text-decoration: none;
            border-bottom: 1px solid #edf2f9;
        }

        .sidebar-client-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04);
            padding: 3px;
        }

        .sidebar-client-avatar img {
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
        }

        .sidebar-client-avatar span {
            font-size: 13px;
            font-weight: 800;
            color: #1d4ed8;
            text-transform: uppercase;
        }

        .sidebar-client-info {
            min-width: 0;
            flex: 1;
        }

        .sidebar-client-name {
            font-size: 13.5px;
            font-weight: 800;
            color: #0d2c6c;
            line-height: 1.25;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-client-loc,
        .sidebar-client-tagline {
            font-size: 11px;
            font-weight: 500;
            color: #64748b;
            margin-top: 1px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ===== SEARCH / FILTER BOX ===== */
        .sidebar-search-area {
            padding: 8px 12px 4px 12px;
            flex-shrink: 0;
        }

        .sidebar-search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 6px 10px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .sidebar-search-box:focus-within {
            background: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .sidebar-search-box i {
            color: #94a3b8;
            font-size: 12px;
            flex-shrink: 0;
        }

        .sidebar-search-box input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 12.5px;
            width: 100%;
            color: #1e293b;
            font-family: inherit;
        }

        .sidebar-search-box input::placeholder {
            color: #94a3b8;
            font-size: 12.5px;
        }

        /* ===== SIDEBAR NAVIGATION ===== */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 8px 6px 16px 6px;
            scrollbar-width: thin;
            scrollbar-color: rgba(37, 99, 235, 0.15) transparent;
        }

        .sidebar-section {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #5c708e;
            padding: 16px 14px 6px 14px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 7px 10px;
            margin: 2px 4px;
            border-radius: 12px;
            color: #24344d;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.15s ease;
            position: relative;
        }

        .sidebar-link:hover {
            background: #f3f7fd;
            color: #1d4ed8;
        }

        .sidebar-link.active {
            background: #eef5ff;
            color: #1d4ed8;
            font-weight: 800;
        }

        .sidebar-link.active::before {
            display: none;
        }

        .sidebar-icon-badge {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .sidebar-link:hover .sidebar-icon-badge {
            transform: scale(1.06);
        }

        .sidebar-link.active .sidebar-icon-badge {
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.14);
        }

        .sidebar-link-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
        }

        /* Badge Color Themes */
        .icon-badge-blue { background: #e0edff; color: #2563eb; }
        .icon-badge-teal { background: #e0f7f6; color: #0d9488; }
        .icon-badge-amber { background: #fef3c7; color: #d97706; }
        .icon-badge-purple { background: #f3e8ff; color: #9333ea; }
        .icon-badge-rose { background: #ffe4e6; color: #e11d48; }
        .icon-badge-emerald { background: #dcfce7; color: #059669; }
        .icon-badge-indigo { background: #e0e7ff; color: #4f46e5; }
        .icon-badge-sky { background: #e0f2fe; color: #0284c7; }
        .icon-badge-cyan { background: #cffafe; color: #0891b2; }
        .icon-badge-pink { background: #fce7f3; color: #db2777; }
        .icon-badge-slate { background: #f1f5f9; color: #475569; }
        .icon-badge-yellow { background: #fef9c3; color: #ca8a04; }
        .icon-badge-violet { background: #ede9fe; color: #7c3aed; }

        /* ===== SIDEBAR FOOTER BAR ===== */
        .sidebar-footer-bar {
            padding: 12px 14px;
            border-top: 1px solid #edf2f9;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-shrink: 0;
        }

        .sidebar-version-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #f0f6ff;
            border: 1px solid #dbe7fb;
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 12.5px;
            font-weight: 700;
            color: #1e3a8a;
            letter-spacing: 0.1px;
        }

        .status-dot-green {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.25);
            display: inline-block;
            flex-shrink: 0;
        }

        .sidebar-power-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .sidebar-power-btn:hover {
            background: #fee2e2;
            color: #dc2626;
            transform: scale(1.05);
        }

        /* ===== ADMIN FOOTER ===== */
        .admin-footer {
            margin-left: var(--sidebar-w);
            padding: 16px 24px;
            background: #ffffff;
            border-top: 1px solid #e5edff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex-shrink: 0;
        }

        .admin-footer .footer-copyright {
            color: rgba(0,0,0,0.6);
            font-size: 13.5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 0;
            line-height: 1;
            text-align: center;
        }

        .admin-footer .footer-copyright > span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            line-height: 1;
        }

        .admin-footer .footer-copy-text { line-height: 1; }

        .admin-footer .footer-brand-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            line-height: 1;
        }

        .admin-footer .footer-credit-logo {
            display: inline-block !important;
            vertical-align: middle !important;
            object-fit: contain !important;
        }

        .admin-footer .footer-webcore-logo {
            height: 21px !important;
            max-height: 21px !important;
            max-width: 75px !important;
            width: auto !important;
            transform: translateY(-3.5px) !important;
        }

        .admin-footer .footer-rescom-logo {
            height: 17px !important;
            max-height: 17px !important;
            max-width: 65px !important;
            width: auto !important;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .admin-footer {
                margin-left: 0;
                padding: 14px 16px;
                justify-content: center;
                text-align: center;
            }
            .admin-footer .footer-copyright {
                justify-content: center;
            }
        }
    </style>
    
    @yield('head')
</head>
<body>
@php
    $siteName = setting('site_name', 'Rescom');
    $siteLogo = setting('site_logo');
    $sidebarBrandLogo = 'https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/Webcorebg.png';
    $sidebarBrandFallback = $siteLogo ?: asset('favicon.png');
@endphp

<div class="page-loader" id="pageLoader" aria-hidden="true">
    <div class="page-loader__inner">
        @if($siteLogo)
            <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="page-loader__logo">
        @else
            <div class="page-loader__logo-text">{{ strtoupper(substr($siteName, 0, 3)) }}</div>
        @endif
        <div class="page-loader__spinner" aria-hidden="true"></div>
    </div>
</div>

 
<!-- ===== SIDEBAR ===== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-top-brand">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-webcore-link">
                <img src="{{ $sidebarBrandLogo }}" alt="WEBcore" class="sidebar-webcore-logo-top">
            </a>
        </div>

        <div class="sidebar-dotted-divider" aria-hidden="true"></div>

        <a href="{{ route('admin.dashboard') }}" class="sidebar-client-header">
            <div class="sidebar-client-avatar">
                @if($siteLogo)
                    <img src="{{ $siteLogo }}" alt="{{ $siteName }}">
                @else
                    <span>{{ strtoupper(substr($siteName, 0, 2)) }}</span>
                @endif
            </div>
            <div class="sidebar-client-info">
                <span class="sidebar-client-name">{{ $siteName }}</span>
                <span class="sidebar-client-loc sidebar-client-tagline">{{ setting('site_tagline') ?: setting('contact_city', setting('contact_address_short', 'Bengaluru, India')) }}</span>
            </div>
        </a>
    </div>

    <div class="sidebar-search-area">
        <div class="sidebar-search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="sidebarSearch" placeholder="Filter menu items..." autocomplete="off">
            <button type="button" id="sidebarSearchClear" style="display:none;background:none;border:none;color:#94a3b8;cursor:pointer;padding:0 2px;font-size:12px;" aria-label="Clear search"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <nav class="sidebar-nav" id="sidebarNav">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-search="dashboard home main overview analytics stats metrics">
            <span class="sidebar-icon-badge icon-badge-blue"><i class="fas fa-home"></i></span>
            <span class="sidebar-link-text">Dashboard</span>
        </a>

        <!-- Content Management -->
        <div class="sidebar-section">Content Management</div>
        <a href="{{ route('admin.banners.index') }}" class="sidebar-link {{ request()->routeIs('admin.banners*') ? 'active' : '' }}" data-search="hero banners sliders home carousel header banner images">
            <span class="sidebar-icon-badge icon-badge-sky"><i class="fas fa-images"></i></span>
            <span class="sidebar-link-text">Hero Banners</span>
        </a>
        <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}" data-search="services solutions offerings IT services development consulting">
            <span class="sidebar-icon-badge icon-badge-emerald"><i class="fas fa-cogs"></i></span>
            <span class="sidebar-link-text">Services</span>
        </a>
        <a href="{{ route('admin.portfolio.index') }}" class="sidebar-link {{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}" data-search="products portfolio projects work case studies showcase">
            <span class="sidebar-icon-badge icon-badge-indigo"><i class="fas fa-briefcase"></i></span>
            <span class="sidebar-link-text">Products</span>
        </a>
        <a href="{{ route('admin.demo-products.index') }}" class="sidebar-link {{ request()->routeIs('admin.demo-products*') ? 'active' : '' }}" data-search="demo products software applications credentials access logins">
            <span class="sidebar-icon-badge icon-badge-amber"><i class="fas fa-key"></i></span>
            <span class="sidebar-link-text">Demo Products</span>
        </a>
        <a href="{{ route('admin.pages.index') }}" class="sidebar-link {{ request()->routeIs('admin.pages*') ? 'active' : '' }}" data-search="pages custom pages content cms site pages">
            <span class="sidebar-icon-badge icon-badge-slate"><i class="fas fa-file-alt"></i></span>
            <span class="sidebar-link-text">Pages</span>
        </a>
        <a href="{{ route('admin.about.index') }}" class="sidebar-link {{ request()->routeIs('admin.about*') ? 'active' : '' }}" data-search="about page company story mission vision leadership who we are">
            <span class="sidebar-icon-badge icon-badge-rose"><i class="fas fa-building-user"></i></span>
            <span class="sidebar-link-text">About Page</span>
        </a>
        <a href="{{ route('admin.legal-pages.index') }}" class="sidebar-link {{ request()->routeIs('admin.legal-pages*') ? 'active' : '' }}" data-search="legal pages privacy policy terms conditions terms of service compliance legal">
            <span class="sidebar-icon-badge icon-badge-indigo"><i class="fas fa-scale-balanced"></i></span>
            <span class="sidebar-link-text">Legal Pages</span>
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}" data-search="gallery photos images media pictures album photoshoots">
            <span class="sidebar-icon-badge icon-badge-blue"><i class="fas fa-camera-retro"></i></span>
            <span class="sidebar-link-text">Gallery</span>
        </a>

        <!-- Blog -->
        <div class="sidebar-section">Blog</div>
        <a href="{{ route('admin.blog.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}" data-search="blog posts articles news insights updates stories write post">
            <span class="sidebar-icon-badge icon-badge-cyan"><i class="fas fa-newspaper"></i></span>
            <span class="sidebar-link-text">Blog Posts</span>
        </a>

        <!-- Team & Social Proof -->
        <div class="sidebar-section">Team & Social Proof</div>
        <a href="{{ route('admin.team.index') }}" class="sidebar-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}" data-search="team members staff employees executives founders directors leaders people">
            <span class="sidebar-icon-badge icon-badge-purple"><i class="fas fa-users"></i></span>
            <span class="sidebar-link-text">Team Members</span>
        </a>
        <a href="{{ route('admin.interns.index') }}" class="sidebar-link {{ request()->routeIs('admin.interns*') ? 'active' : '' }}" data-search="interns internship students graduates testimonials certificates training">
            <span class="sidebar-icon-badge icon-badge-teal"><i class="fas fa-user-graduate"></i></span>
            <span class="sidebar-link-text">Interns</span>
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}" data-search="testimonials reviews feedback client quotes ratings social proof">
            <span class="sidebar-icon-badge icon-badge-amber"><i class="fas fa-quote-left"></i></span>
            <span class="sidebar-link-text">Testimonials</span>
        </a>
        <a href="{{ route('admin.clients.index') }}" class="sidebar-link {{ request()->routeIs('admin.clients*') ? 'active' : '' }}" data-search="clients partners brands logos companies customers trusted by">
            <span class="sidebar-icon-badge icon-badge-emerald"><i class="fas fa-building"></i></span>
            <span class="sidebar-link-text">Clients / Partners</span>
        </a>
        <a href="{{ route('admin.stats.index') }}" class="sidebar-link {{ request()->routeIs('admin.stats*') ? 'active' : '' }}" data-search="stats counters metrics numbers achievements milestones data">
            <span class="sidebar-icon-badge icon-badge-cyan"><i class="fas fa-chart-bar"></i></span>
            <span class="sidebar-link-text">Stats & Counters</span>
        </a>
        <a href="{{ route('admin.events.index') }}" class="sidebar-link {{ request()->routeIs('admin.events*') ? 'active' : '' }}" data-search="events conferences webinars workshops meetups schedule calendar">
            <span class="sidebar-icon-badge icon-badge-rose"><i class="fas fa-calendar-check"></i></span>
            <span class="sidebar-link-text">Events</span>
        </a>

        <!-- Leads & HR -->
        <div class="sidebar-section">Leads & HR</div>
        <a href="{{ route('admin.contacts.index') }}" class="sidebar-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" data-search="inquiries contacts leads messages form submissions customer emails">
            <span class="sidebar-icon-badge icon-badge-blue"><i class="fas fa-envelope"></i></span>
            <span class="sidebar-link-text">Inquiries</span>
            @php $newContacts = \App\Models\Contact::where('status','new')->count(); @endphp
            @if($newContacts > 0)<span class="sidebar-badge">{{ $newContacts }}</span>@endif
        </a>
        <a href="{{ route('admin.jobs.index') }}" class="sidebar-link {{ request()->routeIs('admin.jobs*') ? 'active' : '' }}" data-search="job listings careers vacancies openings hiring positions recruitment">
            <span class="sidebar-icon-badge icon-badge-amber"><i class="fas fa-briefcase"></i></span>
            <span class="sidebar-link-text">Job Listings</span>
        </a>
        <a href="{{ route('admin.career-benefits.index') }}" class="sidebar-link {{ request()->routeIs('admin.career-benefits*') ? 'active' : '' }}" data-search="career benefits perks workplace culture perks reasons to join why rescom">
            <span class="sidebar-icon-badge icon-badge-pink"><i class="fas fa-star"></i></span>
            <span class="sidebar-link-text">Career Benefits</span>
        </a>
        <a href="{{ route('admin.jobs.applications') }}" class="sidebar-link {{ request()->routeIs('admin.jobs.application*') ? 'active' : '' }}" data-search="applications resumes candidates submissions applicants cv recruitment hr">
            <span class="sidebar-icon-badge icon-badge-rose"><i class="fas fa-user-tie"></i></span>
            <span class="sidebar-link-text">Applications</span>
            @php $newApps = \App\Models\JobApplication::where('status','pending')->count(); @endphp
            @if($newApps > 0)<span class="sidebar-badge">{{ $newApps }}</span>@endif
        </a>
        <a href="{{ route('admin.newsletter') }}" class="sidebar-link {{ request()->routeIs('admin.newsletter*') ? 'active' : '' }}" data-search="newsletter subscribers email list audience subscriptions mailing list">
            <span class="sidebar-icon-badge icon-badge-teal"><i class="fas fa-at"></i></span>
            <span class="sidebar-link-text">Newsletter</span>
            @php
                $lastSeenNewsletterId = cache()->get('newsletter_last_seen_id_' . auth()->id(), 0);
                $newSubscribers = \App\Models\NewsletterSubscriber::where('status','active')
                    ->where('id', '>', $lastSeenNewsletterId)
                    ->count();
            @endphp
            @if($newSubscribers > 0)<span class="sidebar-badge">{{ $newSubscribers }}</span>@endif
        </a>

        <!-- Other -->
        <div class="sidebar-section">Other</div>
        <a href="{{ route('admin.chatbot.index') }}" class="sidebar-link {{ request()->routeIs('admin.chatbot*') ? 'active' : '' }}" data-search="chatbot assistant bot ai conversation support chatbot management rescom bot">
            <span class="sidebar-icon-badge icon-badge-blue"><i class="fas fa-robot"></i></span>
            <span class="sidebar-link-text">Chatbot</span>
        </a>
        <a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}" data-search="faqs frequently asked questions help answers accordion questions">
            <span class="sidebar-icon-badge icon-badge-indigo"><i class="fas fa-question-circle"></i></span>
            <span class="sidebar-link-text">FAQs</span>
        </a>
        <a href="{{ route('admin.technologies.index') }}" class="sidebar-link {{ request()->routeIs('admin.technologies*') ? 'active' : '' }}" data-search="technologies tech stack frameworks languages tools programming skills">
            <span class="sidebar-icon-badge icon-badge-teal"><i class="fas fa-microchip"></i></span>
            <span class="sidebar-link-text">Technologies</span>
        </a>
        <a href="{{ route('admin.media.index') }}" class="sidebar-link {{ request()->routeIs('admin.media*') ? 'active' : '' }}" data-search="media library files images uploads assets documents photos manager">
            <span class="sidebar-icon-badge icon-badge-pink"><i class="fas fa-photo-video"></i></span>
            <span class="sidebar-link-text">Media Library</span>
        </a>

        <!-- System -->
        <div class="sidebar-section">System</div>
        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" data-search="settings system general seo site keys configuration contact social branding logo footer header site name tagline">
            <span class="sidebar-icon-badge icon-badge-slate"><i class="fas fa-sliders-h"></i></span>
            <span class="sidebar-link-text">Settings</span>
        </a>
        <a href="{{ route('admin.permissions.index') }}" class="sidebar-link {{ request()->routeIs('admin.permissions*') ? 'active' : '' }}" data-search="user rights permissions roles access control privileges security capabilities">
            <span class="sidebar-icon-badge icon-badge-amber"><i class="fas fa-user-lock"></i></span>
            <span class="sidebar-link-text">User Rights</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" data-search="admin users managers accounts staff profiles credentials passwords members">
            <span class="sidebar-icon-badge icon-badge-blue"><i class="fas fa-user-shield"></i></span>
            <span class="sidebar-link-text">Admin Users</span>
        </a>
        <a href="{{ route('admin.activity-logs') }}" class="sidebar-link {{ request()->routeIs('admin.activity-logs') ? 'active' : '' }}" data-search="activity logs login logs audit trail history actions system logs events">
            <span class="sidebar-icon-badge icon-badge-teal"><i class="fas fa-history"></i></span>
            <span class="sidebar-link-text">Activity Logs</span>
        </a>
        <a href="{{ route('admin.website-visits') }}" class="sidebar-link {{ request()->routeIs('admin.website-visits') ? 'active' : '' }}" data-search="website visits analytics traffic visitors views pageviews daily stats chart tracker">
            <span class="sidebar-icon-badge icon-badge-emerald"><i class="fas fa-chart-line"></i></span>
            <span class="sidebar-link-text">Website Visits</span>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link" data-search="view website public frontend homepage live site open website">
            <span class="sidebar-icon-badge icon-badge-blue"><i class="fas fa-external-link-alt"></i></span>
            <span class="sidebar-link-text">View Website</span>
        </a>
    </nav>

    <div class="sidebar-footer-bar">
        <div class="sidebar-version-pill">
            <span class="status-dot-green"></span>
            <span class="version-name">WEBcore v2.4</span>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" data-logout-confirm="true" style="margin:0;">
            @csrf
            <button type="submit" class="sidebar-power-btn" title="Logout">
                <i class="fas fa-power-off"></i>
            </button>
        </form>
    </div>
</aside>

<!-- ===== HEADER ===== -->
<header class="admin-header">
    <div class="header-left">
        <button class="sidebar-toggle-mobile" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <a href="{{ route('admin.dashboard') }}" class="admin-header-logo" aria-label="Dashboard">
            @if($siteLogo)
                <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="admin-header-logo-img">
            @else
                <span class="admin-header-logo-text">{{ strtoupper(substr($siteName, 0, 3)) }}</span>
            @endif
        </a>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}" style="color:#94a3b8;text-decoration:none">
                <i class="fas fa-home"></i>
            </a>@yield('breadcrumb')
        </div>
    </div>

    <div class="header-right">
        @php 
            $unreadContacts = \App\Models\Contact::where('status','new')->count(); 
            $currentUser = auth()->user();
            $userAvatarUrl = $currentUser && $currentUser->avatar ? media_url($currentUser->avatar) : null;
            $userName = $currentUser ? $currentUser->name : 'Super Admin';
            $userRole = $currentUser && $currentUser->role ? ucwords(str_replace('_', ' ', $currentUser->role)) : 'Administrator';
            $userInitial = strtoupper(substr($userName, 0, 1));
        @endphp

        <!-- Quick Notifications / Inquiries Button -->
        <a href="{{ route('admin.contacts.index') }}" class="header-notif-btn" title="New Inquiries & Notifications" aria-label="Notifications">
            <span class="header-notif-icon-box">
                <i class="fa-solid fa-bell"></i>
                @if($unreadContacts > 0)
                    <span class="header-notif-badge" title="{{ $unreadContacts }} new inquiries">{{ $unreadContacts > 99 ? '99+' : $unreadContacts }}</span>
                    <span class="header-notif-ping"></span>
                @endif
            </span>
        </a>

        <!-- User Profile Pill Dropdown -->
        <div class="profile-menu" id="profileMenu">
            <button type="button" class="profile-trigger" id="profileTrigger" aria-haspopup="true" aria-expanded="false">
                <div class="profile-avatar-frame">
                    @if($userAvatarUrl)
                        <img src="{{ $userAvatarUrl }}" alt="{{ $userName }}" class="profile-avatar-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="profile-avatar-fallback" style="display: none;">{{ $userInitial }}</div>
                    @else
                        <div class="profile-avatar-fallback">{{ $userInitial }}</div>
                    @endif
                    <span class="profile-status-indicator" title="Active"></span>
                </div>
                <div class="profile-user-info">
                    <span class="profile-name">{{ Str::limit($userName, 18) }}</span>
                    <span class="profile-role-tag">{{ $userRole }}</span>
                </div>
                <i class="fa-solid fa-chevron-down profile-caret"></i>
            </button>

            <div class="profile-dropdown" id="profileDropdown" aria-label="Profile menu">
                <!-- Dropdown Header Card -->
                <div class="profile-dropdown-card">
                    <div class="profile-dropdown-avatar-wrap">
                        @if($userAvatarUrl)
                            <img src="{{ $userAvatarUrl }}" alt="{{ $userName }}" class="profile-dd-avatar-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="profile-dd-avatar-fallback" style="display: none;">{{ $userInitial }}</div>
                        @else
                            <div class="profile-dd-avatar-fallback">{{ $userInitial }}</div>
                        @endif
                        <span class="profile-dd-online-dot" title="Online"></span>
                    </div>
                    <div class="profile-dropdown-meta">
                        <div class="profile-dd-name">{{ $userName }}</div>
                        <div class="profile-dd-email">{{ $currentUser->email ?? '' }}</div>
                        <span class="profile-dd-role-badge">
                            <i class="fa-solid fa-shield-halved"></i> {{ $userRole }}
                        </span>
                    </div>
                </div>

                <div class="profile-dropdown-menu-list">
                    <a href="{{ route('admin.profile') }}" class="profile-item profile-item--profile">
                        <span class="profile-item-icon-box icon-blue">
                            <i class="fa-solid fa-user-gear"></i>
                        </span>
                        <div class="profile-item-content">
                            <span class="profile-item-title">My Profile</span>
                            <span class="profile-item-desc">Account settings & security</span>
                        </div>
                    </a>

                    <a href="{{ route('admin.contacts.index') }}" class="profile-item profile-item--notify">
                        <span class="profile-item-icon-box icon-amber">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </span>
                        <div class="profile-item-content">
                            <span class="profile-item-title">Inquiries & Leads</span>
                            <span class="profile-item-desc">Customer messages</span>
                        </div>
                        @if($unreadContacts > 0)
                            <span class="profile-item-counter">{{ $unreadContacts }}</span>
                        @endif
                    </a>

                    <a href="{{ route('home') }}" target="_blank" class="profile-item profile-item--visit">
                        <span class="profile-item-icon-box icon-teal">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </span>
                        <div class="profile-item-content">
                            <span class="profile-item-title">Live Website</span>
                            <span class="profile-item-desc">View public site</span>
                        </div>
                    </a>
                </div>

                <div class="profile-dropdown-divider"></div>

                <form action="{{ route('admin.logout') }}" method="POST" data-logout-confirm="true" style="margin: 0;">
                    @csrf
                    <button type="submit" class="profile-item profile-item--logout">
                        <span class="profile-item-icon-box icon-red">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </span>
                        <div class="profile-item-content">
                            <span class="profile-item-title">Sign Out</span>
                            <span class="profile-item-desc">End your active session</span>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- ===== MAIN ===== -->
<main class="admin-main">
    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="margin:0;padding-left:16px">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            @yield('content')
        </div>
    </div>
</main>

<footer class="admin-footer" style="padding:16px 0;display:flex;justify-content:center;align-items:center;border-top:1px solid #e2e8f0;background:#ffffff">
    <div class="footer-copyright" style="display:inline-flex;align-items:center;justify-content:center;gap:16px;flex-wrap:wrap;font-size:13.5px;color:#475569;font-weight:500;line-height:1">
        <span class="footer-copy-text">© {{ date('Y') }} by {{ $siteName }}. All rights reserved.</span>
      
        <span class="footer-brand-item" style="display:inline-flex;align-items:center;gap:6px">
            <span>Powered by</span>
            <span class="footer-badge-pill" style="display:inline-flex;align-items:center;justify-content:center;background:#ffffff;border:1px solid #cbd5e1;border-radius:7px;padding:2px 9px;height:25px;box-shadow:0 1px 2px rgba(0,0,0,0.04)">
                <img src="https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/Webcorebg.png" alt="WEBcore" style="height:16px !important;max-height:16px !important;width:auto !important;max-width:68px !important;object-fit:contain !important">
            </span>
        </span>
        
        <span class="footer-brand-item" style="display:inline-flex;align-items:center;gap:6px">
            <span>Designed by</span>
            <span class="footer-badge-pill" style="display:inline-flex;align-items:center;justify-content:center;background:#ffffff;border:1px solid #cbd5e1;border-radius:7px;padding:2px 9px;height:25px;box-shadow:0 1px 2px rgba(0,0,0,0.04)">
                <img src="https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/KNR-WEBSITE_f817360c-0c15-4992-bc1b-4df24f071612_KNR-Logo.png" alt="KNR" style="height:16px !important;max-height:16px !important;width:auto !important;max-width:72px !important;object-fit:contain !important">
            </span>
        </span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/admin.js') }}?v={{ time() }}"></script>

<script>
    const attachBlurValidation = (root = document) => {
        const fields = root.querySelectorAll('input, select, textarea');
        const countDigits = (value) => (value.match(/\d/g) || []).length;
        const customValidityMessage = (el) => {
            const minDigits = el.getAttribute('data-min-digits');
            if (minDigits) {
                const min = parseInt(minDigits, 10);
                const digits = countDigits(el.value || '');
                if (digits > 0 && digits < min) return `Please enter at least ${min} digits.`;
            }
            const maxDigits = el.getAttribute('data-max-digits');
            if (maxDigits) {
                const max = parseInt(maxDigits, 10);
                const digits = countDigits(el.value || '');
                if (digits > max) return `Please enter no more than ${max} digits.`;
            }
            if (el.hasAttribute('data-country-selector')) {
                const select = el.parentElement?.querySelector('[data-digits-source]');
                const expected = parseInt(select?.selectedOptions?.[0]?.dataset?.digits || '0', 10);
                const digits = countDigits(el.value || '');
                if (digits > 0 && expected && digits !== expected) {
                    return `Please enter exactly ${expected} digits.`;
                }
            }
            return '';
        };
        const showError = (el) => {
            if (!el || !el.willValidate) return;
            const container = el.parentElement;
            if (!container) return;
            let errorEl = container.querySelector('.field-error');
            if (!errorEl) {
                errorEl = document.createElement('div');
                errorEl.className = 'field-error';
                container.appendChild(errorEl);
            }
            let message = customValidityMessage(el) || el.validationMessage;
            if (!customValidityMessage(el) && el.validity.patternMismatch && el.title) message = el.title;
            errorEl.textContent = message;
        };
        const clearError = (el) => {
            const container = el?.parentElement;
            const errorEl = container?.querySelector('.field-error');
            if (errorEl) errorEl.remove();
        };

        fields.forEach((el) => {
            if (!el.willValidate) return;
            el.addEventListener('blur', () => {
                if (customValidityMessage(el) || !el.checkValidity()) showError(el);
                else clearError(el);
            });
            el.addEventListener('input', () => {
                if (!customValidityMessage(el) && el.checkValidity()) clearError(el);
            });
        });

        root.querySelectorAll('form').forEach((form) => {
            form.addEventListener('submit', (e) => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    fields.forEach((el) => {
                        if (el.form === form && !el.checkValidity()) showError(el);
                    });
                    return;
                }
                const invalidCustom = Array.from(fields).filter((el) => el.form === form && customValidityMessage(el));
                if (invalidCustom.length) {
                    e.preventDefault();
                    invalidCustom.forEach(showError);
                }
            });
        });
    };

    document.addEventListener('DOMContentLoaded', () => attachBlurValidation());

    window.addEventListener('load', () => {
        const loader = document.getElementById('pageLoader');
        if (loader) loader.classList.add('is-hidden');
    });

    const profileTrigger = document.getElementById('profileTrigger');
    const profileDropdown = document.getElementById('profileDropdown');
    const profileMenu = document.getElementById('profileMenu');
    if (profileTrigger && profileDropdown && profileMenu) {
        profileTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('open');
            profileTrigger.setAttribute('aria-expanded', profileMenu.classList.contains('open'));
        });
        document.addEventListener('click', () => {
            profileMenu.classList.remove('open');
            profileTrigger.setAttribute('aria-expanded', 'false');
        });
        profileDropdown.addEventListener('click', (e) => e.stopPropagation());
    }

    document.querySelectorAll('form').forEach((form) => {
        if (form.hasAttribute('data-no-spinner')) return;
        if (form.hasAttribute('data-logout-confirm')) return;
        form.addEventListener('submit', () => {
            const loader = document.getElementById('pageLoader');
            if (loader) {
                loader.classList.remove('is-hidden');
                loader.setAttribute('aria-hidden', 'false');
            }
        });
    });

    document.querySelectorAll('form[data-logout-confirm="true"]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to logout?',
                text: 'Please make sure all your changes are saved.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    const resizeImageFile = (file, maxDim, quality = 0.8) => new Promise((resolve) => {
        if (!file || !file.type || !file.type.startsWith('image/')) return resolve(file);
        const img = new Image();
        const url = URL.createObjectURL(file);
        img.onload = () => {
            const w = img.width;
            const h = img.height;
            const scale = maxDim && (w > maxDim || h > maxDim) ? Math.min(maxDim / w, maxDim / h) : 1;
            const canvas = document.createElement('canvas');
            canvas.width = Math.round(w * scale);
            canvas.height = Math.round(h * scale);
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            canvas.toBlob((blob) => {
                URL.revokeObjectURL(url);
                if (!blob) return resolve(file);
                const newName = file.name.replace(/\.[A-Za-z0-9]+$/, '.webp');
                resolve(new File([blob], newName, { type: 'image/webp' }));
            }, 'image/webp', quality);
        };
        img.onerror = () => {
            URL.revokeObjectURL(url);
            resolve(file);
        };
        img.src = url;
    });

    document.querySelectorAll('input[type="file"].image-resize').forEach((input) => {
        input.addEventListener('change', async () => {
            const maxDim = parseInt(input.dataset.resizeMax || '1920', 10);
            const quality = parseFloat(input.dataset.resizeQuality || '0.8');
            const files = Array.from(input.files || []);
            if (!files.length) return;
            const resized = [];
            for (const f of files) {
                const r = await resizeImageFile(f, maxDim, quality);
                resized.push(r);
            }
            const dt = new DataTransfer();
            resized.forEach((f) => dt.items.add(f));
            input.files = dt.files;
        });
    });

    const sidebarNav = document.querySelector('.sidebar-nav');
    if (sidebarNav) {
        const key = 'adminSidebarScrollTop';
        const saved = sessionStorage.getItem(key);
        if (saved) {
            requestAnimationFrame(() => { sidebarNav.scrollTop = parseInt(saved, 10) || 0; });
        }
        sidebarNav.addEventListener('scroll', () => {
            sessionStorage.setItem(key, String(sidebarNav.scrollTop));
        });
    }

    // Live Sidebar Search / Filter
    const sbSearchInput = document.getElementById('sidebarSearch');
    const sbClearBtn = document.getElementById('sidebarSearchClear');
    const sbNavEl = document.getElementById('sidebarNav') || document.querySelector('.sidebar-nav');
    if (sbSearchInput && sbNavEl) {
        const doSidebarFilter = () => {
            const query = (sbSearchInput.value || '').toLowerCase().trim();
            if (sbClearBtn) {
                sbClearBtn.style.display = query ? 'inline-block' : 'none';
            }
            const sections = sbNavEl.querySelectorAll('.sidebar-section');
            const links = sbNavEl.querySelectorAll('.sidebar-link');

            links.forEach((link) => {
                const text = (link.textContent || '').toLowerCase();
                const searchKeywords = (link.getAttribute('data-search') || '').toLowerCase();
                const isMatch = !query || text.includes(query) || searchKeywords.includes(query);
                link.style.display = isMatch ? 'flex' : 'none';
            });

            sections.forEach((sec) => {
                let next = sec.nextElementSibling;
                let hasVisible = false;
                while (next && !next.classList.contains('sidebar-section')) {
                    if (next.classList.contains('sidebar-link') && next.style.display !== 'none') {
                        hasVisible = true;
                    }
                    next = next.nextElementSibling;
                }
                sec.style.display = (!query || hasVisible) ? 'block' : 'none';
            });
        };

        ['input', 'keyup', 'change', 'search', 'paste'].forEach((evt) => {
            sbSearchInput.addEventListener(evt, doSidebarFilter);
        });

        sbSearchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                sbSearchInput.value = '';
                doSidebarFilter();
            }
        });

        if (sbClearBtn) {
            sbClearBtn.addEventListener('click', (e) => {
                e.preventDefault();
                sbSearchInput.value = '';
                doSidebarFilter();
                sbSearchInput.focus();
            });
        }
    }
</script>

@yield('scripts')
</body>
</html>




