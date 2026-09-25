@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')
<div class="page-hero">
    <div class="container"><h1>Privacy Policy</h1><p>Last updated: January 2025</p></div>
</div>
<section class="section"><div class="container" style="max-width:800px">
<div style="font-size:15px;line-height:1.9;color:#475569">
<p>Rescom ("Company", "we", "us", or "our") respects your privacy and is committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights.</p>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">Information We Collect</h2>
<p>We may collect the following types of information: name, email address, phone number, company name, and project details when you fill out our contact form or subscribe to our newsletter.</p>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">How We Use Your Information</h2>
<ul style="margin-left:20px;margin-bottom:16px"><li>To respond to your inquiries and provide requested services</li><li>To send you newsletters if you have subscribed</li><li>To improve our website and services</li><li>To comply with legal obligations</li></ul>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">Data Security</h2>
<p>We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction.</p>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">Contact Us</h2>
<p>If you have questions about this privacy policy, please contact us at <a href="mailto:{{ setting('contact_email') }}" style="color:var(--primary)">{{ setting('contact_email') }}</a></p>
</div>
</div></section>
@endsection
