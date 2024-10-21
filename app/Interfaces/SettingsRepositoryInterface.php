<?php

namespace App\Interfaces;

use App\Models\Setting;

interface SettingsRepositoryInterface
{
    public static function first(): Setting;
    public static function update(mixed $settings): bool;
}
