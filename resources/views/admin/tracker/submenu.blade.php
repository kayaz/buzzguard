<div class="card-header border-bottom card-nav">
    <nav class="nav">
        <a class="nav-link {{ Request::routeIs('admin.tracker.errors') ? 'active' : '' }}" href="{{route('admin.tracker.errors')}}"><span class="fe-alert-circle"></span> Błędy</a>
        <a class="nav-link {{ Request::routeIs('admin.tracker.events', 'admin.tracker.event') ? 'active' : '' }}" href="{{route('admin.tracker.events')}}"><span class="fe-bell"></span> Wydarzenia</a>
    </nav>
</div>
