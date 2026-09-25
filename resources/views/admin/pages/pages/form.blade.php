@extends('admin.layouts.app')
@section('title', isset($page) ? 'Edit Page' : 'Add Page')
@section('breadcrumb')<span>></span><a href="{{ route('admin.pages.index') }}" style="color:#94a3b8;text-decoration:none">Pages</a><span>></span><span class="current">{{ isset($page) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($page) ? 'Edit' : 'Add' }} Page</h1><a href="{{ route('admin.pages.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<form class="single-card-form" action="{{ isset($page) ? route('admin.pages.update',$page) : route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
@csrf @if(isset($page)) @method('PUT') @endif
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
<div><div class="card"><div class="card-body">
<div class="form-group"><label class="form-label">Page Title *</label><input type="text" name="title" class="form-control" value="{{ old('title',$page->title??'') }}" required></div>
<div class="form-group"><label class="form-label">URL Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug',$page->slug??'') }}" placeholder="auto-generated-from-title"></div>
<div class="form-group"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt',$page->excerpt??'') }}</textarea></div>
<div class="form-group">
    <label class="form-label">Content</label>
    <textarea name="content" id="content" class="form-control wysiwyg" rows="16">{{ old('content',$page->content??'') }}</textarea>
</div>
</div></div></div>
<div><div class="card" style="margin-bottom:16px"><div class="card-header"><h3 class="card-title">Settings</h3></div><div class="card-body">
<div class="form-group"><label class="form-label">Status</label><select name="status" class="form-control"><option value="published" {{ old('status',$page->status??'published')==='published'?'selected':'' }}>Published</option><option value="draft" {{ old('status',$page->status??'draft')==='draft'?'selected':'' }}>Draft</option></select></div>
<div class="form-group"><label class="form-label">Template</label><select name="template" class="form-control"><option value="default" {{ old('template',$page->template??'default')==='default'?'selected':'' }}>Default</option><option value="full-width" {{ old('template',$page->template??'')==='full-width'?'selected':'' }}>Full Width</option><option value="sidebar" {{ old('template',$page->template??'')==='sidebar'?'selected':'' }}>With Sidebar</option></select></div>
<div class="form-group"><label class="form-label">Page Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$page->sort_order??0) }}" min="0"></div>
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:10px"><label style="margin:0;font-size:13px;font-weight:600">Show in Header</label><label class="toggle-switch"><input type="checkbox" name="show_in_header" value="1" {{ old('show_in_header',$page->show_in_header??false)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-top:10px"><label style="margin:0;font-size:13px;font-weight:600">Show in Footer</label><label class="toggle-switch"><input type="checkbox" name="show_in_footer" value="1" {{ old('show_in_footer',$page->show_in_footer??false)?'checked':'' }}><span class="toggle-slider"></span></label></div>
</div></div>
<div class="card" style="margin-bottom:16px"><div class="card-header"><h3 class="card-title">Featured Image</h3></div><div class="card-body">
    @if(!empty($page->featured_image))
        <img src="{{ media_url($page->featured_image) }}" alt="{{ $page->title ?? 'Page banner' }}" style="width:100%;border-radius:10px;margin-bottom:12px;border:1px solid #e2e8f0">
    @endif
    <input type="file" name="featured_image" class="form-control">
</div></div>
<div class="card"><div class="card-header"><h3 class="card-title">SEO</h3></div><div class="card-body">
<div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="{{ old('meta_title',$page->meta_title??'') }}"></div>
<div class="form-group"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description',$page->meta_description??'') }}</textarea></div>
</div></div></div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($page) ? 'Update' : 'Submit' }}</button>
    @if(isset($page))
    <a href="{{ route('admin.pages.preview',$page) }}" class="btn btn-secondary" target="_blank"><i class="fas fa-eye"></i> Preview</a>
    @endif
</div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    const slugify = (value) => value
        .toString()
        .toLowerCase()
        .trim()
        .replace(/[\s\W-]+/g, '-')
        .replace(/^-+|-+$/g, '');

    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.querySelector('input[name="slug"]');
    if (titleInput && slugInput) {
        let slugTouched = slugInput.value.trim().length > 0;
        slugInput.addEventListener('input', () => { slugTouched = true; });
        titleInput.addEventListener('input', () => {
            if (!slugTouched) slugInput.value = slugify(titleInput.value || '');
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
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




