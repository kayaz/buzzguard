@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row"><i class="fe-settings"></i>Panel administratora / SEO</h4>
                    </div>
                </div>
            </div>

            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link" href=""><span class="fe-settings"></span> Panel administratora</a>
                    <a class="nav-link {{ Request::routeIs('admin.dashboard.seo.index') ? ' active' : '' }}" href="{{ route('admin.dashboard.seo.index') }}"><span class="fe-globe"></span> SEO</a>
                    <a class="nav-link" href="{{ route('admin.dashboard.social.index') }}"><span class="fe-hash"></span> Social Media</a>
                </nav>
            </div>

        </div>
        <div class="mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <form method="POST" action="{{route('admin.dashboard.seo.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid p-0">
                            <div class="card p-4">
                                @if (session('success'))
                                    <div class="alert alert-success border-0">
                                        {{ session('success') }}
                                        <script>window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},3000);</script>
                                    </div>
                                @endif
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-12">

                                            @include('form-elements.input-text', ['label' => 'Nazwa strony', 'sublabel' => 'Meta tag - title', 'name' => 'page_title', 'value' => settings()->get("page_title"), 'required' => 1])
                                            @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel' => 'Meta tag - description', 'name' => 'page_description', 'value' => settings()->get("page_description"), 'required' => 1])
                                            @include('form-elements.input-text', ['label' => 'Adres strony', 'sublabel' => 'URL strony', 'name' => 'page_url', 'value' => settings()->get("page_url"), 'required' => 1])

                                        </div>
                                    </div>

                                    <div class="section">
                                        <div class="row">
                                            <div class="col-12">
                                                Podgląd wyszukiwarki Google
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-2 col-form-label control-label">&nbsp;</div>
                                                <div class="col-10" style="line-height: normal">
                                                    <h3 style="font-family: arial,sans-serif;font-size:18px;line-height: 1.2;margin:0;font-weight: normal;color:#1a0dab;">{{settings()->get("page_title")}}</h3>
                                                    <div style="line-height: 14px"><cite style="font-size:14px;line-height: 16px;color: #006621;font-style: normal;font-family: arial,sans-serif">{{settings()->get("page_description")}}</cite></div>
                                                    <span style="font-family: arial,sans-serif;font-size:13px;line-height:18px;color: #545454">{{settings()->get("page_url")}}</span>

                                                </div>
                                            </div>

                                            @include('form-elements.input-text', ['label' => 'Autor strony', 'sublabel' => 'Meta tag - author', 'name' => 'page_author', 'value' => settings()->get("page_author")])
                                            @include('form-elements.input-text', ['label' => 'Adres e-mail', 'name' => 'page_email', 'value' => settings()->get("page_email")])

                                            <div class="form-group row">

                                                <label for="page_robots" class="col-2 col-form-label control-label"><div class="text-right">Indeksowanie<br><span>Meta tag - robots</span></div></label>

                                                <div class="col-4">
                                                    <select id="page_robots" class="form-control" name="page_robots" id="page_robots">
                                                        <option value="noindex, nofollow"<?php if(settings()->get("page_robots") == 'noindex, nofollow'){?> selected<?php } ?>>noindex, nofollow</option>
                                                        <option value="index, follow"<?php if(settings()->get("page_robots") == 'index, follow'){?> selected<?php } ?>>index, follow</option>
                                                        <option value="index, nofollow"<?php if(settings()->get("page_robots") == 'index, nofollow'){?> selected<?php } ?>>index, nofollow</option>
                                                        <option value="noindex, follow"<?php if(settings()->get("page_robots") == 'noindex, follow'){?> selected<?php } ?>>noindex, follow</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-submit">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <input name="submit" id="submit" value="Zapisz" class="btn btn-primary" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
