<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Project;

class IndexController extends Controller
{

    public function show(Project $project)
    {
        $count = Post::where('project_id', '=', $project->id)->count();

        return view('admin.project.index', [
            'count' => $count,
            'project' => $project
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
            $result = Project::where('name', 'LIKE', '%' .$keyword. '%')->orderByDesc('id')->where('status', '=', 1)->get(['name', 'id']);
            return response()->json($result);
        }
    }
}
