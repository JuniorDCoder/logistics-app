<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ setting('meta_description', 'Professional Logistics Services') }}">
    <meta name="keywords" content="{{ setting('meta_keywords', 'logistics, shipping, freight') }}">
    <title>@yield('title', app_name()) | {{ app_name() }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700;800&family=Barlow+Condensed:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary:      #003580;
            --primary-dark: #002060;
            --accent:       #e8a000;
            --accent-dark:  #c47f00;
            --dark:         #0d1b2a;
            --light:        #f5f8ff;
            --gray:         #6c757d;
            --success:      #198754;
            --border:       #dee2e6;
            --shadow:       0 4px 24px rgba(0,53,128,.10);
            --shadow-hover: 0 8px 40px rgba(0,53,128,.18);
            --radius:       12px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Barlow', sans-serif;
            font-size: 16px;
            color: #2d3748;
            background: #fff;
            overflow-x: hidden;
        }

        h1,h2,h3,h4,h5,h6 { font-family: 'Barlow Condensed', sans-serif; font-weight: 700; }

        a { text-decoration: none; }

        /* ─── Preloader ───────────────────────────── */
        #preloader {
            position: fixed; inset: 0; background: var(--primary-dark);
            display: flex; align-items: center; justify-content: center; z-index: 9999;
            transition: opacity .5s ease;
        }
        #preloader .spinner {
            width: 60px; height: 60px;
            border: 4px solid rgba(255,255,255,.2);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ─── Topbar ──────────────────────────────── */
        .topbar {
            background: var(--primary-dark);
            color: #fff;
            font-size: 13px;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .topbar a { color: rgba(255,255,255,.85); transition: color .2s; }
        .topbar a:hover { color: var(--accent); }
        .topbar .divider { margin: 0 12px; opacity: .4; }

        /* ─── Navbar ──────────────────────────────── */
        .main-navbar {
            background: #fff;
            padding: 0;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
            position: sticky; top: 0; z-index: 1000;
        }
        .navbar-brand { padding: 14px 0; }
        .navbar-brand .logo-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 800;
            font-size: 26px;
            color: var(--primary);
            letter-spacing: -0.5px;
        }
        .navbar-brand .logo-text span { color: var(--accent); }
        .navbar-brand img { height: 50px; }

        .navbar-nav .nav-link {
            color: var(--dark) !important;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: .4px;
            text-transform: uppercase;
            padding: 15px 16px !important;
            transition: color .2s;
            position: relative;
        }
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute; bottom: 0; left: 16px; right: 16px;
            height: 3px; background: var(--accent);
            transform: scaleX(0); transition: transform .25s;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active { color: var(--accent) !important; }
        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after { transform: scaleX(1); }

        .btn-track {
            background: var(--accent);
            color: var(--dark) !important;
            border-radius: 6px;
            padding: 7px 16px !important;
            font-weight: 700 !important;
            margin-left: 8px;
            line-height: 1.2;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background .2s, transform .2s !important;
        }
        .btn-track:hover { background: var(--accent-dark); transform: translateY(-1px); }
        .btn-track::after { display: none !important; }
        .navbar-nav .nav-link.btn-track.active,
        .navbar-nav .nav-link.btn-track:hover,
        .navbar-nav .nav-link.btn-track:focus {
            color: var(--dark) !important;
        }

        /* ─── Buttons ─────────────────────────────── */
        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 14px 32px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            transition: all .25s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-primary-custom:hover { background: var(--primary-dark); color: #fff; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,53,128,.3); }

        .btn-accent-custom {
            background: var(--accent);
            color: var(--dark);
            border: none;
            border-radius: 6px;
            padding: 14px 32px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            transition: all .25s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-accent-custom:hover { background: var(--accent-dark); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(232,160,0,.35); }

        .btn-outline-custom {
            border: 2px solid #fff;
            color: #fff;
            background: transparent;
            border-radius: 6px;
            padding: 12px 30px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            transition: all .25s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-outline-custom:hover { background: #fff; color: var(--primary); }

        /* ─── Section Headers ─────────────────────── */
        .section-header { text-align: center; margin-bottom: 60px; }
        .section-label {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 14px;
            position: relative;
        }
        .section-label::before,
        .section-label::after {
            content: '—'; margin: 0 8px; opacity: .6;
        }
        .section-title {
            font-size: clamp(30px, 4vw, 46px);
            color: var(--dark);
            line-height: 1.15;
        }
        .section-desc {
            color: var(--gray);
            max-width: 620px;
            margin: 16px auto 0;
            line-height: 1.7;
        }

        /* ─── Cards ───────────────────────────────── */
        .service-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 36px 28px;
            box-shadow: var(--shadow);
            transition: all .3s;
            border-bottom: 3px solid transparent;
            height: 100%;
        }
        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-bottom-color: var(--accent);
        }
        .service-card .icon-wrap {
            width: 64px; height: 64px;
            background: var(--light);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; color: var(--primary);
            margin-bottom: 20px;
            transition: all .3s;
        }
        .service-card:hover .icon-wrap {
            background: var(--primary);
            color: var(--accent);
        }
        .service-card h4 { font-size: 20px; color: var(--dark); margin-bottom: 12px; }
        .service-card p  { color: var(--gray); font-size: 15px; line-height: 1.65; }
        .service-card .read-more {
            color: var(--primary); font-weight: 600; font-size: 14px;
            display: inline-flex; align-items: center; gap: 6px; margin-top: 16px;
            transition: gap .2s;
        }
        .service-card:hover .read-more { gap: 10px; }

        /* ─── Stats ───────────────────────────────── */
        .stats-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 70px 0;
        }
        .stat-item { text-align: center; color: #fff; }
        .stat-number {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 56px;
            font-weight: 800;
            color: var(--accent);
            line-height: 1;
            display: block;
        }
        .stat-label { font-size: 14px; opacity: .85; letter-spacing: 1px; text-transform: uppercase; margin-top: 8px; }

        /* ─── Testimonials ────────────────────────── */
        .testimonial-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 36px;
            box-shadow: var(--shadow);
            position: relative;
        }
        .testimonial-card::before {
            content: '\201C';
            font-family: Georgia, serif;
            font-size: 100px;
            color: var(--accent);
            opacity: .25;
            position: absolute;
            top: -10px; left: 20px;
            line-height: 1;
        }
        .testimonial-card .stars { color: var(--accent); font-size: 14px; margin-bottom: 14px; }
        .testimonial-card .content { font-style: italic; color: var(--gray); line-height: 1.7; margin-bottom: 20px; }
        .testimonial-card .author-name { font-weight: 700; color: var(--dark); }
        .testimonial-card .author-role { font-size: 13px; color: var(--gray); }

        /* ─── Footer ──────────────────────────────── */
        .footer {
            background: var(--dark);
            color: rgba(255,255,255,.8);
            padding: 70px 0 0;
        }
        .footer h5 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent);
            display: inline-block;
        }
        .footer a { color: rgba(255,255,255,.75); transition: color .2s; font-size: 14px; }
        .footer a:hover { color: var(--accent); }
        .footer ul { list-style: none; padding: 0; }
        .footer ul li { margin-bottom: 10px; font-size: 14px; }
        .footer ul li i { margin-right: 8px; color: var(--accent); width: 16px; }
        .footer-bottom {
            background: rgba(0,0,0,.3);
            padding: 18px 0;
            margin-top: 50px;
            font-size: 13px;
            color: rgba(255,255,255,.5);
        }
        .social-links a {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px;
            background: rgba(255,255,255,.1);
            border-radius: 8px;
            color: #fff; margin-right: 8px;
            transition: all .2s;
        }
        .social-links a:hover { background: var(--accent); color: var(--dark); }

        /* ─── Alert messages ─────────────────────── */
        .alert-float {
            position: fixed; top: 90px; right: 20px;
            z-index: 9998; min-width: 300px; max-width: 400px;
            animation: slideIn .4s ease;
        }
        @keyframes slideIn { from { transform: translateX(120%); } to { transform: translateX(0); } }

        /* ─── Track hero ─────────────────────────── */
        .page-hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 80px 0;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .page-hero::after {
            content: '';
            position: absolute;
            right: -100px; bottom: -100px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
        }
        .page-hero h1 { font-size: clamp(32px, 5vw, 52px); }
        .page-hero .breadcrumb-item, .page-hero .breadcrumb-item a { color: rgba(255,255,255,.75); }
        .page-hero .breadcrumb-item.active { color: var(--accent); }

        /* ─── Responsive ─────────────────────────── */
        @media (max-width: 991px) {
            .navbar-nav .nav-link { padding: 12px 0 !important; }
            .navbar-nav .nav-link::after { display: none; }
            .btn-track { margin-left: 0; margin-top: 8px; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Flash messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-float" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show alert-float" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Topbar -->
    @php
        $topbarEmail = trim((string) setting('contact_email', ''));
        $topbarPhone = trim((string) setting('contact_phone', ''));
        $topbarHours = trim((string) setting('office_hours', ''));

        $socialLinks = [
            'facebook' => trim((string) setting('facebook', '')),
            'twitter' => trim((string) setting('twitter', '')),
            'linkedin' => trim((string) setting('linkedin', '')),
            'instagram' => trim((string) setting('instagram', '')),
        ];

        $topbarItems = [];
        if ($topbarEmail !== '') {
            $topbarItems[] = '<i class="fas fa-envelope me-2" style="color:var(--accent)"></i><a href="mailto:'.e($topbarEmail).'">'.e($topbarEmail).'</a>';
        }
        if ($topbarPhone !== '') {
            $topbarItems[] = '<i class="fas fa-phone me-2" style="color:var(--accent)"></i><a href="tel:'.e($topbarPhone).'">'.e($topbarPhone).'</a>';
        }
        if ($topbarHours !== '') {
            $topbarItems[] = '<i class="fas fa-clock me-2" style="color:var(--accent)"></i><span>'.e($topbarHours).'</span>';
        }
    @endphp
    <div class="topbar d-none d-lg-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    @if(count($topbarItems) > 0)
                        {!! implode('<span class="divider">|</span>', $topbarItems) !!}
                    @endif
                </div>
                <div class="d-flex gap-3">
                    @if($socialLinks['facebook'] !== '' && $socialLinks['facebook'] !== '#')<a href="{{ $socialLinks['facebook'] }}"><i class="fab fa-facebook-f"></i></a>@endif
                    @if($socialLinks['twitter'] !== '' && $socialLinks['twitter'] !== '#')<a href="{{ $socialLinks['twitter'] }}"><i class="fab fa-twitter"></i></a>@endif
                    @if($socialLinks['linkedin'] !== '' && $socialLinks['linkedin'] !== '#')<a href="{{ $socialLinks['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>@endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if(setting('logo'))
                    <img src="{{ asset('storage/'.setting('logo')) }}" alt="{{ app_name() }}">
                @else
                    <span class="logo-text">
                        <span>WorldBridge</span> Cargo <br>
                        <small style="font-size:12px;font-weight:600;letter-spacing:2px;color:var(--gray)">Solutions</small>
                    </span>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services*') ? 'active' : '' }}" href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link btn-track {{ request()->routeIs('track') ? 'active' : '' }}" href="{{ route('track') }}"><i class="fas fa-search-location"></i> Track & Trace</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    @if(setting('logo'))
                        <img src="{{ asset('storage/'.setting('logo')) }}" alt="{{ app_name() }}" style="height:48px;margin-bottom:20px">
                    @else
                        <div style="font-family:'Barlow Condensed',sans-serif;font-size:28px;font-weight:800;color:#fff;margin-bottom:20px">
                            <span style="color:var(--accent)">WorldBridge</span> Cargo <br>
                            <span style="font-size:13px;font-weight:600;letter-spacing:3px;color:rgba(255,255,255,.5)">Solutions</span>
                        </div>
                    @endif
                    <p style="font-size:14px;line-height:1.7;color:rgba(255,255,255,.65)">
                        {{ setting('tagline', 'Professional logistics services with seamless process. Your trusted global freight partner.') }}
                    </p>
                    @if(collect($socialLinks)->filter(fn ($url) => $url !== '' && $url !== '#')->count() > 0)
                        <div class="social-links mt-4">
                            @if($socialLinks['facebook'] !== '' && $socialLinks['facebook'] !== '#')<a href="{{ $socialLinks['facebook'] }}"><i class="fab fa-facebook-f"></i></a>@endif
                            @if($socialLinks['twitter'] !== '' && $socialLinks['twitter'] !== '#')<a href="{{ $socialLinks['twitter'] }}"><i class="fab fa-twitter"></i></a>@endif
                            @if($socialLinks['linkedin'] !== '' && $socialLinks['linkedin'] !== '#')<a href="{{ $socialLinks['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>@endif
                            @if($socialLinks['instagram'] !== '' && $socialLinks['instagram'] !== '#')<a href="{{ $socialLinks['instagram'] }}"><i class="fab fa-instagram"></i></a>@endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-2 col-6">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('track') }}">Track & Trace</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-6">
                    <h5>Services</h5>
                    <ul>
                        <li><a href="{{ route('services.show','air-freight') }}">Air Freight</a></li>
                        <li><a href="{{ route('services.show','ocean-freight') }}">Ocean Freight</a></li>
                        <li><a href="{{ route('services.show','road-freight') }}">Road Freight</a></li>
                        <li><a href="{{ route('services.show','customs-clearance') }}">Customs Clearance</a></li>
                        <li><a href="{{ route('services.show','warehousing') }}">Warehousing</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Contact Info</h5>
                    @php
                        $footerAddress = trim((string) setting('contact_address', ''));
                        $footerEmail = trim((string) setting('contact_email', ''));
                        $footerPhone = trim((string) setting('contact_phone', ''));
                        $footerHours = trim((string) setting('office_hours', ''));
                    @endphp
                    <ul>
                        @if($footerAddress !== '')
                            <li><i class="fas fa-map-marker-alt"></i>{{ $footerAddress }}</li>
                        @endif
                        @if($footerEmail !== '')
                            <li><i class="fas fa-envelope"></i><a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a></li>
                        @endif
                        @if($footerPhone !== '')
                            <li><i class="fas fa-phone"></i><a href="tel:{{ $footerPhone }}">{{ $footerPhone }}</a></li>
                        @endif
                        @if($footerHours !== '')
                            <li><i class="fas fa-clock"></i>{{ $footerHours }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span>© {{ date('Y') }} {{ app_name() }}. All Rights Reserved.</span>
                <span>Designed for seamless global logistics</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        // AOS Init
        AOS.init({ duration: 700, once: true, offset: 60 });

        // Preloader
        window.addEventListener('load', () => {
            const pl = document.getElementById('preloader');
            pl.style.opacity = '0';
            setTimeout(() => pl.remove(), 500);
        });

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert-float').forEach(el => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(el);
                bsAlert.close();
            });
        }, 5000);

        // Counter animation
        function animateCounter(el) {
            const target = +el.dataset.count;
            let current = 0;
            const step = target / 60;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) { el.textContent = target; clearInterval(timer); return; }
                el.textContent = Math.floor(current);
            }, 20);
        }

        const observer = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { animateCounter(e.target); observer.unobserve(e.target); } });
        }, { threshold: 0.5 });

        document.querySelectorAll('[data-count]').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>
