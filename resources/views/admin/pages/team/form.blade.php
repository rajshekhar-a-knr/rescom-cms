@extends('admin.layouts.app')
@section('title', isset($member) ? 'Edit Member' : 'Add Member')
@section('breadcrumb')<span>></span><a href="{{ route('admin.team.index') }}" style="color:#94a3b8;text-decoration:none">Team</a><span>></span><span class="current">{{ isset($member) ? 'Edit' : 'Add' }}</span>@endsection

@php
    $skillsRaw = old('skills_raw', '');
    $topSkillsRaw = old('top_skills_raw', '');
    $coreServicesRaw = old('core_services_raw', '');
    $whyUsPointsRaw = old('why_us_points_raw', '');
    $missionText = old('mission_text', '');
    $visionText = old('vision_text', '');

    if (!$errors->any() && isset($member)) {
        $skillsRaw = is_array($member->skills) ? implode("\n", $member->skills) : (string) $member->skills;
        $topSkillsRaw = is_array($member->top_skills) ? implode("\n", $member->top_skills) : '';
        $coreServicesRaw = is_array($member->core_services) ? json_encode($member->core_services, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '';
        $whyUsPointsRaw = is_array($member->why_us_points) ? json_encode($member->why_us_points, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '';
        $missionText = is_array($member->mission_vision) ? ($member->mission_vision['mission'] ?? '') : '';
        $visionText = is_array($member->mission_vision) ? ($member->mission_vision['vision'] ?? '') : '';
    }
@endphp

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($member) ? 'Edit' : 'Add' }} Team Member</h1>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
        @if(isset($member) && $member->slug)
            <a href="{{ route('digital-card.show', $member->slug) }}" target="_blank" class="btn btn-primary"><i class="fas fa-id-card"></i> Preview Card</a>
        @endif
        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

@if($errors->any())
    <div class="card" style="margin-bottom:16px;border-color:#fecaca;background:#fff7f7">
        <div class="card-body" style="color:#991b1b">
            <strong>Please fix the highlighted details:</strong>
            <ul style="margin:8px 0 0 18px">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form class="single-card-form" action="{{ isset($member) ? route('admin.team.update',$member) : route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
@csrf @if(isset($member)) @method('PUT') @endif
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
<div>
<div class="card">
<div class="card-header"><h3 class="card-title">Member Details</h3></div>
<div class="card-body">
<div class="form-row">
    <div class="form-group"><label class="form-label">Full Name *</label><input type="text" name="name" class="form-control" value="{{ old('name',$member->name??'') }}" required></div>
    <div class="form-group"><label class="form-label">Designation</label><input type="text" name="designation" class="form-control" value="{{ old('designation',$member->designation??'') }}"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Department</label><select name="department_id" class="form-control"><option value="">None</option>@foreach($departments as $department)<option value="{{ $department->id }}" {{ old('department_id',$member->department_id??'')==$department->id?'selected':'' }}>{{ $department->name }}</option>@endforeach</select></div>
    <div class="form-group"><label class="form-label">Experience (years)</label><input type="number" name="experience_years" class="form-control" value="{{ old('experience_years',$member->experience_years??0) }}"></div>
</div>
<div class="form-group"><label class="form-label">Bio</label><textarea name="bio" class="form-control" rows="4">{{ old('bio',$member->bio??'') }}</textarea></div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email',$member->email??'') }}"></div>
    <div class="form-group"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone',$member->phone??'') }}" inputmode="tel" pattern="[0-9\\s\\+\\-\\(\\)]+" title="Please use numbers only." data-min-digits="10"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">LinkedIn URL</label><input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url',$member->linkedin_url??'') }}"></div>
    <div class="form-group"><label class="form-label">Twitter/X URL</label><input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url',$member->twitter_url??'') }}"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Portfolio Website</label><input type="url" name="github_url" placeholder="https://your-portfolio.com" class="form-control" value="{{ old('github_url',$member->github_url??'') }}"></div>
    <div class="form-group"><label class="form-label">Skills (one per line)</label><textarea name="skills_raw" class="form-control" rows="4">{{ $skillsRaw }}</textarea></div>
</div>
</div>
</div>

