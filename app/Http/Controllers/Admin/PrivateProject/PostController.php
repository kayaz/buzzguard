<?php

namespace App\Http\Controllers\Admin\PrivateProject;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\PostType;
use App\Models\Post;
use App\Models\MyProject;


class PostController extends Controller
{
    public function create(MyProject $project)
    {
        return view('admin.private.post.form', [
            'cardTitle' => 'Dodaj wpis',
            'post_type' => PostType::all()->pluck('name', 'slug')->toArray(),
            'project' => $project,
            'backButton' => route('admin.project.private.show', $project)
        ])->with('entry', MyProject::make());
    }

    public function store(PostFormRequest $request)
    {
        $request->merge([
            'user_id' => Auth::id(),
            'date' => date("Y-m-d")
        ]);

        Post::create($request->except(['_token', 'submit']));

        return redirect(route('admin.project.private.show', $request->project_id));
    }

    public function edit(MyProject $project, Post $post)
    {

        return view('admin.private.post.form', [
            'cardTitle' => 'Dodaj wpis',
            'post_type' => PostType::all()->pluck('name', 'slug')->toArray(),
            'project' => $project,
            'entry' => $post,
            'backButton' => route('admin.project.private.show', $project)
        ]);
    }

    public function update(PostFormRequest $request, Post $post)
    {
        $post->update($request->except(['_token', 'submit']));
        return redirect(route('admin.project.private.show', $request->project_id));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['href' => route('admin.project.private.show', ['project' => $post->project_id])]);
    }
}
