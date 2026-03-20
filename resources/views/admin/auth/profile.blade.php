@extends('layouts.admin')
@section('title','My Profile') @section('page-title','My Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="form-card">
            <div class="section-divider"><i class="fas fa-user-circle me-2"></i>Profile Information</div>
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                </div>

                <div class="section-divider mt-4"><i class="fas fa-lock me-2"></i>Change Password</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-5" style="border-radius:8px;font-weight:600">
                        <i class="fas fa-save me-2"></i>Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
