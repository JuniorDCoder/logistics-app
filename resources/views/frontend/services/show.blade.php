{{-- resources/views/frontend/services/show.blade.php --}}
@extends('layouts.app')
@section('title', $service->title)
@section('content')
<div class="page-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.7)">Home</a></li><li class="breadcrumb-item"><a href="{{ route('services') }}" style="color:rgba(255,255,255,.7)">Services</a></li><li class="breadcrumb-item active" style="color:var(--accent)">{{ $service->title }}</li></ol></nav>
        <h1 data-aos="fade-up"><i class="fas {{ $service->icon ?? 'fa-truck' }} me-3" style="color:var(--accent)"></i>{{ $service->title }}</h1>
    </div>
</div>
<section style="padding:90px 0">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                <div style="font-size:17px;color:var(--gray);line-height:1.8">{!! $service->description !!}</div>
                <a href="{{ route('contact') }}" class="btn-primary-custom mt-4"><i class="fas fa-headset"></i> Get a Quote</a>
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div style="background:var(--light);border-radius:14px;padding:28px">
                    <h5 style="font-size:18px;font-family:'Barlow Condensed',sans-serif;font-weight:700;color:var(--dark);text-transform:uppercase;letter-spacing:1px;margin-bottom:20px">All Services</h5>
                    @foreach($services as $s)
                    <a href="{{ route('services.show',$s->slug) }}" style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid #e5e7eb;color:{{ $s->id==$service->id ? 'var(--primary)' : 'var(--dark)' }};font-weight:{{ $s->id==$service->id ? '700' : '500' }};font-size:14px;text-decoration:none">
                        <i class="fas {{ $s->icon ?? 'fa-truck' }}" style="width:20px;color:{{ $s->id==$service->id ? 'var(--accent)' : 'var(--gray)' }}"></i>
                        {{ $s->title }}
                        @if($s->id==$service->id)<i class="fas fa-chevron-right ms-auto" style="font-size:11px;color:var(--accent)"></i>@endif
                    </a>
                    @endforeach
                </div>
                <div style="background:var(--primary);border-radius:14px;padding:28px;margin-top:24px;color:#fff;text-align:center">
                    <i class="fas fa-headset" style="font-size:36px;color:var(--accent);margin-bottom:14px;display:block"></i>
                    <h5 style="font-size:20px;margin-bottom:10px">Need Help?</h5>
                    <p style="font-size:14px;opacity:.8;margin-bottom:20px">Contact our team for a custom solution.</p>
                    <a href="{{ route('contact') }}" style="background:var(--accent);color:var(--dark);padding:12px 24px;border-radius:8px;font-weight:700;display:block;text-decoration:none">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
