@extends('layouts.app')
@section('title', 'Home')

@push('styles')
<style>
/* ─── Hero ─────────────────────────────── */
.hero {
    background: linear-gradient(135deg, var(--primary-dark) 0%, #00204a 50%, #001535 100%);
    min-height: 92vh;
    display: flex; align-items: center;
    position: relative; overflow: hidden;
    color: #fff;
}
.hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(232,160,0,0.04)" fill-opacity="1" d="M0,160L48,154.7C96,149,192,139,288,154.7C384,171,480,213,576,208C672,203,768,149,864,133.3C960,117,1056,139,1152,154.7C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center / cover;
}
.hero-circle-1 { position:absolute; width:600px; height:600px; border-radius:50%; border:1px solid rgba(232,160,0,.1); top:-200px; right:-100px; }
.hero-circle-2 { position:absolute; width:400px; height:400px; border-radius:50%; border:1px solid rgba(232,160,0,.07); top:-100px; right:50px; }
.hero-circle-3 { position:absolute; width:250px; height:250px; border-radius:50%; background:rgba(232,160,0,.05); bottom:50px; left:-80px; }

.hero-label {
    display: inline-flex; align-items: center; gap: 10px;
    background: rgba(232,160,0,.15);
    border: 1px solid rgba(232,160,0,.3);
    color: var(--accent);
    font-size: 12px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase;
    padding: 8px 18px; border-radius: 30px;
    margin-bottom: 24px;
}
.hero h1 {
    font-size: clamp(36px, 5.5vw, 72px);
    line-height: 1.1;
    font-weight: 800;
    margin-bottom: 24px;
}
.hero h1 span { color: var(--accent); }
.hero p { font-size: 17px; opacity: .85; max-width: 560px; line-height: 1.75; margin-bottom: 36px; }

.hero-ctas { display: flex; gap: 16px; flex-wrap: wrap; }

/* Track form in hero */
.hero-track-form {
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 14px;
    padding: 28px;
    margin-top: 50px;
}
.hero-track-form h5 { font-size: 14px; color: rgba(255,255,255,.7); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 14px; }
.hero-track-form .input-group .form-control {
    border-radius: 8px 0 0 8px !important;
    border: none; padding: 14px 18px;
    font-size: 15px;
}
.hero-track-form .input-group .btn {
    background: var(--accent); color: var(--dark);
    border: none; padding: 0 28px; font-weight: 700;
    border-radius: 0 8px 8px 0 !important;
}

/* Hero image side */
.hero-visual {
    position: relative;
}
.hero-visual img {
    border-radius: 20px;
    box-shadow: 0 30px 60px rgba(0,0,0,.4);
    width: 100%;
}
.hero-badge {
    position: absolute;
    background: #fff;
    border-radius: 12px;
    padding: 14px 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.2);
    display: flex; align-items: center; gap: 12px;
}
.hero-badge.b1 { bottom: -20px; left: -30px; }
.hero-badge.b2 { top: 30px; right: -30px; }
.hero-badge .badge-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
.hero-badge .badge-text div:first-child { font-weight: 700; font-size: 18px; color: var(--dark); }
.hero-badge .badge-text div:last-child  { font-size: 12px; color: var(--gray); }

/* ─── Who We Are ──────────────────────── */
.feature-list li {
    display: flex; align-items: flex-start; gap: 14px;
    margin-bottom: 20px; font-size: 15px; color: #4a5568; line-height: 1.6;
}
.feature-list .icon { width: 40px; height: 40px; background: var(--light); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--primary); flex-shrink: 0; }

/* ─── Process Steps ───────────────────── */
.process-section { background: var(--light); }
.step-card {
    text-align: center; padding: 36px 24px;
    position: relative;
}
.step-num {
    width: 56px; height: 56px;
    background: var(--primary);
    color: #fff; font-family: 'Barlow Condensed',sans-serif;
    font-size: 22px; font-weight: 800;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px;
}
.step-arrow {
    position: absolute; top: 56px; right: -28px;
    font-size: 22px; color: var(--accent); opacity: .5;
}

