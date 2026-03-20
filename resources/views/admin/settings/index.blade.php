@extends('layouts.admin')
@section('title','Settings') @section('page-title','Site Settings')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Tab nav -->
    <ul class="nav nav-tabs mb-4" style="border-bottom:2px solid #e5e7eb">
        @foreach(['general'=>'General','social'=>'Social Media','homepage'=>'Homepage','seo'=>'SEO'] as $key => $label)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" href="#{{ $key }}" data-bs-toggle="tab"
               style="font-weight:600;font-size:14px;color:#6c757d;border:none;padding:12px 20px">
                {{ $label }}
            </a>
        </li>
        @endforeach
    </ul>

    <div class="tab-content">
        <!-- General -->
        <div class="tab-pane fade show active" id="general">
            <div class="form-card">
                <div class="section-divider">General Settings</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Application Name</label>
                        <input type="text" name="app_name" class="form-control" value="{{ $settings['general']['app_name']->value ?? '' }}">
                        <small class="text-muted">This overrides the APP_NAME in .env</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tagline</label>
                        <input type="text" name="tagline" class="form-control" value="{{ $settings['general']['tagline']->value ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ $settings['general']['contact_email']->value ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{ $settings['general']['contact_phone']->value ?? '' }}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Office Address</label>
                        <input type="text" name="contact_address" class="form-control" value="{{ $settings['general']['contact_address']->value ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Office Hours</label>
                        <input type="text" name="office_hours" class="form-control" value="{{ $settings['general']['office_hours']->value ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Logo Image</label>
                        <input type="file" name="logo_file" class="form-control" accept="image/*">
                        @if(!empty($settings['general']['logo']->value))
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$settings['general']['logo']->value) }}" alt="Logo" style="height:50px">
                            <small class="text-muted d-block mt-1">Current logo — upload new to replace</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Social -->
        <div class="tab-pane fade" id="social">
            <div class="form-card">
                <div class="section-divider">Social Media Links</div>
                <div class="row g-3">
                    @foreach(['facebook'=>'fa-facebook-f','twitter'=>'fa-twitter','linkedin'=>'fa-linkedin-in','instagram'=>'fa-instagram'] as $key => $icon)
                    <div class="col-md-6">
                        <label class="form-label"><i class="fab {{ $icon }} me-2" style="color:#003580"></i>{{ ucfirst($key) }} URL</label>
                        <input type="text" name="{{ $key }}" class="form-control" value="{{ $settings['social'][$key]->value ?? '' }}" placeholder="https://...">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Homepage -->
        <div class="tab-pane fade" id="homepage">
            <div class="form-card">
                <div class="section-divider">Homepage Content</div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Hero Title</label>
                        <input type="text" name="hero_title" class="form-control" value="{{ $settings['homepage']['hero_title']->value ?? '' }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Hero Subtitle</label>
                        <textarea name="hero_subtitle" class="form-control" rows="3">{{ $settings['homepage']['hero_subtitle']->value ?? '' }}</textarea>
                    </div>
                </div>
                <div class="section-divider mt-4">Statistics Counter</div>
                <div class="row g-3">
                    <div class="col-md-3"><label class="form-label">Years of Experience</label><input type="number" name="stats_years" class="form-control" value="{{ $settings['homepage']['stats_years']->value ?? '15' }}"></div>
                    <div class="col-md-3"><label class="form-label">Company Workers</label><input type="number" name="stats_workers" class="form-control" value="{{ $settings['homepage']['stats_workers']->value ?? '2000' }}"></div>
                    <div class="col-md-3"><label class="form-label">Shipments (thousands)</label><input type="number" name="stats_shipments" class="form-control" value="{{ $settings['homepage']['stats_shipments']->value ?? '50' }}"></div>
                    <div class="col-md-3"><label class="form-label">Satisfied Customers (%)</label><input type="number" name="stats_customers" class="form-control" value="{{ $settings['homepage']['stats_customers']->value ?? '98' }}"></div>
                </div>
            </div>
        </div>

        <!-- SEO -->
        <div class="tab-pane fade" id="seo">
            <div class="form-card">
                <div class="section-divider">SEO Settings</div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ $settings['seo']['meta_description']->value ?? '' }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" value="{{ $settings['seo']['meta_keywords']->value ?? '' }}" placeholder="keyword1, keyword2, ...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary px-5" style="border-radius:8px;font-weight:600;font-size:15px">
            <i class="fas fa-save me-2"></i>Save All Settings
        </button>
    </div>
</form>
@endsection
