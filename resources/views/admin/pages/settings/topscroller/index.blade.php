@extends('admin.layouts.app')
@section('title','Top Scroller')
@section('breadcrumb')<span>></span><span class="current">Top Scroller</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">Top Scroller</h1></div>

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

<div class="card">
    <div class="card-header"><h3 class="card-title">Top Scroller Settings</h3></div>
    <div class="card-body">
        @php
            $get = function ($key, $default = '') use ($settings) {
                if (function_exists('setting')) {
                    return old($key, $settings[$key]->value ?? setting($key, $default));
                }
                return old($key, $settings[$key]->value ?? $default);
            };
        @endphp
        <form class="single-card-form" action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
                <input type="hidden" name="topbar_enabled" value="0">
                <input type="checkbox" id="topbar_enabled" name="topbar_enabled" value="1" {{ $get('topbar_enabled') === '1' ? 'checked' : '' }}>
                <label class="form-label" for="topbar_enabled" style="margin:0">Enable Top Bar</label>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Scroll Speed (seconds)</label>
                    <input type="number" name="top_scroller_speed" class="form-control" min="6" max="120" value="{{ $get('top_scroller_speed', 18) }}">
                    <div style="font-size:12px;color:var(--text-muted);margin-top:6px">Higher value = slower scroll.</div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Top Bar</button>
            </div>
        </form>

        <div style="border-top:1px solid var(--border);margin:18px 0"></div>

        <form class="single-card-form" action="{{ route('admin.settings.topscroller.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Text *</label>
                    <input type="text" name="text" class="form-control" value="{{ old('text') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Link (optional)</label>
                    <input type="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="https://..." maxlength="255">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}" min="0">
                </div>
                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                    <label style="margin:0;font-size:13px;font-weight:600">Active</label>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active',true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Submit</button>
            </div>
        </form>
    </div>
</div>

<div class="card" style="margin-top:16px">
    <div class="card-header"><h3 class="card-title">Scroller Items</h3></div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width:90px">Order</th>
                    <th>Text</th>
                    <th>URL</th>
                    <th style="width:110px">Status</th>
                    <th style="width:140px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->sort_order }}</td>
                        <td style="font-weight:600;font-size:13.5px">{{ Str::limit($item->text, 120) }}</td>
                        <td style="color:#64748b;font-size:13px">{{ $item->url ? Str::limit($item->url, 60) : '>' }}</td>
                        <td>
                            <span class="badge {{ $item->is_active ? 'badge-green' : 'badge-gray' }}">{{ $item->is_active ? 'Active' : 'Disabled' }}</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <form class="single-card-form" action="{{ route('admin.settings.topscroller.toggle', $item) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-secondary btn-sm" title="Toggle">
                                        <i class="fas {{ $item->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.settings.topscroller.edit', $item) }}" class="btn btn-secondary btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="single-card-form" action="{{ route('admin.settings.topscroller.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-confirm="Delete this item?" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:#64748b;padding:18px">No scroller items yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


