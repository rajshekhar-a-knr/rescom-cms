@extends('admin.layouts.app')
@section('title', isset($portfolio) ? 'Edit Project' : 'Add Project')
@section('breadcrumb')<span>></span><a href="{{ route('admin.portfolio.index') }}" style="color:#94a3b8;text-decoration:none">Portfolio</a><span>></span><span class="current">{{ isset($portfolio) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($portfolio) ? 'Edit Project' : 'Add New Project' }}</h1>
    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<form class="single-card-form" action="{{ isset($portfolio) ? route('admin.portfolio.update',$portfolio) : route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
    @csrf @if(isset($portfolio)) @method('PUT') @endif
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Project Details</h3></div>
                <div class="card-body">
                    <div class="form-group"><label class="form-label">Project Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$portfolio->title??'') }}" required></div>
                    <div class="form-row">
                        <div class="form-group"><label class="form-label">Client Name</label><input type="text" name="client_name" class="form-control" value="{{ old('client_name',$portfolio->client_name??'') }}"></div>
                        <div class="form-group"><label class="form-label">Category</label><select name="category_id" class="form-control"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id',$portfolio->category_id??'')==$c->id?'selected':'' }}>{{ $c->name }}</option>@endforeach</select></div>
                    </div>
                    <div class="form-group"><label class="form-label">Short Description</label><textarea name="short_description" class="form-control" rows="2">{{ old('short_description',$portfolio->short_description??'') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Full Description</label><textarea name="description" class="form-control" rows="6">{{ old('description',$portfolio->description??'') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Challenge</label><textarea name="challenge" class="form-control" rows="3">{{ old('challenge',$portfolio->challenge??'') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Solution</label><textarea name="solution" class="form-control" rows="3">{{ old('solution',$portfolio->solution??'') }}</textarea></div>
                    <div class="form-group"><label class="form-label">Results / Outcomes</label><textarea name="results" class="form-control" rows="3">{{ old('results',$portfolio->results??'') }}</textarea></div>
                    <div class="form-row">
                        <div class="form-group"><label class="form-label">Features (one per line)</label><textarea name="technologies_raw" class="form-control" rows="5">{{ old('technologies_raw', (isset($portfolio) && $portfolio->technologies) ? implode("\n",$portfolio->technologies) : '') }}</textarea></div>
                        <div class="form-group"><label class="form-label">Project URL</label><input type="url" name="project_url" class="form-control" value="{{ old('project_url', isset($portfolio) ? $portfolio->project_url : '') }}"><label class="form-label" style="margin-top:12px">Completion Date</label><input type="date" name="completion_date" class="form-control" value="{{ old('completion_date', isset($portfolio) ? $portfolio->completion_date?->format('Y-m-d') : '') }}"></div>
                    </div>
                </div>
            </div>

            <!-- Product Gallery & Screenshots Card -->
            <div class="card" style="margin-bottom:16px">
                <div class="card-header" style="display:flex;align-items:center;justify-content:space-between">
                    <h3 class="card-title"><i class="fas fa-images" style="color:#0284c7;margin-right:8px"></i> Product Gallery & Screenshots</h3>
                    <span style="font-size:12px;color:#64748b;font-weight:600">Multiple files supported</span>
                </div>
                <div class="card-body">
                    <p style="font-size:13px;color:#64748b;margin-bottom:14px;line-height:1.5">
                        Upload high-definition application screens, UI walkthroughs, mobile app views, or platform dashboards. These will be displayed in the full-screen interactive gallery on the website.
                    </p>

                    <div class="form-group">
                        <label class="form-label" style="font-weight:700">Add New Gallery Images / Screenshots</label>
                        <input type="file" name="gallery[]" id="galleryInput" class="form-control" multiple accept="image/*" onchange="handleGalleryPreview(this)">
                        <small style="display:block;color:#94a3b8;margin-top:5px;font-size:12px">Select one or multiple images (PNG, JPG, WebP, SVG). Hold Ctrl / Shift to select multiple files.</small>
                    </div>

                    <!-- Client-Side Live Preview of Selected Files -->
                    <div id="newGalleryPreviewContainer" style="display:none;margin-top:16px;padding:14px;background:#f8fafc;border-radius:12px;border:1px dashed #cbd5e1">
                        <div style="font-size:12px;font-weight:700;color:#0284c7;margin-bottom:10px;text-transform:uppercase;letter-spacing:0.5px">
                            <i class="fas fa-eye"></i> Selected for upload:
                        </div>
                        <div id="newGalleryPreviewGrid" style="display:grid;grid-template-columns:repeat(auto-fill, minmax(110px, 1fr));gap:12px"></div>
                    </div>

                    @php
                        $existingGallery = isset($portfolio) && $portfolio->gallery 
                            ? (is_array($portfolio->gallery) ? $portfolio->gallery : (json_decode($portfolio->gallery, true) ?: []))
                            : [];
                    @endphp

                    @if(!empty($existingGallery))
                    <div style="margin-top:24px;padding-top:18px;border-top:1px solid #e2e8f0">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
                            <label class="form-label" style="font-weight:800;margin:0;color:#1e293b">
                                Existing Gallery Screenshots ({{ count($existingGallery) }})
                            </label>
                            <span style="font-size:11.5px;color:#ef4444;font-weight:700"><i class="fas fa-info-circle"></i> Check "Remove" to delete on save</span>
                        </div>

                        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(130px, 1fr));gap:14px">
                            @foreach($existingGallery as $index => $imgPath)
                            <div style="position:relative;background:#ffffff;border:1.5px solid #e2e8f0;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.04);transition:transform 0.2s ease">
                                <div style="height:90px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;overflow:hidden">
                                    <img src="{{ media_url($imgPath) }}" alt="Screenshot {{ $index + 1 }}" style="width:100%;height:100%;object-fit:cover">
                                </div>
                                <div style="padding:8px 10px;background:#ffffff;display:flex;align-items:center;justify-content:space-between">
                                    <span style="font-size:11px;font-weight:700;color:#64748b">#{{ $index + 1 }}</span>
                                    <label style="display:inline-flex;align-items:center;gap:4px;margin:0;font-size:11px;font-weight:700;color:#ef4444;cursor:pointer">
                                        <input type="checkbox" name="delete_gallery[]" value="{{ $index }}" style="cursor:pointer;accent-color:#ef4444">
                                        <span>Remove</span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <div class="card" style="margin-bottom:16px">
                <div class="card-header"><h3 class="card-title">Settings</h3></div>
                <div class="card-body">
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$portfolio->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div>
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:12px"><label style="margin:0;font-size:13px;font-weight:600">Featured</label><label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$portfolio->is_featured??false)?'checked':'' }}><span class="toggle-slider"></span></label></div>
                    <div class="form-group" style="margin-top:12px">
                        <label class="form-label" style="font-weight:700">Display / Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}" min="0" placeholder="0">
                        <small style="font-size:11px;color:#64748b;display:block;margin-top:4px">Lower numbers appear first on the website (0, 1, 2...)</small>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">Primary Logo / Featured Image</h3></div>
                <div class="card-body">
                    <p style="font-size:12.5px;color:#64748b;margin-bottom:12px">
                        Displayed in product cards and in the main showcase bay. Transparent PNG or SVG logos work best.
                    </p>
                    @if(isset($portfolio) && $portfolio->featured_image)
                    <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;padding:16px;text-align:center;margin-bottom:14px;box-shadow:inset 0 1px 3px rgba(0,0,0,0.03)">
                        <img src="{{ media_url($portfolio->featured_image) }}" style="max-width:100%;max-height:120px;object-fit:contain">
                    </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($portfolio) ? 'Update' : 'Submit' }}</button>
    </div>
</form>

<script>
function handleGalleryPreview(input) {
    const container = document.getElementById('newGalleryPreviewContainer');
    const grid = document.getElementById('newGalleryPreviewGrid');
    grid.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        container.style.display = 'block';
        Array.from(input.files).forEach((file, idx) => {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const card = document.createElement('div');
                card.style.cssText = 'position:relative;background:#fff;border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,0.04)';
                card.innerHTML = `
                    <div style="height:75px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;overflow:hidden">
                        <img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover">
                    </div>
                    <div style="padding:4px 8px;font-size:10.5px;color:#64748b;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                        ${file.name}
                    </div>
                `;
                grid.appendChild(card);
            };
            reader.readAsDataURL(file);
        });
    } else {
        container.style.display = 'none';
    }
}
</script>
@endsection
