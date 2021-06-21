@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.submenu')
        <div class="row">
            <div class="order-2 order-xl-1 col-12 col-xl-2">
                @include('admin.project.partials.sidemenu')
            </div>
            <div class="order-1 order-xl-2 col-12 col-xl-10">
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
