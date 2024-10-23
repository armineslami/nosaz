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

    public static function all(string $column = 'id', string $direction = 'DESC'): Collection
    {
        return Auth::user()->projects()->orderBy($column, direction: $direction)->get();
    }
    public static function paginate($count = 20, string $column = 'id', string $direction = 'DESC'): LengthAwarePaginator
    {
        return Auth::user()->projects()->orderBy($column, direction: $direction)->paginate($count);
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

    public static function search(?string $query, int $count = 20, string $direction = 'DESC'): LengthAwarePaginator
    {
        return Project::where("name", 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orderBy('id', $direction)
            ->paginate($count);
    }
}
