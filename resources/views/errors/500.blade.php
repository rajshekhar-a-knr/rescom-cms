@extends('layouts.app')
@section('title', '500 - Server Error')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:80px 20px">
    <div>
        <div style="font-size:120px;font-weight:900;background:linear-gradient(135deg,#ef4444,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;line-height:1;margin-bottom:16px">500</div>
        <h1 style="font-size:32px;margin-bottom:12px;color:var(--dark)">Server Error</h1>
        <p style="color:#64748b;font-size:16px;max-width:400px;margin:0 auto 32px;line-height:1.7">Something went wrong on our end. We're working on fixing the issue. Please try again in a few minutes.</p>
        <a href="{{ route('home') }}" class="btn btn-blue"><i class="fas fa-home"></i> Go Home</a>
    </div>
</div>
@endsection
