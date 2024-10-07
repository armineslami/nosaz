<?php

namespace App\Http\Controllers;

use App\Repositories\FormulaRepository;
use App\Repositories\VariableRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

            return view('formula.update', ['formula' => $formula]);
        }

        $formulas = FormulaRepository::paginate(SettingRepository::first()->app_paginate_number);
        return view('formula.index', ['formulas' => $formulas]);
    }

    public function create(): View
    {
        $variables = VariableRepository::all();
        return view('formula.create', ['variables' => $variables]);
    }

    public function store(Request $request)
    {

    }
}
