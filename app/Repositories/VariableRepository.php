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

    public static function create(string $name, int $user_id = null): Variable
    {
        return Variable::create([
            'name' => $name,
            'user_id' => $user_id
        ]);
    }

    public static function destroy(int $id, int $user_id): bool
    {
        $variable = self::byId($id);
        if ($variable->user_id === $user_id) {
            return Variable::destroy($id);
        }
        return false;
    }
}
