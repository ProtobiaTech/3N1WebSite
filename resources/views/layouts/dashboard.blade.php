<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $systemDatas = \App\System::getSystemDatas();  ?>
    <meta name="keywords" contents="{{ $systemDatas->site_keywords }}">
    <meta name="description" contents="{{ $systemDatas->site_description }}">
    <title>
        @section('title')
            {{ $systemDatas->site_name }} Dashboard
        @show
    </title>

    <link href="{{ asset('/bowerAssets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/style/style-dashboard.min.css') }}" rel="stylesheet">
    <script src="{{ asset('bowerAssets/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bowerAssets/bootstrap/dist/js/bootstrap.min.js') }}"></script>

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
        <a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('app.Dashboard') }}</a>
        <small><a href="{{ route('home') }}">{{ trans('app.Frontend') }}</a></small>
    </h1>
    <ul class="nav nav-pills pull-right">
        <li class="{{ Request::is('dashboard/system*') ? 'active' : '' }}"><a href="{{ route('dashboard.system.index') }}">{{ trans('app.System') }}</a></li>
        <li class="{{ Request::is('dashboard/category*') ? 'active' : '' }}"><a href="{{ route('dashboard.category.index') }}">{{ trans('app.Category') }}</a></li>
        <li class="{{ Request::is('dashboard/topic*') ? 'active' : '' }}"><a href="{{ route('dashboard.topic.index') }}">{{ trans('app.Topic') }}</a></li>
        <li class="{{ Request::is('dashboard/article*') ? 'active' : '' }}"><a href="{{ route('dashboard.article.index') }}">{{ trans('app.Article') }}</a></li>
        <li class="{{ Request::is('dashboard/blog*') ? 'active' : '' }}"><a href="{{ route('dashboard.blog.index') }}">{{ trans('app.Blog') }}</a></li>
    </ul>
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
        <i class="fa fa-lightbulb-o"></i> {{ $systemDatas->site_slogan }}
    </div>
</footer>

</script>
</body>
</html>
