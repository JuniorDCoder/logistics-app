<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard') | {{ app_name() }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700&family=Barlow+Condensed:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --sidebar-w: 260px;
            --primary: #003580;
            --accent:   #e8a000;
            --dark:     #0d1b2a;
            --sidebar-bg: #0d1b2a;
            --sidebar-hover: rgba(232,160,0,.12);
        }
        * { box-sizing: border-box; }
        body { font-family:'Barlow',sans-serif; background:#f0f2f8; margin:0; }

        /* Sidebar */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            z-index: 1000;
            transition: transform .3s;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            flex-shrink: 0;
        }
        .sidebar-brand .brand-text {
            font-family:'Barlow Condensed',sans-serif;
            font-size: 22px; font-weight: 800; color: #fff;
        }
        .sidebar-brand .brand-text span { color: var(--accent); }
        .sidebar-brand small { font-size: 11px; color: rgba(255,255,255,.4); letter-spacing: 2px; text-transform: uppercase; }

        .sidebar-menu { padding: 16px 0; flex: 1; }
        .menu-label {
            font-size: 10px; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
            color: rgba(255,255,255,.3);
            padding: 12px 20px 6px;
        }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 20px;
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: 14px; font-weight: 500;
            transition: all .2s;
            border-left: 3px solid transparent;
        }
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--sidebar-hover);
            color: var(--accent);
            border-left-color: var(--accent);
        }
        .sidebar-menu a i { width: 20px; text-align: center; font-size: 15px; }
        .badge-count {
            margin-left: auto;
            background: var(--accent);
            color: var(--dark);
            font-size: 11px; font-weight: 700;
            border-radius: 20px; padding: 1px 8px;
        }

        /* Main */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* Top header */
        .admin-header {
            background: #fff;
            padding: 0 28px;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0,0,0,.08);
            position: sticky; top: 0; z-index: 100;
        }
        .page-title-h { font-family:'Barlow Condensed',sans-serif; font-size: 22px; font-weight: 700; color: var(--dark); margin: 0; }
        .admin-user { display: flex; align-items: center; gap: 10px; }
        .admin-avatar {
            width: 38px; height: 38px;
            background: var(--primary);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 15px;
        }

        /* Content */
        .admin-content { padding: 28px; flex: 1; }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,.06);
            border-left: 4px solid var(--primary);
            transition: transform .2s;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card.accent { border-left-color: var(--accent); }
        .stat-card.success { border-left-color: #198754; }
        .stat-card.warning { border-left-color: #ffc107; }
        .stat-card.danger  { border-left-color: #dc3545; }
        .stat-card.info    { border-left-color: #0dcaf0; }
        .stat-card h3 { font-family:'Barlow Condensed',sans-serif; font-size: 38px; font-weight: 800; color: var(--dark); margin: 0; }
        .stat-card p  { color: #6c757d; font-size: 13px; margin: 4px 0 0; }
        .stat-card .stat-icon { font-size: 32px; opacity: .15; }

        /* Table */
        .admin-table { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
        .admin-table table { margin: 0; }
        .admin-table thead th { background: var(--dark); color: #fff; font-weight: 600; font-size: 13px; letter-spacing: .4px; border: none; padding: 14px 16px; }
        .admin-table tbody td { padding: 13px 16px; vertical-align: middle; border-color: #f0f2f8; font-size: 14px; }
        .admin-table tbody tr:hover { background: #f8f9ff; }

        /* Form */
        .form-card { background: #fff; border-radius: 12px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
        .form-label { font-weight: 600; font-size: 13px; color: #374151; }
        .form-control, .form-select { border-color: #d1d5db; border-radius: 8px; font-size: 14px; padding: 10px 14px; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0,53,128,.1); }
        .section-divider { font-family:'Barlow Condensed',sans-serif; font-size: 16px; font-weight: 700; color: var(--primary); border-bottom: 2px solid #e5e7eb; padding-bottom: 8px; margin: 28px 0 20px; text-transform: uppercase; letter-spacing: 1px; }

        /* Status badges */
        .badge-status { font-size: 12px; font-weight: 600; border-radius: 20px; padding: 4px 12px; }

        /* Alert */
        .alert { border-radius: 10px; font-size: 14px; }

        /* Breadcrumb */
        .admin-breadcrumb { font-size: 13px; }
        .admin-breadcrumb .breadcrumb-item + .breadcrumb-item::before { color: #adb5bd; }

        /* Mobile sidebar toggle */
        .sidebar-toggle { display: none; }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .sidebar-toggle { display: block; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-text"><span>IT</span>L Admin</div>
        <small>{{ app_name() }}</small>
    </div>
    <nav class="sidebar-menu">
        <div class="menu-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="menu-label">Operations</div>
        <a href="{{ route('admin.shipments.index') }}" class="{{ request()->routeIs('admin.shipments*') ? 'active' : '' }}">
            <i class="fas fa-boxes"></i> Shipments
        </a>
        <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Messages
            @php $unread = \App\Models\ContactMessage::where('is_read',false)->count(); @endphp
            @if($unread > 0)<span class="badge-count">{{ $unread }}</span>@endif
        </a>

        <div class="menu-label">Content</div>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services*') ? 'active' : '' }}">
            <i class="fas fa-concierge-bell"></i> Services
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
            <i class="fas fa-star"></i> Testimonials
        </a>
        <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Team Members
        </a>

        <div class="menu-label">System</div>
        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Settings
        </a>
        <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <i class="fas fa-user-circle"></i> My Profile
        </a>

        <div class="menu-label">Site</div>
        <a href="{{ route('home') }}" target="_blank">
            <i class="fas fa-external-link-alt"></i> View Website
        </a>
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
    </nav>
</aside>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <header class="admin-header">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-light sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="page-title-h">@yield('page-title', 'Dashboard')</h1>
        </div>
        <div class="admin-user">
            <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
            <div>
                <div style="font-size:13px;font-weight:700;color:#1f2937">{{ auth()->user()->name }}</div>
                <div style="font-size:11px;color:#9ca3af">Administrator</div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="admin-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
