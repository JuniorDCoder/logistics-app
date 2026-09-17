@extends('layouts.admin')
@section('title','Mail Templates') @section('page-title','Mail Templates')

@section('content')
<div class="form-card">
    <div class="section-divider">Automated Shipment Emails</div>
    <p class="text-muted mb-4" style="font-size:14px">
        These emails are sent automatically to the sender and receiver of a shipment. Edit the subject and body text below —
        use the placeholder tokens shown on each template's edit page to insert dynamic values.
        Turn all shipment emails on or off globally from <a href="{{ route('admin.settings.index') }}">Settings</a>.
    </p>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>Template</th>
                <th>Subject</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($templates as $template)
            <tr>
                <td>
                    <div style="font-weight:600">{{ $template->name }}</div>
                    <small class="text-muted">{{ $template->key }}</small>
                </td>
                <td style="max-width:360px">
                    <span class="text-truncate d-inline-block" style="max-width:360px">{{ $template->subject }}</span>
                </td>
                <td>
                    @if($template->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Disabled</span>
                    @endif
                </td>
                <td class="text-end">
                    <a href="{{ route('admin.mail-templates.edit', $template) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center text-muted py-4">No mail templates found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
