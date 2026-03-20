@extends('layouts.app')
@section('title', 'Track & Trace')

@push('styles')
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""
/>
<style>
.timeline { position: relative; padding: 0; }
.timeline::before {
    content: '';
    position: absolute;
    left: 22px; top: 0; bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, var(--primary), var(--accent));
}
.timeline-item {
    display: flex; gap: 24px;
    margin-bottom: 28px;
    position: relative;
}
.timeline-dot {
    width: 46px; height: 46px;
    border-radius: 50%;
    background: var(--primary);
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px var(--primary);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 16px;
    flex-shrink: 0; z-index: 1;
}
.timeline-dot.current {
    background: var(--accent);
    box-shadow: 0 0 0 3px var(--accent);
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%,100% { box-shadow: 0 0 0 3px var(--accent); }
    50%      { box-shadow: 0 0 0 8px rgba(232,160,0,.25); }
}
.timeline-body {
    background: #fff;
    border-radius: 12px;
    padding: 18px 22px;
    box-shadow: 0 2px 12px rgba(0,53,128,.07);
    flex: 1;
    border-left: 3px solid transparent;
}
.timeline-item:first-child .timeline-body { border-left-color: var(--accent); }
.timeline-body .event-time { font-size: 12px; color: var(--gray); margin-bottom: 4px; }
.timeline-body .event-status { font-size: 16px; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
.timeline-body .event-location { font-size: 13px; color: var(--primary); margin-bottom: 6px; }
.timeline-body .event-desc { font-size: 14px; color: var(--gray); }

.track-info-card {
    background: var(--primary);
    border-radius: 14px;
    color: #fff;
    padding: 28px;
}
.track-info-card .label { font-size: 11px; opacity: .65; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.track-info-card .value { font-weight: 600; font-size: 15px; }

.progress-steps {
    display: flex; align-items: center; justify-content: space-between;
    position: relative; margin-bottom: 40px;
}
.progress-steps::before {
    content: '';
    position: absolute; left: 0; right: 0; top: 20px;
    height: 3px; background: #e5e7eb; z-index: 0;
}
.progress-steps .progress-fill {
    position: absolute; left: 0; top: 20px;
    height: 3px; background: var(--primary); z-index: 1;
    transition: width 1s ease;
}
.p-step { text-align: center; position: relative; z-index: 2; flex: 1; }
.p-step-dot {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: #e5e7eb;
    border: 3px solid #fff;
    margin: 0 auto 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; color: #9ca3af;
    transition: all .4s;
}
.p-step.done .p-step-dot   { background: var(--primary); color: #fff; }
.p-step.active .p-step-dot { background: var(--accent); color: var(--dark); }
.p-step-label { font-size: 11px; font-weight: 600; color: var(--gray); text-transform: uppercase; letter-spacing: .5px; }
.p-step.done .p-step-label,
.p-step.active .p-step-label { color: var(--primary); }

.tracking-map-wrap {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: var(--shadow);
    margin-bottom: 22px;
}
.tracking-map-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 14px;
}
.tracking-map-head h6 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: var(--dark);
}
.tracking-map-badge {
    border-radius: 999px;
    background: rgba(0, 53, 128, 0.08);
    color: var(--primary);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 6px 10px;
}
#tracking-live-map {
    height: 320px;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}
.map-location-label {
    margin-top: 12px;
    font-size: 13px;
    color: var(--gray);
}
</style>
@endpush

@section('content')

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Track & Trace</li>
            </ol>
        </nav>
        <h1 data-aos="fade-up"><i class="fas fa-search-location me-3" style="color:var(--accent)"></i>Track Your Shipment</h1>
        <p style="opacity:.8;max-width:500px;margin-top:12px" data-aos="fade-up" data-aos-delay="100">Enter your tracking number to get real-time updates on your shipment status.</p>
    </div>
</div>

