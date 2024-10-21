<?php

namespace App\Services\Settings;

use App\Repositories\SettingsRepository;

class SettingsService
{
    public static function update(mixed $settings): bool
    {
        return SettingsRepository::update($settings);
    }
}