{{-- resources/views/admin/services/index.blade.php --}}
@extends('layouts.admin')
@section('title','Services') @section('page-title','Services')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0 small">Manage website services</p>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary" style="border-radius:8px;font-weight:600"><i class="fas fa-plus me-2"></i>New Service</a>
</div>
<div class="admin-table">
    <table class="table mb-0">
        <thead><tr><th>Title</th><th>Icon</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($services as $s)
            <tr>
                <td><strong>{{ $s->title }}</strong><div class="text-muted small">{{ Str::limit($s->short_description, 60) }}</div></td>
                <td><i class="fas {{ $s->icon }} fa-lg text-primary"></i></td>
                <td><span class="badge {{ $s->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $s->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td>{{ $s->sort_order }}</td>
                <td><div class="d-flex gap-1">
                    <a href="{{ route('admin.services.edit',$s) }}" class="btn btn-sm btn-outline-warning" style="border-radius:6px"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.services.destroy',$s) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" style="border-radius:6px"><i class="fas fa-trash"></i></button></form>
                </div></td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4 text-muted">No services found. <a href="{{ route('admin.services.create') }}">Add one</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
