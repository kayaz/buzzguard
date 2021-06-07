<?php

namespace App\Http\Controllers\Admin\PrivateProject;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrivateFormRequest;

use App\Models\Year;
use App\Models\MyProject;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{

    public function index()
    {
        return view('admin.private.index', [
            'projects' => MyProject::where('user_id', Auth::id())->get()
        ]);
    }

    public function create()
    {
        $years = Year::orderByDesc('year')->get()->pluck('year','year');
        return view('admin.private.form', [
            'cardTitle' => 'Dodaj projekt',
            'selected' => '',
            'years' => $years,
            'backButton' => route('admin.project.private.index')
        ])->with('entry', MyProject::make());
    }

    public function store(PrivateFormRequest $request)
    {
        MyProject::create(array_merge($request->except(['_token', 'submit']), ['user_id' => Auth::id()]));
        return redirect(route('admin.project.private.index'));
    }

    public function edit($id)
    {
        $project = MyProject::find($id);
        $years = Year::orderByDesc('year')->get()->pluck('year','year');

        return view('admin.private.form', [
            'entry' => $project,
            'cardTitle' => 'Edytuj',
            'years' => $years,
            'selected_year' => $project->year,
            'backButton' => route('admin.project.private.index')
        ]);
    }

    public function update(PrivateFormRequest $request, MyProject $project)
    {
        $project->update($request->except(['_token', 'submit']));
        return redirect(route('admin.project.private.index'));
    }

    public function show(MyProject $project)
    {
        return view('admin.private.show', [
            'project' => $project
        ]);
    }

    public function destroy($id)
    {
        $project = MyProject::find($id);
        $project->delete();
        Session::flash('success', 'Piętro usunięte');
        return response()->json('Deleted', 200);
    }
}
