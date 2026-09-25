@extends('layouts.app')
@section('title', $member->name . ' - Leadership Team')

@section('content')
<section class="team-single" >
    <div class="team-single__bg"></div>
    <div class="container" style="margin-top: 80px;">
        <div class="team-single__card">
            <div class="team-single__media">
                @if($member->photo)
                    <img src="{{ media_url($member->photo) }}" alt="{{ $member->name }}">
                @else
                    <div class="team-single__placeholder">&#128100;</div>
                @endif
            </div>

            
            <div class="team-single__body">
                <!-- <span class="team-single__eyebrow">Leadership Team</span> -->
                <h1>{{ $member->name }}</h1>
                <p class="team-single__role">{{ $member->designation }}</p>

                <div class="team-single__meta">
                    @if($member->department)
                        <span class="pill pill--primary">{{ $member->department->name }}</span>
                    @endif
                    @if($member->experience_years)
                        <span class="pill pill--success">{{ $member->experience_years }}+ Years Experience</span>
                    @endif
                </div>
                
 @if(is_array($member->skills) && count($member->skills))
                <div class="team-single__skills">
                    @foreach($member->skills as $skill)
                        <span class="pill pill--soft">{{ $skill }}</span>
                    @endforeach
                </div>
                @endif
                @if($member->bio)
                    <p class="team-single__bio">{{ $member->bio }}</p>
                @endif

                <div class="team-single__actions">
                    @if($member->email)
                        <a href="mailto:{{ $member->email }}" class="team-single__link"><i class="fas fa-envelope"></i> Email</a>
                    @endif
                    @if($member->phone)
                        <a href="tel:{{ $member->phone }}" class="team-single__link"><i class="fas fa-phone"></i> Call</a>
                    @endif
                    @if($member->slug)
                        <a href="{{ route('digital-card.show', $member->slug) }}" class="team-single__link"><i class="fas fa-id-card"></i> Digital Card</a>
                    @endif
                    @if($member->linkedin_url)<a href="{{ $member->linkedin_url }}" target="_blank" class="team-single__icon" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>@endif
                    @if($member->twitter_url)<a href="{{ $member->twitter_url }}" target="_blank" class="team-single__icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>@endif
                    @if($member->github_url)<a href="{{ $member->github_url }}" target="_blank" class="team-single__icon" aria-label="Portfolio"><i class="fas fa-globe"></i></a>@endif
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .team-single {
        position: relative;
        padding: 120px 0 90px;
        background: #f8fafc;
        overflow: hidden;
    }
    .team-single__bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 15% 20%, rgba(14,165,233,0.18), transparent 55%),
                    radial-gradient(circle at 85% 10%, rgba(59,130,246,0.16), transparent 55%),
                    linear-gradient(180deg, rgba(15,23,42,0.02), rgba(15,23,42,0));
        pointer-events: none;
    }
    .team-single__spacer { height: 70px; }
    .team-single__back {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #0f4c81;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 24px;
    }
    .team-single__card {
        position: relative;
        z-index: 1;
        background: #ffffff; /* explicit white card background */
        border-radius: 28px;
        border: 1px solid rgba(15,23,42,0.08);
        box-shadow: 0 35px 70px rgba(15,23,42,0.14);
        overflow: hidden;
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        justify-items: center;
        text-align: center;
    }
    .team-single__media {
        width: 100%;
        background: linear-gradient(135deg, #0f4c81, #1e88e5);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 36px 20px 0;
    }
    .team-single__media img {
        width: min(300px, 68vw);
        height: min(300px, 68vw);
        border-radius: 50%;
        object-fit: cover;
        border: 8px solid rgba(255,255,255,0.9);
        box-shadow: 0 18px 45px rgba(15,23,42,0.25);
        background: #fff;
    }
    .team-single__placeholder {
        width: min(280px, 65vw);
        height: min(280px, 65vw);
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        color: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 90px;
    }
    .team-single__body {
        width: 100%;
        padding: 26px 34px 34px;
        text-align: center;
        color: #0f172a;
    }
    .team-single__eyebrow {
        display: inline-flex;
        padding: 6px 14px;
        border-radius: 999px;
        background: rgba(59,130,246,0.12);
        color: #1d4ed8;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    .team-single__body h1 {
        font-size: 30px;
        color: #000000 !important;
        margin-bottom: 6px;
    }
    .team-single__body h1, .team-single__body h1 * {
        color: #000000 !important;
    }
    .team-single__role {
        font-size: 16px;
        font-weight: 600;
        color: #0f4c81;
        margin-bottom: 14px;
    }
    .team-single__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 16px;
    }
    .team-single__bio {
        color: #0f172a;
        line-height: 1.7;
        font-size: 15px;
        margin-bottom: 18px;
    }
    .team-single__skills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        margin-bottom: 20px;
    }
    .pill {
        font-size: 12px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .pill--primary { color: #0f4c81; background: #eff6ff; border-color: #dbeafe; }
    .pill--success { color: #166534; background: #ecfdf3; border-color: #bbf7d0; }
    .pill--soft { color: #1d4ed8; background: #eff6ff; border-color: #dbeafe; font-weight: 600; }
    .team-single__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }
    .team-single__link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 999px;
        background: #2a72f7 ;
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }
    .team-single__icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #2a72f7 ;
        color:#eff6ff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .team-single__icon:hover { background: #0400ff ; color: #fff; transform: translateY(-5px); }
    .team-single__link:hover { background: #5b015e ; color: #fff; transform: translateY(-5px); }
    
    @media (max-width: 900px) {
        .team-single { padding: 110px 0 70px; }
        .team-single__spacer { height: 56px; }
        .team-single__body { padding: 22px 24px 30px; }
        .team-single__body h1 { font-size: 26px; }
    }
    @media (max-width: 520px) {
        .team-single { padding: 100px 0 60px; }
        .team-single__spacer { height: 48px; }
        .team-single__media { padding: 28px 16px 0; }
        .team-single__media img { width: min(230px, 70vw); height: min(230px, 70vw); }
    }
</style>
@endsection

<style>
/* Ensure header is visible on this full-width card page */
#mainHeader, .header {
    background: transparent !important;
}
#mainHeader .nav-link,
#mainHeader .logo,
#mainHeader .logo .logo-tagline,
.topbar-right a,
.topbar-right .topbar-icon,
.header .nav-link,
.header .logo-tagline {
    color: #0f172a !important;
}
#mainHeader .nav-link i, .header .nav-link i, .topbar-right .topbar-icon i { color: #0f172a !important; }
#mainHeader .nav-link.active, .header .nav-link.active { color: #1e40af !important; }
</style>



