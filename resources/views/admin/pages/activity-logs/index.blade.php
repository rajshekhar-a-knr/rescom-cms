@extends('admin.layouts.app')
@section('title','Activity Logs')
@section('breadcrumb')<span>&rsaquo;</span><span class="current">Activity Logs</span>@endsection
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Activity Logs</h1>
        <p class="page-subtitle">Track admin actions and system changes</p>
    </div>
    <a href="{{ route('admin.activity-logs') }}" class="btn btn-secondary"><i class="fas fa-sync"></i> Refresh</a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                    <th>Changes</th>
                    <th>IP</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                @php
                    $action = $log->action ?: 'updated';
                    $badge = in_array($action, ['created','create']) ? 'green' : (in_array($action, ['deleted','delete']) ? 'red' : 'blue');
                    $modelName = $log->model_type ? class_basename($log->model_type) : '—';
                @endphp
                <tr>
                    <td>
                        <div style="font-weight:600">{{ $log->user?->name ?? 'System' }}</div>
                        <div style="font-size:12px;color:#94a3b8">{{ $log->user?->email ?? '' }}</div>
                    </td>
                    <td><span class="badge badge-{{ $badge }}">{{ ucfirst($action) }}</span></td>
                    <td style="font-size:13px">{{ $modelName }} @if($log->model_id)<span style="color:#94a3b8">#{{ $log->model_id }}</span>@endif</td>
                    <td style="font-size:12px;max-width:220px">
                        @if(!empty($log->old_values) || !empty($log->new_values))
                            <details>
                                <summary style="cursor:pointer;color:#3b82f6">View</summary>
                                <div style="display:grid;gap:8px;margin-top:8px">
                                    @if(!empty($log->old_values))
                                        <div>
                                            <div style="font-weight:600;color:#64748b;margin-bottom:4px">Old</div>
                                            <pre style="white-space:pre-wrap;background:#f8fafc;border:1px solid #e2e8f0;padding:8px;border-radius:8px;font-size:11px;line-height:1.4">{{ json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre>
                                        </div>
                                    @endif
                                    @if(!empty($log->new_values))
                                        <div>
                                            <div style="font-weight:600;color:#64748b;margin-bottom:4px">New</div>
                                            <pre style="white-space:pre-wrap;background:#f8fafc;border:1px solid #e2e8f0;padding:8px;border-radius:8px;font-size:11px;line-height:1.4">{{ json_encode($log->new_values, JSON_PRETTY_PRINT) }}</pre>
                                        </div>
                                    @endif
                                </div>
                            </details>
                        @else
                            —
                        @endif
                    </td>
                    <td style="font-size:12px;color:#94a3b8">{{ $log->ip_address ?? '—' }}</td>
                    <td style="font-size:12px;color:#94a3b8">{{ $log->created_at ? $log->created_at->format('M d, Y H:i') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#94a3b8;padding:24px">No activity logs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $logs->links() }}</div>
</div>
@endsection
