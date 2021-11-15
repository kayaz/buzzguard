<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;

use App\Http\Requests\ReplyFormRequest;
use App\Models\Chat;
use App\Models\Project;

use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{

    public function create(Project $project, Chat $chat)
    {
        return view('admin.project.chat.reply', [
            'cardTitle' => 'Dodaj odpowiedź',
            'project' => $project,
            'chat' => $chat,
            'backButton' => route('admin.project.chat.show', [$project, $chat])
        ])->with('entry', Chat::make());
    }

    public function store(ReplyFormRequest $request, Project $project)
    {
        $request->merge([
            'user_id' => Auth::id(),
            'data' => date("d.m.Y - H:i:s"),

        ]);
        Chat::create($request->only(
            [
                'project_id',
                'parent_id',
                'user_id',
                'content',
                'data'
            ]
        ));
        return redirect(route('admin.project.chat.show', [$request->project_id, $request->parent_id]));
    }

    public function edit(Project $project, Chat $chat, $id)
    {
        $reply = Chat::find($id);
        return view('admin.project.chat.reply', [
            'cardTitle' => 'Edytuj odpowiedź',
            'project' => $project,
            'chat' => $chat,
            'entry' => $reply,
            'backButton' => route('admin.project.chat.show', [$project, $chat])
        ]);
    }

    public function update(ReplyFormRequest $request, Project $project, Chat $chat, $id)
    {
        $reply = Chat::find($id);
        $reply->update($request->only(
            [
                'content'
            ]
        ));
        return redirect(route('admin.project.chat.show', [$project, $chat]));
    }

    public function destroy($id)
    {
        $chat = Chat::find($id);
        $chat->delete();
        return response()->json(['href' => route('admin.project.chat.show', ['project' => $chat->project_id, 'chat' => $chat->parent_id])]);
    }

    public function helpful($id)
    {
        $chat = Chat::find($id);
        ($chat->status == 0) ? $new_status = 1 : $new_status = 0;

        $chat->update(['status' => $new_status]);
        return redirect(route('admin.project.chat.show', ['project' => $chat->project_id, 'chat' => $chat->parent_id]));
    }

}
