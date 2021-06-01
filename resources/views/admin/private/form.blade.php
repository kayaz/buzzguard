@extends('admin.layout')
@section('content')
    @if(Route::is('admin.project.private.edit'))
        <form method="POST" action="{{route('admin.project.private.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.project.private.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.project.private.index', $entry->id)}}">Prywatne projekty</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                                    </div>
                                </div>
                            </div>
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.html-select', ['label' => 'Status', 'name' => 'status', 'selected' => $entry->status, 'select' => ['1' => 'Otwarty', '2' => 'Zamknięty']])
                                        @isset($selected_year)
                                            @include('form-elements.html-select', ['label' => 'Rok', 'name' => 'year', 'select' => $years, 'selected' => $selected_year, 'required' => 1])
                                        @else
                                            @include('form-elements.html-select', ['label' => 'Rok', 'name' => 'year', 'select' => $years, 'required' => 1])
                                        @endif
                                        @include('form-elements.input-text', ['label' => 'Nazwa projektu', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Route::is('admin.project.edit'))
                        <input type="hidden" name="article_id" value="{{$entry->id}}">
                    @endif
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>

@endsection