<div class="card" style="margin-top:16px">
<div class="card-header"><h3 class="card-title">Digital Card Basics</h3></div>
<div class="card-body">
<div class="form-row">
    <div class="form-group"><label class="form-label">Card Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug',$member->slug??'') }}" placeholder="auto-generated-from-name"><small style="color:#64748b">Public URL: /card/slug</small></div>
    <div class="form-group"><label class="form-label">Card Tagline</label><input type="text" name="tagline" class="form-control" value="{{ old('tagline',$member->tagline??'') }}" placeholder="Short intro shown on the card"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Company Name</label><input type="text" name="company_name" class="form-control" value="{{ old('company_name',$member->company_name??setting('site_name','Rescom')) }}"></div>
    <div class="form-group"><label class="form-label">Company Website</label><input type="url" name="company_website" class="form-control" value="{{ old('company_website',$member->company_website??url('/')) }}"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Theme Color</label><input type="color" name="theme_color" class="form-control" value="{{ old('theme_color',$member->theme_color??'#0f4c81') }}"></div>
    <div class="form-group"><label class="form-label">Accent Color</label><input type="color" name="accent_color" class="form-control" value="{{ old('accent_color',$member->accent_color??'#2a72f7') }}"></div>
</div>
</div>
</div>

<div class="card" style="margin-top:16px">
<div class="card-header"><h3 class="card-title">Digital Card Contact</h3></div>
<div class="card-body">
<div class="form-row">
    <div class="form-group"><label class="form-label">Region 1 Label</label><input type="text" name="region1_label" class="form-control" value="{{ old('region1_label',$member->region1_label??'India') }}"></div>
    <div class="form-group"><label class="form-label">Region 1 Phone</label><input type="text" name="region1_phone" class="form-control" value="{{ old('region1_phone',$member->region1_phone??'') }}" inputmode="tel"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Region 1 WhatsApp</label><input type="text" name="region1_whatsapp" class="form-control" value="{{ old('region1_whatsapp',$member->region1_whatsapp??'') }}" inputmode="tel"></div>
    <div class="form-group"><label class="form-label">Region 1 Email</label><input type="email" name="region1_email" class="form-control" value="{{ old('region1_email',$member->region1_email??'') }}"></div>
</div>
<div class="form-group"><label class="form-label">Region 1 Website</label><input type="url" name="region1_website" class="form-control" value="{{ old('region1_website',$member->region1_website??'') }}"></div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Region 2 Label</label><input type="text" name="region2_label" class="form-control" value="{{ old('region2_label',$member->region2_label??'') }}"></div>
    <div class="form-group"><label class="form-label">Region 2 Phone</label><input type="text" name="region2_phone" class="form-control" value="{{ old('region2_phone',$member->region2_phone??'') }}" inputmode="tel"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Region 2 WhatsApp</label><input type="text" name="region2_whatsapp" class="form-control" value="{{ old('region2_whatsapp',$member->region2_whatsapp??'') }}" inputmode="tel"></div>
    <div class="form-group"><label class="form-label">Region 2 Email</label><input type="email" name="region2_email" class="form-control" value="{{ old('region2_email',$member->region2_email??'') }}"></div>
</div>
<div class="form-group"><label class="form-label">Region 2 Website</label><input type="url" name="region2_website" class="form-control" value="{{ old('region2_website',$member->region2_website??'') }}"></div>
</div>
</div>

<div class="card" style="margin-top:16px">
<div class="card-header"><h3 class="card-title">Digital Card Content</h3></div>
<div class="card-body">
<div class="form-row">
    <div class="form-group"><label class="form-label">Primary WhatsApp</label><input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp',$member->whatsapp??'') }}" inputmode="tel"></div>
    <div class="form-group"><label class="form-label">Instagram URL</label><input type="url" name="instagram" class="form-control" value="{{ old('instagram',$member->instagram??'') }}"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">YouTube URL</label><input type="url" name="youtube" class="form-control" value="{{ old('youtube',$member->youtube??'') }}"></div>
    <div class="form-group"><label class="form-label">Facebook URL</label><input type="url" name="facebook" class="form-control" value="{{ old('facebook',$member->facebook??'') }}"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Card Years Experience</label><input type="number" name="years_experience" class="form-control" value="{{ old('years_experience',$member->years_experience??'') }}"></div>
    <div class="form-group"><label class="form-label">Learners Count</label><input type="number" name="learners_count" class="form-control" value="{{ old('learners_count',$member->learners_count??'') }}"></div>
