<div class="card">
    <div class="card-head container-fluid">
        <div class="row">
            <div class="col-6 pl-0">
                <h4 class="page-title row"><i class="fe-users"></i>Użytkownicy</h4>
            </div>
            @can('user-create')
            <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                <a href="{{route('admin.user.create')}}" class="btn btn-primary">Dodaj użytkownika</a>
            </div>
            @endcan
        </div>
    </div>

    <div class="card-header border-bottom card-nav">
        <nav class="nav">
            @can('user-list')
            <a class="nav-link {{ Request::routeIs('admin.user.index') ? 'active' : '' }}" href="{{route('admin.user.index')}}">
                <span class="fe-list"></span> Lista użytkowników
            </a>
            @endcan
            @can('role-list')
            <a class="nav-link {{ Request::routeIs('admin.role.index') ? 'active' : '' }}" href="{{route('admin.role.index')}}">
                <span class="fe-shield"></span> Grupy użytkowników
            </a>
            @endcan
            @can('log-list')
            <a class="nav-link {{ Request::routeIs('admin.logs.index') ? 'active' : '' }}" href="{{route('admin.logs.index')}}">
                <span class="fe-activity"></span> Logi
            </a>
            @endcan
            @can('event-list')
            <a class="nav-link {{ Request::routeIs('admin.tracker.events', 'admin.tracker.event') ? 'active' : '' }}" href="{{route('admin.tracker.events')}}">
                <span class="fe-bell"></span> Wydarzenia
            </a>
            @endcan
            <a class="nav-link {{ Request::routeIs('admin.tracker.errors') ? 'active' : '' }}" href="{{route('admin.tracker.errors')}}">
                <span class="fe-alert-circle"></span> Błędy
            </a>
            @can('year-list')
            <a class="nav-link {{ Request::routeIs('admin.year.index') ? 'active' : '' }}" href="{{route('admin.year.index')}}">
                <span class="fe-calendar"></span> Kalendarz
            </a>
            @endcan
        </nav>
    </div>
</div>
