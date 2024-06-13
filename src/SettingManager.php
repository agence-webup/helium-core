<?php

namespace Webup\Helium;

use Webup\Helium\Models\Setting;

class SettingManager
{
    protected function getSetting(string $key): ?Setting
    {
        return Setting::query()->where('key', $key)->first();
    }

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public function get(string $key, ?string $default = null): ?string
    {
        $setting = $this->getSetting($key);

        return $setting?->value ?? $default;
    }

    public function set(string $key, mixed $value): void
    {
        if (! is_string($value)) {
            $value = strval($value);
        }

        $setting = $this->getSetting($key);
        if (! $setting) {
            $setting = new Setting(['key' => $key]);
        }

        $setting->value = $value;
        $setting->save();
    }

    public function all(): array
    {
        return Setting::all()->pluck('value', 'key')->toArray();
    }
}
