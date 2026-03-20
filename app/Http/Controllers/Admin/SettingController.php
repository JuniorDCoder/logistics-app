<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
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
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            Setting::setValue($key, $value);
        }

        // Handle logo upload
        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('settings', 'public');
            Setting::setValue('logo', $path);
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
