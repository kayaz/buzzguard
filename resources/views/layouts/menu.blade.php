<ul class="mb-0 list-unstyled main-menu">
@foreach($pages as $page)
    <li class="main-menu-item">
        @if($page->url)
            <a href="{{$page->url}}"@if($page->url_target) target="{{$page->url_target}}"@endif>{{$page->title}}</a>
        @else
            <a href="/{{$page->uri}}"@if($page->url_target) target="{{$page->url_target}}"@endif>{{$page->title}}</a>
        @endif
        @if($page->children->count() > 0)
            @include('layouts.submenu', array('pages' => $page->children))
        @endif
    </li>
@endforeach
</ul>
