<h2>{{$project->name}}</h2>
<h4 class="mb-5">Ilość postów: {{$project->posts()->count()}}</h4>

<div class="btn-group mb-3" role="group">
    <a href="{{ route('admin.project.show', $project->id) }}" class="btn btn-outline-primary {{ Request::routeIs('admin.project.show') ? 'active' : '' }}"><i class="fe-list"></i> Lista postów</a>
    <a href="{{ route('admin.project.charts', $project->id) }}" class="btn btn-outline-primary {{ Request::routeIs('admin.project.charts') ? 'active' : '' }}"><i class="fe-pie-chart"></i> Statystyki</a>
    <a href="{{ route('admin.project.calendar', $project->id) }}" class="btn btn-outline-primary {{ Request::routeIs('admin.project.calendar') ? 'active' : '' }}"><i class="fe-calendar"></i> Kalendarz projektu</a>
    <a href="{{ route('admin.project.chat', $project->id) }}" class="btn btn-outline-primary {{ Request::routeIs('admin.project.chat.*') ? 'active' : '' }}"><i class="fe-message-square"></i> Q&A</a>
</div>
