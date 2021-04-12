<div class="card-header border-bottom card-nav pt-0 pb-0">
    <ul class="nav">
        <li>
            <a class="nav-link" href=""><span class="fe-list"></span>Aktualne projekty</a>
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
            <ul class="submenu">
                <li><a href="{{ route('admin.year.closed', 2016) }}">2016</a></li>
                <li><a href="{{ route('admin.year.closed', 2017) }}">2017</a></li>
                <li><a href="{{ route('admin.year.closed', 2018) }}">2018</a></li>
                <li><a href="{{ route('admin.year.closed', 2019) }}">2019</a></li>
                <li><a href="{{ route('admin.year.closed', 2020) }}">2020</a></li>
                <li><a href="{{ route('admin.year.closed', 2021) }}">2021</a></li>
            </ul>
        </li>
        <li><a class="nav-link" href=""><span class="fe-user"></span>Wg. klienta</a></li>
        <li><a class="nav-link" href=""><span class="fe-users"></span>Wg. grupy</a></li>
        <li><a class="nav-link" href=""><span class="fe-briefcase"></span>Moje projekty</a></li>
    </ul>
</div>
