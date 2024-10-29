<?php

namespace App\Repositories;

use App\Interfaces\LabelRepositoryInterface;
use App\Models\Label;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class LabelRepository implements LabelRepositoryInterface
{
    public static function byId($id): ?Label
    {
        return Auth::user()->labels()->where('id', $id)->first();
    }

    public static function all(): Collection
    {
        return Auth::user()->labels()->get();
    }

    public static function allByUserId(int $user_ud): Collection
    {
        return Label::where('user_id', $user_ud)->get();
    }

    public static function idIn(array $ids, bool $includeDefaults = false): Collection
    {
        return $includeDefaults ? Label::whereIn('id', $ids)->get() : Auth::user()->labels()->whereIn('id', $ids)->get();
    }

    public static function create(string $name, bool $is_parent, string $unit = null, int $parent_id = null, int $user_id = null): Label
    {
        return Label::create([
            'name' => $name,
            'is_parent' => $is_parent,
            'unit' => $unit,
            'parent_id' => $parent_id,
            'user_id' => $user_id
        ]);
    }

    public static function destroy(int $id, int $user_id): bool
    {
        $label = self::byId($id);
        if ($label->user_id === $user_id) {
            return Label::destroy($id);
        }
        return false;
    }
}
