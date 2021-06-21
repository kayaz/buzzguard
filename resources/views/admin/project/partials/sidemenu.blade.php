<div class="card mt-3">
    <div class="card-body card-body-rem p-0">
        <div class="table-overflow p-4">
            <div class="about-project">
                @if($project->status == 1)
                    <div class="btn-group mb-3 w-100" role="group">
                        <a href="{{ route('admin.project.edit', $project->id) }}" class="btn btn-sm btn-outline-primary"><i class="fe-list"></i> Edytuj</a>
                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="fe-pie-chart"></i> Usuń</a>
                    </div>
                @endif

                <ul class="list-group">
                    @if($project->client && $project->client->client_name)<li class="list-group-item">Klient: <div class="float-right">{{$project->client->client_name}}</div></li>@endif
                    <li class="list-group-item">Ile dni trwa projekt: <div class="float-right">{{$project->days}}</div></li>
                    <li class="list-group-item">Data rozpoczęcia: <div class="float-right">{{$project->date_start}}</div></li>
                    <li class="list-group-item">Data zakończenia: <div class="float-right">{{$project->date_end}}</div></li>
                </ul>

                <h5><i class="fe-tag"></i> Słowa kluczowe</h5>
                @foreach(explode(',', $project->keywords) as $key)
                    <div class="badge">{{$key}}</div>
                @endforeach

                <h5><i class="fe-users"></i> Osoby w projekcie</h5>
                @if (session('successuser'))
                    <div class="alert alert-success border-0 mb-0">
                        {{ session('successuser') }}
                        <script>window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},3000);</script>
                    </div>
                @endif
                <a href="{{route('admin.userproject.create', $project->id)}}" class="btn btn-primary btn-upload w-100">Dodaj osobę</a>
                @if($project->users->count() > 0)
                    <ul class="list-group list-users">
                        @foreach($project->users as $u)
                            <li class="list-group-item container">
                                <div class="row">
                                    <div class="col-8">
                                        {{$u->name}} {{$u->surname}} (limit: {{ $u->pivot->limit }})
                                    </div>
                                    <div class="col-4 d-flex justify-content-end">
                                        <div class="list-users-menu">
                                            <a href="{{route('admin.userproject.edit', ['user' => $u->pivot->id, 'project' => $project->id])}}"><i class="fe-edit"></i></a>
                                            <a href=""><i class="fe-download"></i></a>
                                            <a href="{{route('admin.userproject.delete', ['user' => $u->pivot->id, 'project' => $project->id])}}"><i class="fe-trash text-danger"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <h5><i class="fe-download"></i> Pliki do pobrania</h5>
                @if (session('success'))
                    <div class="alert alert-success border-0 mb-0">
                        {{ session('success') }}
                        <script>window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},3000);</script>
                    </div>
                @endif
                <button data-toggle="modal" data-target="#bootstrapmodal" class="btn btn-primary btn-upload w-100">Dodaj plik</button>

                @if($project->files()->count() > 0)
                    <ul class="list-group list-files">
                        @foreach($project->files()->get() as $file)
                            <li class="list-group-item">
                                <a href="{{route('admin.project.deletefile', $file->id)}}" class="btn btn-sm"><i class="fe-trash"></i></a>
                                <a href="/public/uploads/projects/files/{{ $file->file }}" target="_blank" title="{{$file->name}}">
                                    <i class="fe-file-{{$file->icon}}"></i> {{ truncateMiddle($file->name, 30) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if($project->description)
                    <h5><i class="fe-info"></i> Dodatkowe informacje</h5>
                    <div class="about-text">
                        <p>{{$project->description}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bootstrapmodal" tabindex="-1" role="dialog" aria-labelledby="uploadlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadlabel">Dodaj plik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fe-x-square"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="jquery-wrapped-fine-uploader"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('/js/fineuploader.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(window).on('shown.bs.modal', function () {
            $('#bootstrapmodal').modal('show');
            let fileCount = 0;
            $('#jquery-wrapped-fine-uploader').fineUploader({
                debug: true,
                multiple: true,
                text: {
                    uploadButton: "Wybierz plik",
                    dragZone: "Przeciągnij i upuść plik tutaj"
                },
                request: {
                    endpoint: '{{route('admin.project.upload')}}',
                    customHeaders: {
                        "X-CSRF-Token": $("meta[name='csrf-token']").attr("content")
                    },
                    params: {
                        project_id: "{{$project->id}}"
                    }
                }
            }).on('error', function (event, id, name, reason) {
            }).on('submit', function () {
                fileCount++;
            }).on('complete', function (event, id, name, response) {
                if (response.success === true) {
                    fileCount--;
                    if (fileCount === 0) {
                        location.reload();
                    }
                }
            });
        });
    </script>
@endpush
