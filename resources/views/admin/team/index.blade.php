{{-- resources/views/admin/team/index.blade.php --}}
@extends('layouts.admin')
@section('title','Team Members') @section('page-title','Team Members')
@section('content')
<div class="d-flex justify-content-between mb-4">
    <p class="text-muted mb-0 small">Manage team members shown on website</p>
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary" style="border-radius:8px;font-weight:600"><i class="fas fa-plus me-2"></i>New Member</a>
</div>
<div class="admin-table">
    <table class="table mb-0">
        <thead><tr><th>Name</th><th>Position</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($members as $m)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        @if($m->photo)
                            <img src="{{ asset('storage/'.$m->photo) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover">
                        @else
                            <div style="width:36px;height:36px;background:#003580;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px">{{ strtoupper(substr($m->name,0,1)) }}</div>
                        @endif
                        <strong>{{ $m->name }}</strong>
                    </div>
                </td>
                <td>{{ $m->position }}</td>
                <td>{{ $m->sort_order }}</td>
                <td><span class="badge {{ $m->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $m->is_active ? 'Active' : 'Hidden' }}</span></td>
                <td><div class="d-flex gap-1">
                    <a href="{{ route('admin.team.edit',$m) }}" class="btn btn-sm btn-outline-warning" style="border-radius:6px"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.team.destroy',$m) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" style="border-radius:6px"><i class="fas fa-trash"></i></button></form>
                </div></td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4 text-muted">No team members. <a href="{{ route('admin.team.create') }}">Add one</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
