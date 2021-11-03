<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectFormRequest;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Year;
use App\Models\Project;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:project-create|project-edit|project-delete', ['only' => ['index','store']]);
        $this->middleware('permission:project-create', ['only' => ['create','store']]);
        $this->middleware('permission:project-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    }

    public function create()
    {
        $years = Year::orderByDesc('year')->get()->pluck('year','year');
        $clients = User::where('client', 1)->pluck('name', 'id');

        return view('admin.project.form', [
            'cardTitle' => 'Dodaj projekt',
            'years' => $years,
            'clients' => $clients,
            'selected' => '',
            'backButton' => route('admin.dashboard.index')
        ])->with('entry', Project::make());
    }

    public function store(ProjectFormRequest $request)
    {
        $deferenceInDays = Carbon::parse($request->date_start)->diffInDays($request->date_end);
        $month = Carbon::parse($request->date_start)->format('m');

        $id = Project::create($request->merge([
            'month' => $month,
            'days' => $deferenceInDays
        ])->except(['_token', 'submit']));

        return redirect(route('admin.project.show', $id));
    }

    public function edit(Project $project)
    {
        $years = Year::orderByDesc('year')->get()->pluck('year','year');
        $clients = User::where('client', 1)->pluck('name', 'id');

        return view('admin.project.form', [
            'entry' =>$project,
            'cardTitle' => 'Edytuj',
            'years' => $years,
            'clients' => $clients,
            'selected_year' => $project->year,
            'selected_client' => $project->client_id,
            'backButton' => route('admin.project.show', $project->id)
        ]);
    }

    public function update(ProjectFormRequest $request, Project $project)
    {
        $deferenceInDays = Carbon::parse($request->date_start)->diffInDays($request->date_end);
        $month = Carbon::parse($request->date_start)->format('m');

        $project->update($request->merge([
            'month' => $month,
            'days' => $deferenceInDays
        ])->except(['_token', 'submit']));

        return redirect(route('admin.project.show', $project->id));
    }

    public function show(Project $project)
    {
        return view('admin.project.index', [
            'project' => $project
        ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['href' => route('admin.year.show', $project->year)]);
    }
}
