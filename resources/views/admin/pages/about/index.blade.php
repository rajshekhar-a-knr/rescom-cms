@extends('admin.layouts.app')
@section('title','About Page')
@section('breadcrumb')<span>></span><span class="current">About Page</span>@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">About Page</h1>
    <!-- <a href="{{ route('admin.about.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add About</a> -->
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title">All About Entries</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Active</th>
                        <th>Order</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->hero_title ?? 'About Page' }}</td>
                        <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                        <td>{{ $item->sort_order }}</td>
                        <td>{{ $item->updated_at?->format('M d, Y') }}</td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.about.edit',$item) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                                <form class="single-card-form" action="{{ route('admin.about.destroy',$item) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-confirm="Delete?"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:#94a3b8">No entries yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $items->links() }}
    </div>
</div>
@endsection
