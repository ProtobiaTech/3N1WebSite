<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Community</title>

    <link href="{{ asset('/bowerAssets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <!-- Fonts -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">{{ i18n('app.Community') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">{{ i18n('app.Home') }}</a></li>
                <li class="{{ Request::is('topic*') ? 'active' : '' }}"><a href="{{ url('/topic') }}">{{ i18n('app.Topics') }}</a></li>
                <!-- <li class=""><a href="{{ url('/page/about') }}">{{ i18n('app.About') }}</a></li> -->
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-rocket"></i> {{ i18n('app.Launch') }}</a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/topic/create') }}"><i class="fa fa-plus"></i> &nbsp;{{ i18n('app.Create Topic') }}</a></li>
                    </ul>
                </li>
                @if (Auth::guest())
                    <li class="{{ Request::is('auth/login') ? 'active' : '' }}"><a href="{{ url('/auth/login') }}">{{ i18n('app.Login') }}</a></li>
                    <li class="{{ Request::is('auth/register') ? 'active' : '' }}"><a href="{{ url('/auth/register') }}">{{ i18n('app.Register') }}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">{{ i18n('app.Logout') }}</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Flash notice -->
<div class="container">
    @include('flash::message')
</div>


@yield('content')


<!-- Footer -->
<footer>
    <div class="container">
        <div class="pull-right">
            &copy;2015
            <a href="http://dev4living.com/" target="_blank">dev4living/Community</a>
        </div>
        <i class="fa fa-lightbulb-o"></i> Think difference, and do it.
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('bowerAssets/jquery/dist/jquery.min.js') }}"></script>
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
