@extends('layouts.admin')
@section('title', 'Edit Shipment')
@section('page-title', 'Edit Shipment')

@section('content')
<div class="mb-4 d-flex gap-2">
    <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
        <i class="fas fa-arrow-left me-2"></i>Back to Shipment
    </a>
</div>

<form action="{{ route('admin.shipments.update', $shipment) }}" method="POST">
    @csrf @method('PUT')

    @if($shipment->status !== request('_old_status', $shipment->status))
    <div class="form-card mb-4" style="border-left:4px solid #e8a000">
        <h6 class="section-divider">Status Change Note (optional)</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Event Location</label>
                <input type="text" name="event_location" class="form-control" placeholder="e.g. London, UK" value="{{ old('event_location') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Event Description</label>
                <input type="text" name="event_description" class="form-control" placeholder="What happened at this stage?" value="{{ old('event_description') }}">
            </div>
        </div>
        <small class="text-muted d-block mt-2">A tracking event will be auto-added when you change the status.</small>
    </div>
    @endif

    @include('admin.shipments._form', ['shipment' => $shipment])

    <div class="mt-4 d-flex gap-3">
        <button type="submit" class="btn btn-primary px-5" style="border-radius:8px;font-weight:600"><i class="fas fa-save me-2"></i>Update Shipment</button>
        <a href="{{ route('admin.shipments.show', $shipment) }}" class="btn btn-outline-secondary" style="border-radius:8px">Cancel</a>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Show status-change note when status field changes
const statusSelect = document.getElementById('statusField');
if (statusSelect) {
    statusSelect.addEventListener('change', function() {
        // Could show/hide a dynamic note panel here
    });
}
</script>
@endpush
