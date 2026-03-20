{{-- resources/views/admin/messages/index.blade.php --}}
@extends('layouts.admin')
@section('title','Messages') @section('page-title','Messages')
@section('content')
<div class="admin-table">
    <table class="table mb-0">
        <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($messages as $m)
            <tr style="{{ !$m->is_read ? 'background:#f8f9ff;font-weight:600' : '' }}">
                <td>{{ $m->name }}</td>
                <td>{{ $m->email }}</td>
                <td>{{ Str::limit($m->subject ?? $m->message, 50) }}</td>
                <td style="font-size:13px;color:#6c757d">{{ $m->created_at->format('M d, Y H:i') }}</td>
                <td><span class="badge {{ $m->is_read ? 'bg-secondary' : 'bg-primary' }}">{{ $m->is_read ? 'Read' : 'Unread' }}</span></td>
                <td><div class="d-flex gap-1">
                    <a href="{{ route('admin.messages.show',$m) }}" class="btn btn-sm btn-outline-primary" style="border-radius:6px"><i class="fas fa-eye"></i></a>
                    <form action="{{ route('admin.messages.destroy',$m) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" style="border-radius:6px"><i class="fas fa-trash"></i></button></form>
                </div></td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-4 text-muted">No messages received yet</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($messages->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #f0f2f8">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
