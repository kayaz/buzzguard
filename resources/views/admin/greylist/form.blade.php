@extends('admin.layout')
@section('content')
@if(Route::is('admin.greylist.edit'))
    <form method="POST" action="{{route('admin.greylist.update', $entry->id)}}" enctype="multipart/form-data">
@method('PUT')
@else
    <form method="POST" action="{{route('admin.greylist.store')}}" enctype="multipart/form-data">
@endif
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title row"><i class="fe-book-open"></i><a href="{{route('admin.greylist.index')}}">Greylist</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.input-text', ['label' => 'Adres IP', 'name' => 'address', 'value' => $entry->address, 'required' => 1])
                            @include('form-elements.input-text', ['label' => 'Powód', 'name' => 'reason', 'value' => $entry->reason])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Route::is('admin.greylist.edit'))
            <input type="hidden" name="article_id" value="{{$entry->id}}">
        @endif
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
