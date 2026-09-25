@extends('admin.layouts.app')
@section('title','User Rights')
@section('breadcrumb')<span>></span><span class="current">User Rights</span>@endsection
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">User Rights Management</h1>
        <div class="page-subtitle">Assign view / add / edit / delete permissions per user.</div>
    </div>
</div>

<style>
    .permissions-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 16px;
        align-items: start;
    }
    .permissions-card { min-width: 0; }
    .bulk-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 6px 10px 14px;
    }
    .bulk-actions .btn { white-space: nowrap; }
    .table-container { overflow-x: auto; }
    .table-container table th,
    .table-container table td {
        white-space: nowrap;
    }
    .module-access-toggle {
        display: inline-flex;
        align-items: center;
        margin-right: 8px;
    }
    @media (max-width: 1024px) {
        .permissions-layout { grid-template-columns: 1fr; }
        .permissions-card { width: 100%; }
        .table-container table { min-width: 620px; }
    }
    @media (max-width: 640px) {
        .bulk-actions { gap: 6px; }
        .bulk-actions .btn { padding: 6px 10px; font-size: 12px; }
    }
</style>

<div class="permissions-layout">
    <div class="card">
        <div class="card-body">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px">
                <div style="font-weight:700">Users</div>
                <div style="font-size:12px;color:#94a3b8">{{ $users->count() }} total</div>
            </div>
            <input type="text" id="userSearch" class="form-control" placeholder="Search user..." style="margin-bottom:10px">
            <div id="userList" style="display:flex;flex-direction:column;gap:6px;max-height:520px;overflow:auto">
                @foreach($users as $u)
                    <a href="{{ route('admin.permissions.index', ['user_id' => $u->id]) }}"
                       class="btn {{ $selectedUser && $selectedUser->id === $u->id ? 'btn-primary' : 'btn-secondary' }} user-item"
                       data-name="{{ strtolower($u->name) }} {{ strtolower($u->email) }}"
                       style="justify-content:flex-start">
                        <i class="fas fa-user"></i> {{ $u->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@if($selectedUser)
    <form action="{{ route('admin.permissions.user.update', $selectedUser) }}" method="POST" class="card permissions-card">
        @csrf
        <div class="card-body">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:10px">
                <div style="font-weight:700; padding-left:10px">Permissions for {{ $selectedUser->name }}</div>
                <div style="color:#94a3b8;font-size:12px;">Role: {{ ucfirst($selectedUser->role) }}</div>
            </div>
            <div class="bulk-actions">
                <button type="button" class="btn btn-secondary btn-sm" data-select-all="view" data-label-off="View All" data-label-on="Unselect View">
                    <i class="fas fa-eye"></i> <span data-label>View All</span>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-select-all="add" data-label-off="Add All" data-label-on="Unselect Add">
                    <i class="fas fa-plus"></i> <span data-label>Add All</span>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-select-all="edit" data-label-off="Edit All" data-label-on="Unselect Edit">
                    <i class="fas fa-pen"></i> <span data-label>Edit All</span>
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-select-all="delete" data-label-off="Delete All" data-label-on="Unselect Delete">
                    <i class="fas fa-trash"></i> <span data-label>Delete All</span>
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-select-all="all" data-label-off="Select All" data-label-on="Unselect All">
                    <i class="fas fa-check-double"></i> <span data-label>Select All</span>
                </button>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>View</th>
                            <th>Add</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $group => $perms)
                            <tr>
                                <td colspan="5" style="background:#f8fafc;color:#64748b;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px">
                                    {{ str_replace(['-','.'], ' ', $group) }}
                                </td>
                            </tr>
                                                                                    @php
                                $find = fn($name) => $perms->firstWhere('name', $name);
                                $view = $find($group.'.view');
                                $create = $find($group.'.create');
                                $edit = $find($group.'.edit');
                                $delete = $find($group.'.delete');
                                $permMap = [
                                    ['perm' => $view, 'type' => 'view'],
                                    ['perm' => $create, 'type' => 'add'],
                                    ['perm' => $edit, 'type' => 'edit'],
                                    ['perm' => $delete, 'type' => 'delete'],
                                ];
                            @endphp
                            <tr>
                                <td style="font-weight:600; display:flex; align-items:center; gap:8px;">
                                    <label class="toggle-switch module-access-toggle">
                                        <input type="checkbox" data-group="{{ $group }}" />
                                        <span class="toggle-slider"></span>
                                    </label>
                                    {{ str_replace(['-','.'], ' ', $group) }}
                                </td>
                                @foreach($permMap as $item)
                                    @php
                                        $p = $item['perm'];
                                        $type = $item['type'];
                                    @endphp
                                    <td>
                                        @if($p)
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="permissions[]" value="{{ $p->id }}" data-group="{{ $group }}" data-perm-type="{{ $type }}" {{ in_array($p->id, $assigned) ? 'checked' : '' }}>
                                            <span class="toggle-slider"></span>
                                        </label>
                                        @else
                                            <span style="color:#cbd5f5">—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-actions" style="margin-top:16px">
                <button class="btn btn-primary"><i class="fas fa-save"></i> Save Permissions</button>
            </div>
        </div>
    </form>
@endif
</div>

<script>
    if (window.history && window.history.replaceState) {
        window.history.replaceState(null, document.title, window.location.href);
    }
    const userSearch = document.getElementById('userSearch');
    const userList = document.getElementById('userList');
    if (userSearch && userList) {
        userSearch.addEventListener('input', () => {
            const q = userSearch.value.trim().toLowerCase();
            userList.querySelectorAll('.user-item').forEach(item => {
                const name = item.getAttribute('data-name') || '';
                item.style.display = name.includes(q) ? '' : 'none';
            });
        });
    }
    const bulkButtons = Array.from(document.querySelectorAll('[data-select-all]'));
    const permCheckboxes = Array.from(document.querySelectorAll('input[data-perm-type]'));

    const updateButtonLabel = (btn, allChecked) => {
        const label = btn.querySelector('[data-label]');
        if (!label) return;
        label.textContent = allChecked ? btn.getAttribute('data-label-on') : btn.getAttribute('data-label-off');
    };

    const refreshBulkButtons = () => {
        bulkButtons.forEach(btn => {
            const type = btn.getAttribute('data-select-all');
            const selector = type === 'all' ? 'input[data-perm-type]' : 'input[data-perm-type="' + type + '"]';
            const items = Array.from(document.querySelectorAll(selector));
            const allChecked = items.length > 0 && items.every(cb => cb.checked);
            updateButtonLabel(btn, allChecked);
        });
    };

    bulkButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const type = btn.getAttribute('data-select-all');
            const selector = type === 'all' ? 'input[data-perm-type]' : 'input[data-perm-type="' + type + '"]';
            const items = Array.from(document.querySelectorAll(selector));
            const allChecked = items.length > 0 && items.every(cb => cb.checked);
            items.forEach(cb => { cb.checked = !allChecked; });
            refreshBulkButtons();
        });
    });

    const syncModuleToggle = (row) => {
        const moduleToggle = row.querySelector('.module-access-toggle input[type="checkbox"]');
        if (!moduleToggle) return;
        const checks = Array.from(row.querySelectorAll('input[data-perm-type]')); 
        moduleToggle.checked = checks.length > 0 && checks.every(ch => ch.checked);
    };

    const onPermCheckboxChange = (cb) => {
        const row = cb.closest('tr');
        if (!row) return;

        const viewCheckbox = row.querySelector('input[data-perm-type="view"]');
        const addEditDelete = Array.from(row.querySelectorAll('input[data-perm-type="add"], input[data-perm-type="edit"], input[data-perm-type="delete"]'));

        if (cb.dataset.permType !== 'view' && cb.checked) {
            // if any add/edit/delete is enabled, view must be enabled
            if (viewCheckbox && !viewCheckbox.checked) {
                viewCheckbox.checked = true;
            }
        }

        if (cb.dataset.permType === 'view' && !cb.checked) {
            // prevent turning off view if any add/edit/delete is still on
            const actionChecked = addEditDelete.some(ch => ch.checked);
            if (actionChecked) {
                cb.checked = true;
            }
        }

        // also if view is manually checked and everything else is checked by module-level intent
        if (viewCheckbox && viewCheckbox.checked && addEditDelete.every(ch => ch.checked)) {
            // nothing to do besides sync in case
        }

        syncModuleToggle(row);
        refreshBulkButtons();
    };

    permCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => onPermCheckboxChange(cb));
    });

    document.querySelectorAll('.module-access-toggle input[type="checkbox"]').forEach(moduleCb => {
        moduleCb.addEventListener('change', () => {
            const row = moduleCb.closest('tr');
            if (!row) return;

            const checks = Array.from(row.querySelectorAll('input[data-perm-type]'));
            checks.forEach(ch => ch.checked = moduleCb.checked);

            // To enforce view when others set
            if (moduleCb.checked) {
                const viewCheckbox = row.querySelector('input[data-perm-type="view"]');
                if (viewCheckbox) viewCheckbox.checked = true;
            }

            refreshBulkButtons();
        });
    });

    refreshBulkButtons();
</script>
@endsection









