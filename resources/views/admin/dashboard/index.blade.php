@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-users"></i>Projekty</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                        <a href="#" class="btn btn-primary">Dodaj projekt</a>
                    </div>
                </div>
            </div>

            @include('admin.submenu')
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow p-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="" class="row" id="findproject">
                                    <input type="text" autocomplete="off" name="project" id="project" placeholder="Wpisz nazwę projektu" class="col-12 form-control">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="/js/bootstrap3-typeahead.min.js"></script>
        <script>
            $(document).ready(function(){
                let route = "/admin/autocomplete";
                $('#project').typeahead({
                    source:  function (term, process) {
                        return $.get(route, { term: term }, function (data) {
                            return process(data);
                        });
                    },
                    afterSelect: function(e){
                        const url = "{{route('admin.project.show', '')}}"+"/"+e.id;
                        window.location.href = url;
                    }
                });
            });
        </script>
    @endpush
@endsection
