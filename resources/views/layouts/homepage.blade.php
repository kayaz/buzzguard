<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ settings()->get("page_title") }}</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ settings()->get("page_description") }}">
    <meta name="robots" content="{{ settings()->get("page_robots") }}">
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

<div id="slider" class="clearfix">
    <ul class="rslidess list-unstyled mb-0">
        @foreach ($sliders as $s)
            <li>
                <img src="{{asset('uploads/slider/'.$s->file) }}" alt="{{ $s->title }}">
                <div class="apla">
                    <h2>{{ $s->title }}<span></span></h2>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div id="news-list" class="container pt-5 pb-5">
    <div class="row">
            @foreach ($articles as $n)
                <article class="col-12" id="list-post-{{ $n->id }}" itemscope="" itemtype="http://schema.org/NewsArticle">
                    <div class="list-post">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" itemprop="url"><img src="{{asset('uploads/articles/thumbs/'.$n->file) }}" alt="{{ $n->title }}"></a>
                            </div>
                            <div class="col-8">
                                <div class="list-post-content">
                                    <header>
                                        @if($n->date)<div class="list-post-date text-muted">Data publikacji: <span itemprop="datePublished" content="{{ $n->date }}">{{ $n->date }}</span></div>@endif
                                        <h2 class="list-post-title"><a href="{{route('front.news.show', $n->slug)}}" itemprop="url"><span itemprop="name headline">{{ $n->title }}</span></a></h2>
                                    </header>

                                    <div class="list-post-entry" itemprop="articleBody">
                                        <p class="text-muted">{{ $n->content_entry }}</p>
                                    </div>

                                    <footer>
                                        <a itemprop="url" href="{{route('front.news.show', $n->slug)}}" title="{{ $n->title }}" class="bttn mt-3">CZYTAJ WIĘCEJ <i class="las la-arrow-right"></i></a>
                                        <meta itemprop="author" content="DeveloPro">
                                        <meta itemprop="mainEntityOfPage" content="">
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
        @endforeach
    </div>
</div>

@include('layouts.footer')

@include('layouts.cookies')

<!-- jQuery -->
<script src="/js/jquery.min.js" charset="utf-8"></script>
<script src="/js/app.js" charset="utf-8"></script>

@stack('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $(".rslidess").responsiveSlides({auto:true, pager:false, nav:true, timeout:4000, random:false, speed:500});
    });
    $(window).load(function() {
        $(".rslidess").show();
        $(".rslides_nav").show();
    });
</script>
<!-- Google fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- jQuery -->
</body>
</html>
