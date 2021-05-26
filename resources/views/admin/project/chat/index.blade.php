@extends('admin.project.layout')

@section('project_content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12">
            @include('admin.project.partials.topmenu')
            <div class="d-flex justify-content-end pb-3">
                <a href="{{ route('admin.project.chat.create', $project->id) }}" class="btn btn-lg btn-primary"><i class="fe-message-circle"></i> Zadaj pytanie</a>
            </div>
            <ul class="navbar-nav topic_list">
                @foreach($posts as $p)
                <li>
                    <div class="media">
                        <div class="d-flex">
                            <span class="rounded-circle">
                                @if($p->author)
                                {!! mb_substr($p->author->name, 0, 1, 'UTF-8') !!}{!! mb_substr($p->author->surname, 0, 1, 'UTF-8') !!}
                                    @else
                                <i class="fe-user"></i>
                                @endif
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="t_title">
                                <a href="{{ route('admin.project.chat.show', ['project' => $project->id,'chat' => $p]) }}">
                                    <h4>{{ $p->name }}</h4>
                                </a>
                            </div>
                            <h6><i class="icon_clock_alt"></i> {{ $p->data }} ({{ \Carbon\Carbon::parse(str_replace('-', '', $p->data))->diffForHumans() }})</h6>
                        </div>
                        <div class="media-right">

                        </div>
                        <div class="media-right">
                            <a class="count" href="{{ route('admin.project.chat.show', ['project' => $project->id, 'chat' => $p]) }}" title="Komentarze"><i class="fe-message-circle"></i> {{ $p->posts_count }}</a>
                            <a class="count" href="{{ route('admin.project.chat.show', ['project' => $project->id, 'chat' => $p]) }}" title="Wyświetlenia"><i class="fe-eye"></i> {{ $p->views }}</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
