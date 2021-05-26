@extends('admin.project.layout')

@section('project_content')
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                @include('admin.project.partials.topmenu')
                <div class="forum-single-content">
                    <div class="row m-0 align-items-center">
                        <div class="col-9">
                            <div class="forum-post-top">
                                <div class="d-flex">
                                    <span class="rounded-circle">
                                    @if($topic->author)
                                            {!! mb_substr($topic->author->name, 0, 1, 'UTF-8') !!}{!! mb_substr($topic->author->surname, 0, 1, 'UTF-8') !!}
                                        @else
                                            <i class="fe-user"></i>
                                    @endif
                                    </span>
                                    <div class="forum-post-author pl-4">
                                        <a href="{{route('admin.user.show', $topic->user_id)}}">
                                            @if($topic->author)
                                                <b>{{ $topic->author->name }} {{ $topic->author->surname }}</b>
                                            @else
                                                Autor
                                            @endif
                                        </a>
                                        <div class="forum-author-meta">
                                            <div class="author-badge">
                                                <i class="fe-calendar"></i> {{ $topic->data }} ({{ \Carbon\Carbon::parse(str_replace('-', '', $topic->data))->diffForHumans() }})
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.project.reply.create', ['project' => $project, 'chat' => $topic]) }}" class="btn btn-primary">Dodaj odpowiedź</a>
                            </div>
                        </div>
                    </div>
                    <div class="forum-single-q">
                        <h1>{{ ($topic->name) ? $topic->name : 'Brak tytułu' }}</h1>
                    </div>
                    <div class="forum-post-content">
                        {!! $topic->content !!}

                        <div class="forum-single-footer pt-3">
                            <a href="{{ route('admin.project.chat.edit', ['project' => $project, 'chat' => $topic]) }}" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i> Edytuj</a>
                            <form method="POST" action="{{ route('admin.project.chat.destroy', ['project' => $project, 'chat' => $topic]) }}" class="d-inline-flex">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn action-button confirmForm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="{{ $topic->id }}"><i class="fe-trash-2"></i> Usuń</button>
                            </form>
                        </div>
                    </div>
                </div>
                @foreach($posts as $p)
                <div class="forum-comment @if($p->status == 1) forum-comment-helpful @endif">
                    <div class="row m-0 align-items-center">
                        <div class="col-12">
                            <div class="forum-post-top mb-3">
                                <div class="col-9 d-flex">
                                    <span class="rounded-circle">
                                        @if($p->author)
                                            {!! mb_substr($p->author->name, 0, 1, 'UTF-8') !!}{!! mb_substr($p->author->surname, 0, 1, 'UTF-8') !!}
                                        @else
                                            <i class="fe-user"></i>
                                        @endif
                                    </span>
                                    <div class="forum-post-author pl-4">
                                        <a href="{{route('admin.user.show', $p->user_id)}}"><b>{{ $p->author->name }} {{ $p->author->surname }}</b></a>
                                        <div class="forum-author-meta">
                                            <div class="author-badge">
                                                <i class="fe-calendar"></i> {{ $p->data }} ({{ \Carbon\Carbon::parse(str_replace('-', '', $p->data))->diffForHumans() }})
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if($p->status == 1)
                                    <p class="accepted-ans-mark">
                                        <i class="fe-check"></i> <span>Super post</span>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="forum-post-content">
                        {!! $p->content !!}
                    </div>
                    <div class="forum-post-footer">
                        <a href="{{ route('admin.project.reply.edit', [$project, $topic, $p])}}" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i> Edytuj</a>
                        <a href="{{ route('admin.project.reply.helpful', $p)}}" data-toggle="tooltip" data-placement="top" title="Ten wpis jest pomocny">
                            @if($p->status == 0)
                            <i class="fe-thumbs-up"></i> Pomocny
                            @else
                             <i class="fe-thumbs-down"></i> Odznacz
                            @endif
                        </a>
                        <form method="POST" action="{{ route('admin.project.reply.destroy', $p->id) }}" class="d-inline-flex">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn action-button confirmForm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="{{ $p->id }}"><i class="fe-trash-2"></i> Usuń</button>
                        </form>
                    </div>
                </div>
                @endforeach

                <div class="row m-0 pt-4 align-items-center">
                    <div class="col-12 pr-4 d-flex justify-content-end">
                        <a href="{{ route('admin.project.reply.create', ['project' => $project, 'chat' => $topic]) }}" class="btn btn-primary">Dodaj odpowiedź</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
