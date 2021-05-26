@extends('admin.layout')
@section('content')
<form method="POST" action="{{route('admin.project.post.moved', $entry)}}">
@method('PUT')
@csrf
    <div class="container">
        <div class="card">
            <div class="card-head container">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row">
                            <i class="fe-home"></i><a href="{{ route('admin.project.show', $project) }}">{{$project->name}}</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}
                        </h4>
                    </div>
                </div>
            </div>
            @include('form-elements.back-route-button')
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @include('form-elements.html-select', ['label' => 'Nazwa projektu', 'name' => 'project_id', 'select' => $projects, 'selected' => $project->id, 'required' => 1])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
</form>
@endsection
