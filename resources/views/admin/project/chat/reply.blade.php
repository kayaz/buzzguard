@extends('admin.layout')
@section('content')
    @if(Route::is('admin.project.reply.edit'))
        <form method="POST" action="{{route('admin.project.reply.update', ['project' => $project, 'chat' => $chat, 'reply' => $entry])}}">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.project.reply.store', ['project' => $project, 'chat' => $chat])}}">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        <h4 class="page-title row">
                                            <i class="fe-home"></i><a href="{{ route('admin.project.chat.show', ['project' => $project, 'chat' => $chat]) }}">{{$project->name}}</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.textarea', ['label' => 'Treść', 'name' => 'content', 'value' => $entry->content, 'rows' => 11, 'class' => 'tinymce', 'required' => 1])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="project_id" value="{{$project->id}}">
                    <input type="hidden" name="parent_id" value="{{$chat->id}}">
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
        @include('form-elements.minitinymce')
@endsection
