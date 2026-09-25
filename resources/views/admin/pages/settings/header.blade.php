@extends('admin.layouts.app')
@section('title','Header Settings')
@section('breadcrumb')<span>></span><a href="{{ route('admin.settings.index') }}" style="color:#94a3b8;text-decoration:none">Settings</a><span>></span><span class="current">Header</span>@endsection
@section('content')
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
    <div>
        <h1 class="page-title" style="margin:0 0 4px 0">Header Settings & Navigation</h1>
        <p style="margin:0;font-size:13px;color:var(--text-muted)">Manage the main navigation tabs, dropdowns, header buttons, and active status.</p>
    </div>
    <div style="display:flex;gap:10px">
        <form action="{{ route('admin.settings.menu-items.reset', 'header') }}" method="POST" onsubmit="return confirm('Reset header navigation to standard defaults?');">
            @csrf
            <button type="submit" class="btn btn-secondary btn-sm" title="Restore standard default navigation tabs">
                <i class="fas fa-undo"></i> Reset to Defaults
            </button>
        </form>
        <button type="button" class="btn btn-primary btn-sm" onclick="openAddHeaderModal()">
            <i class="fas fa-plus"></i> Add Header Tab
        </button>
    </div>
</div>

<div style="display:flex;gap:0;margin-bottom:24px;border-bottom:2px solid var(--border);overflow-x:auto">
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

@if(session('success'))
<div style="background:#ecfdf5;border:1px solid #10b981;color:#065f46;padding:12px 16px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px">
    <i class="fas fa-check-circle" style="color:#10b981;font-size:16px"></i>
    <span style="font-size:14px;font-weight:600">{{ session('success') }}</span>
</div>
@endif

@php
    $get = function ($key, $default = '') use ($settings) {
        if (function_exists('setting')) {
            return old($key, $settings[$key]->value ?? setting($key, $default));
        }
        return old($key, $settings[$key]->value ?? $default);
    };
@endphp

