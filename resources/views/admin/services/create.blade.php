{{-- resources/views/admin/services/create.blade.php --}}
@extends('layouts.admin')
@section('title','Create Service') @section('page-title','Create Service')
@section('content')
<div class="mb-4"><a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px"><i class="fas fa-arrow-left me-2"></i>Back</a></div>
<div class="form-card">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.services._form',['service'=>null])
        <button type="submit" class="btn btn-primary px-5 mt-4" style="border-radius:8px;font-weight:600"><i class="fas fa-save me-2"></i>Create Service</button>
    </form>
</div>
@endsection
