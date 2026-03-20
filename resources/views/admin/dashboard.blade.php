@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-5">
    @php
    $cards = [
        ['label'=>'Total Shipments','val'=>$stats['total_shipments'],'icon'=>'fa-boxes','class'=>'','link'=>route('admin.shipments.index')],
        ['label'=>'In Transit',     'val'=>$stats['in_transit'],     'icon'=>'fa-shipping-fast','class'=>'info','link'=>route('admin.shipments.index').'?status=in_transit'],
        ['label'=>'Delivered',      'val'=>$stats['delivered'],      'icon'=>'fa-check-circle','class'=>'success','link'=>route('admin.shipments.index').'?status=delivered'],
        ['label'=>'Pending',        'val'=>$stats['pending'],        'icon'=>'fa-clock','class'=>'warning','link'=>route('admin.shipments.index').'?status=pending'],
        ['label'=>'Unread Messages','val'=>$stats['unread_messages'],'icon'=>'fa-envelope','class'=>'danger','link'=>route('admin.messages.index')],
        ['label'=>'Services',       'val'=>$stats['total_services'], 'icon'=>'fa-concierge-bell','class'=>'accent','link'=>route('admin.services.index')],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="col-6 col-lg-4 col-xl-2">
        <a href="{{ $card['link'] }}" style="text-decoration:none">
            <div class="stat-card {{ $card['class'] }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3>{{ $card['val'] }}</h3>
                        <p>{{ $card['label'] }}</p>
                    </div>
                    <i class="fas {{ $card['icon'] }} stat-icon" style="font-size:28px;opacity:.15"></i>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="row g-4">
    <!-- Recent Shipments -->
    <div class="col-lg-8">
        <div class="admin-table">
            <div style="padding:20px 22px;border-bottom:1px solid #f0f2f8;display:flex;justify-content:space-between;align-items:center">
                <h6 style="font-family:'Barlow Condensed',sans-serif;font-size:17px;font-weight:700;color:#0d1b2a;margin:0">Recent Shipments</h6>
                <a href="{{ route('admin.shipments.index') }}" style="font-size:13px;color:var(--primary);font-weight:600;text-decoration:none">View All →</a>
            </div>
            <table class="table mb-0">
                <thead><tr><th>Tracking #</th><th>Sender</th><th>Destination</th><th>Status</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($recent_shipments as $s)
                    <tr>
                        <td><a href="{{ route('admin.shipments.show',$s) }}" style="color:var(--primary);font-weight:700;font-family:'Barlow Condensed',sans-serif">{{ $s->tracking_number }}</a></td>
                        <td>{{ $s->sender_name }}</td>
                        <td>{{ $s->destination }}</td>
                        <td><span class="badge badge-status bg-{{ $s->status_color }}">{{ $s->status_label }}</span></td>
                        <td style="color:#6c757d;font-size:13px">{{ $s->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">No shipments yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="col-lg-4">
        <div class="admin-table">
            <div style="padding:20px 22px;border-bottom:1px solid #f0f2f8;display:flex;justify-content:space-between;align-items:center">
                <h6 style="font-family:'Barlow Condensed',sans-serif;font-size:17px;font-weight:700;color:#0d1b2a;margin:0">Messages</h6>
                <a href="{{ route('admin.messages.index') }}" style="font-size:13px;color:var(--primary);font-weight:600;text-decoration:none">View All →</a>
            </div>
            @forelse($recent_messages as $m)
            <a href="{{ route('admin.messages.show',$m) }}" style="display:block;padding:14px 22px;border-bottom:1px solid #f0f2f8;text-decoration:none;{{ !$m->is_read ? 'background:#f8f9ff;' : '' }}">
                <div style="font-size:14px;font-weight:{{ !$m->is_read ? '700' : '500' }};color:#1f2937">{{ $m->name }}</div>
                <div style="font-size:12px;color:#6c757d;margin-top:2px">{{ Str::limit($m->message, 60) }}</div>
                <div style="font-size:11px;color:#9ca3af;margin-top:4px">{{ $m->created_at->diffForHumans() }}</div>
            </a>
            @empty
            <div class="text-center py-4 text-muted" style="font-size:13px">No messages</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div style="background:#fff;border-radius:12px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.06);margin-top:24px">
    <h6 style="font-family:'Barlow Condensed',sans-serif;font-size:17px;font-weight:700;color:#0d1b2a;margin-bottom:16px">Quick Actions</h6>
    <div class="d-flex gap-3 flex-wrap">
        <a href="{{ route('admin.shipments.create') }}" class="btn btn-primary btn-sm" style="border-radius:8px;font-weight:600"><i class="fas fa-plus me-2"></i>New Shipment</a>
        <a href="{{ route('admin.services.create') }}"  class="btn btn-outline-primary btn-sm" style="border-radius:8px;font-weight:600"><i class="fas fa-plus me-2"></i>New Service</a>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-secondary btn-sm" style="border-radius:8px;font-weight:600"><i class="fas fa-plus me-2"></i>New Testimonial</a>
        <a href="{{ route('admin.settings.index') }}"  class="btn btn-outline-warning btn-sm" style="border-radius:8px;font-weight:600"><i class="fas fa-cog me-2"></i>Settings</a>
        <a href="{{ route('track') }}" target="_blank" class="btn btn-outline-success btn-sm" style="border-radius:8px;font-weight:600"><i class="fas fa-search-location me-2"></i>Track Page</a>
    </div>
</div>
@endsection
