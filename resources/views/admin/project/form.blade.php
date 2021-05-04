@extends('admin.layout')
@section('content')
    @if(Route::is('admin.project.edit'))
        <form method="POST" action="{{route('admin.project.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.project.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        @if(Route::is('admin.project.edit'))
                                        <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.project.show', $entry->id)}}">{{ $entry->name }}</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                                        @else
                                            <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.dashboard.index')}}">Lista projektów</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                                        @endif
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

                                        @isset($selected_client)
                                            @include('form-elements.html-select', ['label' => 'Klient', 'name' => 'client_id', 'select' => $clients, 'selected' => $selected_client, 'required' => 1])
                                        @else
                                            @include('form-elements.html-select', ['label' => 'Klient', 'name' => 'client_id', 'select' => $clients, 'required' => 1])
                                        @endif

                                        @include('form-elements.input-text', ['label' => 'Data rozpoczęcia', 'name' => 'date_start', 'value' => $entry->date_start, 'required' => 1])
                                        @include('form-elements.input-text', ['label' => 'Data zakończenia', 'name' => 'date_end', 'value' => $entry->date_end, 'required' => 1])


                                        @include('form-elements.input-text', ['label' => 'Słowa kluczowe', 'sublabel'=> 'Słowa oddzielone przecinkami', 'name' => 'keywords', 'value' => $entry->keywords, 'required' => 1])
                                        @include('form-elements.textarea', ['label' => 'Dodatkowe informacje', 'name' => 'description', 'value' => $entry->description, 'rows' => 11])
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
@push('style')
    <link href="/css/jquery-ui.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="/js/jquery-ui.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#form_date_start, #form_date_end').datepicker({dateFormat: "yy-mm-dd"});
        });
    </script>
@endpush
