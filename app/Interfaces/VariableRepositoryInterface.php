<?php

namespace App\Interfaces;

use App\Models\Variable;
use Illuminate\Database\Eloquent\Collection;

interface VariableRepositoryInterface
{
    public static function byId($id, $private = false): ?Variable;
    public static function all($private = false): Collection;
}
