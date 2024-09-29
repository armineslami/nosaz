<?php

namespace App\Interfaces;

use App\Models\Variable;
use Illuminate\Database\Eloquent\Collection;

interface VariableRepositoryInterface
{
    public static function byId($id, $private = false): ?Variable;
    public static function all($private = false): Collection;
    public static function create(string $name, int $user_id = null): Variable;
    public static function destroy(int $id, int $user_id): bool;
}
