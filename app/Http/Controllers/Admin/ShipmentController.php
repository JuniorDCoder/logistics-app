<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\TrackingEvent;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Shipment::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('tracking_number', 'like', "%$s%")
                  ->orWhere('sender_name', 'like', "%$s%")
                  ->orWhere('receiver_name', 'like', "%$s%")
                  ->orWhere('origin', 'like', "%$s%")
                  ->orWhere('destination', 'like', "%$s%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        $shipments = $query->latest()->paginate(15)->withQueryString();
        return view('admin.shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('admin.shipments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name'       => 'required|string|max:255',
            'sender_email'      => 'nullable|email',
            'sender_phone'      => 'nullable|string|max:50',
            'sender_address'    => 'nullable|string',
            'receiver_name'     => 'required|string|max:255',
            'receiver_email'    => 'nullable|email',
            'receiver_phone'    => 'nullable|string|max:50',
            'receiver_address'  => 'nullable|string',
            'origin'            => 'required|string|max:255',
            'destination'       => 'required|string|max:255',
            'service_type'      => 'required|string',
            'weight'            => 'nullable|numeric',
            'dimensions'        => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'required|string',
            'estimated_delivery'=> 'nullable|date',
            'package_count'     => 'nullable|integer|min:1',
            'declared_value'    => 'nullable|numeric',
            'notes'             => 'nullable|string',
        ]);

        $validated['tracking_number'] = Shipment::generateTrackingNumber();

        $shipment = Shipment::create($validated);

        // Auto-create first tracking event
        TrackingEvent::create([
            'shipment_id' => $shipment->id,
            'status'      => $validated['status'],
            'location'    => $validated['origin'],
            'description' => 'Shipment created and registered in the system.',
            'event_time'  => now(),
        ]);

        return redirect()->route('admin.shipments.show', $shipment)
            ->with('success', "Shipment created! Tracking #: {$shipment->tracking_number}");
    }

    public function show(Shipment $shipment)
    {
        $shipment->load('trackingEvents');
        return view('admin.shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        return view('admin.shipments.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'sender_name'       => 'required|string|max:255',
            'sender_email'      => 'nullable|email',
            'sender_phone'      => 'nullable|string|max:50',
            'sender_address'    => 'nullable|string',
            'receiver_name'     => 'required|string|max:255',
            'receiver_email'    => 'nullable|email',
            'receiver_phone'    => 'nullable|string|max:50',
            'receiver_address'  => 'nullable|string',
            'origin'            => 'required|string|max:255',
            'destination'       => 'required|string|max:255',
            'service_type'      => 'required|string',
            'weight'            => 'nullable|numeric',
            'dimensions'        => 'nullable|string',
            'description'       => 'nullable|string',
            'status'            => 'required|string',
            'estimated_delivery'=> 'nullable|date',
            'actual_delivery'   => 'nullable|date',
            'package_count'     => 'nullable|integer|min:1',
            'declared_value'    => 'nullable|numeric',
            'notes'             => 'nullable|string',
        ]);

        // If status changed, add tracking event
        if ($shipment->status !== $validated['status']) {
            TrackingEvent::create([
                'shipment_id' => $shipment->id,
                'status'      => $validated['status'],
                'location'    => $request->input('event_location', $validated['destination']),
                'description' => $request->input('event_description', 'Shipment status updated to: ' . (Shipment::STATUSES[$validated['status']] ?? $validated['status'])),
                'event_time'  => now(),
            ]);
        }

        $shipment->update($validated);

        return redirect()->route('admin.shipments.show', $shipment)
            ->with('success', 'Shipment updated successfully.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('admin.shipments.index')
            ->with('success', 'Shipment deleted successfully.');
    }

    // Tracking Events CRUD
    public function storeEvent(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'status'      => 'required|string',
            'location'    => 'nullable|string|max:255',
            'description' => 'required|string',
            'event_time'  => 'required|date',
        ]);

        TrackingEvent::create(array_merge($validated, ['shipment_id' => $shipment->id]));

        // Update shipment status
        $shipment->update(['status' => $validated['status']]);

        return back()->with('success', 'Tracking event added.');
    }

    public function destroyEvent(Shipment $shipment, TrackingEvent $event)
    {
        $event->delete();
        return back()->with('success', 'Tracking event deleted.');
    }
}
