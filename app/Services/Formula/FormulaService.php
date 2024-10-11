<?php

namespace App\Services\Formula;

use App\Models\Formula;
use App\Models\Variable;
use App\Repositories\FormulaRepository;
use App\Repositories\VariableRepository;
use Illuminate\Support\Facades\Auth;

class FormulaService
{
    public static function CreateVariable(string $name, int $user_id = null): Variable
    {
        return VariableRepository::create($name, $user_id);
    }

    public static function destroyVariable(int $id, int $user_id = null): bool
    {
        return VariableRepository::destroy($id, $user_id);
    }

    public static function destroyFormula(int $id, int $user_id = null): bool
    {
        return FormulaRepository::destroyById($id, $user_id);
    }

    public static function createFormula(int $name, string $formula, int $user_id): Formula
    {
        return FormulaRepository::create(
            name: $name,
            payload: $formula,
            user_id: $user_id
        );
    }

    public static function updateFormula(int $id, mixed $formula): bool
    {
        return FormulaRepository::update($id, $formula);
    }
}