/* ─── CTA Section ─────────────────────── */
.cta-section {
    background: linear-gradient(135deg, var(--accent) 0%, #f0b412 100%);
    padding: 80px 0;
}
.cta-section h2 { font-size: clamp(28px, 4vw, 44px); color: var(--dark); }
.cta-section p  { color: rgba(0,0,0,.7); font-size: 17px; }
</style>
@endpush

@section('content')

<!-- ─── Hero ──────────────────────────────────────── -->
<section class="hero">
    <div class="hero-circle-1"></div>
    <div class="hero-circle-2"></div>
    <div class="hero-circle-3"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-5 py-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-label">
                    <i class="fas fa-globe-americas"></i>
                    Global Logistics Partner
                </div>
                <h1>{{ setting('hero_title','Professional Logistics Services with Seamless Process') }}</h1>
                <p>{{ setting('hero_subtitle','Our digital freight platform delivers value throughout your supply chain, successfully integrating our TMS with your systems.') }}</p>
                <div class="hero-ctas">
                    <a href="{{ route('services') }}" class="btn-primary-custom" style="background:var(--accent);color:var(--dark)">
                        <i class="fas fa-concierge-bell"></i> Our Services
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline-custom">
                        <i class="fas fa-headset"></i> Contact Us
                    </a>
                </div>

                <div class="hero-track-form mt-5">
                    <h5><i class="fas fa-search-location me-2"></i> Track Your Shipment</h5>
                    <form action="{{ route('track.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="tracking_number" class="form-control" placeholder="Enter tracking number (e.g. {{ \App\Models\Shipment::demoTrackingNumber() }})" required>
                            <button type="submit" class="btn"><i class="fas fa-search me-2"></i>Track</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left" data-aos-delay="200">
                <div class="hero-visual">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&q=80" alt="Logistics">
                    <div class="hero-badge b1">
                        <div class="badge-icon" style="background:#e8f4ff;color:var(--primary)"><i class="fas fa-boxes"></i></div>
                        <div class="badge-text">
                            <div>2,000+</div>
                            <div>Active Shipments</div>
                        </div>
                    </div>
                    <div class="hero-badge b2">
                        <div class="badge-icon" style="background:#fff8e6;color:var(--accent)"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="badge-text">
                            <div>150+</div>
                            <div>Countries Served</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── Stats ─────────────────────────────────────── -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-12 col-lg-3" data-aos="fade-up">
                <div class="stat-item">
                    <span class="stat-number" data-count="{{ setting('stats_years','15') }}">0</span>
                    <div class="stat-label">Years of Experience</div>
                </div>
            </div>
            <div class="col-12 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-item">
                    <span class="stat-number" data-count="{{ setting('stats_workers','2000') }}">0</span>
                    <div class="stat-label">Company Workers</div>
                </div>
            </div>
            <div class="col-12 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-item">
                    <span class="stat-number" data-count="{{ setting('stats_shipments','50') }}">0</span>
                    <span style="font-size:40px;color:var(--accent);font-weight:800">k</span>
                    <div class="stat-label">Monthly Shipments</div>
                </div>
            </div>
            <div class="col-12 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-item">
                    <span class="stat-number" data-count="{{ setting('stats_customers','98') }}">0</span>
                    <span style="font-size:40px;color:var(--accent);font-weight:800">%</span>
                    <div class="stat-label">Satisfied Customers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── About / Who We Are ────────────────────────── -->
<section class="py-6" style="padding:90px 0">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div style="position:relative">
                    <img src="https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=700&q=80" alt="About" style="border-radius:16px;width:100%;box-shadow:0 20px 50px rgba(0,53,128,.15)">
                    <div style="position:absolute;bottom:-20px;right:-20px;background:var(--primary);color:#fff;border-radius:12px;padding:20px 24px;text-align:center">
                        <div style="font-family:'Barlow Condensed',sans-serif;font-size:42px;font-weight:800;color:var(--accent)">15+</div>
                        <div style="font-size:13px;opacity:.8">Years of Excellence</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="section-label">Who We Are</div>
                <h2 class="section-title mb-4">Competitively Priced Services for Your Business</h2>
                <p style="color:var(--gray);font-size:16px;line-height:1.75;margin-bottom:30px">
                    {{ app_name() }} has 2,000+ top logistics providers in our network. Multiple transportation modes are available so you can compare and choose the one that fits your budget and timeframe. We deliver flexible logistics solutions in air freight, sea freight, rail freight, courier, trucking, FCL, LCL, DDP, and DDU.
                </p>
                <ul class="feature-list list-unstyled">
                    <li><div class="icon"><i class="fas fa-plane"></i></div><div><strong>Air Freight</strong> — Fast and reliable air cargo for time-sensitive shipments worldwide.</div></li>
                    <li><div class="icon"><i class="fas fa-ship"></i></div><div><strong>Sea Freight</strong> — Cost-effective ocean solutions for large volume cargo.</div></li>
                    <li><div class="icon"><i class="fas fa-truck"></i></div><div><strong>Road Freight</strong> — Comprehensive land transport with nationwide and cross-border coverage.</div></li>
                    <li><div class="icon"><i class="fas fa-search-location"></i></div><div><strong>Track & Trace</strong> — Real-time shipment visibility at every stage of delivery.</div></li>
                </ul>
                <a href="{{ route('about') }}" class="btn-primary-custom mt-2"><i class="fas fa-arrow-right"></i> Learn More About Us</a>
            </div>
        </div>
    </div>
</section>

<!-- ─── Services ─────────────────────────────────── -->
<section style="background:var(--light);padding:90px 0">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-label">What We Offer</div>
            <h2 class="section-title">Our Quality Services</h2>
            <p class="section-desc">We deliver flexible logistics solutions tailored to your business needs across every mode of transport.</p>
        </div>
        <div class="row g-4">
            @foreach($services as $i => $service)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="service-card">
                    <div class="icon-wrap">
                        <i class="fas {{ $service->icon ?? 'fa-truck' }}"></i>
                    </div>
                    <h4>{{ $service->title }}</h4>
                    <p>{{ $service->short_description }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="read-more">
                        Read More <i class="fas fa-arrow-right" style="font-size:12px"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('services') }}" class="btn-primary-custom"><i class="fas fa-th-large"></i> View All Services</a>
        </div>
    </div>
