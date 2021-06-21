@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.topmenu')
        <div class="card mt-3">
            <table class="table data-table mb-0 w-100" id="sortable">
                <thead class="thead-default">
                <tr>
                    <th>Nazwa</th>
                    <th>Ilośc akcji</th>
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
                                {data: 'name', name: 'name'},
                                {data: 'total', name: 'total'}
                            ]
                        });
                    });
                </script>
            @endpush
        </div>
    </div>
@endsection
