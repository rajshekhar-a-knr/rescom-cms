@extends('layouts.app')

@section('title', 'Newsletter Preferences')

@section('content')
<section class="section">
    <div class="container" style="max-width:720px">
        <div style="background:white;border-radius:20px;padding:36px;box-shadow:var(--shadow);border:1px solid #e2e8f0;text-align:center">
            @if($status === 'unsubscribed')
                <div style="width:64px;height:64px;margin:0 auto 16px;border-radius:16px;background:#fee2e2;display:flex;align-items:center;justify-content:center;color:#b91c1c;font-size:26px">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h2 style="margin:0 0 10px;color:var(--dark)">You are unsubscribed</h2>
                <p style="color:#64748b;line-height:1.7;margin-bottom:18px">
                    {{ $email }} has been removed from our newsletter list. You will no longer receive updates from us.
                </p>
            @elseif($status === 'not_found')
                <div style="width:64px;height:64px;margin:0 auto 16px;border-radius:16px;background:#e2e8f0;display:flex;align-items:center;justify-content:center;color:#64748b;font-size:26px">
                    <i class="fas fa-circle-info"></i>
                </div>
                <h2 style="margin:0 0 10px;color:var(--dark)">Email not found</h2>
                <p style="color:#64748b;line-height:1.7;margin-bottom:18px">
                    We could not find that email in our newsletter list.
                </p>
            @else
                <div style="width:64px;height:64px;margin:0 auto 16px;border-radius:16px;background:#e0f2fe;display:flex;align-items:center;justify-content:center;color:#0369a1;font-size:26px">
                    <i class="fas fa-check"></i>
                </div>
                <h2 style="margin:0 0 10px;color:var(--dark)">Already unsubscribed</h2>
                <p style="color:#64748b;line-height:1.7;margin-bottom:18px">
                    {{ $email }} is already unsubscribed from our newsletter.
                </p>
            @endif
            <a href="{{ route('home') }}" class="btn btn-orange" style="justify-content:center">
                Back to Home
            </a>
        </div>
    </div>
</section>
@endsection
