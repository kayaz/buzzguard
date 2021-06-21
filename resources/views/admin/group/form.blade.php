@extends('admin.layout')
@section('content')
    @if(Route::is('admin.group.edit'))
        <form method="POST" action="{{route('admin.group.update', $entry->id)}}">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.group.store')}}">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        <h4 class="page-title row">
                                            <i class="fe-book-open"></i><a href="{{route('admin.group.index')}}">Lista grup</a>
                                            <span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                                        @isset($selected_projects)
                                            @include('form-elements.html-select-multiple', ['label' => 'Projekty', 'name' => 'projects', 'select' => $projects, 'selected' => $selected_projects, 'required' => 1])
                                        @else
                                            @include('form-elements.html-select-multiple', ['label' => 'Projekty', 'name' => 'projects', 'select' => $projects, 'required' => 1])
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Route::is('admin.group.edit'))
                        <input type="hidden" name="article_id" value="{{$entry->id}}">
                    @endif
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
    <style>
        select.form-control[multiple] {height: 665px}
    </style>
@endsection
