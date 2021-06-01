@extends('admin.project.layout')

@section('project_content')
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">
                @include('admin.project.partials.topmenu')

                <div class="col-12">
                    <ul class="calendar list-unstyled mb-0">
                        @foreach($calendar as $day)
                            <li class="row">
                                <div class="col calendar-day">{{ $day }}<br>
                                    {{ dayName($day) }}
                                </div>
                                <div class="col-11 pl-3">
                                @foreach($posts as $post)
                                    @if($post->date == $day)
                                        <span>
                                        @foreach($project->users as $user)
                                            @if($user->id == $post->user_id)
                                                {{ $user->name }} {{ $user->surname }}
                                            @endif
                                        @endforeach
                                        </span>
                                    @endif
                                @endforeach
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
