<?php

namespace App\Interfaces;

use App\Models\Formula;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface FormulaRepositoryInterface
{
    public static function byId($id, bool $includeDefaults = false): ?Formula;
    public static function all(string $column = 'id', string $direction = 'DESC'): Collection;
    public static function defaults(): Collection;
    public static function paginate($count = 20, string $column = 'id', string $direction = 'DESC'): LengthAwarePaginator;
    public static function create(string $name, string $payload, int $user_id): Formula;
    public static function update(int $id, mixed $formula): bool;
    public static function destroyById(int $id, int $user_id): bool;
}
