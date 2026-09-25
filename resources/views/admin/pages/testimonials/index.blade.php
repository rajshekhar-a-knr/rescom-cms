@extends('admin.layouts.app')
@section('title','Testimonials')
@section('breadcrumb')<span>></span><span class="current">Testimonials</span>@endsection
@section('content')
<div class="page-header">
    <div><h1 class="page-title">Testimonials</h1></div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add
    </a>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Company</th>
                    <th>Rating</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $t)
                    <tr>
                        <td>
                            <div style="font-weight:600">{{ $t->client_name }}</div>
                            <div style="font-size:12px;color:#94a3b8">{{ $t->client_designation }}</div>

                            @if($t->testimonial_source === 'student-college')
                                <div style="margin-top:6px;display:inline-flex;align-items:center;padding:4px 8px;border-radius:999px;background:#eff6ff;color:#1d4ed8;font-size:11px;font-weight:700">
                                    Student / College
                                </div>
                            @endif

                            @if($t->intern)
                                <div style="font-size:12px;color:#64748b;margin-top:6px">
                                    Linked intern: {{ $t->intern->name }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $t->client_company }}</td>
                        <td>{!! str_repeat('&#9733;', (int) $t->rating) !!}</td>
                        <td>{{ $t->is_featured ? 'Yes' : 'No' }}</td>
                        <td>
                            <span class="badge {{ $t->is_active ? 'badge-green' : 'badge-gray' }}">
                                {{ $t->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.testimonials.edit',$t) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="single-card-form" action="{{ route('admin.testimonials.destroy',$t) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-confirm="Delete?">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
