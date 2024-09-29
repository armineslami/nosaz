<?php

namespace App\Repositories;

use App\Interfaces\VariableRepositoryInterface;
use App\Models\Variable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class VariableRepository implements VariableRepositoryInterface
{
    public static function byId($id, $private = false): ?Variable
    {
        return Auth::user()->variables()->where('id', $id)->first();
    }

    public static function all($private = false): Collection
    {
        return Auth::user()->variables()->get();
    }
}
