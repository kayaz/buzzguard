@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-bar-chart-line-"></i>Statystyki - Odwiedziny strony - Użytkownik</h4>
                    </div>
                </div>
            </div>

            @include('admin.tracker.submenu')

        </div>
        <div class="card mt-3">
            <table class="table data-table mb-0 w-100" id="sortable">
                <thead class="thead-default">
                <tr>
                    <th>Typ</th>
                    <th>Nazwa ścieżki</th>
                    <th>Ajax</th>
                    <th>Bezpieczny</th>
                    <th>JSON</th>
                    <th>Błąd</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody class="content">
                </tbody>
            </table>

            @push('scripts')
                <script src="/js/jquery.dataTables.min.js"></script>

                <script>
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
                            ajax: "{{ route('admin.tracker.apiLog', ['uuid' => $uuid]) }}",
                            columns: [
                                {data: 'method', name: 'method'},
                                {data: 'route_name', name: 'route_name'},
                                {data: 'is_ajax', name: 'is_ajax'},
                                {data: 'is_secure', name: 'is_secure'},
                                {data: 'is_json', name: 'is_json'},
                                {data: 'error', name: 'error'},
                                {data: 'created', name: 'created'},
                            ]
                        });
                    });
                </script>
            @endpush
        </div>
    </div>
@endsection

