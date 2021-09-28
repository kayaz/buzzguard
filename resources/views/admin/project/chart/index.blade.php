@extends('admin.project.layout')

@section('project_content')
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                @include('admin.project.partials.topmenu')

                <div class="col-12">
                    <h3 class="mt-4"><i class="fe-bar-chart-line-"></i> Liczba postów wg. dnia</h3>
                    <div class="chart">
                        <div id="posty" style="width:auto;height:280px"></div>
                    </div>
                </div>

                <div class="col-12">
                    <h3 class="mt-4"><i class="fe-bar-chart-line-"></i> Sentymenty</h3>
                    <div class="chart">
                        <div id="sentiments" style="width:auto;height:280px"></div>
                    </div>
                </div>

                <div class="col-12">
                    <h3 class="mt-5"><i class="fe-bar-chart-line-"></i> Liczba postów wg. domeny</h3>
                    <div class="chart">
                        <div id="domeny" style="width:auto;height:280px"></div>
                    </div>
                    <table class="table data-table mb-0 w-100 mt-4" id="sortable">
                        <thead class="thead-default">
                        <tr>
                            <th>Nazwa strony</th>
                            <th class="text-center">Ilość postów</th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach($domains as $d)
                            <tr>
                                <td>{{$d->website}}</a></td>
                                <td class="text-center">{{ $d->num }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                let data = new google.visualization.DataTable();
                const chart = new google.visualization.LineChart(document.getElementById('posty'));

                data.addColumn('date', 'Data');
                data.addColumn('number', 'Ilość wpisów');

                data = google.visualization.arrayToDataTable([
                    ['Data', 'Ilość wpisów'],
                    @foreach($posts as $p)
                    [new Date({{ date("Y, m, d", strtotime("-1 month", strtotime($p->date))) }}), {{ $p->num }}],
                    @endforeach
                ]);

                const options = {
                    hAxis: {
                        title: 'Data',
                        minValue: new Date({{ $start_project }}),
                        maxValue: new Date({{ $end_project }})
                    },
                    vAxis: {
                        title: 'Ilość wpisów'
                    },
                    pointSize: 10,
                    colors: ['#00acc1']

                };
                chart.draw(data, options);

                let chart2_data = google.visualization.arrayToDataTable([
                    ['Źródło', 'Ilość wpisów'],
                    @foreach($domains as $d)
                    ['{{ $d->website }} ({{ $d->num }})', {{ $d->num }}],
                    @endforeach
                ]);
                const chart2_options = {
                    colors: ['#00acc1'],
                    chartArea: { width: "100%", height: "60%" }
                };
                const chart2_chart = new google.visualization.ColumnChart(document.getElementById('domeny'));
                chart2_chart.draw(chart2_data, chart2_options);

                // 1 => 'Pozytywny', 2 => 'Neutralny', 3 => 'Negatywny', 4 => 'Nieoceniony'
                let chart3_data = google.visualization.arrayToDataTable([
                    ['Sentyment', 'Ilość wpisów'],
                    @foreach($sentiments as $d)
                    ['{{ sentiments($d->sentiment) }} ({{ $d->num }})', {{ $d->num }}],
                    @endforeach
                ]);
                const chart3_options = {
                    colors: ['#00acc1'],
                    chartArea: { width: "100%", height: "60%" }
                };
                const chart3_chart = new google.visualization.ColumnChart(document.getElementById('sentiments'));
                chart3_chart.draw(chart3_data, chart3_options);
            }
        </script>
    @endpush
@endsection
