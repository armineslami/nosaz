<?php

namespace App\Interfaces;

use App\Models\Label;
use Illuminate\Database\Eloquent\Collection;

interface LabelRepositoryInterface
{
    public static function byId($id): ?Label;
    public static function all(): Collection;
    public static function idIn(array $ids, bool $includeDefaults = false): Collection;
    public static function create(string $name, bool $is_parent, string $unit = null, int $parent_id = null, int $user_id = null): Label;
    public static function destroy(int $id, int $user_id): bool;
}
