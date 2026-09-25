@extends('layouts.app')
@section('title', '404 - Page Not Found')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:80px 20px">
    <div>
        <div style="font-size:120px;font-weight:900;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;line-height:1;margin-bottom:16px">404</div>
        <h1 style="font-size:32px;margin-bottom:12px;color:var(--dark)">Page Not Found</h1>
        <p style="color:#64748b;font-size:16px;max-width:400px;margin:0 auto 32px;line-height:1.7">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('home') }}" class="btn btn-blue"><i class="fas fa-home"></i> Go Home</a>
            <a href="{{ route('contact') }}" class="btn btn-secondary"><i class="fas fa-headset"></i> Contact Support</a>
        </div>
    </div>
</div>
@endsection
