@extends('layouts.admin')
@section('title', 'Create Shipment')
@section('page-title', 'Create Shipment')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.shipments.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px">
        <i class="fas fa-arrow-left me-2"></i>Back to Shipments
    </a>
</div>

<form action="{{ route('admin.shipments.store') }}" method="POST">
    @csrf
    @include('admin.shipments._form', ['shipment' => null])
    <div class="mt-4 d-flex gap-3">
        <button type="submit" class="btn btn-primary px-5" style="border-radius:8px;font-weight:600"><i class="fas fa-save me-2"></i>Create Shipment</button>
        <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary" style="border-radius:8px">Cancel</a>
    </div>
</form>
@endsection
