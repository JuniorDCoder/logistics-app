@extends('layouts.admin')
@section('title','Edit Testimonial') @section('page-title','Edit Testimonial')
@section('content')
<div class="mb-4"><a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px"><i class="fas fa-arrow-left me-2"></i>Back</a></div>
<div class="form-card">
    <form action="{{ route('admin.testimonials.update',$testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.testimonials._form',['testimonial'=>$testimonial])
        <button type="submit" class="btn btn-primary px-5 mt-4" style="border-radius:8px;font-weight:600"><i class="fas fa-save me-2"></i>Update</button>
    </form>
</div>
@endsection
