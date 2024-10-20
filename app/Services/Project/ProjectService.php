<?php

namespace App\Services\Project;
use App\Models\Project;
use App\Repositories\FormulaRepository;
use App\Repositories\LabelRepository;
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

    static public function calculate(array $variables, int $formulaId, int $user_id): null|Collection
    {
        $formula = FormulaRepository::byId($formulaId, true);

        if (!isset($formula)) {
            return null;
        }

        $payload = $formula->payload;
        $calculation = [];
        $labelIds = [];

        preg_match_all('/[^=]*?=<[^>]+>/', $payload, $matches);
        $lines = $matches[0];


        // Extract all labels ids which are after = inside <>.
        foreach ($lines as $line) {
            // Extract the right-hand side value inside the '<>' (e.g., <X>)
            preg_match('/=<(\d+)>/', $line, $match);
            $labelId = $match[1];
            array_push($labelIds, $labelId);
        }

        $labels = LabelRepository::idIn($labelIds, true);

        foreach ($lines as $line) {

            // Extract the right-hand side value inside the '<>' (e.g., <X>)
            preg_match('/=<(\d+)>/', $line, $match);
            $labelId = $match[1];

            // Replace every #X# with var_X in the expression
            $expression = preg_replace_callback('/#(\d+)#/', function ($matches) use ($variables) {
                $varKey = 'var_' . $matches[1];
                return isset($variables[$varKey]) ? $variables[$varKey] : 0; // Fallback to 0 if var not found
            }, $line);

            // Remove the =<X> part from the expression to leave only the math part
            $expression = preg_replace('/=<\d+>/', '', $expression);

            // Now handle replacements for any <X> in the expression
            $expression = preg_replace_callback('/<(\d+)>/', function ($matches) use ($labels, $calculation) {
                $id = $matches[1];

                $label = $labels->where('id', $id)->first();
                if ($label) {
                    if ($label->parent_id) {
                        $parent = $label->parent;
                        if (isset($calculation[$parent->name][$label->name])) {
                            return $calculation[$parent->name][$label->name]['value'];
                        }
                    } else if (isset($calculation[$label->name])) {
                        return $calculation[$id]['value'];
                    } else {
                        return 0; // Fallback if the calculation for <X> is not found
                    }
                }
                return 0; // Fallback if label not found
            }, $expression);


            try {
                // Evaluate the mathematical expression
                $evalResult = eval ('return ' . $expression . ';');
            } catch (\Throwable $e) {
                // Log::error('Failed to evaluate expression: ' . $expression);
                // Log::error('Error message: ' . $e->getMessage());
                $evalResult = 0;
            }

            $label = $labels->where('id', $labelId)->first();

            // Store the result in $calculation
            if ($label->is_parent) {
                $calculation[$label->name] = ['value' => $evalResult, 'unit' => $label->unit];
            } else {
                $parent = $label->parent;
                $calculation[$parent->name][$label->name] = ['value' => $evalResult, 'unit' => $label->unit];
                ;
            }
        }

        $collection = new Collection();
        $collection->labels = $calculation;
        $collection->formula = $formula;

        return $collection;
    }
}
