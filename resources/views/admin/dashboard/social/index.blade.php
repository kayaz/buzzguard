@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-12 pl-0">
                        <h4 class="page-title row"><i class="fe-settings"></i>Panel administratora / Social Media</h4>
                    </div>
                </div>
            </div>

            <div class="card-header border-bottom card-nav">
                <nav class="nav">
                    <a class="nav-link" href=""><span class="fe-settings"></span> Panel administratora</a>
                    <a class="nav-link" href="{{ route('admin.dashboard.seo.index') }}"><span class="fe-globe"></span> SEO</a>
                    <a class="nav-link {{ Request::routeIs('admin.dashboard.social.index') ? ' active' : '' }}" href="{{ route('admin.dashboard.social.index') }}"><span class="fe-hash"></span> Social Media</a>
                </nav>
            </div>

        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <form method="POST" action="{{route('admin.dashboard.social.store')}}" enctype="multipart/form-data">
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
                                            @include('form-elements.input-text', ['label' => 'Facebook', 'name' => 'social_facebook', 'value' => settings()->get("social_facebook")])
                                            @include('form-elements.input-text', ['label' => 'Instagram', 'name' => 'social_instagram', 'value' => settings()->get("social_instagram")])
                                            @include('form-elements.input-text', ['label' => 'Linkedin', 'name' => 'social_linkedin', 'value' => settings()->get("social_linkedin")])
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
