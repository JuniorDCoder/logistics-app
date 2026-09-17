@extends('layouts.admin')
@section('title','Edit Mail Template') @section('page-title','Edit Mail Template: '.$template->name)

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <form action="{{ route('admin.mail-templates.update', $template) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-card">
                <div class="section-divider">{{ $template->name }}</div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" value="{{ old('subject', $template->subject) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Body (HTML)</label>
                    <textarea name="body" class="form-control" rows="16" style="font-family:monospace;font-size:13px" required>{{ old('body', $template->body) }}</textarea>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $template->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Send this email automatically</label>
                </div>

                <button type="submit" class="btn btn-primary px-4" style="border-radius:8px;font-weight:600">
                    <i class="fas fa-save me-2"></i>Save Template
                </button>
                <a href="{{ route('admin.mail-templates.index') }}" class="btn btn-outline-secondary px-4" style="border-radius:8px;font-weight:600">Cancel</a>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="form-card mb-4">
            <div class="section-divider">Available Placeholders</div>
            <p style="font-size:13px;color:#6b7280;white-space:pre-wrap">{{ $template->description }}</p>
        </div>

        <div class="form-card">
            <div class="section-divider">Current Body Preview</div>
            <div style="border:1px solid #e5e7eb;border-radius:8px;padding:16px;font-size:14px">
                {!! $template->body !!}
            </div>
        </div>
    </div>
</div>
@endsection
