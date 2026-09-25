@extends('admin.layouts.app')
@section('title', isset($faq) ? 'Edit FAQ' : 'Add FAQ')
@section('breadcrumb')<span>></span><a href="{{ route('admin.faqs.index') }}" style="color:#94a3b8;text-decoration:none">FAQs</a><span>></span><span class="current">{{ isset($faq) ? 'Edit' : 'Add' }}</span>@endsection
@section('content')
<div class="page-header"><h1 class="page-title">{{ isset($faq) ? 'Edit' : 'Add' }} FAQ</h1><a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a></div>
<div style="max-width:700px">
<form class="single-card-form" action="{{ isset($faq) ? route('admin.faqs.update',$faq) : route('admin.faqs.store') }}" method="POST">
@csrf @if(isset($faq)) @method('PUT') @endif
<div class="card"><div class="card-body">
<div class="form-group"><label class="form-label">Question *</label><input type="text" name="question" class="form-control" value="{{ old('question',$faq->question??'') }}" required></div>
<div class="form-group"><label class="form-label">Answer *</label><textarea name="answer" class="form-control" rows="5" required>{{ old('answer',$faq->answer??'') }}</textarea></div>
<div class="form-row"><div class="form-group"><label class="form-label">Category</label><select name="category" class="form-control"><option value="general">General</option><option value="process">Process</option><option value="pricing">Pricing</option><option value="technology">Technology</option><option value="security">Security</option><option value="support">Support</option><option value="legal">Legal</option></select></div><div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$faq->sort_order??0) }}"></div></div>
<div class="form-group" style="display:flex;align-items:center;justify-content:space-between"><label style="margin:0;font-size:13px;font-weight:600">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$faq->is_active??true)?'checked':'' }}><span class="toggle-slider"></span></label></div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ isset($faq) ? 'Update' : 'Submit' }}</button>
</div>
</div></div>
</form></div>
@endsection

