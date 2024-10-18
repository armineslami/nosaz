<?php

namespace App\Interfaces;

use App\Models\Variable;
use Illuminate\Database\Eloquent\Collection;

interface VariableRepositoryInterface
{
    public static function byId($id): ?Variable;
    public static function all(): Collection;
    public static function defaults(): Collection;
    public static function idIn(array $ids, bool $includeDefaults = false): Collection;
    public static function create(string $name, int $user_id = null): Variable;
    public static function destroy(int $id, int $user_id): bool;
}
