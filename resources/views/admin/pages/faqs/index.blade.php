@extends('admin.layouts.app')
@section('title','FAQs')
@section('breadcrumb')<span>></span><span class="current">FAQs</span>@endsection
@section('content')
<div class="page-header"><div><h1 class="page-title">FAQs</h1></div><a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add FAQ</a></div>
<div class="card"><div class="table-container"><table><thead><tr><th>Question</th><th>Category</th><th>Order</th><th>Actions</th></tr></thead><tbody>
@foreach($faqs as $faq)
<tr><td style="font-weight:600;font-size:13.5px">{{ Str::limit($faq->question,80) }}</td><td><span class="badge badge-blue">{{ ucfirst($faq->category) }}</span></td><td>{{ $faq->sort_order }}</td>
<td><div style="display:flex;gap:6px"><a href="{{ route('admin.faqs.edit',$faq) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a><form class="single-card-form" action="{{ route('admin.faqs.destroy',$faq) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button></form></div></td></tr>
@endforeach
</tbody></table></div></div>
@endsection

