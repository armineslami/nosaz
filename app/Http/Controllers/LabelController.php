<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLabelRequest;
use App\Repositories\LabelRepository;
use App\Services\Formula\FormulaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LabelController extends Controller
{
    public function create(): View
    {
        $labels = LabelRepository::all();
        return view('formula.label.create', ['labels' => $labels->all()]);
    }

    public function store(CreateLabelRequest $request): JsonResponse|RedirectResponse
    {
        $label = FormulaService::createLabel(
            name: $request->name,
            is_parent: $request->type,
            parent_id: isset($request->parent) ? $request->parent : null,
            user_id: Auth::user()->id
        );

        if ($request->ajax()) {
            return response()->json([
                'stored' => isset($label),
                'message' => 'Label successfully created',
                'label' => $label
            ], 201);
        }

        return Redirect::route('formula.label.create')->with('status', 'label_created');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = FormulaService::destroyLabel($request->id, Auth::user()->id);
        return response()->json(['deleted' => $result]);
    }
}
