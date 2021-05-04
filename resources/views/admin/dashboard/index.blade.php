@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.submenu')
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
        <script src="{{ asset('/js/bootstrap3-typeahead.min.js') }}" charset="utf-8"></script>
        <script>
            $(document).ready(function(){
                let route = "/admin/autocomplete";
                $('#project').typeahead({
                    limit: 10,
                    source:  function (term, process) {
                        return $.get(route, { term: term }, function (data) {
                            return process(data);
                        });
                    },
                    afterSelect: function(e){
                        window.location.href = "{{route('admin.project.show', '')}}" + "/" + e.id;
                    }
                });
            });
        </script>
    @endpush
@endsection
