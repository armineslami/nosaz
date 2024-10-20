<?php

namespace App\Repositories;

use App\Interfaces\SettingsRepositoryInterface;
use App\Models\Setting;

class SettingsRepository implements SettingsRepositoryInterface
{
    public static function first(): Setting
    {
        return Setting::first();
    }

    public static function update(Setting $old_setting, array $new_setting): bool
    {
        return $old_setting->fill($new_setting)->save();
    }
}
