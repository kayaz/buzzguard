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
        <div class="row">
            <div class="col-3 col-xl-2">
                <div class="card mt-3">
                    <div class="card-body card-body-rem p-0">
                        <div class="table-overflow p-5">
                            <div class="about-project">
                                <ul class="list-group">
                                    @if($project->client->client_name)<li class="list-group-item">Klient: <div class="float-right">{{$project->client->client_name}}</div></li>@endif
                                    <li class="list-group-item">Ile dni trwa projekt: <div class="float-right">{{$project->days}}</div></li>
                                    <li class="list-group-item">Data rozpoczęcia: <div class="float-right">{{$project->date_start}}</div></li>
                                    <li class="list-group-item">Data zakończenia: <div class="float-right">{{$project->date_end}}</div></li>
                                </ul>

                                <h5><i class="fe-tag"></i> Słowa kluczowe</h5>
                                @foreach(explode(',', $project->keywords) as $key)
                                    <div class="badge">{{$key}}</div>
                                @endforeach
                                <h5><i class="fe-users"></i> Osoby w projekcie</h5>
                                <ul class="list-group">
                                    @foreach($project->users as $u)
                                    <li class="list-group-item d-flex align-items-center">
                                        <span>{!! mb_substr($u->name, 0, 1, 'UTF-8') !!}{!! mb_substr($u->surname, 0, 1, 'UTF-8') !!}</span><div>{{$u->name}} {{$u->surname}}</div>
                                        <div class="row">
                                            <div class="col-6 d-flex justify-content-center align-items-center border-right">
                                                <a href=""><i class="fe-trash"></i> Usuń</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-center align-items-center">
                                                <a href=""><i class="fe-download"></i> Export</a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                                <h5><i class="fe-download"></i> Pliki do pobrania</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><a href=""><i class="fe-file-text"></i> Dokument </a></li>
                                    <li class="list-group-item"><a href=""><i class="fe-file-text"></i> Dokument </a></li>
                                    <li class="list-group-item"><a href=""><i class="fe-file-text"></i> Dokument </a></li>
                                    <li class="list-group-item"><a href=""><i class="fe-file-text"></i> Dokument </a></li>
                                </ul>
                                @if($project->description)
                                <h5><i class="fe-info"></i> Dodatkowe informacje</h5>
                                <div class="about-text">
                                    <p>{{$project->description}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 col-xl-10">
                <div class="card mt-3">
                    <div class="card-body card-body-rem p-0">
                        <div class="table-overflow p-5">
                            <div class="container-fluid p-0">
                                <div class="row no-gutters">
                                    <div class="col-12">
                                        <h2>{{$project->name}}</h2>
                                        <h4 class="mb-5">Ilość postów: {{$count}}</h4>

                                        <div class="btn-group mb-3" role="group">
                                            <a href="{{ route('admin.project.show', $project->id) }}" class="btn btn-outline-primary active"><i class="fe-list"></i> Lista postów</a>
                                            <a href="{{ route('admin.project.charts', $project->id) }}" class="btn btn-outline-primary"><i class="fe-pie-chart"></i> Statystyki</a>
                                            <a href="{{ route('admin.project.calendar', $project->id) }}" class="btn btn-outline-primary"><i class="fe-calendar"></i> Kalendarz projektu</a>
                                            <a href="{{ route('admin.project.chats', $project->id) }}" class="btn btn-outline-primary"><i class="fe-message-square"></i> Q&A</a>
                                        </div>

                                        <table class="table data-table mb-0 w-100" id="sortable">
                                            <thead class="thead-default">
                                            <tr>
                                                <th>ID</th>
                                                <th>Data</th>
                                                <th>Autor</th>
                                                <th>Nick</th>
                                                <th class="text-center">Nowy wątek</th>
                                                <th>Domena</th>
                                                <th>URL</th>
                                                <th>Typ</th>
                                                <th class="text-center">SEO</th>
                                                <th class="text-center">Sentyment</th>
                                                <th class="text-center">Reakcja</th>
                                                <th class="text-center">Wiek</th>
                                            </tr>
                                            </thead>
                                            <tbody class="content">
                                            </tbody>
                                        </table>
                                        @push('scripts')
                                            <script src="{{ asset('/js/jquery.dataTables.min.js') }}" charset="utf-8"></script>
                                            <script>
                                                $(function () {
                                                    $.fn.dataTable.ext.errMode = 'none';
                                                    $('.data-table').on( 'error.dt', function ( e, settings, techNote, message ) {
                                                        console.log( 'An error has been reported by DataTables: ', message );
                                                    });
                                                });
                                                $(document).ready(function(){
                                                    $('.data-table').DataTable({
                                                        processing: true,
                                                        serverSide: true,
                                                        searching: false,
                                                        language: {
                                                            "url": "/js/polish.json"
                                                        },
                                                        iDisplayLength: 30,
                                                        ajax: "{{ route('admin.post.show', $project->id) }}",
                                                        columns: [
                                                            {data: 'id', name: 'id'},
                                                            {data: 'date', name: 'date'},
                                                            {data: 'user_id', name: 'user_id'},
                                                            {data: 'nick', name: 'nick'},
                                                            {data: 'thread', name: 'thread'},
                                                            {data: 'website', name: 'website'},
                                                            {data: 'url', name: 'url'},
                                                            {data: 'type', name: 'type'},
                                                            {data: 'seo', name: 'seo'},
                                                            {data: 'sentiment', name: 'sentiment'},
                                                            {data: 'reaction', name: 'reaction'},
                                                            {data: 'age_group', name: 'age_group'}
                                                        ]
                                                    });
                                                });
                                            </script>
                                        @endpush
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
