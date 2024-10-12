<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormulaRequest;
use App\Repositories\FormulaRepository;
use App\Repositories\LabelRepository;
use App\Repositories\VariableRepository;
use App\Repositories\SettingRepository;
use App\Services\Formula\FormulaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class FormulaController extends Controller
{
    public function index($id = null): View|RedirectResponse {
        if ($id) {
            $formula = FormulaRepository::byId($id);

            if (!$formula) {
                return Redirect::route('formula.index');
            }

            $variables = VariableRepository::all();
            return view('formula.update', ['formula' => $formula, 'variables' => $variables]);
        }

        $formulas = FormulaRepository::paginate(SettingRepository::first()->app_paginate_number);
        return view('formula.index', ['formulas' => $formulas]);
    }

    public function create(): View
    {
        $variables = VariableRepository::all();
        $labels = LabelRepository::all();
        return view('formula.create', ['variables' => $variables, 'labels' => $labels]);
    }

    public function store(CreateFormulaRequest $request): JsonResponse
    {
        $formula = FormulaService::createFormula(
            name: $request->name,
            formula: $request->formula,
            user_id: Auth::user()->id
        );
        return response()->json(['stored' => isset($formula)]);
    }

    public function update(CreateFormulaRequest $request): JsonResponse
    {
        $formula = FormulaService::updateFormula(
            $request->id,
            [
                'name' => $request->name,
                'payload' => $request->formula,
                'user_id' =>  Auth::user()->id
            ]
        );
        return response()->json(['updated' => isset($formula)]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $destroyed = FormulaService::destroyFormula($request->id, Auth::user()->id);
        if ($destroyed) {
            return Redirect::route('formula.index')->with("status", "formula-deleted");
        }
        else {
            return Redirect::route('formula.update')->with("status", "formula-not-deleted");
        }
    }
}
