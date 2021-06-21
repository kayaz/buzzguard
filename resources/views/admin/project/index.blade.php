@extends('admin.project.layout')

@section('project_content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12">
            @include('admin.project.partials.topmenu')
            <div class="d-flex justify-content-end pb-3">
                <a href="{{ route('admin.project.post.create', $project) }}" class="btn btn-lg btn-primary btn-add-project">
                    <i class="fe-file-plus"></i> Dodaj post
                </a>
            </div>
            <table class="table data-table mb-0 w-100" id="sortable">
                <thead class="thead-default">
                <tr>
                    <th>Data</th>
                    <th class="colsearch">Autor</th>
                    <th class="colsearch">Nick</th>
                    <th class="text-center">Nowy wątek</th>
                    <th class="colsearch">Domena</th>
                    <th>URL</th>
                    <th class="colsearch">Typ</th>
                    <th class="text-center">SEO</th>
                    <th class="text-center">Sentyment</th>
                    <th class="text-center">Reakcja</th>
                    <th class="text-center">Wiek</th>
                    <th class="text-center" style="width:170px !important"></th>
                </tr>
                </thead>
                <tbody class="content">
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="empModal" role="dialog" aria-labelledby="postlabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                         <div class="modal-header">
                            <h5 class="modal-title mb-0" id="postlabel">Podgląd wpisu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fe-x-square"></i>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        </div>
                    </div>
                </div>
            </div>

            @push('scripts')
                <script src="{{ asset('/js/datatables/jszip.min.js') }}" charset="utf-8"></script>
                <script src="{{ asset('/js/datatables/pdfmake.min.js') }}" charset="utf-8"></script>
                <script src="{{ asset('/js/datatables/vfs_fonts.js') }}" charset="utf-8"></script>
                <script src="{{ asset('/js/datatables/jquery.dataTables.js') }}" charset="utf-8"></script>
                <script src="{{ asset('/js/datatables/dataTables.buttons.min.js') }}" charset="utf-8"></script>
                <script src="{{ asset('/js/datatables/buttons.colVis.min.js') }}" charset="utf-8"></script>
                <script src="{{ asset('/js/datatables/buttons.html5.min.js') }}" charset="utf-8"></script>
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
                            responsive: true,
                            dom: 'Brtip',
                            "buttons": [
                                {
                                    extend: 'copyHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                'colvis',
                                'csv',
                            ],
                            language: {
                                "url": "{{ asset('/js/polish.json') }}"
                            },
                            iDisplayLength: 30,
                            ajax: "{{ route('admin.post.show', $project->id) }}",
                            columns: [
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
                                {data: 'age_group', name: 'age_group'},
                                {data: 'actions', name: 'actions'}
                            ],
                            bSort: false,
                            columnDefs: [
                                { className: 'text-center', targets: [0, 2, 4, 5, 6, 7, 8, 11] },
                                { className: 'select-column', targets: [2, 4, 6] },
                            ],
                            initComplete: function () {
                                this.api().columns('.select-column').every( function () {
                                    const column = this;
                                    const select = $('<select><option value="">'+ this.header().textContent +'</option></select>')
                                        .appendTo($(column.header()).empty())
                                        .on('change', function () {
                                            const val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                            );

                                            column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                        });

                                    column.data().unique().sort().each( function ( d, j ) {
                                        select.append( '<option value="'+d+'">'+d+'</option>' )
                                    } );
                                });
                            },
                            "drawCallback": function() {
                                $('[data-toggle="tooltip"]').tooltip();
                                $('[data-toggle="tooltip"]').click(function () {
                                    $('[data-toggle="tooltip"]').tooltip("hide");
                                });

                                $(".confirmForm").click(function(d) {
                                    d.preventDefault();
                                    const c = $(this).closest("form");
                                    const a = c.attr("action");
                                    const b = $("meta[name='csrf-token']").attr("content");
                                    $.confirm({
                                        title: "Potwierdzenie usunięcia",
                                        message: "Czy na pewno chcesz usunąć?",
                                        buttons: {
                                            Tak: {
                                                "class": "btn btn-primary",
                                                action: function() {
                                                    $.ajax({
                                                        url: a,
                                                        type: "DELETE",
                                                        data: {
                                                            _token: b,
                                                        }
                                                    }).done(function( data ) {
                                                        location.href = data.href;
                                                    });
                                                }
                                            },
                                            Nie: {
                                                "class": "btn btn-secondary",
                                                action: function() {}
                                            }
                                        }
                                    })
                                });

                                $(".show-modal").on("click", function(){
                                    const userid = $(this).data('id');
                                    $.ajax({
                                        url: '{{ route('admin.post.modal') }}',
                                        type: 'post',
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            "id": userid
                                        },
                                        success: function(response){
                                            $('#empModal .modal-body').html(response);
                                            const myModal = new bootstrap.Modal(document.getElementById('empModal'));
                                            myModal.show();
                                        }
                                    });
                                });

                            }
                        });
                    });
                </script>
            @endpush
        </div>
    </div>
</div>
@endsection
