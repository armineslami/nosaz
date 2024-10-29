<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormulaRequest;
use App\Http\Requests\ImportFormulaRequest;
use App\Models\Formula;
use App\Repositories\FormulaRepository;
use App\Repositories\LabelRepository;
use App\Repositories\VariableRepository;
use App\Repositories\SettingsRepository;
use App\Services\Formula\FormulaService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;

class FormulaController extends Controller
{
    public function index($id = null, Formula $sharedFormula = null, string $status = null): View|RedirectResponse
    {
        if ($id) {
            $formula = FormulaRepository::byId($id);

            if (!$formula) {
                return Redirect::route('formula.index');
            }

            $variables = VariableRepository::all();
            $labels = LabelRepository::all();

            $share_address = route('formula.share', ['id' => Crypt::encrypt($formula->id)]);

            return view(
                'formula.update',
                [
                    'formula' => $formula,
                    'variables' => $variables,
                    'labels' => $labels,
                    'share_address' => $share_address
                ]
            )->with('status', $status);
        }

        $formulas = FormulaRepository::paginate(SettingsRepository::first()->app_paginate_number);
        return view('formula.index', ['formulas' => $formulas, "sharedFormula" => $sharedFormula]);
    }

    public function create(): View
    {
        $variables = VariableRepository::all();
        $labels = LabelRepository::all();
        return view('formula.create', ['variables' => $variables, 'labels' => $labels]);
    }

    public function store(CreateFormulaRequest $request): JsonResponse|RedirectResponse
    {
        $formula = FormulaService::createFormula(
            name: $request->name,
            formula: $request->formula,
            user_id: Auth::user()->id
        );
        return response()->json(['stored' => isset($formula), 'id' => isset($formula) ? $formula->id : null]);
    }

    public function update(CreateFormulaRequest $request): JsonResponse
    {
        $updated = FormulaService::updateFormula(
            $request->id,
            [
                'name' => $request->name,
                'payload' => $request->formula,
                'user_id' => Auth::user()->id
            ]
        );
        return response()->json(['updated' => $updated]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $destroyed = FormulaService::destroyFormula($request->id, Auth::user()->id);
        if ($destroyed) {
            return Redirect::route('formula.index')->with("status", "formula-deleted");
        } else {
            return Redirect::route('formula.update', $request->id)->with("status", "formula-not-deleted");
        }
    }

    public function share(Request $request): RedirectResponse|View
    {
        $encryptedId = $request->query('id');
        try {
            $decryptedId = Crypt::decrypt($encryptedId);
            $formula = FormulaRepository::byId($decryptedId, true);
            if (!$formula) {
                return Redirect::route('formula.index')->with('status', 'share-link-not-valid');
            }
            if ($formula->user->id === Auth::user()->id) {
                return Redirect::route('formula.index')->with('status', 'formula-already-exists');
            }
            return $this->index(null, $formula);
        } catch (Exception $e) {
            return Redirect::route('formula.index')->with('status', 'share-link-not-valid');
        }
    }

    public function import(ImportFormulaRequest $request): RedirectResponse
    {
        $formula = FormulaService::importFormula($request->id, Auth::user()->id);
        if (isset($formula)) {
            return Redirect::route('formula.index', $formula->id)->with('status', 'formula-imported');
        }
        return Redirect::route('formula.index')->with('status', 'share-link-not-valid');
    }
}
