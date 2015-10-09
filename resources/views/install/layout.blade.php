<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" contents="dev4living.com">
    <title>
        @section('title')
            {{ trans('app.New 3N1WebSite') }}
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
<!-- Flash notice -->
<div id="flash" class="container">
    @include('flash::message')
    <script>
    setTimeout(function() {
        $('#flash .alert').fadeOut();
    }, 4000);
    </script>
</div>


<div style="margin-top:50px"></div>
@yield('content')


</body>
</html>
