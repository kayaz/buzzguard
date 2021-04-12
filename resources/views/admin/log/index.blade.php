@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-activity"></i>Logi</h4>
                    </div>
                </div>
            </div>
            <div class="table-overflow">
                @if (session('success'))
                    <div class="alert alert-success border-0 mb-0">
                        {{ session('success') }}
                        <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                    </div>
                @endif
                <table class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th>Użytkownik</th>
                        <th class="text-center">Moduł</th>
                        <th class="text-center">Metoda</th>
                        <th>URL</th>
                        <th class="text-center">Adres IP</th>
                        <th class="text-center">Data utworzenia</th>
                        <th class="text-center">Data edycji</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $p)
                        <tr>
                            <td>{{ $p->causer->name }}</td>
                            <td class="text-center">{{ $p->log_name }}</td>
                            <td class="text-center"><div class="badge badge-method badge-method-{{strtolower($p->properties['methodType'])}}">{{ $p->properties['methodType'] }}</div></td>
                            <td>{{ $p->properties['route'] }}</td>
                            <td class="text-center">{{ $p->properties['ipAddress'] }}</td>
                            <td class="text-center">{{ $p->created_at->diffForHumans() }}</td>
                            <td class="text-center">{{ $p->updated_at->diffForHumans() }}</td>
                            <td class="option-120">

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
