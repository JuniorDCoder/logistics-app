@extends('layouts.admin')
@section('title','Settings') @section('page-title','Site Settings')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Tab nav -->
    <ul class="nav nav-tabs mb-4" style="border-bottom:2px solid #e5e7eb">
        @foreach(['general'=>'General','social'=>'Social Media','homepage'=>'Homepage','seo'=>'SEO','integrations'=>'Integrations'] as $key => $label)
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
                        <label class="form-label">Tracking Number Prefix</label>
                        <input type="text" name="tracking_prefix" class="form-control" maxlength="6" style="text-transform:uppercase"
                               value="{{ $settings['general']['tracking_prefix']->value ?? '' }}" placeholder="e.g. WBC">
                        <small class="text-muted">Letters/numbers used at the start of new tracking numbers. Leave blank to auto-generate from the first 3 letters of the Application Name.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Application Timezone</label>
                        @php $currentTimezone = $settings['general']['timezone']->value ?? config('app.timezone', 'UTC'); @endphp
                        <select name="timezone" class="form-control">
                            @foreach(timezone_options() as $region => $zones)
                            <optgroup label="{{ $region }}">
                                @foreach($zones as $identifier => $label)
                                <option value="{{ $identifier }}" {{ $currentTimezone === $identifier ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        <small class="text-muted">Used to record every timestamp in the app (shipments, tracking events, messages, etc). Changing it only affects times recorded from now on.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ $settings['general']['contact_email']->value ?? '' }}">
                        <small class="text-muted">Shown publicly on the website.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Notification Email</label>
                        <input
                            type="email"
                            name="notification_email"
                            class="form-control"
                            value="{{ $settings['general']['notification_email']->value ?? config('mail.admin.address', '') }}"
                        >
                        <small class="text-muted">Receives contact form emails. Falls back to admin user emails if left blank.</small>
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
                        <small class="text-muted d-block mt-1">Used across the website, admin panel and emails wherever the logo appears.</small>
                    </div>
                </div>

                <div class="section-divider mt-4">Shipment Email Notifications</div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="shipment_email_notifications" id="shipment_email_notifications" value="1"
                                {{ ($settings['general']['shipment_email_notifications']->value ?? '1') !== '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="shipment_email_notifications">
                                Automatically email the sender and receiver when a shipment is registered or its status changes
                            </label>
                        </div>
                        <small class="text-muted">Edit the wording of these emails under <a href="{{ route('admin.mail-templates.index') }}">Mail Templates</a>.</small>
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

        <!-- Integrations -->
        <div class="tab-pane fade" id="integrations">
            <div class="form-card">
                <div class="section-divider">Chatwoot Live Chat</div>
                <p class="text-muted mb-3" style="font-size:14px">
                    Adds a live chat widget to the public website, powered by <a href="https://www.chatwoot.com" target="_blank" rel="noopener">Chatwoot</a>.
                    Get your token from your Chatwoot account under <strong>Settings → Inboxes → (your website inbox) → Configuration</strong>.
                </p>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="chatwoot_enabled" id="chatwoot_enabled" value="1"
                                {{ ($settings['integrations']['chatwoot_enabled']->value ?? '0') === '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="chatwoot_enabled">Enable Chatwoot Live Chat on the website</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Chatwoot Base URL</label>
                        <input type="url" name="chatwoot_base_url" class="form-control"
                               value="{{ $settings['integrations']['chatwoot_base_url']->value ?? 'https://app.chatwoot.com' }}"
                               placeholder="https://app.chatwoot.com">
                        <small class="text-muted">Use https://app.chatwoot.com for Chatwoot Cloud, or your own domain if self-hosted.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Website Token</label>
                        <input type="text" name="chatwoot_website_token" class="form-control"
                               value="{{ $settings['integrations']['chatwoot_website_token']->value ?? '' }}"
                               placeholder="e.g. a1B2c3D4e5F6...">
                        <small class="text-muted">The Website Token for your inbox — used together with the Base URL above.</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Or paste the full embed script instead</label>
                        <textarea name="chatwoot_script_override" class="form-control" rows="6" style="font-family:monospace;font-size:13px"
                                  placeholder="<script>&#10;  (function(d,t) { ... })(document,&quot;script&quot;);&#10;</script>">{{ $settings['integrations']['chatwoot_script_override']->value ?? '' }}</textarea>
                        <small class="text-muted">Optional. If you paste the complete script Chatwoot gives you here, it's used as-is instead of the Base URL/Website Token fields above — useful if you need custom widget settings (locale, position, colors, etc).</small>
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/11.2.4/choices.min.css">
<style>
    .choices { margin-bottom: 0; }
    .choices__inner { border-radius: 8px; min-height: calc(1.5em + 1rem + 2px); padding: 0.5rem 0.75rem; }
    .choices__list--dropdown { z-index: 1050; }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/11.2.4/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var timezoneSelect = document.querySelector('select[name="timezone"]');
        if (timezoneSelect && window.Choices) {
            new Choices(timezoneSelect, {
                searchEnabled: true,
                searchPlaceholderValue: 'Search timezones...',
                itemSelectText: '',
                shouldSort: false,
                searchResultLimit: 30,
                renderChoiceLimit: -1,
                placeholder: false,
                fuseOptions: { threshold: 0.3 },
            });
        }
    });
</script>
@endpush