<section style="padding:70px 0;background:var(--light)">
    <div class="container">
        <!-- Search Form -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7" data-aos="fade-up">
                <div style="background:#fff;border-radius:16px;padding:36px;box-shadow:0 4px 24px rgba(0,53,128,.1)">
                    <h4 style="font-size:22px;color:var(--dark);margin-bottom:20px"><i class="fas fa-barcode me-2" style="color:var(--accent)"></i>Enter Tracking Number</h4>
                    <form action="{{ route('track.search') }}" method="POST">
                        @csrf
                        <div class="input-group" style="border:2px solid #e5e7eb;border-radius:10px;overflow:hidden">
                            <span class="input-group-text" style="background:#fff;border:none;padding:14px 18px;color:var(--primary)"><i class="fas fa-search"></i></span>
                            <input type="text" name="tracking_number" class="form-control" style="border:none;padding:14px 0;font-size:16px;outline:none;box-shadow:none" placeholder="e.g. {{ \App\Models\Shipment::demoTrackingNumber() }}" value="{{ request('tracking_number') }}" required>
                            <button type="submit" style="background:var(--primary);color:#fff;border:none;padding:14px 28px;font-family:'Barlow Condensed',sans-serif;font-size:16px;font-weight:700;text-transform:uppercase;letter-spacing:.5px">
                                Track Now
                            </button>
                        </div>
                        @error('tracking_number')
                        <div class="text-danger mt-2 small">{{ $message }}</div>
                        @enderror
                    </form>
                    <p class="mb-0 mt-3" style="font-size:13px;color:var(--gray)"><i class="fas fa-info-circle me-1" style="color:var(--accent)"></i>Ex: <strong>{{ \App\Models\Shipment::demoTrackingNumber() }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Result -->
        @isset($shipment)
        <div data-aos="fade-up">
            <!-- Progress Bar -->
            @php
            $statusOrder = ['pending','picked_up','in_transit','at_customs','out_for_delivery','delivered'];
            $currentIdx  = array_search($shipment->status, $statusOrder) ?: 0;
            $progressPct = round(($currentIdx / (count($statusOrder)-1)) * 100);
            $stepIcons   = ['fa-clock','fa-box','fa-shipping-fast','fa-stamp','fa-truck','fa-check-circle'];
            $mapEvents = $shipment->trackingEvents
                ->filter(fn ($event) => filled($event->location))
                ->sortBy('event_time')
                ->values()
                ->map(fn ($event) => [
                    'location' => $event->location,
                    'status' => \App\Models\Shipment::STATUSES[$event->status] ?? ucfirst(str_replace('_', ' ', $event->status)),
                    'description' => $event->description,
                    'event_time' => $event->event_time?->format('M d, Y H:i'),
                ]);
            @endphp

            <div style="background:#fff;border-radius:16px;padding:36px;box-shadow:var(--shadow);margin-bottom:32px">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div>
                        <div style="font-size:12px;color:var(--gray);text-transform:uppercase;letter-spacing:1px;margin-bottom:6px">Tracking Number</div>
                        <div style="font-size:26px;font-family:'Barlow Condensed',sans-serif;font-weight:800;color:var(--primary)">{{ $shipment->tracking_number }}</div>
                    </div>
                    <div>
                        <span class="badge badge-status bg-{{ $shipment->status_color }}" style="font-size:14px;padding:8px 18px;border-radius:30px">
                            {{ $shipment->status_label }}
                        </span>
                    </div>
                </div>

                <div class="progress-steps">
                    <div class="progress-fill" style="width:{{ $progressPct }}%"></div>
                    @foreach($statusOrder as $idx => $s)
                    <div class="p-step {{ $idx < $currentIdx ? 'done' : ($idx == $currentIdx ? 'active' : '') }}">
                        <div class="p-step-dot">
                            <i class="fas {{ $stepIcons[$idx] }}"></i>
                        </div>
                        <div class="p-step-label d-none d-md-block">{{ \App\Models\Shipment::STATUSES[$s] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="row g-4">
                <!-- Info Cards -->
                <div class="col-lg-4">
                    <div class="track-info-card mb-4">
                        <div class="label"><i class="fas fa-route me-1"></i>Route</div>
                        <div class="value mt-2">
                            <div><i class="fas fa-map-marker me-2" style="color:var(--accent)"></i>{{ $shipment->origin }}</div>
                            <div style="margin:8px 0;border-left:2px solid rgba(255,255,255,.2);padding-left:18px;color:rgba(255,255,255,.6);font-size:13px">via {{ \App\Models\Shipment::SERVICE_TYPES[$shipment->service_type] ?? $shipment->service_type }}</div>
                            <div><i class="fas fa-flag-checkered me-2" style="color:var(--accent)"></i>{{ $shipment->destination }}</div>
                        </div>
                    </div>

                    <div style="background:#fff;border-radius:14px;padding:22px;box-shadow:var(--shadow)">
                        <h6 style="font-size:14px;font-weight:700;color:var(--dark);text-transform:uppercase;letter-spacing:1px;margin-bottom:16px">Shipment Details</h6>
                        <div class="row g-2">
                            @foreach([
                                ['Service',   \App\Models\Shipment::SERVICE_TYPES[$shipment->service_type] ?? $shipment->service_type],
                                ['Sender',    $shipment->sender_name],
                                ['Receiver',  $shipment->receiver_name],
                                ['Packages',  $shipment->package_count.' pcs'],
                                ['Weight',    $shipment->weight ? $shipment->weight.' kg' : '—'],
                                ['Est. Delivery', $shipment->estimated_delivery ? $shipment->estimated_delivery->format('M d, Y') : '—'],
                            ] as $row)
                            <div class="col-6">
                                <div style="font-size:11px;color:var(--gray);text-transform:uppercase;letter-spacing:.5px">{{ $row[0] }}</div>
                                <div style="font-size:14px;font-weight:600;color:var(--dark)">{{ $row[1] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="col-lg-8">
                    <div class="tracking-map-wrap">
                        <div class="tracking-map-head">
                            <h6><i class="fas fa-map-marked-alt me-2" style="color:var(--primary)"></i>Live Shipment Location</h6>
                            <span class="tracking-map-badge">Map View</span>
                        </div>
                        <div id="tracking-live-map" data-events='@json($mapEvents)'></div>
                        <div id="map-location-label" class="map-location-label">
                            <i class="fas fa-spinner fa-spin me-1" style="color:var(--accent)"></i>Locating shipment on the map...
                        </div>
                    </div>

                    <div style="background:#fff;border-radius:14px;padding:28px;box-shadow:var(--shadow)">
                        <h6 style="font-size:16px;font-weight:700;color:var(--dark);margin-bottom:24px"><i class="fas fa-history me-2" style="color:var(--primary)"></i>Tracking History</h6>
                        @if($shipment->trackingEvents->count() > 0)
                        <div class="timeline">
                            @foreach($shipment->trackingEvents as $i => $event)
                            <div class="timeline-item">
                                <div class="timeline-dot {{ $i === 0 ? 'current' : '' }}">
                                    <i class="fas {{ $i === 0 ? 'fa-map-marker-alt' : 'fa-check' }}"></i>
                                </div>
                                <div class="timeline-body">
                                    <div class="event-time"><i class="far fa-clock me-1"></i>{{ $event->event_time->format('M d, Y — H:i') }}</div>
                                    <div class="event-status">{{ \App\Models\Shipment::STATUSES[$event->status] ?? ucfirst($event->status) }}</div>
                                    @if($event->location)
                                    <div class="event-location"><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</div>
                                    @endif
                                    <div class="event-desc">{{ $event->description }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-4" style="color:var(--gray)">
                            <i class="fas fa-history" style="font-size:40px;opacity:.3;margin-bottom:12px;display:block"></i>
                            No tracking events yet.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </div>
</section>
@endsection

@push('scripts')
<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""
></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const mapElement = document.getElementById('tracking-live-map');
    const mapLabel = document.getElementById('map-location-label');

    if (!mapElement || typeof L === 'undefined') {
        return;
    }

    const events = JSON.parse(mapElement.dataset.events || '[]').filter((event) => event.location);

    if (!events.length) {
        mapLabel.innerHTML = '<i class="fas fa-info-circle me-1" style="color:var(--accent)"></i>No location updates available yet.';
        return;
    }

    const map = L.map(mapElement, {scrollWheelZoom: false});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const geocode = async (location) => {
        const endpoint = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(location)}`;
        const response = await fetch(endpoint, {
            headers: {'Accept': 'application/json'}
        });

        if (!response.ok) {
            return null;
        }

        const payload = await response.json();
        if (!payload.length) {
            return null;
        }

        return {
            lat: Number(payload[0].lat),
            lng: Number(payload[0].lon)
        };
    };

    const resolvedPoints = [];

    const resolveLocations = async () => {
        for (const event of events) {
            try {
                const point = await geocode(event.location);
                if (point) {
                    resolvedPoints.push({...event, ...point});
                }
            } catch (error) {
                // Skip geocoding failures and continue with other events.
            }
        }

        if (!resolvedPoints.length) {
            map.setView([20, 0], 2);
            mapLabel.innerHTML = '<i class="fas fa-exclamation-circle me-1" style="color:var(--accent)"></i>Unable to resolve map coordinates for current tracking updates.';
            return;
        }

        const latLngs = resolvedPoints.map((point) => [point.lat, point.lng]);
        L.polyline(latLngs, {
            color: '#003580',
            weight: 4,
            opacity: 0.75
        }).addTo(map);

        resolvedPoints.forEach((point, index) => {
            const isLatest = index === resolvedPoints.length - 1;
            const marker = L.circleMarker([point.lat, point.lng], {
                radius: isLatest ? 9 : 6,
                color: isLatest ? '#c47f00' : '#003580',
                fillColor: isLatest ? '#e8a000' : '#1d4f9f',
                fillOpacity: 0.95,
                weight: isLatest ? 3 : 2,
            }).addTo(map);

            marker.bindPopup(
                `<strong>${isLatest ? 'Current position' : point.status}</strong><br>${point.location}<br><small>${point.event_time || ''}</small>`
            );
        });

        if (latLngs.length === 1) {
            map.setView(latLngs[0], 5);
        } else {
            map.fitBounds(latLngs, {padding: [30, 30]});
        }

        const latest = resolvedPoints[resolvedPoints.length - 1];
        mapLabel.innerHTML = `<i class="fas fa-location-dot me-1" style="color:var(--accent)"></i>Current location: <strong>${latest.location}</strong> (${latest.status})`;
    };

    resolveLocations();
});
</script>
@endpush
