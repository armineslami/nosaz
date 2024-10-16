<?php

namespace App\Services\Formula;

use App\Models\Formula;
use App\Models\Label;
use App\Models\Variable;
use App\Repositories\FormulaRepository;
use App\Repositories\LabelRepository;
use App\Repositories\VariableRepository;

class FormulaService
{
    public static function createVariable(string $name, int $user_id = null): Variable
    {
        return VariableRepository::create($name, $user_id);
    }

    public static function destroyVariable(int $id, int $user_id = null): bool
    {
        return VariableRepository::destroy($id, $user_id);
    }

    public static function createLabel(string $name, bool $is_parent, string $unit = null, int $parent_id = null, int $user_id = null): Label
    {
        return LabelRepository::create(
            name: $name,
            is_parent: $is_parent,
            unit: $unit,
            parent_id: $parent_id,
            user_id: $user_id
        );
    }

    public static function destroyLabel(int $id, int $user_id = null): bool
    {
        return LabelRepository::destroy($id, $user_id);
    }

    public static function createFormula(string $name, string $formula, int $user_id): Formula
    {
        return FormulaRepository::create(
            name: $name,
            payload: $formula,
            user_id: $user_id
        );
    }

    public static function destroyFormula(int $id, int $user_id = null): bool
    {
        return FormulaRepository::destroyById($id, $user_id);
    }

    public static function updateFormula(int $id, mixed $formula): bool
    {
        return FormulaRepository::update($id, $formula);
    }
}
