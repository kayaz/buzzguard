<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupFormRequest;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    function __construct(){
        $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index','store','show']]);
        $this->middleware('permission:group-create', ['only' => ['create','store']]);
        $this->middleware('permission:group-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:group-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.group.index', ['list' => Group::orderBy('id', 'asc')->get()]);
    }

    public function create()
    {

        return view('admin.group.form', [
            'cardTitle' => 'Nowa grupa',
            'backButton' => route('admin.group.index'),
            'projects' => Project::orderBy('name', 'asc')->pluck('name', 'id')
        ])->with('entry', Group::make());
    }

    public function store(GroupFormRequest $request)
    {
        Group::create($request->except(['_token', 'submit']));
        return redirect(route('admin.group.index'))->with('success', 'Nowa grupa dodana');
    }

    public function show($id)
    {
        $entry = Group::find($id);

        return view('admin.group.show', [
            'entry' => $entry,
            'list' => Project::whereIn('id', $entry->projects)->orderByDesc('year')->get()
        ]);
    }

    public function edit($id)
    {
        $entry = Group::find($id);

        return view('admin.group.form', [
            'entry' => $entry,
            'cardTitle' => 'Edytuj grupę',
            'backButton' => route('admin.group.index'),
            'projects' => Project::orderBy('name', 'asc')->pluck('name', 'id'),
            'selected_projects' => $entry->projects
        ]);
    }

    public function update(GroupFormRequest $request, Group $group)
    {
        $group->update($request->except(['_token', 'submit']));
        return redirect(route('admin.group.index'))->with('success', 'Grupa zaktualizowana');
    }

    public function destroy($id)
    {
        $entry = Group::find($id);
        $entry->delete();
        Session::flash('success', 'Grupa usunięte');
        return response()->json('Deleted');
    }
}
