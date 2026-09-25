@extends('admin.layouts.app')
@section('title','Events')
@section('breadcrumb')<span>></span><span class="current">Events</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Events</h1></div>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Event</a>
</div>
<div style="margin-bottom:16px;display:flex;gap:10px;flex-wrap:wrap">
    <a href="{{ route('admin.events.index') }}" class="btn {{ empty($type) ? 'btn-blue' : 'btn-secondary' }}">All Events</a>
    @foreach(($types ?? []) as $t)
        <a href="{{ route('admin.events.index', ['type' => $t]) }}" class="btn {{ ($type === $t) ? 'btn-blue' : 'btn-secondary' }}">{{ $t }}</a>
    @endforeach
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Photos</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px">
                            @if($event->image)
                                <img src="{{ media_url($event->image) }}" style="width:50px;height:35px;object-fit:cover;border-radius:6px">
                            @else
                                <div style="width:50px;height:35px;background:#eef2ff;border-radius:6px;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            @endif
                            <div>
                                <div style="font-weight:600">{{ Str::limit($event->title,40) }}</div>
                                @if($event->summary)<div style="font-size:12px;color:#64748b">{{ Str::limit($event->summary,40) }}</div>@endif
                            </div>
                        </div>
                    </td>
                    <td style="font-size:13px">{{ $event->event_type ?? 'General' }}</td>
                    <td style="font-size:13px">{{ $event->event_date ? $event->event_date->format('M d, Y') : 'TBA' }}</td>
                    <td style="font-size:13px">{{ $event->location ?? 'TBA' }}</td>
                    <td><span class="badge badge-blue">{{ $event->photos()->count() }}</span></td>
                    <td><span class="badge {{ $event->is_active ? 'badge-green' : 'badge-gray' }}">{{ $event->is_active ? 'Active' : 'Hidden' }}</span></td>
                    <td>{{ $event->sort_order }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.events.edit',$event) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                            <form class="single-card-form" action="{{ route('admin.events.destroy',$event) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($events->isEmpty())
                    <tr class="table-empty"><td colspan="7">No events yet.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection




