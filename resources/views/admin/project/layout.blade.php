@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.submenu')
        <div class="row">
            <div class="col-3 col-xl-2">
                @include('admin.project.partials.sidemenu')
            </div>
            <div class="col-9 col-xl-10">
                <div class="card mt-3">
                    <div class="card-body card-body-rem p-0">
                        <div class="table-overflow p-5">
                            @yield('project_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
