<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public static function byId($id): ?Project
    {
        return Auth::user()->projects()->where('id', $id)->first();
    }

    public static function all(): Collection
    {
        return Auth::user()->projects()->get();
    }
    public static function paginate($count = 20): LengthAwarePaginator
    {
        return Auth::user()->projects()->paginate($count);
    }

    public static function create(string $name, string $description = null, array $variables, int $formulaId, int $user_id): Project
    {
        return Project::create([
            'name' => $name,
            'description' => $description,
            'variables' => json_encode($variables),
            'formula_id' => $formulaId === 0 ? null : $formulaId,
            'user_id' => $user_id,
        ]);
    }

    public static function update(int $id, mixed $project): bool
    {
        return Auth::user()->projects()->findOrFail($id)->update($project);
    }

    public static function destroy(int $id, int $user_id): bool
    {
        $project = self::byId($id);
        if ($project->user_id === $user_id) {
            return Project::destroy($id);
        }
        return false;
    }
}
