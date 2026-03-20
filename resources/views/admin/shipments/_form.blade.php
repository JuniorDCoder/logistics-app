{{-- Shared form for create/edit shipment --}}
<div class="row g-4">
    <!-- Sender -->
    <div class="col-12">
        <div class="form-card">
            <div class="section-divider"><i class="fas fa-user me-2"></i>Sender Information</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="sender_name" class="form-control @error('sender_name') is-invalid @enderror"
                        value="{{ old('sender_name', $shipment?->sender_name) }}" required>
                    @error('sender_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="sender_email" class="form-control" value="{{ old('sender_email', $shipment?->sender_email) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="sender_phone" class="form-control" value="{{ old('sender_phone', $shipment?->sender_phone) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea name="sender_address" class="form-control" rows="2">{{ old('sender_address', $shipment?->sender_address) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Receiver -->
    <div class="col-12">
        <div class="form-card">
            <div class="section-divider"><i class="fas fa-user-check me-2"></i>Receiver Information</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="receiver_name" class="form-control @error('receiver_name') is-invalid @enderror"
                        value="{{ old('receiver_name', $shipment?->receiver_name) }}" required>
                    @error('receiver_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="receiver_email" class="form-control" value="{{ old('receiver_email', $shipment?->receiver_email) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="receiver_phone" class="form-control" value="{{ old('receiver_phone', $shipment?->receiver_phone) }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea name="receiver_address" class="form-control" rows="2">{{ old('receiver_address', $shipment?->receiver_address) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipment Details -->
    <div class="col-12">
        <div class="form-card">
            <div class="section-divider"><i class="fas fa-box me-2"></i>Shipment Details</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Origin *</label>
                    <input type="text" name="origin" class="form-control @error('origin') is-invalid @enderror"
                        value="{{ old('origin', $shipment?->origin) }}" required placeholder="City, Country">
                    @error('origin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Destination *</label>
                    <input type="text" name="destination" class="form-control @error('destination') is-invalid @enderror"
                        value="{{ old('destination', $shipment?->destination) }}" required placeholder="City, Country">
                    @error('destination')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Service Type *</label>
                    <select name="service_type" class="form-select" required>
                        @foreach(\App\Models\Shipment::SERVICE_TYPES as $val => $label)
                        <option value="{{ $val }}" {{ old('service_type', $shipment?->service_type) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status *</label>
                    <select name="status" id="statusField" class="form-select" required>
                        @foreach(\App\Models\Shipment::STATUSES as $val => $label)
                        <option value="{{ $val }}" {{ old('status', $shipment?->status ?? 'pending') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" step="0.01" name="weight" class="form-control" value="{{ old('weight', $shipment?->weight) }}" placeholder="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Dimensions (LxWxH)</label>
                    <input type="text" name="dimensions" class="form-control" value="{{ old('dimensions', $shipment?->dimensions) }}" placeholder="60x40x30 cm">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Package Count</label>
                    <input type="number" name="package_count" class="form-control" min="1" value="{{ old('package_count', $shipment?->package_count ?? 1) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estimated Delivery</label>
                    <input type="date" name="estimated_delivery" class="form-control"
                        value="{{ old('estimated_delivery', $shipment?->estimated_delivery?->format('Y-m-d')) }}">
                </div>
                @if($shipment)
                <div class="col-md-4">
                    <label class="form-label">Actual Delivery</label>
                    <input type="date" name="actual_delivery" class="form-control"
                        value="{{ old('actual_delivery', $shipment?->actual_delivery?->format('Y-m-d')) }}">
                </div>
                @endif
                <div class="col-md-4">
                    <label class="form-label">Declared Value (USD)</label>
                    <input type="number" step="0.01" name="declared_value" class="form-control" value="{{ old('declared_value', $shipment?->declared_value) }}" placeholder="0.00">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cargo Description</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="What's in the package?">{{ old('description', $shipment?->description) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Internal Notes</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Private notes (not shown to customer)">{{ old('notes', $shipment?->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
