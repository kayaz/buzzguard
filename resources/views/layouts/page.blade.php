<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@hasSection('seo_title')@yield('seo_title')@else{{ settings()->get("page_title") }} - @yield('meta_title')@endif</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@hasSection('seo_description')@yield('seo_description')@else{{ settings()->get("page_description") }}@endif">
    <meta name="robots" content="@hasSection('seo_robots')@yield('seo_robots')@else{{ settings()->get("page_robots") }}@endif">
    <meta name="author" content="{{ settings()->get("page_author") }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    @stack('style')
</head>
<body class="{{ !empty($body_class) ? $body_class : '' }}">
<div class="page-header">
    @include('layouts.header')

    @yield('pagheader')
</div>
<div id="page">
    @yield('content')
</div>
@include('layouts.footer')

@include('layouts.cookies')

<!-- jQuery -->
<script src="/js/jquery.min.js" charset="utf-8"></script>
<script src="/js/app.js" charset="utf-8"></script>

@stack('scripts')

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
<!-- Google fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- jQuery -->
</body>
</html>
