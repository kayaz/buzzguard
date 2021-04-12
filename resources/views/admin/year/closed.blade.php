@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-users"></i>Projekty</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                        <a href="#" class="btn btn-primary">Dodaj projekt</a>
                    </div>
                </div>
            </div>

            @include('admin.submenu')
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow p-5">
                    <div class="container p-0">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <h2 class="mb-5"><i class="fe-lock"></i> Zamknięte projekty - rok: {{$year->year}}</h2>
                                <table class="table data-table mb-0 w-100" id="sortable">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>Nazwa</th>
                                        <th class="text-center">Klient</th>
                                        <th class="text-center">Data rozpoczęcia</th>
                                        <th class="text-center">Data zakończenia</th>
                                        <th class="text-center">Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="content">
                                    @foreach($yearprojects as $pr)
                                        <tr>
                                            <td><a href="{{ route('admin.project.show', $pr->id) }}">{{$pr->name}}</a></td>
                                            <td class="text-center">{{$pr->client_id}}</td>
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
