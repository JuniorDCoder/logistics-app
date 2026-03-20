@extends('layouts.app')
@section('title', 'Our Services')
@section('content')
<div class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.7)">Home</a></li><li class="breadcrumb-item active" style="color:var(--accent)">Services</li></ol></nav>
        <h1 data-aos="fade-up">Our Services</h1>
        <p style="opacity:.8;max-width:500px;margin-top:10px" data-aos="fade-up" data-aos-delay="100">Flexible logistics solutions for every business need.</p>
    </div>
</div>
<section style="padding:90px 0;background:var(--light)">
    <div class="container">
        <div class="row g-4">
            @foreach($services as $i => $service)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="service-card">
                    <div class="icon-wrap"><i class="fas {{ $service->icon ?? 'fa-truck' }}"></i></div>
                    <h4>{{ $service->title }}</h4>
                    <p>{{ $service->short_description }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="read-more">Learn More <i class="fas fa-arrow-right" style="font-size:12px"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
