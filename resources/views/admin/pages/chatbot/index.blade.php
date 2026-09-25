@extends('admin.layouts.app')
@section('title','Chatbot')
@section('breadcrumb')<span>></span><span class="current">Chatbot</span>@endsection
@section('content')
<div class="page-header" style="align-items:flex-start;gap:12px;flex-wrap:wrap">
    <div>
        <h1 class="page-title">Chatbot FAQs</h1>
        <div class="page-subtitle">Manage chatbot knowledge base and settings.</div>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
        <a href="{{ route('admin.chatbot.queries') }}" class="btn btn-secondary">
            <i class="fas fa-inbox"></i> Unanswered Queries
            @if($pendingCount)
                <span class="badge badge-red" style="margin-left:6px">{{ $pendingCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.chatbot.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add FAQ</a>
    </div>
</div>

<div class="card" style="margin-bottom:16px">
    <div class="card-body" style="display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap">
        <div style="font-weight:600">Chatbot Status</div>
        <form action="{{ route('admin.chatbot.settings') }}" method="POST">
            @csrf
            <label class="toggle-switch" style="display:flex;align-items:center;gap:10px">
                <input type="checkbox" name="chatbot_enabled" value="1" {{ $chatbotEnabled ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
                <span style="font-size:13px;color:#64748b">{{ $chatbotEnabled ? 'Enabled' : 'Disabled' }}</span>
            </label>
            <button class="btn btn-secondary btn-sm" style="margin-left:10px">Update</button>
        </form>
    </div>
</div>

<form class="card" method="GET" style="margin-bottom:16px">
    <div class="card-body" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search question or keyword" style="max-width:260px">
        <select name="category" class="form-control" style="max-width:200px">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <select name="status" class="form-control" style="max-width:160px">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button class="btn btn-secondary">Filter</button>
        <a href="{{ route('admin.chatbot.index') }}" class="btn btn-light">Reset</a>
    </div>
</form>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Category</th>
                    <th>Keywords</th>
                    <th>Asked</th>
                    <th>Status</th>
                    <th style="width:140px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td style="font-weight:600;font-size:13.5px">{{ Str::limit($faq->question, 70) }}</td>
                    <td><span class="badge badge-blue">{{ $faq->category }}</span></td>
                    <td style="color:#64748b;font-size:12px">{{ Str::limit($faq->keywords, 60) }}</td>
                    <td>{{ $faq->times_asked }}</td>
                    <td>
                        <span class="badge {{ $faq->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.chatbot.edit', $faq) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.chatbot.toggle', $faq) }}" method="POST">
                                @csrf
                                <button class="btn btn-light btn-sm" title="Toggle">
                                    <i class="fas fa-toggle-{{ $faq->is_active ? 'on' : 'off' }}"></i>
                                </button>
                            </form>
                            <form class="single-card-form" action="{{ route('admin.chatbot.destroy', $faq) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#94a3b8">No FAQs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:16px">{{ $faqs->links() }}</div>
@endsection
