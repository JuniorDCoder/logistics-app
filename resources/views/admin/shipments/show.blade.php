@extends('layouts.admin')
@section('title', 'Shipment: '.$shipment->tracking_number)
@section('page-title', 'Shipment Detail')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <a href="{{ route('admin.shipments.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
        <i class="fas fa-arrow-left me-2"></i>All Shipments
    </a>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.shipments.edit', $shipment) }}" class="btn btn-warning btn-sm" style="border-radius:8px;font-weight:600">
            <i class="fas fa-edit me-1"></i>Edit
        </a>
        <form action="{{ route('admin.shipments.destroy', $shipment) }}" method="POST" onsubmit="return confirm('Delete this shipment?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" style="border-radius:8px;font-weight:600"><i class="fas fa-trash me-1"></i>Delete</button>
        </form>
    </div>
</div>

<div class="row g-4">
    <!-- Left column: details -->
    <div class="col-lg-8">
        <!-- Header card -->
        <div class="form-card mb-4" style="background:linear-gradient(135deg,#003580,#001a40);color:#fff">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <div style="font-size:12px;opacity:.6;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px">Tracking Number</div>
                    <div style="font-family:'Barlow Condensed',sans-serif;font-size:32px;font-weight:800;color:#e8a000">{{ $shipment->tracking_number }}</div>
                </div>
                <span class="badge badge-status bg-{{ $shipment->status_color }}" style="font-size:14px;padding:8px 18px">{{ $shipment->status_label }}</span>
            </div>
            <div class="row g-3 mt-2">
                <div class="col-6 col-md-3">
                    <div style="font-size:11px;opacity:.5;text-transform:uppercase;letter-spacing:.5px">Service</div>
                    <div style="font-weight:600;font-size:14px">{{ \App\Models\Shipment::SERVICE_TYPES[$shipment->service_type] ?? $shipment->service_type }}</div>
                </div>
                <div class="col-6 col-md-3">
                    <div style="font-size:11px;opacity:.5;text-transform:uppercase;letter-spacing:.5px">Packages</div>
                    <div style="font-weight:600;font-size:14px">{{ $shipment->package_count }}</div>
                </div>
                <div class="col-6 col-md-3">
                    <div style="font-size:11px;opacity:.5;text-transform:uppercase;letter-spacing:.5px">Weight</div>
                    <div style="font-weight:600;font-size:14px">{{ $shipment->weight ? $shipment->weight.' kg' : '—' }}</div>
                </div>
                <div class="col-6 col-md-3">
                    <div style="font-size:11px;opacity:.5;text-transform:uppercase;letter-spacing:.5px">Est. Delivery</div>
                    <div style="font-weight:600;font-size:14px">{{ $shipment->estimated_delivery ? $shipment->estimated_delivery->format('M d, Y') : '—' }}</div>
                </div>
            </div>
        </div>

        <!-- Sender / Receiver -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="form-card h-100">
                    <div class="section-divider"><i class="fas fa-user me-2"></i>Sender</div>
                    <div class="mb-2"><strong>{{ $shipment->sender_name }}</strong></div>
                    @if($shipment->sender_email)<div class="text-muted small"><i class="fas fa-envelope me-1"></i>{{ $shipment->sender_email }}</div>@endif
                    @if($shipment->sender_phone)<div class="text-muted small"><i class="fas fa-phone me-1"></i>{{ $shipment->sender_phone }}</div>@endif
                    @if($shipment->sender_address)<div class="text-muted small mt-2"><i class="fas fa-map-marker-alt me-1"></i>{{ $shipment->sender_address }}</div>@endif
                    <div class="mt-3 pt-3" style="border-top:1px solid #f0f2f8">
                        <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">Origin</span><br>
                        <strong style="color:#003580">{{ $shipment->origin }}</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-card h-100">
                    <div class="section-divider"><i class="fas fa-user-check me-2"></i>Receiver</div>
                    <div class="mb-2"><strong>{{ $shipment->receiver_name }}</strong></div>
                    @if($shipment->receiver_email)<div class="text-muted small"><i class="fas fa-envelope me-1"></i>{{ $shipment->receiver_email }}</div>@endif
                    @if($shipment->receiver_phone)<div class="text-muted small"><i class="fas fa-phone me-1"></i>{{ $shipment->receiver_phone }}</div>@endif
                    @if($shipment->receiver_address)<div class="text-muted small mt-2"><i class="fas fa-map-marker-alt me-1"></i>{{ $shipment->receiver_address }}</div>@endif
                    <div class="mt-3 pt-3" style="border-top:1px solid #f0f2f8">
                        <span style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px">Destination</span><br>
                        <strong style="color:#003580">{{ $shipment->destination }}</strong>
                    </div>
                </div>
            </div>
        </div>

        @if($shipment->description || $shipment->notes)
        <div class="form-card mb-4">
            @if($shipment->description)
            <div class="mb-3">
                <div class="section-divider">Cargo Description</div>
                <p class="text-muted mb-0">{{ $shipment->description }}</p>
            </div>
            @endif
            @if($shipment->notes)
            <div>
                <div class="section-divider">Internal Notes</div>
                <p class="text-muted mb-0">{{ $shipment->notes }}</p>
            </div>
            @endif
        </div>
        @endif
    </div>

    <!-- Right column: tracking events -->
    <div class="col-lg-4">
        <!-- Add Event Form -->
        <div class="form-card mb-4">
            <div class="section-divider"><i class="fas fa-plus me-2"></i>Add Tracking Event</div>
            <form action="{{ route('admin.shipments.events.store', $shipment) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        @foreach(\App\Models\Shipment::STATUSES as $val => $label)
                        <option value="{{ $val }}" {{ $shipment->status == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="e.g. London, UK">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea name="description" class="form-control" rows="2" required placeholder="What happened?"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Event Time *</label>
                    <input type="datetime-local" name="event_time" class="form-control" required value="{{ now()->format('Y-m-d\TH:i') }}">
                </div>
                <button type="submit" class="btn btn-primary w-100" style="border-radius:8px;font-weight:600">
                    <i class="fas fa-plus me-2"></i>Add Event
                </button>
            </form>
        </div>

        <!-- Timeline -->
        <div class="form-card">
            <div class="section-divider"><i class="fas fa-history me-2"></i>Tracking History</div>
            @forelse($shipment->trackingEvents as $event)
            <div style="display:flex;gap:12px;margin-bottom:20px;position:relative">
                <div style="width:36px;height:36px;background:#003580;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;flex-shrink:0">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div style="flex:1;background:#f8f9ff;border-radius:10px;padding:12px 14px">
                    <div style="font-size:11px;color:#9ca3af">{{ $event->event_time->format('M d, Y — H:i') }}</div>
                    <div style="font-weight:700;font-size:14px;color:#0d1b2a;margin:2px 0">
                        {{ \App\Models\Shipment::STATUSES[$event->status] ?? $event->status }}
                    </div>
                    @if($event->location)<div style="font-size:13px;color:#003580"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</div>@endif
                    <div style="font-size:13px;color:#6c757d;margin-top:4px">{{ $event->description }}</div>
                    <form action="{{ route('admin.shipments.events.destroy', [$shipment, $event]) }}" method="POST" class="mt-2" onsubmit="return confirm('Delete event?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-link text-danger p-0" style="font-size:12px"><i class="fas fa-trash me-1"></i>Remove</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-3 text-muted" style="font-size:13px">
                <i class="fas fa-history" style="font-size:32px;opacity:.2;display:block;margin-bottom:8px"></i>
                No events yet
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
