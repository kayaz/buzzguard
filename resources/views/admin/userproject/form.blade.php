@extends('admin.layout')
@section('content')
@if(Route::is('admin.userproject.edit'))
    <form method="POST" action="{{route('admin.userproject.update', $entry->id)}}">
@method('PUT')
@else
    <form method="POST" action="{{route('admin.userproject.store')}}">
@endif
@csrf
        <div class="container">
            <div class="card">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title row"><i class="fe-home"></i><a href="{{ route('admin.project.show', $project->id) }}">{{$project->name}}</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="user" class="col-2 col-form-label control-label required">
                                <div class="text-right">Użytkownicy <span class="text-danger d-inline">*</span></div></label>
                                <div class="col-4">
                                    <select class="form-control" id="user" name="user_id">
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}" @if($entry->user_id && $entry->user_id == $user->id) selected @endif>{{$user->surname}} {{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @include('form-elements.input-text', ['label' => 'Dzienny limit postów', 'name' => 'limit', 'value' => $entry->limit, 'required' => 1])
                            @include('form-elements.input-text', ['label' => 'Limit postów na projekt', 'name' => 'limit_project', 'value' => $entry->limit_project, 'required' => 1])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="project_id" value="{{$project->id}}">
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