<!-- 1. Header Navigation Tabs Table (Full CRUD) -->
<div class="card" style="margin-bottom:24px;border-radius:14px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.03)">
    <div class="card-header" style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px">
        <div>
            <h3 class="card-title" style="margin:0 0 4px 0;font-size:16px">Navigation Tabs & Links</h3>
            <p style="margin:0;font-size:12px;color:var(--text-muted)">Toggle Active / Inactive to show or hide tabs on both desktop navbar and mobile menu in real-time.</p>
        </div>
        <span class="badge" style="background:rgba(15,76,129,0.1);color:var(--primary);padding:6px 12px;border-radius:999px;font-weight:700;font-size:12px">
            {{ $menuItems->count() }} Total Tabs ({{ $menuItems->where('is_active', 1)->count() }} Active)
        </span>
    </div>
    <div class="card-body" style="padding:0">
        <div class="table-responsive">
            <table class="table" style="width:100%;margin:0;border-collapse:collapse">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:1px solid var(--border);text-align:left">
                        <th style="padding:12px 16px;width:70px;font-size:12px;font-weight:700;color:#64748b">Order</th>
                        <th style="padding:12px 16px;font-size:12px;font-weight:700;color:#64748b">Tab Title</th>
                        <th style="padding:12px 16px;font-size:12px;font-weight:700;color:#64748b">Type & Destination</th>
                        <th style="padding:12px 16px;width:100px;font-size:12px;font-weight:700;color:#64748b">Badge</th>
                        <th style="padding:12px 16px;width:110px;font-size:12px;font-weight:700;color:#64748b">Target</th>
                        <th style="padding:12px 16px;width:130px;font-size:12px;font-weight:700;color:#64748b;text-align:center">Active Status</th>
                        <th style="padding:12px 16px;width:120px;font-size:12px;font-weight:700;color:#64748b;text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody id="headerItemsTableBody">
                    @forelse($menuItems as $item)
                    <tr style="border-bottom:1px solid #f1f5f9;transition:background 0.15s" id="row-item-{{ $item->id }}">
                        <td style="padding:14px 16px;font-weight:700;color:#64748b;font-size:13px">
                            <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;background:#f1f5f9;border-radius:6px;font-weight:800">{{ $item->sort_order }}</span>
                        </td>
                        <td style="padding:14px 16px;font-weight:700;font-size:14px;color:#1e293b">
                            <div style="display:flex;align-items:center;gap:8px">
                                @if($item->icon) <i class="{{ $item->icon }}" style="color:#0284c7"></i> @endif
                                <span>{{ $item->title }}</span>
                            </div>
                        </td>
                        <td style="padding:14px 16px;font-size:13px">
                            @if($item->item_type === 'dropdown_products')
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#e0f2fe;color:#0369a1;padding:3px 8px;border-radius:6px;font-weight:700;font-size:11px">
                                    <i class="fas fa-layer-group"></i> Products Mega-Dropdown
                                </span>
                            @elseif($item->item_type === 'dropdown_services')
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#fae8ff;color:#86198f;padding:3px 8px;border-radius:6px;font-weight:700;font-size:11px">
                                    <i class="fas fa-cogs"></i> Services Mega-Dropdown
                                </span>
                            @elseif($item->item_type === 'dropdown_resources')
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#fef3c7;color:#92400e;padding:3px 8px;border-radius:6px;font-weight:700;font-size:11px">
                                    <i class="fas fa-folder-open"></i> Resources Dropdown
                                </span>
                            @elseif($item->item_type === 'presentation')
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#ecfdf5;color:#047857;padding:3px 8px;border-radius:6px;font-weight:700;font-size:11px">
                                    <i class="fas fa-desktop"></i> Interactive Presentation
                                </span>
                            @else
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#f1f5f9;color:#475569;padding:3px 8px;border-radius:6px;font-weight:600;font-size:11px">
                                    <i class="fas fa-link"></i> Link
                                </span>
                            @endif
                            <div style="font-family:monospace;font-size:11.5px;color:#64748b;margin-top:3px">{{ $item->url ?: '#' }}</div>
                        </td>
                        <td style="padding:14px 16px;font-size:12px">
                            @if($item->badge_text)
                                <span style="background:linear-gradient(135deg,#0284c7,#06b6d4);color:white;padding:2px 8px;border-radius:999px;font-size:10.5px;font-weight:800">{{ $item->badge_text }}</span>
                            @else
                                <span style="color:#cbd5e1">—</span>
                            @endif
                        </td>
                        <td style="padding:14px 16px;font-size:12px;color:#64748b">
                            <code>{{ $item->target }}</code>
                        </td>
                        <td style="padding:14px 16px;text-align:center">
                            <button type="button" 
                                    class="toggle-badge-btn {{ $item->is_active ? 'active' : 'inactive' }}" 
                                    onclick="toggleItemStatus({{ $item->id }}, this)"
                                    title="Click to toggle Active / Inactive"
                                    style="border:none;background:none;cursor:pointer;padding:0">
                                <span style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:999px;font-size:11.5px;font-weight:700;transition:all 0.2s;{{ $item->is_active ? 'background:#dcfce7;color:#15803d;border:1px solid #bbf7d0' : 'background:#fee2e2;color:#b91c1c;border:1px solid #fecaca' }}">
                                    <span style="width:7px;height:7px;border-radius:50%;background:{{ $item->is_active ? '#22c55e' : '#ef4444' }}"></span>
                                    <span>{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                                </span>
                            </button>
                        </td>
                        <td style="padding:14px 16px;text-align:right;white-space:nowrap">
                            <button type="button" class="btn btn-sm btn-secondary" style="padding:5px 9px" onclick='openEditHeaderModal(@json($item))' title="Edit Tab">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.settings.menu-items.destroy', $item) }}" method="POST" style="display:inline-block;margin:0" onsubmit="return confirm('Delete tab \'{{ $item->title }}\'?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="padding:5px 9px;background:#ef4444;color:white;border:none;border-radius:6px" title="Delete Tab">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:32px;color:var(--text-muted)">
                            No header tabs configured. Click <strong>Reset to Defaults</strong> above or <strong>Add Header Tab</strong>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 2. Header Layout & Action Buttons Form -->
<form class="single-card-form" action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <!-- Header Features & Toggles -->
        <div class="card" style="border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,0.03)">
            <div class="card-header"><h3 class="card-title">Header Feature Toggles</h3></div>
            <div class="card-body">
                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">Main Navigation Menu</div>
                        <div style="font-size:12px;color:var(--text-muted)">Enable/disable the entire navbar menu tabs</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="header_menu_enabled" value="0">
                        <input type="checkbox" name="header_menu_enabled" value="1" {{ $get('header_menu_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">Top Announcement Bar</div>
                        <div style="font-size:12px;color:var(--text-muted)">Show scrolling top announcement bar</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="topbar_enabled" value="0">
                        <input type="checkbox" name="topbar_enabled" value="1" {{ $get('topbar_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">Search Icon & Popup</div>
                        <div style="font-size:12px;color:var(--text-muted)">Show live interactive search in the header</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="header_search_enabled" value="0">
                        <input type="checkbox" name="header_search_enabled" value="1" {{ $get('header_search_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding:10px 0">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">Interactive Presentation Button</div>
                        <div style="font-size:12px;color:var(--text-muted)">Show futuristic presentation launcher button in header</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="header_presentation_enabled" value="0">
                        <input type="checkbox" name="header_presentation_enabled" value="1" {{ $get('header_presentation_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Header CTA Button Settings -->
        <div class="card" style="border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,0.03)">
            <div class="card-header"><h3 class="card-title">Header Action & CTA Button</h3></div>
            <div class="card-body">
                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding-bottom:12px;border-bottom:1px solid #f1f5f9">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">Primary CTA Button</div>
                        <div style="font-size:12px;color:var(--text-muted)">Display prominent call-to-action button (e.g. Request Demo)</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="header_cta_enabled" value="0">
                        <input type="checkbox" name="header_cta_enabled" value="1" {{ $get('header_cta_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="form-group" style="margin-top:14px">
                    <label class="form-label">CTA Button Text</label>
                    <input type="text" name="header_cta_text" class="form-control" value="{{ $get('header_cta_text', 'Request Demo') }}" placeholder="e.g. Request Demo">
                </div>

                <div class="form-group">
                    <label class="form-label">CTA Button URL / Route</label>
                    <input type="text" name="header_cta_url" class="form-control" value="{{ $get('header_cta_url', '/request-demo') }}" placeholder="e.g. /request-demo or /contact">
                </div>

                <div class="form-group">
                    <label class="form-label">Presentation Button Label</label>
                    <input type="text" name="header_presentation_text" class="form-control" value="{{ $get('header_presentation_text', 'Presentation') }}" placeholder="e.g. Presentation">
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions" style="margin-top:20px;display:flex;justify-content:flex-end">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Header Settings</button>
    </div>
</form>

<!-- Modal: Add Header Item -->
<div id="addHeaderModal" class="custom-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(15,23,42,0.6);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
    <div style="background:white;width:100%;max-width:540px;border-radius:16px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);overflow:hidden;animation:modalIn 0.2s ease">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid #e2e8f0;background:#f8fafc">
            <h3 style="margin:0;font-size:16px;font-weight:800;color:#0f172a"><i class="fas fa-plus-circle" style="color:var(--primary);margin-right:8px"></i> Add Header Tab</h3>
            <button type="button" onclick="closeAddHeaderModal()" style="border:none;background:none;font-size:20px;color:#94a3b8;cursor:pointer">&times;</button>
        </div>
        <form action="{{ route('admin.settings.menu-items.store') }}" method="POST" style="padding:24px">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $headerMenu->id }}">
            <input type="hidden" name="section" value="main">

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Tab Title *</label>
                <input type="text" name="title" class="form-control" required placeholder="e.g. About, Services, Products, Contact">
            </div>

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Tab Type</label>
                <select name="item_type" class="form-control" onchange="handleTypeChange(this, 'add')">
                    <option value="link">Standard Page Link</option>
                    <option value="dropdown_products">Products Mega-Dropdown (Dynamic)</option>
                    <option value="dropdown_services">Services Mega-Dropdown (Dynamic)</option>
                    <option value="dropdown_resources">Resources Dropdown (Internship, Events, Blogs, FAQs)</option>
                    <option value="presentation">Corporate Interactive Presentation</option>
                    <option value="custom">Custom URL</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom:14px" id="addUrlGroup">
                <label class="form-label" style="font-weight:700">URL / Path</label>
                <input type="text" name="url" class="form-control" placeholder="e.g. /about or /services or https://example.com">
                <small style="color:#64748b">Use relative paths (e.g. /about) or full URLs.</small>
            </div>

            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Badge Text (Optional)</label>
                    <input type="text" name="badge_text" class="form-control" placeholder="e.g. Live, New, Hot">
                </div>
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Open In Target</label>
                    <select name="target" class="form-control">
                        <option value="_self">Same Tab (_self)</option>
                        <option value="_blank">New Tab (_blank)</option>
                    </select>
                </div>
            </div>

            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ ($menuItems->max('sort_order') ?? 0) + 1 }}">
                </div>
                <div class="form-group" style="display:flex;align-items:center;margin-top:28px">
                    <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-weight:700;font-size:13.5px">
                        <input type="checkbox" name="is_active" value="1" checked style="width:18px;height:18px">
                        <span>Active by default</span>
                    </label>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;border-top:1px solid #e2e8f0;padding-top:16px">
                <button type="button" class="btn btn-secondary" onclick="closeAddHeaderModal()">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Tab</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Header Item -->
<div id="editHeaderModal" class="custom-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(15,23,42,0.6);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
    <div style="background:white;width:100%;max-width:540px;border-radius:16px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);overflow:hidden;animation:modalIn 0.2s ease">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid #e2e8f0;background:#f8fafc">
            <h3 style="margin:0;font-size:16px;font-weight:800;color:#0f172a"><i class="fas fa-edit" style="color:var(--primary);margin-right:8px"></i> Edit Header Tab</h3>
            <button type="button" onclick="closeEditHeaderModal()" style="border:none;background:none;font-size:20px;color:#94a3b8;cursor:pointer">&times;</button>
        </div>
        <form id="editHeaderForm" method="POST" style="padding:24px">
            @csrf @method('PUT')
            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Tab Title *</label>
                <input type="text" id="editTitle" name="title" class="form-control" required>
            </div>

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Tab Type</label>
                <select id="editItemType" name="item_type" class="form-control" onchange="handleTypeChange(this, 'edit')">
                    <option value="link">Standard Page Link</option>
                    <option value="dropdown_products">Products Mega-Dropdown (Dynamic)</option>
                    <option value="dropdown_services">Services Mega-Dropdown (Dynamic)</option>
                    <option value="dropdown_resources">Resources Dropdown (Internship, Events, Blogs, FAQs)</option>
                    <option value="presentation">Corporate Interactive Presentation</option>
                    <option value="custom">Custom URL</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom:14px" id="editUrlGroup">
                <label class="form-label" style="font-weight:700">URL / Path</label>
                <input type="text" id="editUrl" name="url" class="form-control">
            </div>

            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Badge Text (Optional)</label>
                    <input type="text" id="editBadgeText" name="badge_text" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Open In Target</label>
                    <select id="editTarget" name="target" class="form-control">
                        <option value="_self">Same Tab (_self)</option>
                        <option value="_blank">New Tab (_blank)</option>
                    </select>
                </div>
            </div>

            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Sort Order</label>
                    <input type="number" id="editSortOrder" name="sort_order" class="form-control">
                </div>
                <div class="form-group" style="display:flex;align-items:center;margin-top:28px">
                    <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-weight:700;font-size:13.5px">
                        <input type="checkbox" id="editIsActive" name="is_active" value="1" style="width:18px;height:18px">
                        <span>Active</span>
                    </label>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;border-top:1px solid #e2e8f0;padding-top:16px">
                <button type="button" class="btn btn-secondary" onclick="closeEditHeaderModal()">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Tab</button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes modalIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>

<script>
function openAddHeaderModal() {
    document.getElementById('addHeaderModal').style.display = 'flex';
}
function closeAddHeaderModal() {
    document.getElementById('addHeaderModal').style.display = 'none';
}
function openEditHeaderModal(item) {
    document.getElementById('editHeaderForm').action = "{{ url('admin/settings/menu-items') }}/" + item.id;
    document.getElementById('editTitle').value = item.title || '';
    document.getElementById('editItemType').value = item.item_type || 'link';
    document.getElementById('editUrl').value = item.url || '';
    document.getElementById('editBadgeText').value = item.badge_text || '';
    document.getElementById('editTarget').value = item.target || '_self';
    document.getElementById('editSortOrder').value = item.sort_order || 0;
    document.getElementById('editIsActive').checked = !!item.is_active;

    document.getElementById('editHeaderModal').style.display = 'flex';
}
function closeEditHeaderModal() {
    document.getElementById('editHeaderModal').style.display = 'none';
}

function handleTypeChange(select, prefix) {
    const val = select.value;
    const urlInput = prefix === 'add' ? document.querySelector('#addUrlGroup input') : document.getElementById('editUrl');
    if (val === 'dropdown_products') {
        if (!urlInput.value || urlInput.value === '#') urlInput.value = '/portfolio';
    } else if (val === 'dropdown_services') {
        if (!urlInput.value || urlInput.value === '#') urlInput.value = '/services';
    } else if (val === 'dropdown_resources') {
        urlInput.value = '#';
    } else if (val === 'presentation') {
        urlInput.value = '/presentations/rescom-presentation';
    }
}

function toggleItemStatus(itemId, btn) {
    btn.disabled = true;
    fetch("{{ url('admin/settings/menu-items') }}/" + itemId + "/toggle", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        btn.disabled = false;
        if (data.success) {
            const isActive = data.is_active;
            const span = btn.querySelector('span');
            if (isActive) {
                span.style.background = '#dcfce7';
                span.style.color = '#15803d';
                span.style.border = '1px solid #bbf7d0';
                span.querySelector('span:first-child').style.background = '#22c55e';
                span.querySelector('span:last-child').textContent = 'Active';
            } else {
                span.style.background = '#fee2e2';
                span.style.color = '#b91c1c';
                span.style.border = '1px solid #fecaca';
                span.querySelector('span:first-child').style.background = '#ef4444';
                span.querySelector('span:last-child').textContent = 'Inactive';
            }
        }
    })
    .catch(err => {
        btn.disabled = false;
        console.error(err);
        alert('Failed to toggle status.');
    });
}
</script>
@endsection
