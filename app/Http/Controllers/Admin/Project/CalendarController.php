<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Project;

class CalendarController extends Controller
{
    public function index(Project $project)
    {
        $posts = Post::where('project_id', '=', $project->id)->get();
        $dates = array();
        $current = strtotime($project->date_start);
        $end = strtotime($project->date_end);

        while ($current <= $end) {
            $dates[] = date('Y-m-d', $current);
            $current = strtotime('+1 days', $current);
        }

        return view('admin.project.calendar.index', [
            'calendar' => $dates,
            'posts' => $posts,
            'project' => $project
        ]);
    }
}

