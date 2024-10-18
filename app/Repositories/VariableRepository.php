<?php

namespace App\Repositories;

use App\Interfaces\VariableRepositoryInterface;
use App\Models\Variable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class VariableRepository implements VariableRepositoryInterface
{
    public static function byId($id): ?Variable
    {
        return Auth::user()->variables()->where('id', $id)->first();
    }

    public static function all(): Collection
    {
        return Auth::user()->variables()->get();
    }

    public static function defaults(): Collection
    {
        return Variable::where(['user_id' => null, 'created_at' => Carbon::create(1990, 1, 1)])->get();
    }

    public static function idIn(array $ids, bool $includeDefaults = false): Collection
    {
        return $includeDefaults ? Variable::whereIn('id', $ids)->get() : Auth::user()->variables()->whereIn('id', $ids)->get();
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
