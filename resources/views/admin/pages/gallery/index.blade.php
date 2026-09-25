@extends('admin.layouts.app')
@section('title','Gallery')
@section('breadcrumb')<span>></span><span class="current">Gallery</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Gallery</h1></div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Image</a>
        <button type="submit" form="galleryReorderForm" class="btn btn-secondary"><i class="fas fa-sort"></i> Save Order</button>
    </div>
</div>

<div class="card">
    <div class="table-container">
            <table id="galleryTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr draggable="true" data-id="{{ $item->id }}" style="cursor:grab">
                    <td>
                        @if($item->image)
                            <img src="{{ media_url($item->image) }}" style="width:70px;height:50px;object-fit:cover;border-radius:8px" loading="lazy" decoding="async">
                        @else
                            <div style="width:70px;height:50px;background:#eef2ff;border-radius:8px;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600">{{ $item->title ?? '>' }}</div>
                        @if($item->caption)<div style="font-size:12px;color:#64748b">{{ $item->caption }}</div>@endif
                    </td>
                    <td><span class="badge badge-blue">{{ $item->category ?? 'General' }}</span></td>
                    <td><span class="badge {{ $item->is_active ? 'badge-green' : 'badge-gray' }}">{{ $item->is_active ? 'Active' : 'Hidden' }}</span></td>
                    <td>{{ $item->sort_order }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.gallery.edit',$item) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                            <form class="single-card-form" action="{{ route('admin.gallery.destroy',$item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($items->isEmpty())
                    <tr class="table-empty"><td colspan="6">No gallery items yet.</td></tr>
                @endif
            </tbody>
            </table>
    </div>
</div>

<form id="galleryReorderForm" action="{{ route('admin.gallery.reorder') }}" method="POST" style="display:none">
    @csrf
</form>
@endsection

@section('scripts')
<script>
(() => {
    const tbody = document.querySelector('#galleryTable tbody');
    if (!tbody) return;
    let dragRow = null;
    tbody.addEventListener('dragstart', (e) => {
        const tr = e.target.closest('tr[draggable="true"]');
        if (!tr) return;
        dragRow = tr;
        tr.style.opacity = '0.6';
    });
    tbody.addEventListener('dragend', () => {
        if (dragRow) dragRow.style.opacity = '1';
        dragRow = null;
    });
    tbody.addEventListener('dragover', (e) => {
        e.preventDefault();
        const tr = e.target.closest('tr[draggable="true"]');
        if (!tr || tr === dragRow) return;
        const rect = tr.getBoundingClientRect();
        const next = (e.clientY - rect.top) > rect.height / 2;
        tbody.insertBefore(dragRow, next ? tr.nextSibling : tr);
    });
    const form = document.getElementById('galleryReorderForm');
    form?.addEventListener('submit', (e) => {
        form.querySelectorAll('input[name="order[]"]').forEach((n) => n.remove());
        tbody.querySelectorAll('tr[data-id]').forEach((tr) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'order[]';
            input.value = tr.dataset.id;
            form.appendChild(input);
        });
    });
})();
</script>
@endsection




