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
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Rok</th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach ($list as $p)
                            <tr>
                                <td>{{ $p->year }}</td>
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
                    <a href="{{ route('admin.year.create') }}" class="btn btn-primary">Dodaj rok</a>
                </div>
            </div>
        </div>
    </div>
@endsection
