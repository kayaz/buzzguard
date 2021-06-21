@extends('admin.layout')
@section('content')
    <form method="POST" action="{{route('admin.account.update', $entry->id)}}">
    @method('PUT')
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 p-0">
                            @if (session('success'))
                                <div class="alert alert-success border-0 mb-0">
                                    {{ session('success') }}
                                    <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                            @include('form-elements.input-text', ['label' => 'E-mail', 'name' => 'email', 'value' => $entry->email, 'required' => 1])
                            @include('form-elements.html-password', ['label' => 'Hasło', 'name' => 'password', 'value' => $entry->password, 'required' => 1])
                            @include('form-elements.html-password', ['label' => 'Powtórz hasło', 'name' => 'confirm-password', 'required' => 1])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Route::is('admin.account.edit'))
            <input type="hidden" name="article_id" value="{{$entry->id}}">
        @endif
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
