@extends('admin.layouts.app')
@section('title','Footer Settings')
@section('breadcrumb')<span>></span><a href="{{ route('admin.settings.index') }}" style="color:#94a3b8;text-decoration:none">Settings</a><span>></span><span class="current">Footer</span>@endsection
@section('content')
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
    <div>
        <h1 class="page-title" style="margin:0 0 4px 0">Footer Settings & Navigation</h1>
        <p style="margin:0;font-size:13px;color:var(--text-muted)">Manage footer columns, active sections, quick links, policies, and company links.</p>
    </div>
    <div style="display:flex;gap:10px">
        <form action="{{ route('admin.settings.menu-items.reset', 'footer') }}" method="POST" onsubmit="return confirm('Reset footer links to standard defaults?');">
            @csrf
            <button type="submit" class="btn btn-secondary btn-sm" title="Restore standard default footer links">
                <i class="fas fa-undo"></i> Reset to Defaults
            </button>
        </form>
        <button type="button" class="btn btn-primary btn-sm" onclick="openAddFooterModal()">
            <i class="fas fa-plus"></i> Add Footer Link
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

<!-- 1. Footer Links Section (Full CRUD) -->
<div class="card" style="margin-bottom:24px;border-radius:14px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.03)">
    <div class="card-header" style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;flex-wrap:wrap;gap:12px">
        <div>
            <h3 class="card-title" style="margin:0 0 4px 0;font-size:16px">Footer Column Links</h3>
            <p style="margin:0;font-size:12px;color:var(--text-muted)">Manage and toggle footer links for Company and Policies columns. Services are dynamically listed from the Services Module.</p>
        </div>
        <div style="display:flex;gap:6px" id="footerFilterPills">
            <button type="button" class="btn btn-sm btn-primary active-pill" onclick="filterFooterSection('all', this)" style="border-radius:999px;font-size:12px;padding:4px 12px">All ({{ $menuItems->count() }})</button>
            <button type="button" class="btn btn-sm btn-secondary" onclick="filterFooterSection('company', this)" style="border-radius:999px;font-size:12px;padding:4px 12px">Company ({{ $menuItems->where('section', 'company')->count() }})</button>
            <button type="button" class="btn btn-sm btn-secondary" onclick="filterFooterSection('policies', this)" style="border-radius:999px;font-size:12px;padding:4px 12px">Policies ({{ $menuItems->where('section', 'policies')->count() }})</button>
        </div>
    </div>
    <div class="card-body" style="padding:0">
        <div class="table-responsive">
            <table class="table" style="width:100%;margin:0;border-collapse:collapse">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:1px solid var(--border);text-align:left">
                        <th style="padding:12px 16px;width:110px;font-size:12px;font-weight:700;color:#64748b">Section</th>
                        <th style="padding:12px 16px;width:70px;font-size:12px;font-weight:700;color:#64748b">Order</th>
                        <th style="padding:12px 16px;font-size:12px;font-weight:700;color:#64748b">Link Title</th>
                        <th style="padding:12px 16px;font-size:12px;font-weight:700;color:#64748b">URL Destination</th>
                        <th style="padding:12px 16px;width:100px;font-size:12px;font-weight:700;color:#64748b">Target</th>
                        <th style="padding:12px 16px;width:130px;font-size:12px;font-weight:700;color:#64748b;text-align:center">Active Status</th>
                        <th style="padding:12px 16px;width:120px;font-size:12px;font-weight:700;color:#64748b;text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody id="footerItemsTableBody">
                    @forelse($menuItems as $item)
                    <tr style="border-bottom:1px solid #f1f5f9;transition:background 0.15s" data-section="{{ $item->section }}" id="row-footer-{{ $item->id }}">
                        <td style="padding:14px 16px">
                            @if($item->section === 'services')
                                <span style="background:#fae8ff;color:#86198f;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:700">Services</span>
                            @elseif($item->section === 'company')
                                <span style="background:#e0f2fe;color:#0369a1;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:700">Company</span>
                            @elseif($item->section === 'policies')
                                <span style="background:#fef3c7;color:#92400e;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:700">Policies</span>
                            @else
                                <span style="background:#f1f5f9;color:#475569;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:700">{{ ucfirst($item->section) }}</span>
                            @endif
                        </td>
                        <td style="padding:14px 16px;font-weight:700;color:#64748b;font-size:13px">
                            <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;background:#f1f5f9;border-radius:6px;font-weight:800">{{ $item->sort_order }}</span>
                        </td>
                        <td style="padding:14px 16px;font-weight:700;font-size:14px;color:#1e293b">
                            <div style="display:flex;align-items:center;gap:8px">
                                @if($item->badge_text)
                                    <span style="background:linear-gradient(135deg,#0284c7,#06b6d4);color:white;padding:1px 6px;border-radius:999px;font-size:9.5px;font-weight:800">{{ $item->badge_text }}</span>
                                @endif
                                <span>{{ $item->title }}</span>
                            </div>
                        </td>
                        <td style="padding:14px 16px;font-family:monospace;font-size:12px;color:#0284c7">
                            {{ $item->url ?: '#' }}
                        </td>
                        <td style="padding:14px 16px;font-size:12px;color:#64748b">
                            <code>{{ $item->target }}</code>
                        </td>
                        <td style="padding:14px 16px;text-align:center">
                            <button type="button" 
                                    class="toggle-badge-btn" 
                                    onclick="toggleFooterItemStatus({{ $item->id }}, this)"
                                    title="Click to toggle Active / Inactive"
                                    style="border:none;background:none;cursor:pointer;padding:0">
                                <span style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:999px;font-size:11.5px;font-weight:700;transition:all 0.2s;{{ $item->is_active ? 'background:#dcfce7;color:#15803d;border:1px solid #bbf7d0' : 'background:#fee2e2;color:#b91c1c;border:1px solid #fecaca' }}">
                                    <span style="width:7px;height:7px;border-radius:50%;background:{{ $item->is_active ? '#22c55e' : '#ef4444' }}"></span>
                                    <span>{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                                </span>
                            </button>
                        </td>
                        <td style="padding:14px 16px;text-align:right;white-space:nowrap">
                            <button type="button" class="btn btn-sm btn-secondary" style="padding:5px 9px" onclick='openEditFooterModal(@json($item))' title="Edit Link">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.settings.menu-items.destroy', $item) }}" method="POST" style="display:inline-block;margin:0" onsubmit="return confirm('Delete footer link \'{{ $item->title }}\'?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="padding:5px 9px;background:#ef4444;color:white;border:none;border-radius:6px" title="Delete Link">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:32px;color:var(--text-muted)">
                            No footer links configured. Click <strong>Reset to Defaults</strong> above or <strong>Add Footer Link</strong>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 2. Footer General Settings & Column Toggles Form -->
<form class="single-card-form" action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
        <!-- Footer Column Toggles & Titles -->
        <div class="card" style="border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,0.03)">
            <div class="card-header"><h3 class="card-title">Footer Columns & Section Toggles</h3></div>
            <div class="card-body">
                <!-- Column 1: Services -->
                <div style="padding:12px 0;border-bottom:1px solid #f1f5f9">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px">
                        <div>
                            <div style="font-weight:700;font-size:14px;color:#1e293b">Column 1: Services List</div>
                            <div style="font-size:12px;color:var(--text-muted)">Displays active services from Services Module automatically</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="hidden" name="footer_services_enabled" value="0">
                            <input type="checkbox" name="footer_services_enabled" value="1" {{ $get('footer_services_enabled', 1) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <input type="text" name="footer_services_title" class="form-control form-control-sm" value="{{ $get('footer_services_title', 'Our Services') }}" placeholder="Column Title">
                    <div style="margin-top:6px;font-size:12px;color:#0284c7">
                        <i class="fas fa-info-circle"></i> Services are managed in <a href="{{ route('admin.services.index') }}" style="color:#0284c7;font-weight:600;text-decoration:underline">Services Module</a>.
                    </div>
                </div>

                <!-- Column 2: Company -->
                <div style="padding:12px 0;border-bottom:1px solid #f1f5f9">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px">
                        <div>
                            <div style="font-weight:700;font-size:14px;color:#1e293b">Column 2: Company Links</div>
                            <div style="font-size:12px;color:var(--text-muted)">Enable/disable the Company links column</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="hidden" name="footer_company_enabled" value="0">
                            <input type="checkbox" name="footer_company_enabled" value="1" {{ $get('footer_company_enabled', 1) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <input type="text" name="footer_company_title" class="form-control form-control-sm" value="{{ $get('footer_company_title', 'Company') }}" placeholder="Column Title">
                </div>

                <!-- Column 3: Policies -->
                <div style="padding:12px 0;border-bottom:1px solid #f1f5f9">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px">
                        <div>
                            <div style="font-weight:700;font-size:14px;color:#1e293b">Column 3: Policies & Legal</div>
                            <div style="font-size:12px;color:var(--text-muted)">Enable/disable the Policies column</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="hidden" name="footer_legal_enabled" value="0">
                            <input type="checkbox" name="footer_legal_enabled" value="1" {{ $get('footer_legal_enabled', 1) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <input type="text" name="footer_legal_title" class="form-control form-control-sm" value="{{ $get('footer_legal_title', 'Policies') }}" placeholder="Column Title">
                </div>

                <!-- Column 4: Contact -->
                <div style="padding:12px 0">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px">
                        <div>
                            <div style="font-weight:700;font-size:14px;color:#1e293b">Column 4: Get In Touch (Contact)</div>
                            <div style="font-size:12px;color:var(--text-muted)">Enable/disable the Office contact column</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="hidden" name="footer_contact_enabled" value="0">
                            <input type="checkbox" name="footer_contact_enabled" value="1" {{ $get('footer_contact_enabled', 1) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <input type="text" name="footer_contact_title" class="form-control form-control-sm" value="{{ $get('footer_contact_title', 'Get In Touch') }}" placeholder="Column Title">
                </div>
            </div>
        </div>

        <!-- Footer Brand, About & Newsletter -->
        <div class="card" style="border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,0.03)">
            <div class="card-header"><h3 class="card-title">Footer Brand, Newsletter & Social</h3></div>
            <div class="card-body">
                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #f1f5f9">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">About / Brand Column</div>
                        <div style="font-size:12px;color:var(--text-muted)">Show site logo and company description in footer</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="footer_about_enabled" value="0">
                        <input type="checkbox" name="footer_about_enabled" value="1" {{ $get('footer_about_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="form-group" style="margin-top:12px">
                    <label class="form-label">Footer About Text</label>
                    <textarea name="footer_about" class="form-control" rows="3">{{ $get('footer_about', 'Rescom is your trusted technology partner for digital transformation. We build innovative solutions that drive business growth.') }}</textarea>
                </div>

                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-top:1px solid #f1f5f9;border-bottom:1px solid #f1f5f9">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">Social Media Icons</div>
                        <div style="font-size:12px;color:var(--text-muted)">Show configured social media icons in footer</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="footer_social_enabled" value="0">
                        <input type="checkbox" name="footer_social_enabled" value="1" {{ $get('footer_social_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f1f5f9">
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1e293b">Newsletter Subscribe Box</div>
                        <div style="font-size:12px;color:var(--text-muted)">Show email subscribe form in footer</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="footer_newsletter_enabled" value="0">
                        <input type="checkbox" name="footer_newsletter_enabled" value="1" {{ $get('footer_newsletter_enabled', 1) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="form-group" style="margin-top:12px">
                    <label class="form-label">Newsletter Heading</label>
                    <input type="text" name="footer_newsletter_label" class="form-control" value="{{ $get('footer_newsletter_label', 'Subscribe to our newsletter') }}" placeholder="e.g. Subscribe to our newsletter">
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions" style="margin-top:20px;display:flex;justify-content:flex-end">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Footer Settings</button>
    </div>
</form>

<!-- Modal: Add Footer Item -->
<div id="addFooterModal" class="custom-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(15,23,42,0.6);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
    <div style="background:white;width:100%;max-width:540px;border-radius:16px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);overflow:hidden;animation:modalIn 0.2s ease">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid #e2e8f0;background:#f8fafc">
            <h3 style="margin:0;font-size:16px;font-weight:800;color:#0f172a"><i class="fas fa-plus-circle" style="color:var(--primary);margin-right:8px"></i> Add Footer Link</h3>
            <button type="button" onclick="closeAddFooterModal()" style="border:none;background:none;font-size:20px;color:#94a3b8;cursor:pointer">&times;</button>
        </div>
        <form action="{{ route('admin.settings.menu-items.store') }}" method="POST" style="padding:24px">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $footerMenu->id }}">
            <input type="hidden" name="item_type" value="link">

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Footer Section / Column *</label>
                <select name="section" class="form-control" required>
                    <option value="company">Column 2: Company</option>
                    <option value="policies">Column 3: Policies</option>
                    <option value="quick_links">Quick Links / Custom</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Link Title *</label>
                <input type="text" name="title" class="form-control" required placeholder="e.g. About Us, Privacy Policy">
            </div>

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">URL Destination *</label>
                <input type="text" name="url" class="form-control" required placeholder="e.g. /about or /contact or https://...">
            </div>

            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Badge Text (Optional)</label>
                    <input type="text" name="badge_text" class="form-control" placeholder="e.g. Live, New">
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
                <button type="button" class="btn btn-secondary" onclick="closeAddFooterModal()">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Add Link</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Footer Item -->
<div id="editFooterModal" class="custom-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(15,23,42,0.6);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px)">
    <div style="background:white;width:100%;max-width:540px;border-radius:16px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);overflow:hidden;animation:modalIn 0.2s ease">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid #e2e8f0;background:#f8fafc">
            <h3 style="margin:0;font-size:16px;font-weight:800;color:#0f172a"><i class="fas fa-edit" style="color:var(--primary);margin-right:8px"></i> Edit Footer Link</h3>
            <button type="button" onclick="closeEditFooterModal()" style="border:none;background:none;font-size:20px;color:#94a3b8;cursor:pointer">&times;</button>
        </div>
        <form id="editFooterForm" method="POST" style="padding:24px">
            @csrf @method('PUT')
            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Footer Section / Column *</label>
                <select id="editFooterSection" name="section" class="form-control" required>
                    <option value="company">Column 2: Company</option>
                    <option value="policies">Column 3: Policies</option>
                    <option value="quick_links">Quick Links / Custom</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">Link Title *</label>
                <input type="text" id="editFooterTitle" name="title" class="form-control" required>
            </div>

            <div class="form-group" style="margin-bottom:14px">
                <label class="form-label" style="font-weight:700">URL Destination *</label>
                <input type="text" id="editFooterUrl" name="url" class="form-control" required>
            </div>

            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Badge Text (Optional)</label>
                    <input type="text" id="editFooterBadgeText" name="badge_text" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Open In Target</label>
                    <select id="editFooterTarget" name="target" class="form-control">
                        <option value="_self">Same Tab (_self)</option>
                        <option value="_blank">New Tab (_blank)</option>
                    </select>
                </div>
            </div>

            <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700">Sort Order</label>
                    <input type="number" id="editFooterSortOrder" name="sort_order" class="form-control">
                </div>
                <div class="form-group" style="display:flex;align-items:center;margin-top:28px">
                    <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-weight:700;font-size:13.5px">
                        <input type="checkbox" id="editFooterIsActive" name="is_active" value="1" style="width:18px;height:18px">
                        <span>Active</span>
                    </label>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;border-top:1px solid #e2e8f0;padding-top:16px">
                <button type="button" class="btn btn-secondary" onclick="closeEditFooterModal()">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Link</button>
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
function openAddFooterModal() {
    document.getElementById('addFooterModal').style.display = 'flex';
}
function closeAddFooterModal() {
    document.getElementById('addFooterModal').style.display = 'none';
}
function openEditFooterModal(item) {
    document.getElementById('editFooterForm').action = "{{ url('admin/settings/menu-items') }}/" + item.id;
    document.getElementById('editFooterSection').value = item.section || 'services';
    document.getElementById('editFooterTitle').value = item.title || '';
    document.getElementById('editFooterUrl').value = item.url || '';
    document.getElementById('editFooterBadgeText').value = item.badge_text || '';
    document.getElementById('editFooterTarget').value = item.target || '_self';
    document.getElementById('editFooterSortOrder').value = item.sort_order || 0;
    document.getElementById('editFooterIsActive').checked = !!item.is_active;

    document.getElementById('editFooterModal').style.display = 'flex';
}
function closeEditFooterModal() {
    document.getElementById('editFooterModal').style.display = 'none';
}

function filterFooterSection(section, btn) {
    document.querySelectorAll('#footerFilterPills button').forEach(b => {
        b.classList.remove('btn-primary');
        b.classList.add('btn-secondary');
    });
    btn.classList.remove('btn-secondary');
    btn.classList.add('btn-primary');

    const rows = document.querySelectorAll('#footerItemsTableBody tr[data-section]');
    rows.forEach(r => {
        if (section === 'all' || r.getAttribute('data-section') === section) {
            r.style.display = '';
        } else {
            r.style.display = 'none';
        }
    });
}

function toggleFooterItemStatus(itemId, btn) {
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
