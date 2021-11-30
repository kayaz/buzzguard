<?php

namespace App\Http\Controllers\Admin\UserProject;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:userproject-create|userproject-edit|userproject-delete', ['only' => ['index','store']]);
        $this->middleware('permission:userproject-create', ['only' => ['create','store']]);
        $this->middleware('permission:userproject-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:userproject-delete', ['only' => ['destroy']]);
    }

    public function create(Project $project)
    {
        $users = User::orderBy('name')->get(['surname', 'name', 'id']);

        return view('admin.userproject.form', [
            'cardTitle' => 'Dodaj użytkownika',
            'backButton' => route('admin.project.show', $project->id),
            'project' => $project,
            'users' => $users,
        ])->with('entry', User::make());
    }

    public function store(Request $request)
    {
        ProjectUser::create($request->merge([
            'date' => date('Y-m-d'),
        ])->except(['_token', 'submit']));

        return redirect(route('admin.project.show', $request->project_id));
    }

    public function edit($id, Project $project)
    {
        $entry = ProjectUser::find($id);
        $users = User::orderBy('name')->get(['surname', 'name', 'id']);

        return view('admin.userproject.form', [
            'cardTitle' => 'Edytuj użytkownika',
            'backButton' => route('admin.project.show', $project->id),
            'entry' => $entry,
            'project' => $project,
            'users' => $users
        ]);
    }

    public function update(Request $request, ProjectUser $user)
    {
        $user->update($request->except(['_token', 'submit']));
        return redirect(route('admin.project.show', $request->project_id));
    }

    public function destroy($id, $project)
    {
        ProjectUser::where('id', $id)->delete();

        Session::flash('successuser', 'Użytkownik usunięty');
        return redirect(route('admin.project.show', $project));
    }
}