</section>

<!-- ─── Process ───────────────────────────────────── -->
<section style="padding:90px 0">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-label">How It Works</div>
            <h2 class="section-title">Simple 4-Step Process</h2>
        </div>
        <div class="row g-0 justify-content-center">
            @php
            $steps = [
                ['num'=>'01','icon'=>'fa-clipboard-list','title'=>'Request a Quote','desc'=>'Tell us about your shipment and get competitive pricing instantly.'],
                ['num'=>'02','icon'=>'fa-box','title'=>'Pack & Pickup','desc'=>'We collect your cargo from your location, properly packed and documented.'],
                ['num'=>'03','icon'=>'fa-route','title'=>'In Transit','desc'=>'Your shipment travels through our secure global logistics network.'],
                ['num'=>'04','icon'=>'fa-check-circle','title'=>'Delivery','desc'=>'Safe and timely delivery to the destination with proof of delivery.'],
            ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="{{ $i * 120 }}">
                <div class="step-card">
                    <div class="step-num">{{ $step['num'] }}</div>
                    <div style="font-size:32px;color:var(--primary);margin-bottom:14px"><i class="fas {{ $step['icon'] }}"></i></div>
                    <h5 style="font-size:18px;color:var(--dark);margin-bottom:10px">{{ $step['title'] }}</h5>
                    <p style="font-size:14px;color:var(--gray)">{{ $step['desc'] }}</p>
                    @if($i < 3)
                    <div class="step-arrow d-none d-md-block"><i class="fas fa-chevron-right"></i></div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ─── Testimonials ─────────────────────────────── -->
<section style="background:var(--light);padding:90px 0">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-label">What Clients Say</div>
            <h2 class="section-title">Our Customers' Feedback</h2>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $i => $t)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="testimonial-card h-100">
                    <div class="stars">
                        @for($s=1;$s<=$t->rating;$s++)<i class="fas fa-star"></i>@endfor
                    </div>
                    <p class="content">{{ $t->content }}</p>
                    <div class="d-flex align-items-center gap-3">
                        @if($t->avatar)
                            <img src="{{ asset('storage/'.$t->avatar) }}" alt="{{ $t->name }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover">
                        @else
                            <div style="width:44px;height:44px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">{{ strtoupper(substr($t->name,0,1)) }}</div>
                        @endif
                        <div>
                            <div class="author-name">{{ $t->name }}</div>
                            <div class="author-role">{{ $t->position }}{{ $t->company ? ', '.$t->company : '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ─── Team ─────────────────────────────────────── -->
@if($team->count() > 0)
<section style="padding:90px 0">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-label">Our People</div>
            <h2 class="section-title">Meet Our Expert Team</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($team as $i => $member)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div style="text-align:center;background:#fff;border-radius:14px;padding:30px 20px;box-shadow:0 4px 20px rgba(0,53,128,.08);transition:transform .3s" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" style="width:90px;height:90px;border-radius:50%;object-fit:cover;margin-bottom:16px;border:4px solid var(--light)">
                    @else
                        <div style="width:90px;height:90px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:32px;font-weight:800;color:#fff;font-family:'Barlow Condensed',sans-serif">{{ strtoupper(substr($member->name,0,1)) }}</div>
                    @endif
                    <h5 style="font-size:18px;color:var(--dark);margin-bottom:4px">{{ $member->name }}</h5>
                    <div style="font-size:13px;color:var(--accent);font-weight:600;margin-bottom:10px">{{ $member->position }}</div>
                    @if($member->bio)<p style="font-size:13px;color:var(--gray);line-height:1.6">{{ Str::limit($member->bio, 80) }}</p>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ─── CTA ───────────────────────────────────────── -->
<section class="cta-section">
    <div class="container text-center" data-aos="zoom-in">
        <h2 class="mb-3">Ready to Ship with Confidence?</h2>
        <p class="mb-4">Get started today with our professional logistics team. We'll handle every detail.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('contact') }}" class="btn-primary-custom" style="background:var(--dark);color:#fff"><i class="fas fa-headset"></i> Contact Support</a>
            <a href="{{ route('track') }}" class="btn-primary-custom" style="background:#fff;color:var(--dark)"><i class="fas fa-search-location"></i> Track Shipment</a>
        </div>
    </div>
</section>

@endsection
