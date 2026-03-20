<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        try {
            $value = Setting::getValue($key);
            return $value !== null ? $value : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (!function_exists('app_name')) {
    function app_name(): string
    {
        try {
            $name = Setting::getValue('app_name');
            return $name ?: config('app.name', 'IntertransitLogistics');
        } catch (\Exception $e) {
            return config('app.name', 'IntertransitLogistics');
        }
    }
}
