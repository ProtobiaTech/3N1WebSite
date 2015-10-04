<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" contents="dev4living.com">
    <?php $systemDatas = \App\System::getSystemDatas();  ?>
    <meta name="keywords" contents="{{ $systemDatas->site_keywords }}">
    <meta name="description" contents="{{ $systemDatas->site_description }}">
    <title>
        @section('title')
            {{ $systemDatas->site_name }}
        @show
    </title>

    <link href="{{ asset('/bowerAssets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/bowerAssets/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/style/style.min.css') }}" rel="stylesheet">
    <script src="{{ asset('bowerAssets/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bowerAssets/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Header -->
<nav id="header" class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topNav">
                <i class="fa fa-bank"></i>
            </button>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#launchNav">
                <i class="fa fa-rocket"></i>
            </button>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#userNav">
                <i class="fa fa-user"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">{{ $systemDatas->site_name }}</a>
        </div>

        <!-- TopNav -->
        <div class="collapse navbar-collapse" id="topNav">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('article*') ? 'active' : '' }}">
                    <a href="{{ url('/article') }}">
                        <i class="visible-xs-inline fa fa-file-text">&nbsp;</i>
                        {{ trans('app.Article') }}
                    </a>
                </li>
                <li class="{{ Request::is('topic*') ? 'active' : '' }}">
                    <a href="{{ url('/topic') }}">
                        <i class="visible-xs-inline fa fa-comments">&nbsp;</i>
                        {{ trans('app.Topic') }}
                    </a>
                </li>
                <li class="{{ Request::is('blog*') ? 'active' : '' }}">
                    <a href="{{ url('/blog') }}">
                        <i class="visible-xs-inline fa fa-leaf">&nbsp;</i>
                        {{ trans('app.Blog') }}
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right hidden-xs">
                @if (Auth::guest())
                    <li class="{{ Request::is('auth/login') ? 'active' : '' }}"><a href="{{ url('/auth/login') }}">{{ trans('app.Login') }}</a></li>
                    <li class="{{ Request::is('auth/register') ? 'active' : '' }}"><a href="{{ url('/auth/register') }}">{{ trans('app.Register') }}</a></li>
                @else
                    <li class="">
                        <a href="{{ route('uc.show', Auth::user()->id) }}">
                            <i class="fa fa-bell"></i>
                            <span class="visible-xs-inline">{{ trans('app.Notice') }}</span>
                            <span id="header-uncheck-notice-num" class="badge">{{ Auth::user()->uncheckNotices->count() }}</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-rocket"></i>
                            <span class="visible-xs-inline">{{ trans('app.Launch') }}</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/topic/create') }}"><i class="fa fa-comments"></i> &nbsp;{{ trans('app.Create Topic') }}</a></li>
                            @if (Auth::check() && Auth::user()->hasRole('admin'))
                                <li><a href="{{ url('/blog/create') }}"><i class="fa fa-leaf"></i> &nbsp;{{ trans('app.Create Blog') }}</a></li>
                                <li><a href="{{ url('/article/create') }}"><i class="fa fa-file-text"></i> &nbsp;{{ trans('app.Create Article') }}</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user visible-xs-inline"></i>&nbsp;
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @if (Auth::check() && Auth::user()->hasRole('admin'))
                                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> &nbsp;{{ trans('app.Dashboard') }}</a></li>
                            @endif
                            <li><a href="{{ route('uc.show', Auth::user()->id) }}"><i class="fa fa-bank"></i> &nbsp;{{ trans('app.User Center') }}</a></li>
                            <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out"></i> &nbsp;{{ trans('app.Logout') }}</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

        <!-- LaunchNav -->
        <div class="collapse navbar-collapse" id="launchNav">
            <ul class="nav navbar-nav visible-xs">
                <li><a href="{{ url('/topic/create') }}"><i class="fa fa-comments"></i> &nbsp;{{ trans('app.Create Topic') }}</a></li>
                @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <li><a href="{{ url('/blog/create') }}"><i class="fa fa-leaf"></i> &nbsp;{{ trans('app.Create Blog') }}</a></li>
                    <li><a href="{{ url('/article/create') }}"><i class="fa fa-file-text"></i> &nbsp;{{ trans('app.Create Article') }}</a></li>
                @endif
            </ul>
        </div>

        <!-- UserNav -->
        <div class="collapse navbar-collapse" id="userNav">
            <ul class="nav navbar-nav visible-xs">
                 @if (Auth::guest())
                     <li class="{{ Request::is('auth/login') ? 'active' : '' }}"><a href="{{ url('/auth/login') }}"><i class="fa fa-sign-in"></i> &nbsp;{{ trans('app.Login') }}</a></li>
                     <li class="{{ Request::is('auth/register') ? 'active' : '' }}"><a href="{{ url('/auth/register') }}"><i class="fa fa-child"></i> &nbsp;{{ trans('app.Register') }}</a></li>
                 @else
                    <li>
                    <a href="{{ route('uc.show', Auth::user()->id) }}">
                        <i class="fa fa-bell"></i> &nbsp;{{ trans('app.Notice') }}
                        <span id="header-uncheck-notice-num" class="badge">{{ Auth::user()->uncheckNotices->count() }}</span>
                    </a></li>
                    <li><a href="{{ route('uc.show', Auth::user()->id) }}"><i class="fa fa-bank"></i> &nbsp;{{ trans('app.User Center') }}</a></li>
                    <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out"></i> &nbsp;{{ trans('app.Logout') }}</a></li>
                 @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Flash notice -->
<div id="flash" class="container">
    @include('flash::message')
    <script>
    setTimeout(function() {
        $('#flash .alert').fadeOut();
    }, 4000);
    </script>
</div>


@yield('content')


<!-- Footer -->
<footer id="footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <i class="fa fa-plug"></i> Powered by
            <a href="http://dev4living.com" target="_blank">dev4living</a><a>/</a><a href="https://github.com/dev4living/3N1WebSite" target="_blank">3N1WebSite</a>
        </div>
        <i class="fa fa-lightbulb-o"></i> {{ $systemDatas->site_slogan }}
        <div class="visible-xs">
            <i class="fa fa-plug"></i> Powered by
            <a href="http://dev4living.com" target="_blank">dev4living</a><a>/</a><a href="https://github.com/dev4living/3N1WebSite" target="_blank">3N1WebSite</a>
        </div>
    </div>
</footer>
<div class="hidden">
{!! $systemDatas->site_analytic !!}
</div>

</body>
</html>
