<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | {{ app_name() }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Barlow+Condensed:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family:'Barlow',sans-serif; background:linear-gradient(135deg,#003580,#001a40); min-height:100vh; display:flex; align-items:center; }
        .login-card { background:#fff; border-radius:20px; padding:48px 40px; box-shadow:0 30px 80px rgba(0,0,0,.4); width:100%; max-width:440px; }
        .brand { text-align:center; margin-bottom:36px; }
        .brand-text { font-family:'Barlow Condensed',sans-serif; font-size:32px; font-weight:800; color:#003580; }
        .brand-text span { color:#e8a000; }
        .brand small { display:block; font-size:12px; color:#9ca3af; letter-spacing:3px; text-transform:uppercase; margin-top:2px; }
        .form-control { border-radius:10px; border-color:#d1d5db; padding:13px 16px; font-size:15px; }
        .form-control:focus { border-color:#003580; box-shadow:0 0 0 3px rgba(0,53,128,.1); }
        .btn-login { background:linear-gradient(135deg,#003580,#002060); color:#fff; border:none; border-radius:10px; padding:14px; font-family:'Barlow Condensed',sans-serif; font-size:18px; font-weight:700; letter-spacing:.5px; width:100%; transition:all .2s; }
        .btn-login:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,53,128,.4); }
        .input-icon { position:relative; }
        .input-icon i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9ca3af; }
        .input-icon .form-control { padding-left:44px; }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="login-card">
            <div class="brand">
                <div class="brand-text"><span>IT</span>L Admin</div>
                <small>{{ app_name() }}</small>
            </div>

            @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3 mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted small text-uppercase" style="letter-spacing:.5px">Email Address</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" value="{{ old('email','admin@logistics.com') }}" required autofocus>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted small text-uppercase" style="letter-spacing:.5px">Password</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check mb-0">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label small" for="remember">Remember me</label>
                    </div>
                </div>
                <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt me-2"></i>Login to Dashboard</button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" style="color:#6c757d;font-size:13px;text-decoration:none"><i class="fas fa-arrow-left me-1"></i> Back to Website</a>
            </div>
            <div class="text-center mt-3" style="font-size:12px;color:#9ca3af">Default: admin@logistics.com / password</div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
