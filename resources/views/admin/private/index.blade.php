@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.submenu')
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow p-5">
                    <div class="container p-0">
                        <div class="row no-gutters">
                            <div class="col-6">
                                <h2 class="mb-5"><i class="fe-lock"></i> Prywatne projekty</h2>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end pb-3">
                                    <a href="{{ route('admin.project.private.create') }}" class="btn btn-lg btn-primary"><i class="fe-file-plus"></i> Dodaj projekt</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table data-table mb-0 w-100" id="sortable">
                                    <thead class="thead-default">
                                    <tr>
                                        <th>Nazwa</th>
                                        <th class="text-center">Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="content">
                                    @foreach($projects as $p)
                                        <tr>
                                            <td><a href="{{ route('admin.project.private.show', $p->id) }}">{{$p->name}}</a></td>
                                            <td class="text-center">{!! status($p->status) !!}</td>
                                            <td class="option-120">
                                                <div class="btn-group">
                                                    <a href="{{route('admin.project.private.edit', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>
                                                    <form method="POST" action="#">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="{{ $p->id }}"><i class="fe-trash-2"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
