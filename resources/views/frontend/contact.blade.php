@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<div class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.7)">Home</a></li>
                <li class="breadcrumb-item active" style="color:var(--accent)">Contact</li>
            </ol>
        </nav>
        <h1 data-aos="fade-up">Contact Us</h1>
        <p style="opacity:.8;max-width:500px;margin-top:10px" data-aos="fade-up" data-aos-delay="100">Our team is ready to help with all your logistics needs.</p>
    </div>
</div>

<section style="padding:90px 0;background:var(--light)">
    <div class="container">
        <div class="row g-5">
            <!-- Info -->
            <div class="col-lg-4" data-aos="fade-right">
                <h3 style="font-size:28px;color:var(--dark);margin-bottom:24px">Get In Touch</h3>
                @php
                    $contactInfo = array_values(array_filter([
                        ($email = trim((string) setting('contact_email', ''))) !== '' ? ['icon'=>'fa-envelope','title'=>'Email Us','val'=>$email,'href'=>'mailto:'.$email] : null,
                        ($phone = trim((string) setting('contact_phone', ''))) !== '' ? ['icon'=>'fa-phone','title'=>'Call Us','val'=>$phone,'href'=>'tel:'.$phone] : null,
                        ($address = trim((string) setting('contact_address', ''))) !== '' ? ['icon'=>'fa-map-marker-alt','title'=>'Our Office','val'=>$address,'href'=>'#'] : null,
                        ($hours = trim((string) setting('office_hours', ''))) !== '' ? ['icon'=>'fa-clock','title'=>'Office Hours','val'=>$hours,'href'=>'#'] : null,
                    ]));
                @endphp

                @forelse($contactInfo as $info)
                <div style="display:flex;gap:16px;margin-bottom:24px;background:#fff;border-radius:12px;padding:20px;box-shadow:0 2px 12px rgba(0,53,128,.07)">
                    <div style="width:48px;height:48px;background:var(--light);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--primary);flex-shrink:0">
                        <i class="fas {{ $info['icon'] }}"></i>
                    </div>
                    <div>
                        <div style="font-size:12px;color:var(--gray);text-transform:uppercase;letter-spacing:1px">{{ $info['title'] }}</div>
                        <a href="{{ $info['href'] }}" style="color:var(--dark);font-weight:600;font-size:15px">{{ $info['val'] }}</a>
                    </div>
                </div>
                @empty
                <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 2px 12px rgba(0,53,128,.07);color:var(--gray)">
                    Contact information will be published soon.
                </div>
                @endforelse
            </div>

            <!-- Form -->
            <div class="col-lg-8" data-aos="fade-left">
                <div style="background:#fff;border-radius:16px;padding:40px;box-shadow:0 4px 24px rgba(0,53,128,.08)">
                    <h3 style="font-size:28px;color:var(--dark);margin-bottom:6px">Send Us a Message</h3>
                    <p style="color:var(--gray);margin-bottom:28px">We'll get back to you within 24 hours.</p>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-600">Your Name *</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="John Doe">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600">Email Address *</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="john@example.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600">Subject</label>
                                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="e.g. Air Freight Inquiry">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-600">Message *</label>
                                <textarea name="message" rows="6" class="form-control @error('message') is-invalid @enderror" required placeholder="Tell us about your shipment or inquiry...">{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-primary-custom"><i class="fas fa-paper-plane"></i> Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
