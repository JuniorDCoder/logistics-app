<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageNotification;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $services     = Service::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->get();
        $team         = TeamMember::where('is_active', true)->orderBy('sort_order')->take(4)->get();
        return view('frontend.home', compact('services', 'testimonials', 'team'));
    }

    public function about()
    {
        $team = TeamMember::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.about', compact('team'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.services.index', compact('services'));
    }

    public function serviceDetail($slug)
    {
        $service  = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.services.show', compact('service', 'services'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactMessage::create($request->only(['name', 'email', 'phone', 'subject', 'message']));

        $adminEmail = trim((string) setting('contact_email', ''));
        if ($adminEmail !== '' && filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($adminEmail)->send(new ContactMessageNotification($contactMessage));
            } catch (\Throwable $exception) {
                Log::warning('Failed to send contact notification email.', [
                    'admin_email' => $adminEmail,
                    'error' => $exception->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'Thank you! Your message has been received. We will get back to you shortly.');
    }
}
