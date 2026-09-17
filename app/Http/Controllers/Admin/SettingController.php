<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    private const SETTING_META = [
        'notification_email' => [
            'group' => 'general',
            'type' => 'text',
            'label' => 'Notification Email',
        ],
        'shipment_email_notifications' => [
            'group' => 'general',
            'type' => 'boolean',
            'label' => 'Shipment Email Notifications',
        ],
        'tracking_prefix' => [
            'group' => 'general',
            'type' => 'text',
            'label' => 'Tracking Number Prefix',
        ],
        'timezone' => [
            'group' => 'general',
            'type' => 'select',
            'label' => 'Application Timezone',
        ],
    ];

    private const CHECKBOX_KEYS = ['shipment_email_notifications'];

    public function index()
    {
        $groups = ['general', 'social', 'homepage', 'seo'];
        $settings = [];
        foreach ($groups as $group) {
            $settings[$group] = Setting::where('group', $group)->get()->keyBy('key');
        }
        return view('admin.settings.index', compact('settings', 'groups'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_email' => ['nullable', 'email'],
            'notification_email' => ['nullable', 'email'],
            'logo_file' => ['nullable', 'image'],
            'tracking_prefix' => ['nullable', 'alpha_num', 'max:6'],
            'timezone' => ['nullable', 'timezone'],
        ]);

        $data = $request->except(['_token', '_method', 'logo_file']);

        foreach (self::CHECKBOX_KEYS as $checkboxKey) {
            $data[$checkboxKey] = $request->boolean($checkboxKey) ? '1' : '0';
        }

        if (isset($data['tracking_prefix'])) {
            $data['tracking_prefix'] = strtoupper((string) $data['tracking_prefix']);
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                array_merge(self::SETTING_META[$key] ?? [], ['value' => $value])
            );

            Cache::forget("setting_{$key}");
        }

        // Handle logo upload
        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('settings', 'public');
            Setting::setValue('logo', $path);
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
