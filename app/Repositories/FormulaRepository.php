<?php

namespace App\Repositories;

use App\Interfaces\FormulaRepositoryInterface;
use App\Models\Formula;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class FormulaRepository implements FormulaRepositoryInterface
{
    public static function byId($id, bool $includeDefaults = false): ?Formula
    {
        return $includeDefaults ? Formula::where('id', $id)->first() : Auth::user()->formulas()->where('id', $id)->first();
    }

    public static function all(string $column = 'id', string $direction = 'DESC'): Collection
    {
        return Auth::user()->formulas()->orderBy($column, direction: $direction)->get();
    }

    public static function defaults(): Collection
    {
        return Formula::where(['user_id' => null, 'created_at' => Carbon::create(1990, 1, 1)])->get();
    }

    public static function paginate($count = 20, string $column = 'id', string $direction = 'DESC'): LengthAwarePaginator
    {
        return Auth::user()->formulas()->orderBy($column, direction: $direction)->paginate($count);
    }

    public static function create(string $name, string $payload, int $user_id): Formula
    {
        return Formula::create([
            'name' => $name,
            'payload' => $payload,
            'user_id' => $user_id
        ]);
    }

    public static function update(int $id, mixed $formula): bool
    {
        return Auth::user()->formulas()->findOrFail($id)->update($formula);
    }

    public static function destroyById(int $id, int $user_id): bool
    {
        $formula = self::byId($id);
        if ($formula->user_id === $user_id) {
            return Formula::destroy($id);
        }
        return false;
    }
}
