@extends('admin.layout')
@section('content')
<form method="POST" action="{{route('admin.year.store')}}">
    @csrf
    <div class="container">
        <div class="card">
            <div class="card-head container">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row">
                            <i class="fe-book-open"></i><a href="{{route('admin.year.index')}}">Lista lat</a>
                            <span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}
                        </h4>
                    </div>
                </div>
            </div>
            @include('form-elements.back-route-button')
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @include('form-elements.input-text', ['label' => 'Rok', 'name' => 'year', 'value' => $entry->year, 'required' => 1])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
</form>
@endsection
