@extends('admin.layout')
@section('content')
@if(Route::is('admin.project.chat.edit'))
<form method="POST" action="{{route('admin.project.chat.update', ['project' => $project, 'chat' => $entry])}}">
@method('PUT')
@else
<form method="POST" action="{{route('admin.project.chat.store', $project->id)}}">
@endif
@csrf
        <div class="container">
            <div class="card">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title row">
                                <i class="fe-home"></i><a href="{{ route('admin.project.chat', $project->id) }}">{{$project->name}}</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}
                            </h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                            @include('form-elements.textarea', ['label' => 'Treść', 'name' => 'content', 'value' => $entry->content, 'rows' => 11, 'class' => 'tinymce', 'required' => 1])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="project_id" value="{{$project->id}}">
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
    @include('form-elements.minitinymce')
@endsection
