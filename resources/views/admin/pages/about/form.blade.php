@extends('admin.layouts.app')
@section('title', isset($about) ? 'Edit About Page' : 'Add About Page')
@section('breadcrumb')<span>></span><a href="{{ route('admin.about.index') }}" style="color:#94a3b8;text-decoration:none">About Page</a><span>></span><span class="current">{{ isset($about) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($about) ? 'Edit' : 'Add' }} About Page</h1>
    <a href="{{ route('admin.about.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form class="single-card-form" action="{{ isset($about) ? route('admin.about.update',$about) : route('admin.about.store') }}" method="POST">
@csrf @if(isset($about)) @method('PUT') @endif
<div class="card">
    <div class="card-header"><h3 class="card-title">About Content</h3></div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Hero Badge</label>
                <input type="text" name="hero_badge" class="form-control" value="{{ old('hero_badge',$about->hero_badge??'Est. 2021') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Hero Highlight</label>
                <input type="text" name="hero_highlight" class="form-control" value="{{ old('hero_highlight',$about->hero_highlight??'Transforms Businesses') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Hero Title</label>
            <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title',$about->hero_title??'Building Technology That') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Hero Subtitle</label>
            <textarea name="hero_subtitle" id="hero_subtitle_editor" class="form-control" rows="3">{{ old('hero_subtitle',$about->hero_subtitle??'We are a team of passionate technologists committed to delivering innovative IT solutions that help businesses grow, scale, and succeed in the digital era.') }}</textarea>
        </div>

        <hr style="border:none;border-top:1px solid #eef2f7;margin:22px 0">

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Story Badge</label>
                <input type="text" name="story_badge" class="form-control" value="{{ old('story_badge',$about->story_badge??'Our Story') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Story Highlight</label>
                <input type="text" name="story_highlight" class="form-control" value="{{ old('story_highlight',$about->story_highlight??'Global IT Leader') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Story Title</label>
            <input type="text" name="story_title" class="form-control" value="{{ old('story_title',$about->story_title??'From a Small Team to a') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Story Paragraph 1</label>
            <textarea name="story_body_1" class="form-control" rows="3">{{ old('story_body_1',$about->story_body_1??'Founded in 2021 by Rajesh Kumar and Priya Sharma, Rescom started as a 5-person web development shop in Bengaluru. Driven by a vision to democratize enterprise-grade technology, we grew rapidly by delivering exceptional results for every client.') }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Story Paragraph 2</label>
            <textarea name="story_body_2" class="form-control" rows="3">{{ old('story_body_2',$about->story_body_2??'Today, with 150+ professionals across multiple offices, we serve 200+ clients in 20+ countries. Our journey is defined by one constant: an unrelenting commitment to quality, innovation, and client success.') }}</textarea>
        </div>

        <hr style="border:none;border-top:1px solid #eef2f7;margin:22px 0">

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Vision Title</label>
                <input type="text" name="vision_title" class="form-control" value="{{ old('vision_title',$about->vision_title??'Our Vision') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Mission Title</label>
                <input type="text" name="mission_title" class="form-control" value="{{ old('mission_title',$about->mission_title??'Our Mission') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Vision Description</label>
                <textarea name="vision_body" class="form-control" rows="3">{{ old('vision_body',$about->vision_body??'To be the most trusted technology partner for organizations worldwide by delivering solutions that create lasting impact.') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Mission Description</label>
                <textarea name="mission_body" class="form-control" rows="3">{{ old('mission_body',$about->mission_body??'To empower businesses with modern, secure, and scalable technology solutions that accelerate growth and efficiency.') }}</textarea>
            </div>
        </div>

        <hr style="border:none;border-top:1px solid #eef2f7;margin:22px 0">

        <div class="form-group">
            <label class="form-label">Values Section Title</label>
            <input type="text" name="values_title" class="form-control" value="{{ old('values_title',$about->values_title??'Our Core Values') }}">
        </div>

        @php
            $values = old('values') ?: ($about->values ?? [
                ['icon' => 'fas fa-star','title' => 'Excellence First','desc' => 'We never compromise on quality. Every line of code, every design decision, every interaction is held to the highest standard.'],
                ['icon' => 'fas fa-handshake','title' => 'Client Partnership','desc' => 'We treat every clients project as our own. Your success is our success — thats not just a tagline, its how we work.'],
                ['icon' => 'fas fa-lightbulb','title' => 'Innovation Always','desc' => 'Technology evolves rapidly. We stay at the cutting edge so our clients always benefit from the latest and best solutions.'],
                ['icon' => 'fas fa-shield-alt','title' => 'Trust & Transparency','desc' => 'Honest communication, realistic timelines, and full accountability. We build relationships, not just software.'],
                ['icon' => 'fas fa-people-group','title' => 'People Focused','desc' => 'We invest in our people and culture so we can deliver the best outcomes for our clients.'],
            ]);
        @endphp

        @for($i=1;$i<=5;$i++)
            @php $val = $values[$i-1] ?? ['icon'=>'','title'=>'','desc'=>'']; @endphp
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Value {{ $i }} Icon (Font Awesome)</label>
                    <input type="text" name="value_{{ $i }}_icon" class="form-control" value="{{ old('value_'.$i.'_icon',$val['icon'] ?? '') }}" placeholder="fas fa-star">
                </div>
                <div class="form-group">
                    <label class="form-label">Value {{ $i }} Title</label>
                    <input type="text" name="value_{{ $i }}_title" class="form-control" value="{{ old('value_'.$i.'_title',$val['title'] ?? '') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Value {{ $i }} Description</label>
                <textarea name="value_{{ $i }}_desc" class="form-control" rows="2">{{ old('value_'.$i.'_desc',$val['desc'] ?? '') }}</textarea>
            </div>
        @endfor

        <div class="form-row" style="margin-top:6px">
            <div class="form-group">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$about->sort_order??0) }}">
            </div>
            <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                <label style="margin:0;font-size:13px;font-weight:600">Active</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active',$about->is_active??true)?'checked':'' }}>
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($about) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </div>
</div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    if (window.CKEDITOR && document.getElementById('hero_subtitle_editor')) {
        CKEDITOR.replace('hero_subtitle_editor', {
            height: 160,
            removeButtons: 'Subscript,Superscript,Anchor,Styles,SpecialChar,Image,Table,HorizontalRule',
        });
    }
</script>
   @endsection
