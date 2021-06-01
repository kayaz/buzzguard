@extends('admin.private.layout')

@section('project_content')
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                <h2>{{$project->name}}</h2>
                <h4 class="mb-5">Ilość postów: {{$project->posts()->count()}}</h4>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-start pb-3">
                    <a href="{{ route('admin.project.private.index') }}" class="btn btn-lg btn-primary"><i class="fe-arrow-left"></i> Wróć</a>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end pb-3">
                    <a href="{{ route('admin.project.private.post.create', $project) }}" class="btn btn-lg btn-primary"><i class="fe-file-plus"></i> Dodaj post</a>
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
                                ajax: "{{ route('admin.privatepost.show', $project->id) }}",
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
                                }
                            });
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>
@endsection
