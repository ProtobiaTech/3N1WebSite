<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>
        @section('title')
            Community | new online community
        @show
    </title>

    <link href="{{ asset('/bowerAssets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/style/style_old.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/style/style.css') }}" rel="stylesheet">
    <script src="{{ asset('bowerAssets/jquery/dist/jquery.min.js') }}"></script>

    <!-- Fonts -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="cy-dashboard">
<!-- Header -->
<nav id="header" class="container">
    <h1>
        {{ trans('admin.Dashboard') }}
        <small><a href="{{ route('home') }}">{{ trans('admin.Home') }}</a></small>
    </h1>
    <ul class="nav nav-pills pull-right">
        <li class="{{ Request::is('admin/topic*') ? 'active' : '' }}"><a href="{{ route('admin.topic.index') }}">{{ trans('app.Topic') }}</a></li>
        <li class="{{ Request::is('admin/article*') ? 'active' : '' }}"><a href="{{ route('admin.article.index') }}">{{ trans('app.Article') }}</a></li>
        <li class="{{ Request::is('admin/blog*') ? 'active' : '' }}"><a href="{{ route('admin.blog.index') }}">{{ trans('app.Blog') }}</a></li>
    </ul>
</nav>


<!-- Flash notice -->
<div class="container">
    @include('flash::message')
</div>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <ul class="nav nav-pills nav-stacked">
                @section('nav-option')
                @show
            </ul>
        </div>

        <div class="col-sm-10">
            @section('main-body')
            @show
        </div>
    </div>
</div>
@show


<!-- Footer -->
<footer>
    <div class="container">
        <div class="pull-right">
            &copy;2015
            <a href="http://dev4living.com" target="_blank">dev4living</a><a>/</a><a href="http://community.dev4living.com" target="_blank">Community</a>
        </div>
        <i class="fa fa-lightbulb-o"></i> Think difference, and do it.
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('bowerAssets/jquery-pjax/jquery.pjax.js') }}"></script>
<script src="{{ asset('bowerAssets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bowerAssets/nprogress/nprogress.js') }}"></script>
<link href="{{ asset('bowerAssets/nprogress/nprogress.css') }}" rel="stylesheet">
<!-- NProgress -->
<script>
$(document).ready(function() {
    $(document).pjax('a', 'body');

    $(document).on('pjax:start', function() {
        NProgress.start();
    });
    $(document).on('pjax:end', function() {
        NProgress.done();
    });
});
</script>
</body>
</html>
