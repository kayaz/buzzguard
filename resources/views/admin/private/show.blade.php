@extends('admin.private.layout')

@section('project_content')
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                <h2>{{$privateProject->name}}</h2>
                <h4 class="mb-5">Ilość postów: {{$privateProject->posts()->count()}}</h4>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-start pb-3">
                    <a href="{{ route('admin.project.private.index') }}" class="btn btn-lg btn-primary"><i class="fe-arrow-left"></i> Wróć</a>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end pb-3">
                    <a href="{{ route('admin.project.private.post.create', $privateProject) }}" class="btn btn-lg btn-primary"><i class="fe-file-plus"></i> Dodaj post</a>
                </div>
            </div>
            <div class="col-12">
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
                        <th class="text-center"></th>
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
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fe-x-square"></i>
                                </button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                            </div>
                        </div>
                    </div>
                </div>

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
                                ajax: "{{ route('admin.privatepost.show', $privateProject->id) }}",
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
                                    {data: 'age_group', name: 'age_group'},
                                    {data: 'actions', name: 'actions'}
                                ],
                                "drawCallback": function() {
                                    let $tooltipElement = jQuery('[data-toggle="tooltip"]');
                                    $tooltipElement.tooltip();
                                    $tooltipElement.click(function () {
                                        $tooltipElement.tooltip("hide");
                                    });

                                    $(".show-modal").on("click", function () {
                                        const userid = $(this).data('id');
                                        $(this).closest('tr').addClass('tr-opened');
                                        $.ajax({
                                            url: '{{ route('admin.privatepost.modal') }}',
                                            type: 'post',
                                            data: {
                                                "_token": "{{ csrf_token() }}",
                                                "id": userid
                                            },
                                            success: function (response) {
                                                $('#empModal .modal-body').html(response);
                                                const myModal = new bootstrap.Modal(document.getElementById('empModal'));
                                                myModal.show();

                                                const myModalEl = document.getElementById('empModal');
                                                myModalEl.addEventListener('hidden.bs.modal', function () {
                                                    $('.data-table tr').removeClass('tr-opened');
                                                })

                                            }
                                        });
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
                                }
                            });
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>
@endsection
