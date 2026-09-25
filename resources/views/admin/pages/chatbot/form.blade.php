@extends('admin.layouts.app')
@section('title', isset($faq) ? 'Edit Chatbot FAQ' : 'Add Chatbot FAQ')
@section('breadcrumb')<span>></span><a href="{{ route('admin.chatbot.index') }}" style="color:#94a3b8;text-decoration:none">Chatbot</a><span>></span><span class="current">{{ isset($faq) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">{{ isset($faq) ? 'Edit' : 'Add' }} Chatbot FAQ</h1>
    <a href="{{ route('admin.chatbot.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div style="max-width:760px">
<form class="single-card-form" action="{{ isset($faq) ? route('admin.chatbot.update',$faq) : route('admin.chatbot.store') }}" method="POST">
@csrf @if(isset($faq)) @method('PUT') @endif
<div class="card"><div class="card-body">
    <div class="form-group">
        <label class="form-label">Category *</label>
        <input type="text" name="category" class="form-control" value="{{ old('category',$faq->category??'General') }}" required>
    </div>
    <div class="form-group">
        <label class="form-label">Question *</label>
        <input type="text" name="question" class="form-control" value="{{ old('question',$faq->question??'') }}" required>
    </div>
    <div class="form-group">
        <label class="form-label">Answer *</label>
        <textarea name="answer" class="form-control" rows="6" required>{{ old('answer',$faq->answer??'') }}</textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Keywords (comma-separated)</label>
        <input type="text" name="keywords" class="form-control" value="{{ old('keywords',$faq->keywords??'') }}">
    </div>
    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between">
        <label style="margin:0;font-size:13px;font-weight:600">Active</label>
        <label class="toggle-switch">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active',$faq->is_active??true)?'checked':'' }}>
            <span class="toggle-slider"></span>
        </label>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($faq) ? 'Update' : 'Submit' }}</button>
    </div>
</div></div>
</form>
</div>
@endsection
