@extends('admin.project.layout')

@section('project_content')
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                @include('admin.project.partials.topmenu')

                <div class="col-12">
                    <div class="chart">
                        <div id="posty" style="width:auto;height:280px"></div>
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
@endsection
