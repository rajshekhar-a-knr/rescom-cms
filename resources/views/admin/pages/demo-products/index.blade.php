@extends('admin.layouts.app')

@section('title','Demo Products')
@section('breadcrumb')<span>></span><span class="current">Demo Products</span>@endsection

@section('head')
<style>
    .demo-requests-modal {
        position: fixed;
        inset: 0;
        z-index: 500;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .demo-requests-modal.open {
        display: flex;
    }

    .demo-requests-modal__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.56);
        backdrop-filter: blur(4px);
    }

    .demo-requests-modal__panel {
        position: relative;
        width: min(1180px, 100%);
        max-height: min(760px, calc(100vh - 48px));
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: 0 24px 80px rgba(15, 23, 42, 0.24);
        overflow: hidden;
    }

    .demo-requests-modal__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 18px;
        border-bottom: 1px solid var(--border);
    }

    .demo-requests-modal__body {
        overflow: auto;
    }

    .demo-requests-modal__close {
        width: 36px;
        height: 36px;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: #ffffff;
        color: var(--text);
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Demo Products</h1>
        <div class="page-subtitle">Manage product cards and the credentials sent from the Request Demo page.</div>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
        <button type="button" class="btn btn-secondary" id="openDemoRequests">
            <i class="fas fa-users"></i> Demo Requests
        </button>
        <a href="{{ route('admin.demo-products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Demo Product</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Demo Products</h3>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Requests</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px">
                                @if($product->image)
                                    <img src="{{ media_url($product->image) }}" style="width:52px;height:38px;object-fit:cover;border-radius:6px" alt="{{ $product->title }}">
                                @else
                                    <div style="width:52px;height:38px;background:#eff6ff;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#2563eb"><i class="fas fa-cube"></i></div>
                                @endif
                                <div>
                                    <div style="font-weight:700">{{ Str::limit($product->title, 44) }}</div>
                                    @if($product->demo_url)
                                        <div style="font-size:12px;color:#64748b">{{ Str::limit($product->demo_url, 54) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-blue">{{ $product->category ?: 'General' }}</span></td>
                        <td><span class="badge badge-gray">{{ $product->requests_count }}</span></td>
                        <td><span class="badge badge-blue" style="font-weight:700">{{ $product->sort_order }}</span></td>
                        <td><span class="badge {{ $product->is_active ? 'badge-green' : 'badge-gray' }}">{{ $product->is_active ? 'Active' : 'Hidden' }}</span></td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.demo-products.edit', $product) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                                <form class="single-card-form" action="{{ route('admin.demo-products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-confirm="Delete this demo product?"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:28px;color:#64748b">No demo products added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $products->links() }}</div>
</div>

<div class="demo-requests-modal" id="demoRequestsModal" aria-hidden="true">
    <div class="demo-requests-modal__backdrop" data-demo-requests-close></div>
    <div class="demo-requests-modal__panel" role="dialog" aria-modal="true" aria-labelledby="demoRequestsTitle">
        <div class="demo-requests-modal__header">
            <div>
                <h3 class="card-title" id="demoRequestsTitle">Demo Requests</h3>
                <div class="card-subtitle">Latest users who requested demo credentials.</div>
            </div>
            <button type="button" class="demo-requests-modal__close" data-demo-requests-close aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="demo-requests-modal__body">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Organization</th>
                            <th>Product</th>
                            <th>Requested</th>
                            <th>Email Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demoRequests as $demoRequest)
                            <tr>
                                <td style="font-weight:700">{{ $demoRequest->full_name ?: 'Not captured' }}</td>
                                <td>
                                    <a href="mailto:{{ $demoRequest->email }}" style="color:#2563eb;text-decoration:none">{{ $demoRequest->email }}</a>
                                </td>
                                <td>
                                    @if($demoRequest->phone)
                                        <a href="tel:{{ $demoRequest->phone }}" style="color:#0f172a;text-decoration:none">{{ $demoRequest->phone }}</a>
                                    @else
                                        <span style="color:#94a3b8">Not captured</span>
                                    @endif
                                </td>
                                <td>{{ $demoRequest->organization ?: 'Not captured' }}</td>
                                <td>{{ $demoRequest->product?->title ?: 'Deleted product' }}</td>
                                <td style="font-size:12px;color:#64748b">{{ $demoRequest->created_at?->format('M d, Y h:i A') }}</td>
                                <td>
                                    <span class="badge {{ $demoRequest->sent_at ? 'badge-green' : 'badge-gray' }}">
                                        {{ $demoRequest->sent_at ? 'Sent' : 'Logged' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center;padding:28px;color:#64748b">No demo requests yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('demoRequestsModal');
    const openButton = document.getElementById('openDemoRequests');
    if (!modal || !openButton) return;

    const openModal = () => {
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    openButton.addEventListener('click', openModal);
    modal.querySelectorAll('[data-demo-requests-close]').forEach((button) => {
        button.addEventListener('click', closeModal);
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal.classList.contains('open')) {
            closeModal();
        }
    });
});
</script>
@endsection
