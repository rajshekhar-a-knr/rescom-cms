@extends('admin.layouts.app')
@section('title','Content Settings')
@section('breadcrumb')<span>></span><span class="current">Content</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">Content Settings</h1></div>
<div style="display:flex;gap:0;margin-bottom:24px;border-bottom:2px solid var(--border)">
    @foreach([
        route('admin.settings.index') => 'General',
        route('admin.settings.header') => 'Header',
        route('admin.settings.footer') => 'Footer',
        route('admin.settings.seo') => 'SEO',
        route('admin.settings.social') => 'Social',
        route('admin.settings.topscroller') => 'Top Scroller',
        route('admin.settings.email') => 'Email',
        route('admin.settings.content') => 'Content'
    ] as $url => $label)
    <a href="{{ $url }}" style="padding:10px 20px;text-decoration:none;font-size:14px;font-weight:600;border-bottom:3px solid {{ request()->url()===$url ? 'var(--primary)' : 'transparent' }};color:{{ request()->url()===$url ? 'var(--primary)' : 'var(--text-muted)' }};margin-bottom:-2px;white-space:nowrap">{{ $label }}</a>
    @endforeach
</div>
@php
    $get = function ($key) use ($settings) {
        if (function_exists('setting')) {
            return old($key, $settings[$key]->value ?? setting($key, ''));
        }
        return old($key, $settings[$key]->value ?? '');
    };
