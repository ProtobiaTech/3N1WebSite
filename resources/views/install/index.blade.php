@extends('install.layout')

@section('content')
<div class="container">
    <div class="text-center" style="margin-bottom:30px">
        <h1><i class="fa fa-cubes"></i> 一个新的3N1WebSite</h1>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 text-center">
            <p>
                欢迎使用3N1WebSite
            </p>

            <a href="{{ url('install/check') }}" class="btn btn-primary btn-block">开始安装</a>
        </div>
    </div>
</div>
@endsection
