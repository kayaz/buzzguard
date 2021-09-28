<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Project;

class ChartController extends Controller
{
    public function index(Project $project)
    {

        $start_project = date("Y, m, d", strtotime("-1 month", strtotime($project->date_start)));
        $end_project = date("Y, m, d", strtotime("-1 month", strtotime($project->date_end)));

        $posts = Post::where('project_id', '=', $project->id)->groupBy('date')->selectRaw('count(*) as num, date')->get('date');

        $domains = Post::where('project_id', '=', $project->id)->groupBy('website')->selectRaw('count(*) as num, website')->orderByDesc('num')->get('website');

        $sentiments = Post::where('project_id', '=', $project->id)->groupBy('sentiment')->selectRaw('count(*) as num, sentiment')->orderByDesc('num')->get('sentiment');

        return view('admin.project.chart.index', [
            'project' => $project,
            'posts' => $posts,
            'domains' => $domains,
            'sentiments' => $sentiments,
            'start_project' => $start_project,
            'end_project' => $end_project
        ]);
    }
}
