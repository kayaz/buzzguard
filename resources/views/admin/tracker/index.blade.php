@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-bar-chart-line-"></i>Statystyki - Odwiedziny strony</h4>
                    </div>
                </div>
            </div>

            @include('admin.tracker.submenu')

        </div>
        <div class="card mt-3">
            <div class="p-5">
                <div id="pageViewsLine" style="height: 250px;"></div>
            </div>
            <table class="table data-table mb-0 w-100" id="sortable">
                <thead class="thead-default">
                <tr>
                    <th>ID</th>
                    <th>IP</th>
                    <th>Kraj / Miasto</th>
                    <th>Język</th>
                    <th>Użytkownik</th>
                    <th>Urządzenie</th>
                    <th>Przeglądarka</th>
                    <th>Referer</th>
                    <th>Ilość stron</th>
                    <th>Ostatnia aktywność</th>
                </tr>
                </thead>
                <tbody class="content">
                </tbody>
            </table>

            @push('scripts')
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
            <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

            <script src="/js/jquery.dataTables.min.js"></script>

            <script>
                var pageViewsLine = Morris.Line({
                    element: 'pageViewsLine',
                    parseTime:false,
                    grid: true,
                    data: [{'date': 0, 'total': 0}],
                    xkey: 'date',
                    ykeys: ['total'],
                    labels: ['Wyświetlenia strony']
                });
                const formatDates = function()
                {
                    const json = '{!! $list !!}';
                    data = JSON.parse(json);

                    moment.locale('pl');
                    for(key in data)
                    {
                        if (data[key].date !== 'undefined')
                        {

                            data[key].date = moment(data[key].date, "YYYY-MM-DD").format('LL');
                        }
                    }

                    return data;
                };
                pageViewsLine.setData(formatDates());

                $(function () {
                    $.fn.dataTable.ext.errMode = 'none';
                    $('.data-table').on( 'error.dt', function ( e, settings, techNote, message ) {
                        console.log( 'An error has been reported by DataTables: ', message );
                    });

                    $('.data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        searching: false,
                        language: {
                            "url": "/js/polish.json"
                        },
                        ajax: "{{ route('admin.tracker.apiVisits') }}",
                        columns: [
                            {data: 'id', name: 'id', searchable: false},
                            {data: 'client_ip', name: 'client_ip'},
                            {data: 'country', name: 'country'},
                            {data: 'language', name: 'language'},
                            {data: 'user', name: 'user'},
                            {data: 'device', name: 'device'},
                            {data: 'browser', name: 'browser'},
                            {data: 'referer', name: 'referer'},
                            {data: 'pageViews', name: 'pageViews'},
                            {data: 'lastActivity', name: 'lastActivity'},
                        ]
                    });
                });
            </script>
            @endpush
        </div>
    </div>
@endsection

