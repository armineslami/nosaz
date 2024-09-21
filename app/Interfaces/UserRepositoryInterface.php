<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    static function updateOrCreate(array $attributes, array $values = []): User;
}
