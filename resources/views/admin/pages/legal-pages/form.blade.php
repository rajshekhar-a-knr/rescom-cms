@extends('admin.layouts.app')
@section('title', isset($page) ? 'Edit Legal Page' : 'Add Legal Page')
@section('breadcrumb')<span>></span><a href="{{ route('admin.legal-pages.index') }}" style="color:#94a3b8;text-decoration:none">Legal Pages</a><span>></span><span class="current">{{ isset($page) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($page) ? 'Edit' : 'Add' }} Legal Page</h1><a href="{{ route('admin.legal-pages.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<form class="single-card-form" action="{{ isset($page) ? route('admin.legal-pages.update',$page) : route('admin.legal-pages.store') }}" method="POST">
@csrf @if(isset($page)) @method('PUT') @endif
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
    <div>
        <div class="card"><div class="card-body">
            <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$page->title??'') }}" required></div>
            <div class="form-group"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug',$page->slug??'') }}" placeholder="auto-generated-from-title"></div>
            <div class="form-group"><label class="form-label">Content</label><textarea name="content" id="content" class="form-control" rows="18">{{ old('content',$page->content??'') }}</textarea></div>
        </div></div>
    </div>
    <div>
        <div class="card" style="margin-bottom:16px"><div class="card-header"><h3 class="card-title">Settings</h3></div><div class="card-body">
            <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$page->sort_order??0) }}" min="0"></div>
            <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:10px"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$page->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div>
        </div></div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($page) ? 'Update' : 'Submit' }}</button>
</div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    const slugifyLegal = (value) => value
        .toString()
        .toLowerCase()
        .trim()
        .replace(/[\s\W-]+/g, '-')
        .replace(/^-+|-+$/g, '');

    document.addEventListener('DOMContentLoaded', () => {
        const titleInput = document.querySelector('input[name="title"]');
        const slugInput = document.querySelector('input[name="slug"]');
        if (titleInput && slugInput) {
            let slugTouched = slugInput.value.trim().length > 0;
            slugInput.addEventListener('input', () => { slugTouched = true; });
            titleInput.addEventListener('input', () => {
                if (!slugTouched) slugInput.value = slugifyLegal(titleInput.value || '');
            });
        }

        if (window.CKEDITOR) {
            CKEDITOR.replace('content', {
                height: 480,
                removePlugins: 'notification',
                removeButtons: 'Subscript,Superscript,About',
                contentsCss: ['https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap'],
                bodyClass: 'wysiwyg-body'
            });
        }
    });
</script>
@endsection





