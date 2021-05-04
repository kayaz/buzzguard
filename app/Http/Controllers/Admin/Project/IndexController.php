<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Year;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectFile;

class IndexController extends Controller
{

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

    public function edit($id)
    {
        $project = Project::find($id);

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
        $count = Post::where('project_id', '=', $project->id)->count();
        $files = ProjectFile::where('project_id', $project->id)->get();

        return view('admin.project.index', [
            'count' => $count,
            'project' => $project,
            'files' => $files
        ]);
    }

    public function charts(Project $project)
    {
        $count = Post::where('project_id', '=', $project->id)->count();

        return view('admin.project.charts', [
            'count' => $count,
            'project' => $project
        ]);
    }

    public function chats(Project $project)
    {
        $count = Post::where('project_id', '=', $project->id)->count();

        return view('admin.project.chats', [
            'count' => $count,
            'project' => $project
        ]);
    }

    public function calendar(Project $project)
    {
        $posts = Post::where('project_id', '=', $project->id)->get();

        $dates = array();
        $current = strtotime($project->date_start);
        $end = strtotime($project->date_end);

        while ($current <= $end) {
            $dates[] = date('Y-m-d', $current);
            $current = strtotime('+1 days', $current);
        }

        return view('admin.project.calendar', [
            'calendar' => $dates,
            'posts' => $posts,
            'project' => $project
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->get('term');

        if($keyword) {
            $result = Project::where('name', 'LIKE', '%' .$keyword. '%')->orderByDesc('id')->get(['name', 'id']);
            return response()->json($result);
        }
    }

    public function upload(Request $request)
    {
        $project_file = ProjectFile::create($request->merge([
            'project_id' => $request->get('project_id')
        ])->only([
            'project_id'
        ]));

        if ($request->hasFile('qqfile')) {
            $project_file->imageUpload($request->file('qqfile'));
        }
        Session::flash('success', 'Plik dodany');
        return response()->json(['success' => true]);
    }

    public function deletefile($id)
    {

        $projectFile = ProjectFile::find($id);

        if ($projectFile->file) {
            $file_path = public_path('uploads/projects/files/' . $projectFile->file);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $projectFile->delete();
        Session::flash('success', 'Plik usunięty');
        return redirect(route('admin.project.show', $projectFile->project_id));
    }
}
