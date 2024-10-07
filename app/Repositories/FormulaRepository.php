<?php

namespace App\Repositories;

use App\Interfaces\FormulaRepositoryInterface;
use App\Models\Formula;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class FormulaRepository implements FormulaRepositoryInterface
{
    public static function byId($id): ?Formula
    {
        return Formula::find($id);
    }

    public static function all(): Collection
    {
        return Formula::all();
    }

    public static function paginate($count = 20): LengthAwarePaginator
    {
        return Formula::paginate($count);
    }

    public static function create(string $name, string $payload, int $user_id, bool $private = false): Formula
    {
        return Formula::create([
            'name' => $name,
            'payload' => $payload,
            'user_id' => $user_id,
            'private' => $private
        ]);
    }

    public static function update(int $id, mixed $formula): bool
    {
        return Formula::findOrFail($id)->update($formula);
    }

    public static function deleteById(int $id): int
    {
        return Formula::destroy($id);
    }
}
