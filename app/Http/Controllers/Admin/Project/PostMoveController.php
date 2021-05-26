<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Project;

class PostMoveController extends Controller
{
    public function edit(Project $project, Post $post)
    {
        return view('admin.project.post.move', [
            'cardTitle' => 'Przenieś wpis',
            'projects' => Project::orderBy('name')->where('status', 1)->get()->pluck('name', 'id')->toArray(),
            'project' => $project,
            'entry' => $post,
            'backButton' => route('admin.project.show', $project)
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->except(['_token', 'submit']));
        return redirect(route('admin.project.show', $request->project_id));
    }
}
