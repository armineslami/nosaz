<?php

namespace App\Repositories;

use App\Interfaces\SettingsRepositoryInterface;
use App\Models\Setting;
use Auth;

class SettingsRepository implements SettingsRepositoryInterface
{
    public static function first(): Setting
    {
        return Setting::first();
    }

    public static function update(mixed $settings): bool
    {
        return Auth::user()->settings()->update($settings);
    }
}
