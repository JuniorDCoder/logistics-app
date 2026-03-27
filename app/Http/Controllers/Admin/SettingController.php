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
    ];

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
        ]);

        $data = $request->except(['_token', '_method']);

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
