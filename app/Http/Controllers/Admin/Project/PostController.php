<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\PostType;
use App\Models\Post;
use App\Models\Project;


class PostController extends Controller
{
    public function create(Project $project)
    {
        return view('admin.project.post.form', [
            'cardTitle' => 'Dodaj wpis',
            'post_type' => PostType::all()->pluck('name', 'slug')->toArray(),
            'project' => $project,
            'backButton' => route('admin.project.show', $project)
        ])->with('entry', Post::make());
    }

    public function store(PostFormRequest $request)
    {
        $request->merge([
            'user_id' => Auth::id(),
            'date' => date("Y-m-d")
        ]);

        $post = Post::create($request->except(['_token', 'submit', 'file']));

        if ($request->hasFile('file')) {
            $post->upload($request->nick, $request->file('file'));
        }

        return redirect(route('admin.project.show', $request->project_id));
    }

    public function edit(Project $project, Post $post)
    {

        return view('admin.project.post.form', [
            'cardTitle' => 'Dodaj wpis',
            'post_type' => PostType::all()->pluck('name', 'slug')->toArray(),
            'project' => $project,
            'entry' => $post,
            'backButton' => route('admin.project.show', $project)
        ]);
    }

    public function update(PostFormRequest $request, Post $post)
    {
        $post->update($request->except(['_token', 'submit', 'file']));

        if ($request->hasFile('file')) {
            $post->upload($request->nick, $request->file('file'), $post->file);
        }

        return redirect(route('admin.project.show', $request->project_id));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['href' => route('admin.project.show', ['project' => $post->project_id])]);
    }
}
