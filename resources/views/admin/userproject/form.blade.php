@extends('admin.layout')
@section('content')
    <form method="POST" action="{{route('admin.userproject.store')}}" enctype="multipart/form-data">
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
                                        <option value="{{$user->id}}">{{$user->surname}} {{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="project_id" value="{{$project->id}}">
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
