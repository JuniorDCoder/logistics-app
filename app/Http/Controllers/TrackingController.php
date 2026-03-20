<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('frontend.tracking');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        $shipment = Shipment::with('trackingEvents')
            ->where('tracking_number', strtoupper(trim($request->tracking_number)))
            ->first();

        if (!$shipment) {
            return back()->with('error', 'No shipment found with tracking number: ' . $request->tracking_number);
        }

        return view('frontend.tracking', compact('shipment'));
    }
}
