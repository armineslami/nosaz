<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    // Define your repository methods here
    static function updateOrCreate(array $attributes, array $values = []): User
    {
        return User::updateOrCreate($attributes, $values);
    }
}
