<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>kCMS</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex, nofollow">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Wylaczenie numeru tel. -->
    <meta name="format-detection" content="telephone=no">

    <!-- Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body class="lang-pl">
<div id="admin">
    <div id="content">
        <header id="header-navbar">
            <h1><a href="{{route('admin.dashboard.index')}}" class="logo"><span>BuzzGuard</span></a></h1>

            <div class="user">
                <ul class="mb-0 list-unstyled">
                    <li><span class="fe-calendar"></span> <span id="livedate"><?=date('d-m-Y');?></span></li>
                    <li><span class="fe-clock"></span> <span id="liveclock"></span></li>
                    <li class="dropdown">
                        <div id="header-user-dropdown" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-offset="100,200">
                            <span class="fe-user"></span> Witaj: <b>{{ Auth::user()->name }}</b>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="header-user-dropdown">
                            <li><a class="dropdown-item" href="{{route('admin.user.show', Auth::user()->id)}}">Mój profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.project.private.index') }}">Moje projekty</a></li>
                            <li><a class="dropdown-item" href="{{route('admin.account.edit', Auth::user()->id)}}">Zmień dane</a></li>
                        </ul>
                    </li>
                    @role('Administrator')<li><a href="{{route('admin.user.index')}}"><span class="fe-settings"></span> Ustawienia</a></li>@endrole
                    <li>
                        <a title="Wyloguj" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="fe-lock"></span> Wyloguj</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <div class="content">
            @yield('submenu')

            @yield('content')
        </div>
    </div>
</div>

<!--Google font style-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/jquery-ui.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/cms.js') }}" charset="utf-8"></script>

@stack('scripts')

</body>
</html>
