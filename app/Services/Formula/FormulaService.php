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

    public static function importFormula(int $id, int $user_id): Formula
    {
        $formula = FormulaRepository::byId($id, true);

        $payload = $formula->payload;

        // Match IDs between ##
        preg_match_all('/#(\d+)#/', $formula->payload, $variableMatches);
        $variableIds = $variableMatches[1]; // Extracted IDs between ##

        $variables = VariableRepository::idIn($variableIds, true);

        foreach ($variables as $variable) {
            $newVariable = self::createVariable($variable->name, $user_id);
            // replace $variable->id with $newVariable->id inside $payload (ids are between ##)
            $payload = str_replace("#{$variable->id}#", "#{$newVariable->id}#", $payload);
        }

        // Match IDs between <>
        preg_match_all('/<(\d+)>/', $formula->payload, $labelMatches);
        $labelIds = $labelMatches[1]; // Extracted IDs between <>

        $allOwnerUserLabels = LabelRepository::allByUserId($formula->user->id);

        $createdLabelIds = [];

        foreach ($labelIds as $id) {
            $ownerLabel = $allOwnerUserLabels->where("id", $id)->first();
            if (!isset($createdLabelIds[$id])) {
                if ($ownerLabel->is_parent) {
                    $newLable = self::createLabel(
                        $ownerLabel->name,
                        $ownerLabel->is_parent,
                        $ownerLabel->unit,
                        $ownerLabel->parent_id,
                        $user_id
                    );
                    $createdLabelIds[$id] = $newLable->id;
                    $payload = str_replace("<{$id}>", "<{$newLable->id}>", $payload);
                } else {
                    $parentId = null;
                    $parent = $ownerLabel->parent;
                    if (isset($createdLabelIds[$parent->id])) {
                        $parentId = $createdLabelIds[$parent->id];
                    } else {
                        $newParent = self::createLabel(
                            $parent->name,
                            $parent->is_parent,
                            $parent->unit,
                            $parent->parent_id,
                            $user_id
                        );
                        $parentId = $newParent->id;
                        $createdLabelIds[$parent->id] = $newParent->id;
                        $payload = str_replace("<{$parent->id}>", "<{$newParent->id}>", $payload);
                    }
                    $newLable = self::createLabel(
                        $ownerLabel->name,
                        $ownerLabel->is_parent,
                        $ownerLabel->unit,
                        $parentId,
                        $user_id
                    );
                    $createdLabelIds[$id] = $newLable->id;
                    $payload = str_replace("<{$id}>", "<{$newLable->id}>", $payload);
                }
            }
        }

        return self::createFormula(
            name: $formula->name,
            formula: $payload,
            user_id: $user_id
        );
    }
}
