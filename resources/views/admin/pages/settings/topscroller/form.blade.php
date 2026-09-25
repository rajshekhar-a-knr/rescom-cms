@extends('admin.layouts.app')
@section('title','Edit Scroller Item')
@section('breadcrumb')<span>></span><a href="{{ route('admin.settings.topscroller') }}" style="color:#94a3b8;text-decoration:none">Top Scroller</a><span>></span><span class="current">Edit</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">Edit Scroller Item</h1><a href="{{ route('admin.settings.topscroller') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>

<div style="display:flex;gap:0;margin-bottom:24px;border-bottom:2px solid var(--border)">
    @foreach([route('admin.settings.index')=>'General',route('admin.settings.seo')=>'SEO',route('admin.settings.social')=>'Social',route('admin.settings.topscroller')=>'Top Scroller',route('admin.settings.email')=>'Email',route('admin.settings.content')=>'Content'] as $url=>$label)
    <a href="{{ $url }}" style="padding:10px 20px;text-decoration:none;font-size:14px;font-weight:600;border-bottom:3px solid {{ Str::startsWith(request()->url(), $url) ? 'var(--primary)' : 'transparent' }};color:{{ Str::startsWith(request()->url(), $url) ? 'var(--primary)' : 'var(--text-muted)' }};margin-bottom:-2px">{{ $label }}</a>
    @endforeach
</div>

<div style="max-width:720px">
    <form class="single-card-form" action="{{ route('admin.settings.topscroller.update', $topScroller) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="form-group"><label class="form-label">Text *</label><input type="text" name="text" class="form-control" value="{{ old('text', $topScroller->text) }}" required></div>
                <div class="form-group"><label class="form-label">Link (optional)</label><input type="url" name="url" class="form-control" value="{{ old('url', $topScroller->url) }}" placeholder="https://..." maxlength="255"></div>
                <div class="form-row">
                    <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $topScroller->sort_order) }}" min="0"></div>
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                        <label style="margin:0;font-size:13px;font-weight:600">Active</label>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $topScroller->is_active) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


