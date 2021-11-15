<?php

namespace App\Http\Controllers\Admin\PrivateProject;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrivateFormRequest;

use App\Models\MyPost;
use App\Models\Year;
use App\Models\MyProject;

use Illuminate\Http\Request;
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

    public function edit(MyProject $privateProject)
    {
        $this->authorize('privateProject', $privateProject);

        $years = Year::orderByDesc('year')->get()->pluck('year','year');

        return view('admin.private.form', [
            'entry' => $privateProject,
            'cardTitle' => 'Edytuj',
            'years' => $years,
            'selected_year' => $privateProject->year,
            'backButton' => route('admin.project.private.index')
        ]);
    }

    public function update(PrivateFormRequest $request, MyProject $privateProject)
    {
        $this->authorize('privateProject', $privateProject);

        $privateProject->update($request->except(['_token', 'submit']));
        return redirect(route('admin.project.private.index'));
    }

    public function show(MyProject $privateProject)
    {
        $this->authorize('privateProject', $privateProject);

        return view('admin.private.show', [
            'privateProject' => $privateProject
        ]);
    }

    public function modal(Request $request)
    {
        $id = $request->get('id');
        return view('admin.project.post.modal', MyPost::find($id))->render();
    }

    public function destroy($id)
    {
        $project = MyProject::find($id);
        $project->delete();
        Session::flash('success', 'Piętro usunięte');
        return response()->json('Deleted', 200);
    }
}
