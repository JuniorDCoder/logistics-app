@extends('layouts.admin')
@section('title','Message') @section('page-title','Message Detail')
@section('content')
<div class="mb-4 d-flex gap-2">
    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px"><i class="fas fa-arrow-left me-2"></i>All Messages</a>
    <form action="{{ route('admin.messages.destroy',$message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" style="border-radius:8px"><i class="fas fa-trash me-1"></i>Delete</button>
    </form>
</div>
<div class="form-card" style="max-width:700px">
    <div class="mb-4 pb-4" style="border-bottom:1px solid #f0f2f8">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="text-muted small text-uppercase" style="letter-spacing:.5px">From</div>
                <strong>{{ $message->name }}</strong>
                <div class="text-muted small">{{ $message->email }}</div>
                @if($message->phone)<div class="text-muted small">{{ $message->phone }}</div>@endif
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase" style="letter-spacing:.5px">Received</div>
                <div>{{ $message->created_at->format('F j, Y \a\t H:i') }}</div>
                <div class="text-muted small">{{ $message->created_at->diffForHumans() }}</div>
            </div>
        </div>
    </div>
    @if($message->subject)
    <div class="mb-3">
        <div class="text-muted small text-uppercase mb-1" style="letter-spacing:.5px">Subject</div>
        <strong>{{ $message->subject }}</strong>
    </div>
    @endif
    <div>
        <div class="text-muted small text-uppercase mb-2" style="letter-spacing:.5px">Message</div>
        <div style="background:#f8f9ff;border-radius:10px;padding:20px;line-height:1.8;color:#374151">{{ $message->message }}</div>
    </div>
    <div class="mt-4 pt-4" style="border-top:1px solid #f0f2f8">
        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary" style="border-radius:8px;font-weight:600">
            <i class="fas fa-reply me-2"></i>Reply via Email
        </a>
    </div>
</div>
@endsection
