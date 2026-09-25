@extends('admin.layouts.app')
@section('title', isset($event) ? 'Edit Event' : 'Add Event')
@section('breadcrumb')<span>></span><a href="{{ route('admin.events.index') }}" style="color:#94a3b8;text-decoration:none">Events</a><span>></span><span class="current">{{ isset($event) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($event) ? 'Edit' : 'Add' }} Event</h1>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form class="single-card-form" action="{{ isset($event) ? route('admin.events.update',$event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($event)) @method('PUT') @endif

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title',$event->title ?? '') }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Event Type</label>
            <input type="text" name="event_type" class="form-control" list="event-type-list" value="{{ old('event_type',$event->event_type ?? '') }}" placeholder="e.g. Workshop, Webinar, Meetup">
            <datalist id="event-type-list">
                @foreach(($types ?? []) as $type)
                    <option value="{{ $type }}"></option>
                @endforeach
            </datalist>
        </div>
        <div class="form-group">
            <label class="form-label">Event Date</label>
            <input type="date" name="event_date" class="form-control" value="{{ old('event_date', isset($event->event_date) ? $event->event_date->format('Y-m-d') : '') }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location',$event->location ?? '') }}">
        </div>
        <div class="form-group">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$event->sort_order ?? 0) }}">
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Summary</label>
        <input type="text" name="summary" class="form-control" value="{{ old('summary',$event->summary ?? '') }}">
    </div>

    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="6">{{ old('description',$event->description ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Featured Image</label>
        <input type="file" name="image" class="form-control image-resize" data-resize-max="1600" data-resize-quality="0.8" accept="image/*">
        @if(isset($event) && $event->image)
            <div style="margin-top:10px">
                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" data-src="{{ media_url($event->image) }}" class="img-preview lazy-load" loading="lazy" decoding="async" fetchpriority="low">
            </div>
        @endif
    </div>

    <div class="form-group">
        <label class="form-label">Event Photos (multiple)</label>
        <input type="file" name="photos[]" class="form-control image-resize" data-resize-max="1280" data-resize-quality="0.75" accept="image/*" multiple>
        @if(isset($event) && $event->photos && $event->photos->count())
            <div id="eventPhotosGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:12px;margin-top:12px">
                @foreach($event->photos->sortBy('sort_order') as $photo)
                    <div class="event-photo-item" draggable="true" data-id="{{ $photo->id }}" style="position:relative">
                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" data-src="{{ media_url($photo->image) }}" style="width:100%;height:100px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0" class="lazy-load" loading="lazy" decoding="async" fetchpriority="low">
                        <span style="position:absolute;bottom:6px;left:6px;background:rgba(15,23,42,0.75);color:white;font-size:10px;padding:2px 6px;border-radius:999px">Drag</span>
                        <button type="button" class="event-photo-delete" title="Delete"
                                style="position:absolute;top:6px;right:6px;width:24px;height:24px;background:rgba(239,68,68,0.95);color:white;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:11px;border:none">
                            <i class="fas fa-trash"></i>
                        </button>
                        <input type="checkbox" name="remove_photos[]" value="{{ $photo->id }}" style="display:none">
                    </div>
                @endforeach
            </div>
            <div id="eventPhotoOrderInputs"></div>
        @endif
    </div>

    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
        <label style="margin:0;font-size:13px;font-weight:600">Active</label>
        <label class="toggle-switch">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active',$event->is_active ?? true)?'checked':'' }}>
            <span class="toggle-slider"></span>
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($event) ? 'Update' : 'Submit' }}</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
(() => {
    const grid = document.getElementById('eventPhotosGrid');
    const orderInputs = document.getElementById('eventPhotoOrderInputs');
    if (!grid || !orderInputs) return;
    let dragItem = null;
    grid.addEventListener('dragstart', (e) => {
        const item = e.target.closest('.event-photo-item');
        if (!item) return;
        dragItem = item;
        item.style.opacity = '0.6';
    });
    grid.addEventListener('dragend', () => {
        if (dragItem) dragItem.style.opacity = '1';
        dragItem = null;
    });
    grid.addEventListener('dragover', (e) => {
        e.preventDefault();
        const item = e.target.closest('.event-photo-item');
        if (!item || item === dragItem) return;
        const rect = item.getBoundingClientRect();
        const next = (e.clientY - rect.top) > rect.height / 2;
        grid.insertBefore(dragItem, next ? item.nextSibling : item);
    });
    const buildOrderInputs = () => {
        orderInputs.innerHTML = '';
        grid.querySelectorAll('.event-photo-item[data-id]').forEach((item) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'photo_order[]';
            input.value = item.dataset.id;
            orderInputs.appendChild(input);
        });
    };
    buildOrderInputs();
    grid.addEventListener('drop', buildOrderInputs);

    grid.addEventListener('click', (e) => {
        const btn = e.target.closest('.event-photo-delete');
        if (!btn) return;
        const item = btn.closest('.event-photo-item');
        if (!item) return;
        const checkbox = item.querySelector('input[name="remove_photos[]"]');
        if (!checkbox) return;
        checkbox.checked = !checkbox.checked;
        item.style.opacity = checkbox.checked ? '0.45' : '1';
        item.style.filter = checkbox.checked ? 'grayscale(1)' : '';
    });
})();

(() => {
    const lazyImgs = document.querySelectorAll('img.lazy-load[data-src]');
    if (!lazyImgs.length) return;
    const loadImg = (img) => {
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
    };
    if ('IntersectionObserver' in window) {
        const io = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                loadImg(entry.target);
                observer.unobserve(entry.target);
            });
        }, { rootMargin: '200px 0px' });
        lazyImgs.forEach(img => io.observe(img));
    } else {
        lazyImgs.forEach(loadImg);
    }
})();
</script>
@endsection




