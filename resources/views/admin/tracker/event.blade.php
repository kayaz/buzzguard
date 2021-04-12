@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-bell"></i>Wydarzenie: {{ __('tracker.'.$event->name)}}</h4>
                    </div>
                </div>
            </div>

            @include('admin.tracker.submenu')

        </div>
        <div class="card mt-3">
            <table class="table mb-0">
                <thead class="thead-default">
                <tr>
                    <th>Data</th>
                    <th>Dane</th>
                </tr>
                </thead>
                <tbody class="content">
                @foreach ($list as $p)
                    <tr>
                        <td class="text-nowrap">{{ $p->created_at }}</td>
                        <td class="w-100">
                            @php $array = json_decode($p->name,TRUE); @endphp
                            @isset($p->name)
                                {{ $array['form_message'] }}
                                <hr class="mb-2">
                                <div style="color:#979797" class="small">Autor: {{ $array['form_name'] }} / E-mail: {{ $array['form_email'] }} / IP: {{ $p->client_ip }}</div></td>
                        @endisset
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
