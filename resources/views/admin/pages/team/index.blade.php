@extends('admin.layouts.app')
@section('title','Team')
@section('breadcrumb')<span>></span><span class="current">Team</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">Team Members</h1></div><a href="{{ route('admin.team.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Member</a></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Member</th><th>Department</th><th>Designation</th><th>Featured</th><th>Status</th><th>Digital Card</th><th>Actions</th></tr></thead><tbody>
@foreach($members as $m)
<tr><td><div style="display:flex;align-items:center;gap:10px">@if($m->photo)<img src="{{ media_url($m->photo) }}" style="width:38px;height:38px;border-radius:50%;object-fit:cover">@else<div style="width:38px;height:38px;background:linear-gradient(135deg,#3b82f6,#8b5cf6);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700">{{ strtoupper(substr($m->name,0,1)) }}</div>@endif<div style="font-weight:600">{{ $m->name }}</div></div></td>
<td style="font-size:13px">{{ $m->department?->name ?? '>' }}</td><td style="font-size:13px">{{ $m->designation }}</td>
<td>{{ $m->is_featured ? 'Yes' : 'No' }}</td>
<td><span class="badge {{ $m->is_active ? 'badge-green' : 'badge-gray' }}">{{ $m->is_active ? 'Active' : 'Hidden' }}</span></td>
<td>@if($m->slug)<div style="display:flex;gap:6px;flex-wrap:wrap"><a href="{{ route('digital-card.show',$m->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="View card"><i class="fas fa-id-card"></i></a><a href="{{ route('digital-card.pdf',$m->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="Download PDF"><i class="fas fa-file-pdf"></i></a><button type="button" class="btn btn-secondary btn-sm qr-open-btn" title="Preview QR" data-qr-url="{{ route('digital-card.qr.png',$m->slug) }}" data-qr-label="{{ e($m->name) }}"><i class="fas fa-qrcode"></i></button></div>@else<span style="color:#94a3b8;font-size:12px">Save to generate</span>@endif</td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.team.edit',$m) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.team.destroy',$m) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div><div style="padding:16px">{{ $members->links() }}</div></div>

<div id="qrPreviewModal" class="qr-modal" aria-hidden="true" role="dialog" aria-labelledby="qrModalTitle">
    <div class="qr-modal__backdrop"></div>
    <div class="qr-modal__panel">
        <button type="button" class="qr-modal__close" aria-label="Close QR preview">×</button>
        <div class="qr-modal__header">
            <div>
                <div class="qr-modal__eyebrow">QR Code Preview</div>
                <h2 id="qrModalTitle" class="qr-modal__title">Team Member QR</h2>
            </div>
            <span class="qr-modal__subtitle">Scan to open the digital card instantly</span>
        </div>
        <div class="qr-modal__body">
            <img id="qrPreviewImage" class="qr-modal__image" src="" alt="QR code preview">
            <div class="qr-modal__meta"><span id="qrPreviewName"></span></div>
        </div>
        <div class="qr-modal__actions">
            <a id="qrDownloadLink" class="btn btn-primary btn-sm" download="qr-code.png">Download PNG</a>
            <a id="qrOpenLink" class="btn btn-secondary btn-sm" target="_blank" rel="noopener">Open in new tab</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('qrPreviewModal');
        const image = document.getElementById('qrPreviewImage');
        const title = document.getElementById('qrPreviewName');
        const downloadLink = document.getElementById('qrDownloadLink');
        const openLink = document.getElementById('qrOpenLink');
        const closeBtn = modal.querySelector('.qr-modal__close');
        const backdrop = modal.querySelector('.qr-modal__backdrop');

        const openModal = (url, label) => {
            image.src = url;
            title.textContent = label ? label : 'Digital card QR';
            downloadLink.href = url;
            openLink.href = url;
            modal.setAttribute('aria-hidden', 'false');
            modal.classList.add('qr-modal--open');
        };

        const closeModal = () => {
            modal.setAttribute('aria-hidden', 'true');
            modal.classList.remove('qr-modal--open');
            image.src = '';
        };

        document.querySelectorAll('.qr-open-btn').forEach((button) => {
            button.addEventListener('click', function () {
                openModal(this.dataset.qrUrl, this.dataset.qrLabel || 'QR Code');
            });
        });

        closeBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal);
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && modal.classList.contains('qr-modal--open')) {
                closeModal();
            }
        });
    });
</script>
<style>
    .qr-modal { display: none; position: fixed; inset: 0; z-index: 9999; align-items: center; justify-content: center; padding: 24px; }
    .qr-modal--open { display: flex; }
    .qr-modal__backdrop { position: absolute; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(8px); }
    .qr-modal__panel { position: relative; background: #ffffff; border-radius: 20px; max-width: 520px; width: min(100%, 520px); padding: 24px; box-shadow: 0 30px 80px rgba(15, 23, 42, 0.16); border: 1px solid rgba(15,23,42,.08); }
    .qr-modal__close { position: absolute; top: 16px; right: 16px; width: 36px; height: 36px; border: none; border-radius: 50%; background: rgba(15, 23, 42, 0.08); color: #0f172a; font-size: 20px; line-height: 1; cursor: pointer; }
    .qr-modal__header { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
    .qr-modal__eyebrow { font-size: 11px; letter-spacing: 1px; text-transform: uppercase; color: #3b82f6; font-weight: 700; }
    .qr-modal__title { font-size: 20px; margin: 0; color: #111827; }
    .qr-modal__subtitle { font-size: 13px; color: #64748b; }
    .qr-modal__body { display: grid; place-items: center; padding: 14px 0; }
    .qr-modal__image { width: min(260px, 100%); height: auto; border-radius: 18px; background: #f8fafc; padding: 16px; border: 1px solid rgba(15,23,42,.08); }
    .qr-modal__meta { margin-top: 14px; color: #334155; font-size: 14px; text-align: center; }
    .qr-modal__actions { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; margin-top: 16px; }
    .qr-modal__actions .btn { min-width: 140px; }
</style>
@endsection


