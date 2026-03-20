@extends('layouts.admin')
@section('title', 'Shipments')
@section('page-title', 'Shipments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <p class="text-muted mb-0" style="font-size:13px">Manage all shipments and tracking</p>
    </div>
    <a href="{{ route('admin.shipments.create') }}" class="btn btn-primary" style="border-radius:8px;font-weight:600;font-size:14px">
        <i class="fas fa-plus me-2"></i>New Shipment
    </a>
</div>

<!-- Filters -->
<div class="form-card mb-4">
    <form method="GET" action="{{ route('admin.shipments.index') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Search</label>
            <input type="text" name="search" class="form-control" placeholder="Tracking #, name, origin, destination..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                @foreach(\App\Models\Shipment::STATUSES as $val => $label)
                <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Service Type</label>
            <select name="service_type" class="form-select">
                <option value="">All Services</option>
                @foreach(\App\Models\Shipment::SERVICE_TYPES as $val => $label)
                <option value="{{ $val }}" {{ request('service_type') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100" style="border-radius:8px"><i class="fas fa-search"></i></button>
            <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary" style="border-radius:8px"><i class="fas fa-times"></i></a>
        </div>
    </form>
</div>

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Tracking #</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Route</th>
                <th>Service</th>
                <th>Status</th>
                <th>Est. Delivery</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shipments as $s)
            <tr>
                <td>
                    <a href="{{ route('admin.shipments.show', $s) }}" style="font-family:'Barlow Condensed',sans-serif;font-weight:700;font-size:15px;color:var(--primary);text-decoration:none">
                        {{ $s->tracking_number }}
                    </a>
                </td>
                <td>
                    <div style="font-weight:600;font-size:14px">{{ $s->sender_name }}</div>
                    @if($s->sender_email)<div style="font-size:12px;color:#9ca3af">{{ $s->sender_email }}</div>@endif
                </td>
                <td>
                    <div style="font-weight:600;font-size:14px">{{ $s->receiver_name }}</div>
                    @if($s->receiver_email)<div style="font-size:12px;color:#9ca3af">{{ $s->receiver_email }}</div>@endif
                </td>
                <td>
                    <div style="font-size:13px"><i class="fas fa-circle" style="font-size:6px;color:#10b981;margin-right:4px"></i>{{ $s->origin }}</div>
                    <div style="font-size:13px"><i class="fas fa-circle" style="font-size:6px;color:#e8a000;margin-right:4px"></i>{{ $s->destination }}</div>
                </td>
                <td style="font-size:13px;color:#6c757d">{{ \App\Models\Shipment::SERVICE_TYPES[$s->service_type] ?? $s->service_type }}</td>
                <td><span class="badge badge-status bg-{{ $s->status_color }}">{{ $s->status_label }}</span></td>
                <td style="font-size:13px;color:#6c757d">{{ $s->estimated_delivery ? $s->estimated_delivery->format('M d, Y') : '—' }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.shipments.show', $s) }}" class="btn btn-sm btn-outline-primary" style="border-radius:6px" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.shipments.edit', $s) }}" class="btn btn-sm btn-outline-warning" style="border-radius:6px" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.shipments.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this shipment?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" style="border-radius:6px" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center py-5 text-muted">
                <i class="fas fa-boxes" style="font-size:48px;opacity:.2;display:block;margin-bottom:12px"></i>
                No shipments found. <a href="{{ route('admin.shipments.create') }}">Create the first one</a>
            </td></tr>
            @endforelse
        </tbody>
    </table>
    @if($shipments->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #f0f2f8">
        {{ $shipments->links() }}
    </div>
    @endif
</div>
@endsection
