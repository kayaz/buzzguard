@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.topmenu')
        <div class="card mt-3">
            <table class="table data-table mb-0 w-100" id="sortable">
                <thead class="thead-default">
                <tr>
                    <th>Kod HTTP</th>
                    <th>Metoda</th>
                    <th>Treść błędu</th>
                    <th>Ścieżka</th>
                    <th>IP</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody class="content"></tbody>
            </table>

            @push('scripts')
                <script src="{{ asset('/js/datatables/jquery.dataTables.js') }}"></script>

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
                            ajax: "{{ route('admin.tracker.apiUsers') }}",
                            columns: [
                                {data: 'user_id', name: 'user_id'},
                                {data: 'updated_at', name: 'updated_at'}
                            ]
                        });
                    });
                </script>
            @endpush
        </div>
    </div>
@endsection
