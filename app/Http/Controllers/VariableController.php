<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVariableRequest;
use App\Repositories\VariableRepository;
use App\Services\Formula\FormulaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VariableController extends Controller
{
    public function create(): View
    {
        $variables = VariableRepository::all();
        return view('formula.variable.create', ['variables' => $variables->all()]);
    }

    public function store(CreateVariableRequest $request)
    {
        FormulaService::createVariable($request->name, Auth::user()->id);
        return Redirect::route('formula.variable.create')->with('status', 'variable_created');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = FormulaService::destroyVariable($request->id, Auth::user()->id);
        return response()->json(['deleted' => $result ]);
    }
}
