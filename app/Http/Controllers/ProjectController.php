<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateProjectRequest;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\FormulaRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\SettingsRepository;
use App\Services\Project\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Arr;

class ProjectController extends Controller
{
    public function index($id = null): View|RedirectResponse
    {
        if ($id) {
            $project = ProjectRepository::byId($id);

            if (!$project) {
                return Redirect::route('project.index');
            }

            $project->variables = json_decode($project->variables);
            $data = ProjectService::setUpFormData($project->formula_id);

            return view(
                'project.update',
                ['project' => $project, 'data' => $data, 'formulaId' => $project->formula_id]
            );
        }

        $projects = ProjectRepository::paginate(SettingsRepository::first()->app_paginate_number);
        return view('project.index', ['projects' => $projects]);
    }

    public function create(Request $request): View|RedirectResponse
    {
        $data = ProjectService::setUpFormData($request->query('formulaId'));

        // If formula id is not correct, variables will be null and in this case redirect to default formula
        if (is_null($data->variables)) {
            $formulas = FormulaRepository::defaults();
            return Redirect()->to('/project/create?formulaId=' . $formulas->first()->id);
        }

        return view(
            'project.create',
            ['data' => $data, 'formulaId' => $request->query('formulaId')]
        );
    }

    public function store(CreateProjectRequest $request): RedirectResponse
    {
        $project = ProjectService::create(
            $request->name,
            $request->description,
            Arr::except($request->validated(), ['name', 'formula', 'description']),
            $request->formula,
            user_id: Auth::user()->id
        );

        if (isset($project)) {
            return Redirect::route('project.index', $project->id)->with('status', 'project-created');
        } else {
            return Redirect::route('project.create')->with('status', 'project-not-created');
        }
    }

    public function update(UpdateProjectRequest $request): RedirectResponse
    {
        $updated = ProjectService::update(
            $request->id,
            [
                'name' => $request->name,
                'description' => $request->description,
                'variables' => Arr::except($request->validated(), ['name', 'description']),
            ]
        );

        return Redirect::route('project.index', $request->id)->with('status', $updated ? 'project-updated' : 'project-not-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $destroyed = ProjectService::destroy($request->id, Auth::user()->id);
        if ($destroyed) {
            return Redirect::route('project.index')->with('status', 'project-destroyed');
        } else {
            return Redirect::route('project.update', $request->id)->with('status', 'project-not-destroyed');
        }
    }

    public function calculate(CalculateProjectRequest $request): View|RedirectResponse
    {
        $result = ProjectService::calculate(
            variables: Arr::except($request->validated(), ['name', 'description', 'formula']),
            formulaId: $request->validated()['formula'],
            user_id: Auth::user()->id
        );

        if ($result) {
            return view(
                'project.calculation',
                [
                    'labels' => $result->labels,
                    'formula' => $result->formula,
                    'project' => [
                        'name' => $request->validated()['name'] ?? null,
                        'description' => $request->validated()['description'] ?? null
                    ]
                ]
            );
        } else {
            return redirect()->back()->with('status', 'formula-pyload-corrupted');
        }
    }

    public function search(Request $request): View|RedirectResponse
    {
        $query = $request->input('query');
        if (!isset($query)) {
            return Redirect::route('project.index');
        }
        $result = ProjectService::search(query: $query, count: SettingsRepository::first()->app_paginate_number);
        return view('project.index', ['search_result' => $result, 'query' => $query]);
    }
}
