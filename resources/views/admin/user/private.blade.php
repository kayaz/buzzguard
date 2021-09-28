@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.submenu')
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow p-5">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-3 text-center">
                                <div class="d-flex justify-content-center">
                                    <span class="user-rounded-circle">
                                        @if($user->name && $user->surname)
                                            {!! mb_substr($user->name, 0, 1, 'UTF-8') !!}{!! mb_substr($user->surname, 0, 1, 'UTF-8') !!}
                                        @else
                                            <i class="fe-user"></i>
                                        @endif
                                    </span>
                                </div>
                                <h2>{{ $user->surname }} {{ $user->name }}</h2>
                            </div>
                            <div class="col-9">
                                <div class="card-header border-bottom card-nav p-0">
                                    <ul class="nav">
                                        <li><a class="nav-link pt-3 pb-3" href="{{route('admin.user.show', $user->id)}}"><span class="fe-folder"></span>Otwarte projekty</a></li>
                                        <li><a class="nav-link pt-3 pb-3 active" href="{{route('admin.user.private', $user->id)}}"><span class="fe-briefcase"></span>Prywatne projekty</a></li>
                                    </ul>
                                </div>
                                <table class="table data-table mb-0 w-100" id="sortable">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>Nazwa</th>
                                        <th class="text-center">Data rozpoczęcia</th>
                                        <th class="text-center">Data zakończenia</th>
                                        <th class="text-center">Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="content">
                                    @foreach($projects as $pr)
                                        <tr>
                                            <td><a href="{{ route('admin.user.private.show', $pr->id) }}">{{$pr->name}}</a></td>
                                            <td class="text-center">{{$pr->date_start}}</td>
                                            <td class="text-center">{{$pr->date_end}}</td>
                                            <td class="text-center">{!! status($pr->status) !!}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
