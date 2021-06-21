@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.submenu')
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow p-5">
                    <div class="container p-0">
                        <div class="row no-gutters">
                            <div class="col-6">
                                <h2 class="mb-5"><i class="fe-briefcase"></i> Grupa projektów: {{ $entry->name }}</h2>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end pb-3">
                                    <a href="{{ route('admin.group.index') }}" class="btn btn-lg btn-primary"><i class="fe-arrow-left"></i> Wróć do listy</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table data-table mb-0 w-100" id="sortable">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>Nazwa</th>
                                        <th>Rok</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody class="content">
                                    @foreach($list as $p)
                                        <tr>
                                            <td><a href="{{ route('admin.group.show', $p->id) }}">{{$p->name}}</a></td>
                                            <td>{{$p->year}}</td>
                                            <td>{!! status($p->status) !!}</a></td>
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
