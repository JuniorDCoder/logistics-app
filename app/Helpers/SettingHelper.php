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

if (!function_exists('app_timezone')) {
    function app_timezone(): string
    {
        try {
            $timezone = Setting::getValue('timezone');
            return $timezone ?: config('app.timezone', 'UTC');
        } catch (\Exception $e) {
            return config('app.timezone', 'UTC');
        }
    }
}

if (!function_exists('timezone_options')) {
    /**
     * All IANA timezone identifiers PHP knows about, grouped by region and
     * labelled with their current UTC offset, for populating a <select>.
     */
    function timezone_options(): array
    {
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        $groups = [];

        foreach (\DateTimeZone::listIdentifiers() as $identifier) {
            $offsetSeconds = (new \DateTimeZone($identifier))->getOffset($now);
            $sign = $offsetSeconds < 0 ? '-' : '+';
            $hours = str_pad((string) intdiv(abs($offsetSeconds), 3600), 2, '0', STR_PAD_LEFT);
            $minutes = str_pad((string) (intdiv(abs($offsetSeconds), 60) % 60), 2, '0', STR_PAD_LEFT);

            $region = str_contains($identifier, '/') ? explode('/', $identifier)[0] : 'Other';
            $groups[$region][$identifier] = "{$identifier} (UTC{$sign}{$hours}:{$minutes})";
        }

        ksort($groups);

        foreach ($groups as &$zones) {
            ksort($zones);
        }

        return $groups;
    }
}
