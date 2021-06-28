@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.topmenu')
        <div class="card mt-3">
            <table class="table data-table w-100" id="sortable">
                <thead class="thead-default">
                <tr>
                    <th>Wiadomość</th>
                    <th>Status</th>
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
                                "url": "{{ asset('/js/polish.json') }}"
                            },
                            ajax: "{{ route('admin.tracker.apiEvents') }}",
                            columns: [
                                {data: 'message', name: 'message'},
                                {data: 'status', name: 'status'},
                                {data: 'created_at', name: 'created_at'}
                            ]
                        });
                    });
                </script>
            @endpush
        </div>
    </div>
@endsection
