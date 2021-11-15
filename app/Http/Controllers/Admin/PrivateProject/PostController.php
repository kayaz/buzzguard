<?php

namespace App\Http\Controllers\Admin\PrivateProject;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\PostType;
use App\Models\MyPost;
use App\Models\MyProject;


class PostController extends Controller
{
    public function create(MyProject $privateProject)
    {
        $this->authorize('privateProject', $privateProject);

        return view('admin.private.post.form', [
            'cardTitle' => 'Dodaj wpis',
            'post_type' => PostType::all()->pluck('name', 'slug')->toArray(),
            'privateProject' => $privateProject,
            'backButton' => route('admin.project.private.show', $privateProject)
        ])->with('entry', MyProject::make());
    }

    public function store(PostFormRequest $request)
    {
        $request->merge([
            'user_id' => Auth::id(),
            'date' => date("Y-m-d")
        ]);

        $post = MyPost::create($request->except(['_token', 'submit', 'file']));

        if ($request->hasFile('file')) {
            $post->upload($request->nick, $request->file('file'));
        }

        return redirect(route('admin.project.private.show', $request->project_id));
    }

    public function edit(MyProject $privateProject, MyPost $post)
    {
        $this->authorize('privateProject', $privateProject);

        return view('admin.private.post.form', [
            'cardTitle' => 'Dodaj wpis',
            'post_type' => PostType::all()->pluck('name', 'slug')->toArray(),
            'privateProject' => $privateProject,
            'entry' => $post,
            'backButton' => route('admin.project.private.show', $privateProject)
        ]);
    }

    public function update(PostFormRequest $request, MyPost $post)
    {
        $post->update($request->except(['_token', 'submit', 'file']));

        if ($request->hasFile('file')) {
            $post->upload($request->nick, $request->file('file'), $post->file);
        }

        return redirect(route('admin.project.private.show', $request->project_id));
    }

    public function destroy(MyPost $post)
    {
        $post->delete();
        return response()->json(['href' => route('admin.project.private.show', ['project' => $post->project_id])]);
    }
}
