@extends('admin.layouts.app')

@section('title', isset($demoProduct) ? 'Edit Demo Product' : 'Add Demo Product')
@section('breadcrumb')<span>></span><a href="{{ route('admin.demo-products.index') }}" style="color:#94a3b8;text-decoration:none">Demo Products</a><span>></span><span class="current">{{ isset($demoProduct) ? 'Edit' : 'Add' }}</span>@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">{{ isset($demoProduct) ? 'Edit Demo Product' : 'Add Demo Product' }}</h1>
        <div class="page-subtitle">Create the product card and the credentials users receive by email.</div>
    </div>
    <a href="{{ route('admin.demo-products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form class="single-card-form" action="{{ isset($demoProduct) ? route('admin.demo-products.update', $demoProduct) : route('admin.demo-products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($demoProduct)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Product Card</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Product Title *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $demoProduct->title ?? '') }}" required>
                        @error('title')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category', $demoProduct->category ?? '') }}" placeholder="CRM, ERP, Education...">
                            @error('category')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $demoProduct->sort_order ?? 0) }}" min="0">
                            @error('sort_order')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $demoProduct->short_description ?? '') }}</textarea>
                        @error('short_description')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Highlights / Features (one per line)</label>
                        <textarea name="features_raw" class="form-control" rows="5">{{ old('features_raw', isset($demoProduct) && $demoProduct->features ? implode("\n", $demoProduct->features) : '') }}</textarea>
                        @error('features_raw')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Demo Credentials</h3></div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Demo URL</label>
                            <input type="url" name="demo_url" class="form-control" value="{{ old('demo_url', $demoProduct->demo_url ?? '') }}" placeholder="https://demo.example.com">
                            @error('demo_url')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Login URL</label>
                            <input type="url" name="login_url" class="form-control" value="{{ old('login_url', $demoProduct->login_url ?? '') }}" placeholder="https://demo.example.com/login">
                            @error('login_url')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Credential Email</label>
                            <input type="email" name="credential_email" class="form-control" value="{{ old('credential_email', $demoProduct->credential_email ?? '') }}">
                            @error('credential_email')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Credential Username</label>
                            <input type="text" name="credential_username" class="form-control" value="{{ old('credential_username', $demoProduct->credential_username ?? '') }}">
                            @error('credential_username')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Credential Password</label>
                        <input type="text" name="credential_password" class="form-control" value="{{ old('credential_password', $demoProduct->credential_password ?? '') }}">
                        @error('credential_password')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Credential Notes / Instructions</label>
                        <textarea name="credential_notes" class="form-control" rows="5" placeholder="Example: Use the admin role to explore reports. Data resets every night.">{{ old('credential_notes', $demoProduct->credential_notes ?? '') }}</textarea>
                        @error('credential_notes')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Settings</h3></div>
                <div class="card-body">
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
                        <label style="margin:0;font-size:13px;font-weight:600">Active</label>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $demoProduct->is_active ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Product Image</h3></div>
                <div class="card-body">
                    @if(isset($demoProduct) && $demoProduct->image)
                        <img src="{{ media_url($demoProduct->image) }}" style="width:100%;border-radius:8px;margin-bottom:12px" alt="{{ $demoProduct->title }}">
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="card" style="margin-top:16px">
                <div class="card-header"><h3 class="card-title">Preview Video</h3></div>
                <div class="card-body">
                    @if(isset($demoProduct) && $demoProduct->preview_video)
                        <video src="{{ media_url($demoProduct->preview_video) }}" controls style="width:100%;border-radius:8px;margin-bottom:12px;background:#0f172a"></video>
                        <div style="font-size:12px;color:#64748b;margin-bottom:12px;line-height:1.5">A preview video is uploaded. The public Preview button is active.</div>
                    @else
                        <div style="font-size:12px;color:#64748b;margin-bottom:12px;line-height:1.5">Upload a video to activate the public Preview button.</div>
                    @endif
                    <input type="file" name="preview_video" class="form-control" accept="video/mp4,video/webm,video/ogg,video/quicktime">
                    @error('preview_video')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($demoProduct) ? 'Update' : 'Submit' }}</button>
    </div>
</form>
@endsection
