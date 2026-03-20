{{-- resources/views/admin/testimonials/index.blade.php --}}
@extends('layouts.admin')
@section('title','Testimonials') @section('page-title','Testimonials')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-muted mb-0 small">Manage customer testimonials</p>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary" style="border-radius:8px;font-weight:600"><i class="fas fa-plus me-2"></i>New Testimonial</a>
</div>
<div class="admin-table">
    <table class="table mb-0">
        <thead><tr><th>Name</th><th>Company</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($testimonials as $t)
            <tr>
                <td><strong>{{ $t->name }}</strong><div class="text-muted small">{{ $t->position }}</div></td>
                <td>{{ $t->company ?? '—' }}</td>
                <td>@for($i=1;$i<=$t->rating;$i++)<i class="fas fa-star text-warning" style="font-size:12px"></i>@endfor</td>
                <td><span class="badge {{ $t->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $t->is_active ? 'Active' : 'Hidden' }}</span></td>
                <td><div class="d-flex gap-1">
                    <a href="{{ route('admin.testimonials.edit',$t) }}" class="btn btn-sm btn-outline-warning" style="border-radius:6px"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.testimonials.destroy',$t) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" style="border-radius:6px"><i class="fas fa-trash"></i></button></form>
                </div></td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4 text-muted">No testimonials. <a href="{{ route('admin.testimonials.create') }}">Add one</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
