{{-- create.blade.php --}}
@extends('layouts.admin')
@section('title','New Team Member') @section('page-title','New Team Member')
@section('content')
<div class="mb-4"><a href="{{ route('admin.team.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px"><i class="fas fa-arrow-left me-2"></i>Back</a></div>
<div class="form-card">
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.team._form',['team'=>null])
        <button type="submit" class="btn btn-primary px-5 mt-4" style="border-radius:8px;font-weight:600"><i class="fas fa-save me-2"></i>Add Member</button>
    </form>
</div>
@endsection