@endphp
<form class="single-card-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="settings-section" style="margin-bottom:16px">
        <div class="card-body">
            <div class="content-tabs" style="display:flex;gap:8px;flex-wrap:wrap">
                @foreach([
                    'header-footer' => 'Header & Footer',
                    'home' => 'Home',
                    'about' => 'About',
                    'services' => 'Services',
                    'contact' => 'Contact',
                    'blog' => 'Blog',
                    'events' => 'Events',
                    'gallery' => 'Gallery',
                    'testimonials-faqs' => 'Testimonials & FAQs',
                    'portfolio' => 'Portfolio',
                    'careers' => 'Careers',
                    'terms-privacy' => 'Terms & Privacy'
                ] as $tabId => $label)
                    <button type="button" class="btn btn-secondary btn-sm content-tab-btn {{ $loop->first ? 'active' : '' }}" data-tab="{{ $tabId }}" style="border-radius:20px">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="header-footer">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Header & Footer</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Header CTA Text</label><input type="text" name="header_cta_text" class="form-control" value="{{ $get('header_cta_text') }}"></div>
                <div class="form-group"><label class="form-label">Header CTA URL</label><input type="text" name="header_cta_url" class="form-control" value="{{ $get('header_cta_url') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Footer Services Title</label><input type="text" name="footer_services_title" class="form-control" value="{{ $get('footer_services_title') }}"></div>
                <div class="form-group"><label class="form-label">Footer Company Title</label><input type="text" name="footer_company_title" class="form-control" value="{{ $get('footer_company_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Footer Contact Title</label><input type="text" name="footer_contact_title" class="form-control" value="{{ $get('footer_contact_title') }}"></div>
                <div class="form-group"><label class="form-label">Footer Newsletter Label</label><input type="text" name="footer_newsletter_label" class="form-control" value="{{ $get('footer_newsletter_label') }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Footer Services Links (JSON)</label>
                <textarea name="footer_services_links" class="form-control" rows="4">{{ $get('footer_services_links') }}</textarea>
                <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Format: [{"label":"Web Development","url":"/services/custom-web-development"}]</div>
            </div>
            <div class="form-group">
                <label class="form-label">Footer Company Links (JSON)</label>
                <textarea name="footer_company_links" class="form-control" rows="4">{{ $get('footer_company_links') }}</textarea>
                <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Format: [{"label":"About Us","url":"/about"}]</div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="home" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Home Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="home_meta_title" class="form-control" value="{{ $get('home_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="home_meta_description" class="form-control" value="{{ $get('home_meta_description') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Trusted Label</label><input type="text" name="home_trusted_label" class="form-control" value="{{ $get('home_trusted_label') }}"></div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">Services Badge</label><input type="text" name="home_services_badge" class="form-control" value="{{ $get('home_services_badge') }}"></div>
                <div class="form-group"><label class="form-label">Services Title</label><input type="text" name="home_services_title" class="form-control" value="{{ $get('home_services_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Services Subtitle</label><textarea name="home_services_subtitle" class="form-control" rows="2">{{ $get('home_services_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Services Button Text</label><input type="text" name="home_services_button_text" class="form-control" value="{{ $get('home_services_button_text') }}"></div>
                <div class="form-group"><label class="form-label">Services Button URL</label><input type="text" name="home_services_button_url" class="form-control" value="{{ $get('home_services_button_url') }}"></div>
            </div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">Why Badge</label><input type="text" name="home_why_badge" class="form-control" value="{{ $get('home_why_badge') }}"></div>
                <div class="form-group"><label class="form-label">Why Title</label><input type="text" name="home_why_title" class="form-control" value="{{ $get('home_why_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Why Description</label><textarea name="home_why_body" class="form-control" rows="3">{{ $get('home_why_body') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Why Button Text</label><input type="text" name="home_why_button_text" class="form-control" value="{{ $get('home_why_button_text') }}"></div>
                <div class="form-group"><label class="form-label">Why Button URL</label><input type="text" name="home_why_button_url" class="form-control" value="{{ $get('home_why_button_url') }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Why Items (JSON)</label>
                <textarea name="home_why_items" class="form-control" rows="4">{{ $get('home_why_items') }}</textarea>
                <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Format: [{"icon":"fas fa-shield-alt","color":"#3b82f6","title":"Title","desc":"Description"}]</div>
            </div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">Portfolio Badge</label><input type="text" name="home_portfolio_badge" class="form-control" value="{{ $get('home_portfolio_badge') }}"></div>
                <div class="form-group"><label class="form-label">Portfolio Title</label><input type="text" name="home_portfolio_title" class="form-control" value="{{ $get('home_portfolio_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Portfolio Subtitle</label><textarea name="home_portfolio_subtitle" class="form-control" rows="2">{{ $get('home_portfolio_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Portfolio Button Text</label><input type="text" name="home_portfolio_button_text" class="form-control" value="{{ $get('home_portfolio_button_text') }}"></div>
                <div class="form-group"><label class="form-label">Portfolio Button URL</label><input type="text" name="home_portfolio_button_url" class="form-control" value="{{ $get('home_portfolio_button_url') }}"></div>
            </div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">Process Badge</label><input type="text" name="home_process_badge" class="form-control" value="{{ $get('home_process_badge') }}"></div>
                <div class="form-group"><label class="form-label">Process Title</label><input type="text" name="home_process_title" class="form-control" value="{{ $get('home_process_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Process Subtitle</label><textarea name="home_process_subtitle" class="form-control" rows="2">{{ $get('home_process_subtitle') }}</textarea></div>
            <div class="form-group">
                <label class="form-label">Process Steps (JSON)</label>
                <textarea name="home_process_steps" class="form-control" rows="4">{{ $get('home_process_steps') }}</textarea>
                <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Format: [{"number":"1","icon":"fas fa-comments","title":"Consultation","desc":"..."}]</div>
            </div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">Testimonials Badge</label><input type="text" name="home_testimonials_badge" class="form-control" value="{{ $get('home_testimonials_badge') }}"></div>
                <div class="form-group"><label class="form-label">Testimonials Title</label><input type="text" name="home_testimonials_title" class="form-control" value="{{ $get('home_testimonials_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Testimonials Subtitle</label><textarea name="home_testimonials_subtitle" class="form-control" rows="2">{{ $get('home_testimonials_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Testimonials Button Text</label><input type="text" name="home_testimonials_button_text" class="form-control" value="{{ $get('home_testimonials_button_text') }}"></div>
                <div class="form-group"><label class="form-label">Testimonials Button URL</label><input type="text" name="home_testimonials_button_url" class="form-control" value="{{ $get('home_testimonials_button_url') }}"></div>
            </div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">Team Badge</label><input type="text" name="home_team_badge" class="form-control" value="{{ $get('home_team_badge') }}"></div>
                <div class="form-group"><label class="form-label">Team Title</label><input type="text" name="home_team_title" class="form-control" value="{{ $get('home_team_title') }}"></div>
            </div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">Blog Badge</label><input type="text" name="home_blog_badge" class="form-control" value="{{ $get('home_blog_badge') }}"></div>
                <div class="form-group"><label class="form-label">Blog Title</label><input type="text" name="home_blog_title" class="form-control" value="{{ $get('home_blog_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Blog Button Text</label><input type="text" name="home_blog_button_text" class="form-control" value="{{ $get('home_blog_button_text') }}"></div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Badge</label><input type="text" name="home_cta_badge" class="form-control" value="{{ $get('home_cta_badge') }}"></div>
                <div class="form-group"><label class="form-label">CTA Title</label><input type="text" name="home_cta_title" class="form-control" value="{{ $get('home_cta_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">CTA Description</label><textarea name="home_cta_body" class="form-control" rows="2">{{ $get('home_cta_body') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Button 1 Text</label><input type="text" name="home_cta_btn1_text" class="form-control" value="{{ $get('home_cta_btn1_text') }}"></div>
                <div class="form-group"><label class="form-label">CTA Button 1 URL</label><input type="text" name="home_cta_btn1_url" class="form-control" value="{{ $get('home_cta_btn1_url') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Button 2 Text</label><input type="text" name="home_cta_btn2_text" class="form-control" value="{{ $get('home_cta_btn2_text') }}"></div>
                <div class="form-group"><label class="form-label">CTA Button 2 URL</label><input type="text" name="home_cta_btn2_url" class="form-control" value="{{ $get('home_cta_btn2_url') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">CTA Phone Line</label><input type="text" name="home_cta_phone_line" class="form-control" value="{{ $get('home_cta_phone_line') }}"></div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">FAQ Badge</label><input type="text" name="home_faq_badge" class="form-control" value="{{ $get('home_faq_badge') }}"></div>
                <div class="form-group"><label class="form-label">FAQ Title</label><input type="text" name="home_faq_title" class="form-control" value="{{ $get('home_faq_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">FAQ Description</label><textarea name="home_faq_body" class="form-control" rows="2">{{ $get('home_faq_body') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">FAQ Button Text</label><input type="text" name="home_faq_button_text" class="form-control" value="{{ $get('home_faq_button_text') }}"></div>
                <div class="form-group"><label class="form-label">FAQ Button URL</label><input type="text" name="home_faq_button_url" class="form-control" value="{{ $get('home_faq_button_url') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="about" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">About Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="about_meta_title" class="form-control" value="{{ $get('about_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="about_meta_description" class="form-control" value="{{ $get('about_meta_description') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="about_hero_badge" class="form-control" value="{{ $get('about_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="about_hero_title" class="form-control" value="{{ $get('about_hero_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Hero Subtitle</label><textarea name="about_hero_subtitle" class="form-control" rows="2">{{ $get('about_hero_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Story Badge</label><input type="text" name="about_story_badge" class="form-control" value="{{ $get('about_story_badge') }}"></div>
                <div class="form-group"><label class="form-label">Story Title</label><input type="text" name="about_story_title" class="form-control" value="{{ $get('about_story_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Story Paragraph 1</label><textarea name="about_story_p1" class="form-control" rows="3">{{ $get('about_story_p1') }}</textarea></div>
            <div class="form-group"><label class="form-label">Story Paragraph 2</label><textarea name="about_story_p2" class="form-control" rows="3">{{ $get('about_story_p2') }}</textarea></div>
            <div class="form-group">
                <label class="form-label">Story Stats (JSON)</label>
                <textarea name="about_story_stats" class="form-control" rows="3">{{ $get('about_story_stats') }}</textarea>
                <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Format: [{"value":"2021","label":"Year Founded"}]</div>
            </div>
            <div class="form-group">
                <label class="form-label">Core Values Title</label>
                <input type="text" name="about_values_title" class="form-control" value="{{ $get('about_values_title') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Core Values Items (JSON)</label>
                <textarea name="about_values_items" class="form-control" rows="4">{{ $get('about_values_items') }}</textarea>
                <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Format: [{"icon":"fas fa-star","title":"Excellence","desc":"..."}]</div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Team Badge</label><input type="text" name="about_team_badge" class="form-control" value="{{ $get('about_team_badge') }}"></div>
                <div class="form-group"><label class="form-label">Team Title</label><input type="text" name="about_team_title" class="form-control" value="{{ $get('about_team_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Team Subtitle</label><textarea name="about_team_subtitle" class="form-control" rows="2">{{ $get('about_team_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Advantage Badge</label><input type="text" name="about_advantage_badge" class="form-control" value="{{ $get('about_advantage_badge') }}"></div>
                <div class="form-group"><label class="form-label">Advantage Title</label><input type="text" name="about_advantage_title" class="form-control" value="{{ $get('about_advantage_title') }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Advantage Items (JSON)</label>
                <textarea name="about_advantage_items" class="form-control" rows="4">{{ $get('about_advantage_items') }}</textarea>
                <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Format: [{"icon":"fas fa-certificate","color":"#3b82f6","title":"Certified","desc":"..."}]</div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Clients Badge</label><input type="text" name="about_clients_badge" class="form-control" value="{{ $get('about_clients_badge') }}"></div>
                <div class="form-group"><label class="form-label">Clients Title</label><input type="text" name="about_clients_title" class="form-control" value="{{ $get('about_clients_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">About CTA Title</label><input type="text" name="about_cta_title" class="form-control" value="{{ $get('about_cta_title') }}"></div>
                <div class="form-group"><label class="form-label">About CTA Description</label><input type="text" name="about_cta_body" class="form-control" value="{{ $get('about_cta_body') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">About CTA Button 1 Text</label><input type="text" name="about_cta_btn1_text" class="form-control" value="{{ $get('about_cta_btn1_text') }}"></div>
                <div class="form-group"><label class="form-label">About CTA Button 1 URL</label><input type="text" name="about_cta_btn1_url" class="form-control" value="{{ $get('about_cta_btn1_url') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">About CTA Button 2 Text</label><input type="text" name="about_cta_btn2_text" class="form-control" value="{{ $get('about_cta_btn2_text') }}"></div>
                <div class="form-group"><label class="form-label">About CTA Button 2 URL</label><input type="text" name="about_cta_btn2_url" class="form-control" value="{{ $get('about_cta_btn2_url') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="services" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Services Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="services_meta_title" class="form-control" value="{{ $get('services_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="services_meta_description" class="form-control" value="{{ $get('services_meta_description') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="services_hero_badge" class="form-control" value="{{ $get('services_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="services_hero_title" class="form-control" value="{{ $get('services_hero_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Hero Subtitle</label><textarea name="services_hero_subtitle" class="form-control" rows="2">{{ $get('services_hero_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Process Badge</label><input type="text" name="services_process_badge" class="form-control" value="{{ $get('services_process_badge') }}"></div>
                <div class="form-group"><label class="form-label">Process Title</label><input type="text" name="services_process_title" class="form-control" value="{{ $get('services_process_title') }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Process Steps (JSON)</label>
                <textarea name="services_process_steps" class="form-control" rows="4">{{ $get('services_process_steps') }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Title</label><input type="text" name="services_cta_title" class="form-control" value="{{ $get('services_cta_title') }}"></div>
                <div class="form-group"><label class="form-label">CTA Description</label><input type="text" name="services_cta_body" class="form-control" value="{{ $get('services_cta_body') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Button Text</label><input type="text" name="services_cta_button_text" class="form-control" value="{{ $get('services_cta_button_text') }}"></div>
                <div class="form-group"><label class="form-label">CTA Button URL</label><input type="text" name="services_cta_button_url" class="form-control" value="{{ $get('services_cta_button_url') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="contact" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Contact Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="contact_meta_title" class="form-control" value="{{ $get('contact_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="contact_meta_description" class="form-control" value="{{ $get('contact_meta_description') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="contact_hero_badge" class="form-control" value="{{ $get('contact_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="contact_hero_title" class="form-control" value="{{ $get('contact_hero_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Hero Subtitle</label><textarea name="contact_hero_subtitle" class="form-control" rows="2">{{ $get('contact_hero_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Card Label: Call</label><input type="text" name="contact_card_call_label" class="form-control" value="{{ $get('contact_card_call_label') }}"></div>
                <div class="form-group"><label class="form-label">Card Label: Email</label><input type="text" name="contact_card_email_label" class="form-control" value="{{ $get('contact_card_email_label') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Card Label: Hours</label><input type="text" name="contact_card_hours_label" class="form-control" value="{{ $get('contact_card_hours_label') }}"></div>
                <div class="form-group"><label class="form-label">Card Label: WhatsApp</label><input type="text" name="contact_card_whatsapp_label" class="form-control" value="{{ $get('contact_card_whatsapp_label') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Card Value: WhatsApp</label><input type="text" name="contact_card_whatsapp_value" class="form-control" value="{{ $get('contact_card_whatsapp_value') }}"></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Office Badge</label><input type="text" name="contact_office_badge" class="form-control" value="{{ $get('contact_office_badge') }}"></div>
                <div class="form-group"><label class="form-label">Office Title</label><input type="text" name="contact_office_title" class="form-control" value="{{ $get('contact_office_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Office Card Title</label><input type="text" name="contact_office_card_title" class="form-control" value="{{ $get('contact_office_card_title') }}"></div>
                <div class="form-group"><label class="form-label">Office City</label><input type="text" name="contact_office_city" class="form-control" value="{{ $get('contact_office_city') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">India Office Title</label><input type="text" name="contact_india_title" class="form-control" value="{{ $get('contact_india_title') }}"></div>
                <div class="form-group"><label class="form-label">India Office City</label><input type="text" name="contact_india_city" class="form-control" value="{{ $get('contact_india_city') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">India Office Address</label><textarea name="contact_india_address" class="form-control" rows="2">{{ $get('contact_india_address') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">India Office Directions URL</label><input type="text" name="contact_india_directions_url" class="form-control" value="{{ $get('contact_india_directions_url') }}"></div>
                <div class="form-group"><label class="form-label">India Office Image</label><input type="file" name="contact_india_image" class="form-control" accept="image/*"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Australia Office Title</label><input type="text" name="contact_aus_title" class="form-control" value="{{ $get('contact_aus_title') }}"></div>
                <div class="form-group"><label class="form-label">Australia Office City</label><input type="text" name="contact_aus_city" class="form-control" value="{{ $get('contact_aus_city') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Australia Office Address</label><textarea name="contact_aus_address" class="form-control" rows="2">{{ $get('contact_aus_address') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Australia Office Directions URL</label><input type="text" name="contact_aus_directions_url" class="form-control" value="{{ $get('contact_aus_directions_url') }}"></div>
                <div class="form-group"><label class="form-label">Australia Office Image</label><input type="file" name="contact_aus_image" class="form-control" accept="image/*"></div>
            </div>
            <div class="form-group"><label class="form-label">Directions Text</label><input type="text" name="contact_directions_text" class="form-control" value="{{ $get('contact_directions_text') }}"></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Social Title</label><input type="text" name="contact_social_title" class="form-control" value="{{ $get('contact_social_title') }}"></div>
                <div class="form-group"><label class="form-label">Certifications Text</label><input type="text" name="contact_certifications_text" class="form-control" value="{{ $get('contact_certifications_text') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Form Title</label><input type="text" name="contact_form_title" class="form-control" value="{{ $get('contact_form_title') }}"></div>
                <div class="form-group"><label class="form-label">Form Subtitle</label><input type="text" name="contact_form_subtitle" class="form-control" value="{{ $get('contact_form_subtitle') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Form Submit Text</label><input type="text" name="contact_form_submit_text" class="form-control" value="{{ $get('contact_form_submit_text') }}"></div>
                <div class="form-group"><label class="form-label">Form Privacy Text</label><input type="text" name="contact_form_privacy_text" class="form-control" value="{{ $get('contact_form_privacy_text') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Map Embed URL</label><input type="text" name="contact_map_embed_url" class="form-control" value="{{ $get('contact_map_embed_url') }}"></div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="blog" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Blog Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="blog_meta_title" class="form-control" value="{{ $get('blog_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="blog_meta_description" class="form-control" value="{{ $get('blog_meta_description') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="blog_hero_badge" class="form-control" value="{{ $get('blog_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="blog_hero_title" class="form-control" value="{{ $get('blog_hero_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Hero Subtitle</label><textarea name="blog_hero_subtitle" class="form-control" rows="2">{{ $get('blog_hero_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Search Placeholder</label><input type="text" name="blog_search_placeholder" class="form-control" value="{{ $get('blog_search_placeholder') }}"></div>
                <div class="form-group"><label class="form-label">Empty Title</label><input type="text" name="blog_empty_title" class="form-control" value="{{ $get('blog_empty_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Categories Title</label><input type="text" name="blog_categories_title" class="form-control" value="{{ $get('blog_categories_title') }}"></div>
                <div class="form-group"><label class="form-label">Recent Title</label><input type="text" name="blog_recent_title" class="form-control" value="{{ $get('blog_recent_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Tags Title</label><input type="text" name="blog_tags_title" class="form-control" value="{{ $get('blog_tags_title') }}"></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Title</label><input type="text" name="blog_cta_title" class="form-control" value="{{ $get('blog_cta_title') }}"></div>
                <div class="form-group"><label class="form-label">CTA Description</label><input type="text" name="blog_cta_body" class="form-control" value="{{ $get('blog_cta_body') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Email Placeholder</label><input type="text" name="blog_cta_placeholder" class="form-control" value="{{ $get('blog_cta_placeholder') }}"></div>
                <div class="form-group"><label class="form-label">CTA Button Text</label><input type="text" name="blog_cta_button_text" class="form-control" value="{{ $get('blog_cta_button_text') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="events" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Events Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="events_meta_title" class="form-control" value="{{ $get('events_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="events_hero_badge" class="form-control" value="{{ $get('events_hero_badge') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="events_hero_title" class="form-control" value="{{ $get('events_hero_title') }}"></div>
                <div class="form-group"><label class="form-label">Hero Subtitle</label><input type="text" name="events_hero_subtitle" class="form-control" value="{{ $get('events_hero_subtitle') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Empty Title</label><input type="text" name="events_empty_title" class="form-control" value="{{ $get('events_empty_title') }}"></div>
                <div class="form-group"><label class="form-label">Empty Body</label><input type="text" name="events_empty_body" class="form-control" value="{{ $get('events_empty_body') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Card Location Fallback</label><input type="text" name="events_location_fallback" class="form-control" value="{{ $get('events_location_fallback') }}"></div>
                <div class="form-group"><label class="form-label">Card View Details Text</label><input type="text" name="events_view_details_text" class="form-control" value="{{ $get('events_view_details_text') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Event Badge (Detail)</label><input type="text" name="event_detail_badge" class="form-control" value="{{ $get('event_detail_badge') }}"></div>
                <div class="form-group"><label class="form-label">Event Gallery Title</label><input type="text" name="event_gallery_title" class="form-control" value="{{ $get('event_gallery_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Event CTA Primary Text</label><input type="text" name="event_cta_primary_text" class="form-control" value="{{ $get('event_cta_primary_text') }}"></div>
                <div class="form-group"><label class="form-label">Event CTA Secondary Text</label><input type="text" name="event_cta_secondary_text" class="form-control" value="{{ $get('event_cta_secondary_text') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="gallery" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Gallery Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="gallery_meta_title" class="form-control" value="{{ $get('gallery_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="gallery_hero_badge" class="form-control" value="{{ $get('gallery_hero_badge') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="gallery_hero_title" class="form-control" value="{{ $get('gallery_hero_title') }}"></div>
                <div class="form-group"><label class="form-label">Hero Subtitle</label><input type="text" name="gallery_hero_subtitle" class="form-control" value="{{ $get('gallery_hero_subtitle') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">All Filter Label</label><input type="text" name="gallery_filter_all_label" class="form-control" value="{{ $get('gallery_filter_all_label') }}"></div>
                <div class="form-group"><label class="form-label">Empty Title</label><input type="text" name="gallery_empty_title" class="form-control" value="{{ $get('gallery_empty_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Empty Body</label><input type="text" name="gallery_empty_body" class="form-control" value="{{ $get('gallery_empty_body') }}"></div>
                <div class="form-group"><label class="form-label">Card Title Fallback</label><input type="text" name="gallery_card_title_fallback" class="form-control" value="{{ $get('gallery_card_title_fallback') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Card Category Fallback</label><input type="text" name="gallery_card_category_fallback" class="form-control" value="{{ $get('gallery_card_category_fallback') }}"></div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="testimonials-faqs" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Testimonials & FAQs</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Testimonials Meta Title</label><input type="text" name="testimonials_meta_title" class="form-control" value="{{ $get('testimonials_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Testimonials Hero Title</label><input type="text" name="testimonials_hero_title" class="form-control" value="{{ $get('testimonials_hero_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Testimonials Hero Badge</label><input type="text" name="testimonials_hero_badge" class="form-control" value="{{ $get('testimonials_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">Testimonials Hero Subtitle</label><input type="text" name="testimonials_hero_subtitle" class="form-control" value="{{ $get('testimonials_hero_subtitle') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Testimonials Empty Title</label><input type="text" name="testimonials_empty_title" class="form-control" value="{{ $get('testimonials_empty_title') }}"></div>
                <div class="form-group"><label class="form-label">Testimonials Empty Body</label><input type="text" name="testimonials_empty_body" class="form-control" value="{{ $get('testimonials_empty_body') }}"></div>
            </div>

            <div class="form-row">
                <div class="form-group"><label class="form-label">FAQs Meta Title</label><input type="text" name="faqs_meta_title" class="form-control" value="{{ $get('faqs_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">FAQs Hero Title</label><input type="text" name="faqs_hero_title" class="form-control" value="{{ $get('faqs_hero_title') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">FAQs Hero Badge</label><input type="text" name="faqs_hero_badge" class="form-control" value="{{ $get('faqs_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">FAQs Hero Subtitle</label><input type="text" name="faqs_hero_subtitle" class="form-control" value="{{ $get('faqs_hero_subtitle') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">FAQs Empty Title</label><input type="text" name="faqs_empty_title" class="form-control" value="{{ $get('faqs_empty_title') }}"></div>
                <div class="form-group"><label class="form-label">FAQs Empty Body</label><input type="text" name="faqs_empty_body" class="form-control" value="{{ $get('faqs_empty_body') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="portfolio" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Portfolio Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="portfolio_meta_title" class="form-control" value="{{ $get('portfolio_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="portfolio_meta_description" class="form-control" value="{{ $get('portfolio_meta_description') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="portfolio_hero_badge" class="form-control" value="{{ $get('portfolio_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="portfolio_hero_title" class="form-control" value="{{ $get('portfolio_hero_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Hero Subtitle</label><textarea name="portfolio_hero_subtitle" class="form-control" rows="2">{{ $get('portfolio_hero_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">All Projects Label</label><input type="text" name="portfolio_filter_all_label" class="form-control" value="{{ $get('portfolio_filter_all_label') }}"></div>
                <div class="form-group"><label class="form-label">Featured Label</label><input type="text" name="portfolio_featured_label" class="form-control" value="{{ $get('portfolio_featured_label') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Title</label><input type="text" name="portfolio_cta_title" class="form-control" value="{{ $get('portfolio_cta_title') }}"></div>
                <div class="form-group"><label class="form-label">CTA Description</label><input type="text" name="portfolio_cta_body" class="form-control" value="{{ $get('portfolio_cta_body') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Button Text</label><input type="text" name="portfolio_cta_button_text" class="form-control" value="{{ $get('portfolio_cta_button_text') }}"></div>
                <div class="form-group"><label class="form-label">CTA Button URL</label><input type="text" name="portfolio_cta_button_url" class="form-control" value="{{ $get('portfolio_cta_button_url') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="careers" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Careers Page</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="careers_meta_title" class="form-control" value="{{ $get('careers_meta_title') }}"></div>
                <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="careers_meta_description" class="form-control" value="{{ $get('careers_meta_description') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Hero Badge</label><input type="text" name="careers_hero_badge" class="form-control" value="{{ $get('careers_hero_badge') }}"></div>
                <div class="form-group"><label class="form-label">Hero Title</label><input type="text" name="careers_hero_title" class="form-control" value="{{ $get('careers_hero_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Hero Subtitle</label><textarea name="careers_hero_subtitle" class="form-control" rows="2">{{ $get('careers_hero_subtitle') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Why Badge</label><input type="text" name="careers_why_badge" class="form-control" value="{{ $get('careers_why_badge') }}"></div>
                <div class="form-group"><label class="form-label">Why Title</label><input type="text" name="careers_why_title" class="form-control" value="{{ $get('careers_why_title') }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Why Items (JSON)</label>
                <textarea name="careers_why_items" class="form-control" rows="4">{{ $get('careers_why_items') }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Openings Badge</label><input type="text" name="careers_open_badge" class="form-control" value="{{ $get('careers_open_badge') }}"></div>
                <div class="form-group"><label class="form-label">Openings Title</label><input type="text" name="careers_open_title" class="form-control" value="{{ $get('careers_open_title') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Openings Subtitle</label><input type="text" name="careers_open_subtitle" class="form-control" value="{{ $get('careers_open_subtitle') }}"></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Empty Title</label><input type="text" name="careers_empty_title" class="form-control" value="{{ $get('careers_empty_title') }}"></div>
                <div class="form-group"><label class="form-label">Empty Body</label><input type="text" name="careers_empty_body" class="form-control" value="{{ $get('careers_empty_body') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Empty Button Text</label><input type="text" name="careers_empty_button_text" class="form-control" value="{{ $get('careers_empty_button_text') }}"></div>
                <div class="form-group"><label class="form-label">Empty Button URL</label><input type="text" name="careers_empty_button_url" class="form-control" value="{{ $get('careers_empty_button_url') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Title</label><input type="text" name="careers_cta_title" class="form-control" value="{{ $get('careers_cta_title') }}"></div>
                <div class="form-group"><label class="form-label">CTA Description</label><input type="text" name="careers_cta_body" class="form-control" value="{{ $get('careers_cta_body') }}"></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">CTA Button Text</label><input type="text" name="careers_cta_button_text" class="form-control" value="{{ $get('careers_cta_button_text') }}"></div>
                <div class="form-group"><label class="form-label">CTA Button URL</label><input type="text" name="careers_cta_button_url" class="form-control" value="{{ $get('careers_cta_button_url') }}"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="content-tab-panel" data-tab-panel="terms-privacy" style="display:none">
        <div class="settings-section" style="margin-bottom:16px">
        <div class="card-header"><h3 class="card-title">Terms & Privacy</h3></div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Terms Title</label><input type="text" name="terms_title" class="form-control" value="{{ $get('terms_title') }}"></div>
                <div class="form-group"><label class="form-label">Terms Updated Text</label><input type="text" name="terms_updated_text" class="form-control" value="{{ $get('terms_updated_text') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Terms Body HTML</label><textarea name="terms_body_html" class="form-control" rows="6">{{ $get('terms_body_html') }}</textarea></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Privacy Title</label><input type="text" name="privacy_title" class="form-control" value="{{ $get('privacy_title') }}"></div>
                <div class="form-group"><label class="form-label">Privacy Updated Text</label><input type="text" name="privacy_updated_text" class="form-control" value="{{ $get('privacy_updated_text') }}"></div>
            </div>
            <div class="form-group"><label class="form-label">Privacy Body HTML</label><textarea name="privacy_body_html" class="form-control" rows="6">{{ $get('privacy_body_html') }}</textarea></div>
        </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Content Settings</button>
    </div>
</form>

<script>
    (function () {
        const buttons = document.querySelectorAll('.content-tab-btn');
        const panels = document.querySelectorAll('.content-tab-panel');
        const activate = (id) => {
            buttons.forEach(btn => btn.classList.toggle('active', btn.dataset.tab === id));
            panels.forEach(panel => panel.style.display = panel.dataset.tabPanel === id ? 'block' : 'none');
        };
        buttons.forEach(btn => {
            btn.addEventListener('click', () => activate(btn.dataset.tab));
        });
        const first = buttons[0]?.dataset?.tab;
        if (first) activate(first);
    })();
</script>
@endsection



