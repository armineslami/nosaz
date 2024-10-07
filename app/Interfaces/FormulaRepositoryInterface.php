<?php

namespace App\Interfaces;

use App\Models\Formula;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface FormulaRepositoryInterface
{
    public static function byId($id): ?Formula;
    public static function all(): Collection;
    public static function paginate($count = 20): LengthAwarePaginator;
    public static function create(string $name, string $payload, int $user_id, bool $private = false): Formula;
    public static function update(int $id, mixed $formula): bool;
    public static function deleteById(int $id): int;
}
