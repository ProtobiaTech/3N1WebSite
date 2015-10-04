@extends('install.layout')

@section('content')
<div class="container">
    <div class="text-center" style="margin-bottom:30px">
        <h1><i class="fa fa-cubes"></i> 一个新的3N1WebSite</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center">
            <p>
                3N1WebSite是集 博客 / 内容管理系统 / 论坛 于一体的PHP网站程序 <br>
                它开源且免费，使用最开放的<a href="http://opensource.org/licenses/MIT" target="_blank">MIT授权</a> <br>
                被授权人有权利使用、复制、修改、合并、出版发布、散布、再授权和/或贩售软件及软件的副本。 <br>
            </p>

            <p>
                欢迎使用3N1WebSite构建你的网站，我们会提供强有力的支持 <br>
                官方网站: <a href="http://dev4living.com/3n1website" target="_blank">http://dev4living.com</a> <br>
                开发交流: <a href="https://gitter.im/dev4living/3N1WebSite" target="_blank">https://gitter.im/dev4living/3N1WebSite</a> <br>
                QQ交流群: 242078519 <br>
                Rod: supgeek-rod(AT)gmail.com <br>
            </p>

            <p>点击 开始安装 按钮进行安装</p>
            <br>

            <a href="{{ url('install/check') }}" class="btn btn-primary btn-block">开始安装</a>
        </div>
    </div>
</div>
@endsection
