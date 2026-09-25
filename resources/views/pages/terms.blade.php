@extends('layouts.app')
@section('title', 'Terms of Service')
@section('content')
<div class="page-hero"><div class="container"><h1>Terms of Service</h1><p>Last updated: January 2025</p></div></div>
<section class="section"><div class="container" style="max-width:800px">
<div style="font-size:15px;line-height:1.9;color:#475569">
<p>By accessing and using the Rescom website and services, you agree to be bound by these Terms of Service.</p>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">Services</h2>
<p>Rescom provides IT services including web development, mobile application development, cloud solutions, cybersecurity, and digital consulting. All services are subject to separate service agreements.</p>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">Intellectual Property</h2>
<p>All content on this website, including text, graphics, logos, and software, is the property of Rescom and protected by applicable intellectual property laws.</p>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">Limitation of Liability</h2>
<p>Rescom shall not be liable for any indirect, incidental, special, or consequential damages resulting from the use or inability to use our services.</p>
<h2 style="font-size:22px;color:#0f172a;margin:32px 0 12px">Contact</h2>
<p>For questions about these terms: <a href="mailto:{{ setting('contact_email') }}" style="color:var(--primary)">{{ setting('contact_email') }}</a></p>
</div></div></section>
@endsection
