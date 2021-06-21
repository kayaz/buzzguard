@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        @include('admin.topmenu')
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    @if (session('success'))
                        <div class="alert alert-success border-0 mb-0">
                            {{ session('success') }}
                            <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                        </div>
                    @endif
                    <table class="table mb-0" id="sortable">
                        <thead class="thead-default">
                        <tr>
                            <th>#</th>
                            <th>Imię</th>
                            <th>Adres e-mail</th>
                            <th>Typ konta</th>
                            <th class="text-center">Status</th>
                            <th>Data utworzenia</th>
                            <th>Data edycji</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach ($list as $index => $p)
                            <tr>
                                <th class="position" scope="row">{{ $index+1 }}</th>
                                <td>{{ $p->name }} {{ $p->surname }}</td>
                                <td>{{ $p->email }}</td>
                                <td>
                                    @if(!empty($p->getRoleNames()))
                                        @foreach($p->getRoleNames() as $v)
                                            <label class="badge badge-role">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">{!! status($p->active) !!}</td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <a href="{{route('admin.user.show', $p)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Pokaż profil"><i class="fe-user"></i></a>
                                        <a href="{{route('admin.user.edit', $p)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
                                        <form method="POST" action="{{route('admin.user.destroy', $p)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń" data-id="{{ $p->id }}"><i class="fe-trash-2"></i></button>
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
    <div class="form-group form-group-submit">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('admin.user.create')}}" class="btn btn-primary">Dodaj użytkownika</a>
                </div>
            </div>
        </div>
    </div>
@endsection
