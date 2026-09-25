@extends('admin.layouts.app')
@section('title','Media Library')
@section('breadcrumb')<span>></span><span class="current">Media Library</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Media Library</h1><p class="page-subtitle">Manage uploaded images and files</p></div>
<label class="btn btn-primary" style="cursor:pointer"><i class="fas fa-upload"></i> Upload Files<input type="file" id="fileUpload" multiple accept="image/*,application/pdf" style="display:none"></label>
</div>
<div id="uploadProgress" style="display:none" class="alert alert-info"><i class="fas fa-spinner fa-spin"></i> Uploading...</div>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px" id="mediaGrid">
    @foreach($media as $item)
    <div class="card" style="overflow:visible">
        <div style="position:relative">
            @if(str_starts_with($item->mime_type,'image/'))
            <img src="{{ media_url($item->path) }}" style="width:100%;height:130px;object-fit:cover;border-radius:8px 8px 0 0">
            @else
            <div style="height:130px;display:flex;align-items:center;justify-content:center;background:#f8fafc;border-radius:8px 8px 0 0"><i class="fas fa-file-pdf" style="font-size:40px;color:#ef4444"></i></div>
            @endif
            <button onclick="deleteMedia({{ $item->id }},this)" style="position:absolute;top:6px;right:6px;background:rgba(239,68,68,0.9);color:white;border:none;width:24px;height:24px;border-radius:50%;cursor:pointer;font-size:11px;display:flex;align-items:center;justify-content:center"><i class="fas fa-times"></i></button>
        </div>
        <div style="padding:8px">
            <div style="font-size:11px;color:#64748b;word-break:break-all">{{ Str::limit($item->original_name,25) }}</div>
            <div style="font-size:10px;color:#94a3b8">{{ number_format($item->size/1024,1) }} KB</div>
        </div>
    </div>
    @endforeach
</div>
<div style="margin-top:20px">{{ $media->links() }}</div>
@endsection
@section('scripts')
<script>
document.getElementById('fileUpload').addEventListener('change', function(e) {
    const files = e.target.files;
    if (!files.length) return;
    document.getElementById('uploadProgress').style.display = 'flex';
    const formData = new FormData();
    Array.from(files).forEach(f => formData.append('files[]', f));
    formData.append('_token', '{{ csrf_token() }}');
    fetch('{{ route("admin.media.upload") }}', { method: 'POST', body: formData })
        .then(r => r.json())
        .then(d => { if(d.success) location.reload(); else alert('Upload failed'); })
        .catch(() => alert('Upload failed'))
        .finally(() => { document.getElementById('uploadProgress').style.display = 'none'; });
});
function deleteMedia(id, btn) {
    if (!confirm('Delete this file?')) return;
    fetch(`/admin/media/${id}`, {method:'DELETE',headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}})
    .then(r => r.json()).then(d => { if(d.success) btn.closest('.card').remove(); });
}
</script>
@endsection



