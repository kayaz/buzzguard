@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.submenu')
        <div class="row">
            <div class="col-3 col-xl-2">
                <div class="card mt-3">
                    <div class="card-body card-body-rem p-0">
                        <div class="table-overflow p-5">
                            <div class="about-project">
                                <div class="btn-group mb-3 w-100" role="group">
                                    <a href="{{ route('admin.project.edit', $project->id) }}" class="btn btn-sm btn-outline-primary"><i class="fe-list"></i> Edytuj</a>
                                    <a href="#" class="btn btn-sm btn-outline-primary"><i class="fe-pie-chart"></i> Usuń</a>
                                </div>

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
                                            <a href="{{ route('admin.project.show', $project->id) }}" class="btn btn-outline-primary"><i class="fe-list"></i> Lista postów</a>
                                            <a href="{{ route('admin.project.charts', $project->id) }}" class="btn btn-outline-primary active"><i class="fe-pie-chart"></i> Statystyki</a>
                                            <a href="{{ route('admin.project.calendar', $project->id) }}" class="btn btn-outline-primary"><i class="fe-calendar"></i> Kalendarz projektu</a>
                                            <a href="{{ route('admin.project.chats', $project->id) }}" class="btn btn-outline-primary"><i class="fe-message-square"></i> Q&A</a>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="chart">
                                                    <div id="posty" style="width:auto;height:280px"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);

            function drawChart() {
                const data = new google.visualization.DataTable();
                const chart = new google.visualization.LineChart(document.getElementById('posty'));

                data.addColumn('date', 'Data');
                data.addColumn('number', 'Ilość wpisów');

                const options = {
                    hAxis: {
                        title: 'Data',
                        minValue: new Date(),
                        maxValue: new Date()
                    },
                    vAxis: {
                        title: 'Ilość wpisów'
                    },
                    pointSize: 10
                };
                chart.draw(data, options);
            }
        </script>
        @endpush
    </div>
@endsection
