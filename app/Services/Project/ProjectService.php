<?php

namespace App\Services\Project;
use App\Models\Project;
use App\Repositories\FormulaRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\VariableRepository;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    static public function setUpFormData(int|null $formulaId): object
    {
        $variables = null;

        $formula = FormulaRepository::byId($formulaId, true);
        $variables = self::extractVariableIdsFromFormula($formula);
        $defaults = FormulaRepository::defaults();
        $formulas = FormulaRepository::all();

        return (object) ['formulas' => (object) ['user' => $formulas, 'defaults' => $defaults], 'variables' => $variables];
    }

    static private function extractVariableIdsFromFormula($formula): Collection|null
    {
        if (!isset($formula))
            return null;
        $payload = $formula->payload;
        preg_match_all('/#(.*?)#/', $payload, $matches);
        $ids = $matches[1];
        return VariableRepository::idIn($ids, true);
    }

    static public function create(string $name, string $description = null, array $variables, int $formulaId, int $user_id): Project
    {
        name:
        return ProjectRepository::create($name, $description, $variables, $formulaId, $user_id);
    }

    static public function update(int $id, mixed $project): bool
    {
        return ProjectRepository::update($id, $project);
    }

    static public function destroy(int $id, int $user_id): bool
    {
        return ProjectRepository::destroy($id, $user_id);
    }

    static public function calculate(array $variables, int $formulaId = 0, int $user_id): null|array
    {
        $formula = FormulaRepository::byId($formulaId);

        if (!isset($formula)) {
            return null;
        }

        $payload = $formula->payload;
        $calculation = [];

        dd($payload);

        for ($i = 0; $i < count($payload); $i++) {

        }

        /**
         * 1+2*#3#=<43>  ==>  [
         *  "<43>": [
         *      "value": 10, 
         *      "children": [
         *          "<90">: "2"
         *      ]
         *  ]
         * ]
         */

        return $calculation;
    }
}
