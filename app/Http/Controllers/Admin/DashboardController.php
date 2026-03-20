<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_shipments'     => Shipment::count(),
            'in_transit'          => Shipment::where('status', 'in_transit')->count(),
            'delivered'           => Shipment::where('status', 'delivered')->count(),
            'pending'             => Shipment::where('status', 'pending')->count(),
            'unread_messages'     => ContactMessage::where('is_read', false)->count(),
            'total_services'      => Service::count(),
            'total_testimonials'  => Testimonial::count(),
            'total_team'          => TeamMember::count(),
        ];

        $recent_shipments = Shipment::latest()->take(10)->get();
        $recent_messages  = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_shipments', 'recent_messages'));
    }
}
