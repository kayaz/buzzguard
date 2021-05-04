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

    public function create(Project $project)
    {
        $users = User::where('client', 0)->orderBy('name')->get(['surname', 'name', 'id']);

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

    public function destroy($id, $project)
    {
        ProjectUser::where('user_id', $id)->delete();

        Session::flash('successuser', 'Użytkownik usunięty');
        return redirect(route('admin.project.show', $project));
    }
}