</div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Workshops Count</label><input type="number" name="workshops_count" class="form-control" value="{{ old('workshops_count',$member->workshops_count??'') }}"></div>
    <div class="form-group"><label class="form-label">Countries Text</label><input type="text" name="countries_count" class="form-control" value="{{ old('countries_count',$member->countries_count??'') }}" placeholder="10+"></div>
</div>
<div class="form-group"><label class="form-label">Top Skills Override (one per line)</label><textarea name="top_skills_raw" class="form-control" rows="4">{{ $topSkillsRaw }}</textarea></div>
<div class="form-group"><label class="form-label">Core Services JSON</label><textarea name="core_services_raw" class="form-control" rows="5" placeholder='[{"title":"Service","items":["Item one","Item two"]}]'>{{ $coreServicesRaw }}</textarea></div>
<div class="form-group"><label class="form-label">Why Us Points JSON</label><textarea name="why_us_points_raw" class="form-control" rows="5" placeholder='[{"title":"Trusted delivery","description":"Clear communication and reliable outcomes."}]'>{{ $whyUsPointsRaw }}</textarea></div>
<div class="form-row">
    <div class="form-group"><label class="form-label">Mission</label><textarea name="mission_text" class="form-control" rows="3">{{ $missionText }}</textarea></div>
    <div class="form-group"><label class="form-label">Vision</label><textarea name="vision_text" class="form-control" rows="3">{{ $visionText }}</textarea></div>
</div>
</div>
</div>
</div>

<div>
<div class="card" style="margin-bottom:16px">
<div class="card-header"><h3 class="card-title">Settings</h3></div>
<div class="card-body">
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$member->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:12px"><label style="margin:0;font-size:13px;font-weight:600">Featured on Homepage</label><label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$member->is_featured??false)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-group" style="margin-top:12px"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$member->sort_order??0) }}"></div>
</div>
</div>

<div class="card" style="margin-bottom:16px">
<div class="card-header"><h3 class="card-title">Photo</h3></div>
<div class="card-body">
@if(isset($member) && $member->photo)<div style="display:flex;justify-content:center"><img id="photoPreview" src="{{ media_url($member->photo) }}" style="width:140px;height:140px;object-fit:cover;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08)"></div>@else<div style="display:flex;justify-content:center"><img id="photoPreview" src="" style="display:none;width:140px;height:140px;object-fit:cover;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08)"></div>@endif
<input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(event, 'photoPreview')">
</div>
</div>

<div class="card" style="margin-bottom:16px">
<div class="card-header"><h3 class="card-title">Card Banner</h3></div>
<div class="card-body">
@if(isset($member) && $member->banner)<div style="display:flex;justify-content:center"><img id="bannerPreview" src="{{ media_url($member->banner) }}" style="width:100%;height:110px;object-fit:cover;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08)"></div>@else<div style="display:flex;justify-content:center"><img id="bannerPreview" src="" style="display:none;width:100%;height:110px;object-fit:cover;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08)"></div>@endif
<input type="file" name="banner" class="form-control" accept="image/*" onchange="previewImage(event, 'bannerPreview')">
</div>
</div>

<div class="card">
<div class="card-header"><h3 class="card-title">Company Logo</h3></div>
<div class="card-body">
@if(isset($member) && $member->company_logo)<div style="display:flex;justify-content:center"><img id="logoPreview" src="{{ media_url($member->company_logo) }}" style="max-width:160px;max-height:90px;object-fit:contain;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08);padding:8px"></div>@else<div style="display:flex;justify-content:center"><img id="logoPreview" src="" style="display:none;max-width:160px;max-height:90px;object-fit:contain;border-radius:14px;margin-bottom:12px;border:1px solid rgba(0,0,0,0.08);padding:8px"></div>@endif
<input type="file" name="company_logo" class="form-control" accept="image/*" onchange="previewImage(event, 'logoPreview')">
</div>
</div>
</div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($member) ? 'Update' : 'Submit' }}</button>
</div>
</form>
@endsection

@section('scripts')
<script>
function previewImage(event, targetId){
    const preview = document.getElementById(targetId);
    if (!preview || !event.target.files || !event.target.files[0]) return;
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
}
</script>
@endsection
