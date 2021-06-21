<div class="card">
    <div class="card-head container-fluid">
        <div class="row">
            <div class="col-6 pl-0">
                <h4 class="page-title row"><i class="fe-users"></i>Projekty</h4>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                <a href="{{ route('admin.project.create') }}" class="btn btn-primary">Dodaj projekt</a>
            </div>
        </div>
    </div>

    <div class="card-header border-bottom card-nav p-0">
        <ul class="nav">
            <li><a class="nav-link" href="{{ route('admin.dashboard.index') }}"><span class="fe-search"></span>Wyszukiwarka projektów</a></li>
            <li>
                <a class="nav-link" href="#"><span class="fe-list"></span>Aktualne projekty</a>
                <ul class="submenu">
                    @foreach(projectsMenu() as $p)
                        @if($p->activeProjects->count() > 0)
                            <li class="has-submenu">
                                <a href="{{ route('admin.year.show', $p->year) }}">{{ $p->year }}</a>
                                <ul class="submenu">
                                    @foreach($p->activeProjects as $pr)
                                        <li><a href="{{ route('admin.project.show', $pr->id) }}" class="link-status-1">{{ $pr->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li><a class="nav-link" href=""><span class="fe-lock"></span>Zamknięte projekty</a>
                <ul class="submenu scrollable">
                    <li><a href="{{ route('admin.year.closed', 2016) }}">2016</a></li>
                    <li><a href="{{ route('admin.year.closed', 2017) }}">2017</a></li>
                    <li><a href="{{ route('admin.year.closed', 2018) }}">2018</a></li>
                    <li><a href="{{ route('admin.year.closed', 2019) }}">2019</a></li>
                    <li><a href="{{ route('admin.year.closed', 2020) }}">2020</a></li>
                    <li><a href="{{ route('admin.year.closed', 2021) }}">2021</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href=""><span class="fe-user"></span>Wg. klienta</a>
                <ul class="submenu scrollable">
                    @foreach(clientsMenu() as $c)
                    <li><a href="{{ route('admin.clientproject.show', $c->id) }}">{{$c->name}} {{$c->surname}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a class="nav-link" href="{{ route('admin.group.index') }}"><span class="fe-briefcase"></span>Wg. grupy</a></li>
        </ul>
    </div>
</div>
