<?php

namespace App\Services\Formula;

use App\Models\Variable;
use App\Repositories\VariableRepository;

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
}
