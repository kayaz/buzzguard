@extends('admin.layout')
@section('content')
@if(Route::is('admin.project.private.post.edit'))
<form method="POST" action="{{route('admin.project.private.post.update', $entry)}}" enctype="multipart/form-data">
@method('PUT')
@else
<form method="POST" action="{{route('admin.project.private.post.store', $privateProject)}}" enctype="multipart/form-data">
@endif
@csrf
    <div class="container">
        <div class="card">
            <div class="card-head container">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row">
                            <i class="fe-home"></i><a href="{{ route('admin.project.private.show', $privateProject) }}">{{$privateProject->name}}</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}
                        </h4>
                    </div>
                </div>
            </div>
            @include('form-elements.back-route-button')
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @include('form-elements.input-text', ['label' => 'Nick', 'sublabel' => 'Nazwa wyświetlana', 'name' => 'nick', 'value' => $entry->nick, 'required' => 1])
                        @include('form-elements.html-select', ['label' => 'Nowy wątek', 'name' => 'thread', 'select' => array(0 => 'Nie', 1 => 'Tak'), 'selected' => $entry->thread, 'required' => 1])
                        @include('form-elements.input-text', ['label' => 'Link do wpisu', 'name' => 'url', 'value' => $entry->url, 'required' => 1])
                        @include('form-elements.input-text', ['label' => 'Nazwa strony', 'name' => 'website', 'value' => $entry->website, 'required' => 1])
                        @include('form-elements.html-select', ['label' => 'Rodzaj wpisu', 'name' => 'type', 'select' => $post_type, 'selected' => $entry->thread, 'required' => 1])
                        @include('form-elements.html-select', ['label' => 'Sentyment', 'name' => 'sentiment', 'select' => array(1 => 'Pozytywny', 2 => 'Neutralny', 3 => 'Negatywny', 4 => 'Nieoceniony'), 'selected' => $entry->sentiment, 'required' => 1])
                        @include('form-elements.html-select', ['label' => 'Reakcja na post', 'name' => 'reaction', 'select' => array(0 => 'Nie', 1 => 'Tak'), 'selected' => $entry->reaction, 'required' => 1])
                        @include('form-elements.html-select', ['label' => 'Grupa wiekowa', 'name' => 'age_group', 'select' => array(1 => '13-18', 2 => '19-25', 3 => '26-36', 4 => '37-45', 5 => '45-60'), 'selected' => $entry->age_group, 'required' => 1])
                        @include('form-elements.html-select', ['label' => 'SEO WoMM', 'name' => 'seo', 'select' => array(0 => 'Nie', 1 => 'Tak'), 'selected' => $entry->seo, 'required' => 1])
                        @include('form-elements.html-select', ['label' => 'Kategoria', 'name' => 'category', 'select' => array('nieproduktowy' => 'Post', 'produktowy' => 'Zdjęcie', 'film' => 'Film'), 'selected' => $entry->category, 'required' => 1])
                        @include('form-elements.input-file', ['label' => 'Załącznik', 'sublabel' => 'max. waga pliku: ', 'name' => 'file'])
                        @include('form-elements.textarea', ['label' => 'Treść wpisu', 'name' => 'content', 'value' => $entry->content, 'rows' => 8, 'required' => 1])
                        @include('form-elements.textarea', ['label' => 'Dodatkowe informacje', 'name' => 'additional', 'value' => $entry->additional, 'rows' => 5])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="project_id" value="{{$privateProject->id}}">
    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
</form>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('keyup', 'input#form_url', function () {
            const url = $(this).val(), field = $('#form_website'), domain = domain_from_url(url);
            field.val(domain);
        });
    </script>
@endpush
