<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;

use App\Http\Requests\ChatFormRequest;
use App\Models\Chat;
use App\Models\Project;

use App\Events\QA;

use App\Repositories\ChatRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private $chat_repository;

    public function __construct(ChatRepositoryInterface $chat_repository)
    {
        $this->chat_repository = $chat_repository;
    }

    public function index(Project $project)
    {
        return view('admin.project.chat.index', [
            'project' => $project,
            'posts' => $this->chat_repository->getAllForProject($project->id, 0, 10)
        ]);
    }

    public function create(Project $project)
    {
        $event_array = [
            'project' => $project->name,
            'project_id' => $project->id,
            'user' => Auth::user()->email
        ];

        event(new QA($event_array));

        return view('admin.project.chat.form', [
            'cardTitle' => 'Dodaj nowe pytanie',
            'project' => $project,
            'backButton' => route('admin.project.chat', $project->id)
        ])->with('entry', Chat::make());
    }

    public function store(ChatFormRequest $request)
    {
        $request->merge([
            'user_id' => Auth::id(),
            'data' => date("d.m.Y - H:i:s"),

        ]);
        $chat = Chat::create($request->only(
            [
                'project_id',
                'user_id',
                'name',
                'content',
                'data'
            ]
        ));
        return redirect(route('admin.project.chat.show', [$request->project_id, $chat]));
    }

    public function edit(Project $project, Chat $chat)
    {
        return view('admin.project.chat.form', [
            'cardTitle' => 'Edytuj wpis: '.$chat->name,
            'project' => $project,
            'entry' => $chat,
            'backButton' => route('admin.project.chat', $project->id)
        ]);
    }

    public function update(ChatFormRequest $request, Project $project, Chat $chat)
    {
        $chat->update($request->only(
            [
                'name',
                'content'
            ]
        ));
        return redirect(route('admin.project.chat.show', [$project, $chat]));
    }

    public function show(Project $project, Chat $chat)
    {
        $topic = Chat::with('author')->find($chat->id);
        $posts = Chat::with('author')->where(['parent_id' => $chat->id])->get();

        return view('admin.project.chat.show', [
            'project' => $project,
            'posts' => $posts,
            'topic' => $topic
        ]);
    }

    public function destroy(Project $project, Chat $chat)
    {
        $chat->delete();
        return response()->json(['href' => route('admin.project.chat', ['project' => $project->id])]);
    }
}
