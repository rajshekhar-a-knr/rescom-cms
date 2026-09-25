@extends('admin.layouts.app')
@section('title','Chatbot Queries')
@section('breadcrumb')<span>></span><a href="{{ route('admin.chatbot.index') }}" style="color:#94a3b8;text-decoration:none">Chatbot</a><span>></span><span class="current">Queries</span>@endsection
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Unanswered Queries</h1>
        <div class="page-subtitle">Review unanswered questions and respond.</div>
    </div>
    <a href="{{ route('admin.chatbot.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form class="card" method="GET" style="margin-bottom:16px">
    <div class="card-body" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search question" style="max-width:260px">
        <select name="status" class="form-control" style="max-width:160px">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
        </select>
        <button class="btn btn-secondary">Filter</button>
        <a href="{{ route('admin.chatbot.queries') }}" class="btn btn-light">Reset</a>
    </div>
</form>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Status</th>
                    <th>Response</th>
                    <th style="width:240px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($queries as $q)
                <tr>
                    <td style="font-weight:600;font-size:13.5px">{{ Str::limit($q->user_question, 90) }}</td>
                    <td>
                        <span class="badge {{ $q->status === 'resolved' ? 'badge-green' : 'badge-yellow' }}">
                            {{ ucfirst($q->status) }}
                        </span>
                    </td>
                    <td style="color:#64748b;font-size:12px">{{ Str::limit($q->admin_response, 80) }}</td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap">
                            <form action="{{ route('admin.chatbot.queries.respond', $q) }}" method="POST" style="min-width:180px">
                                @csrf
                                <input type="text" name="admin_response" class="form-control" placeholder="Quick reply" value="{{ $q->admin_response }}" style="height:34px;font-size:12px">
                                <button class="btn btn-primary btn-sm" style="margin-top:6px"><i class="fas fa-paper-plane"></i> Reply</button>
                            </form>
                            <form action="{{ route('admin.chatbot.queries.convert', $q) }}" method="POST">
                                @csrf
                                <button class="btn btn-secondary btn-sm"><i class="fas fa-wand-magic-sparkles"></i> Convert to FAQ</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:#94a3b8">No queries found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:16px">{{ $queries->links() }}</div>
@endsection
