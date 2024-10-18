<?php

namespace App\Interfaces;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public static function byId($id): ?Project;
    public static function all(): Collection;
    public static function paginate($count = 20): LengthAwarePaginator;
    public static function create(string $name, string $description = null, array $variables, int $formulaId, int $user_id): Project;
    public static function update(int $id, mixed $project): bool;
}
