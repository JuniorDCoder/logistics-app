@extends('layouts.app')
@section('title', 'About Us')
@section('content')
<div class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.7)">Home</a></li><li class="breadcrumb-item active" style="color:var(--accent)">About</li></ol></nav>
        <h1 data-aos="fade-up">About {{ app_name() }}</h1>
        <p style="opacity:.8;max-width:500px;margin-top:10px" data-aos="fade-up" data-aos-delay="100">Your trusted global logistics partner since 2009.</p>
    </div>
</div>
<section style="padding:90px 0">
    <div class="container">
        <div class="row align-items-center g-5 mb-6">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=800&q=80" alt="About" style="border-radius:16px;width:100%;box-shadow:0 20px 50px rgba(0,53,128,.15)">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="section-label">Our Story</div>
                <h2 class="section-title mb-4">We Are Passionate About Customers</h2>
                <p style="color:var(--gray);font-size:16px;line-height:1.8;margin-bottom:20px">{{ app_name() }} is a leading global asset-light supply chain management company. We design and implement industry-leading solutions for large and medium-sized national and multinational companies.</p>
                <p style="color:var(--gray);font-size:16px;line-height:1.8">Approximately 2,000 employees in more than 120 countries are dedicated to delivering effective and robust supply-chain solutions across a variety of sectors where we apply our operational expertise to provide best-in-class services.</p>
            </div>
        </div>
        @if($team->count() > 0)
        <div class="section-header mt-5" data-aos="fade-up">
            <div class="section-label">Our People</div>
            <h2 class="section-title">Meet the Leadership Team</h2>
        </div>
        <div class="row g-4">
            @foreach($team as $i => $member)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $i*80 }}">
                <div style="background:#fff;border-radius:14px;padding:30px 20px;box-shadow:0 4px 20px rgba(0,53,128,.08);text-align:center">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" style="width:90px;height:90px;border-radius:50%;object-fit:cover;margin-bottom:16px;border:4px solid var(--light)">
                    @else
                        <div style="width:90px;height:90px;background:linear-gradient(135deg,var(--primary),var(--primary-dark));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:32px;font-weight:800;color:#fff;font-family:'Barlow Condensed',sans-serif">{{ strtoupper(substr($member->name,0,1)) }}</div>
                    @endif
                    <h5 style="font-size:18px;color:var(--dark);margin-bottom:4px">{{ $member->name }}</h5>
                    <div style="font-size:13px;color:var(--accent);font-weight:600;margin-bottom:10px">{{ $member->position }}</div>
                    @if($member->bio)<p style="font-size:13px;color:var(--gray);line-height:1.6">{{ $member->bio }}</p>@endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
