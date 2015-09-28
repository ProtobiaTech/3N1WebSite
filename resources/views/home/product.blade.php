@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">
        <i class="fa fa-cubes"></i>
        3N1WebSite
    </h1>
    <div class="text-center">
        <a class="github-button" href="https://github.com/dev4living/3n1website" data-icon="octicon-star" data-count-href="/dev4living/3n1website/stargazers" data-count-api="/repos/dev4living/3n1website#stargazers_count" data-count-aria-label="# stargazers on GitHub" aria-label="Star dev4living/3n1website on GitHub">Star</a>
        &nbsp; &nbsp;
        <a class="github-button" href="https://github.com/dev4living/3n1website/issues" data-icon="octicon-issue-opened" data-count-api="/repos/dev4living/3n1website#open_issues_count" data-count-aria-label="# issues on GitHub" aria-label="Issue dev4living/3n1website on GitHub">Issue</a>
        &nbsp; &nbsp;
        <a class="github-button" href="https://github.com/dev4living/3n1website/archive/master.zip" data-style="mega" data-icon="octicon-cloud-download" aria-label="Download dev4living/3n1website on GitHub">Download</a>
    </div>

    <div class="text-center">
        <p>
            3N1WebSite是集 博客 / 内容管理系统 / 论坛 于一体的PHP网站程序 <br>
            它开源且免费，使用最开放的<a href="http://opensource.org/licenses/MIT" target="_blank">MIT授权</a> <br>
            被授权人有权利使用、复制、修改、合并、出版发布、散布、再授权和/或贩售软件及软件的副本。
        </p>

        <p>
            它优雅小巧，如你所见，此站正是构建在3N1WebSite之上 <br>
            你也可以尝试一个空<a href="http://3n1website.dev4living.com" target="_blank">DEMO</a>，<small>管理员帐号: admin@3n1website.local &nbsp; 密码: 3n1website</small>
        </p>

        <p>
            欢迎使用3N1WebSite构建你的网站，我们会提供强有力的支持 <br>
            开发交流: <a href="https://gitter.im/dev4living/3N1WebSite" target="_blank">https://gitter.im/dev4living/3N1WebSite</a> <br>
            QQ交流群: 242078519 <br>
            Rod: supgeek-rod(AT)gmail.com
        </p>
        <br><br>
    </div>

    <div class="row">
        <!-- news -->
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    官方消息
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li>
                            <a href="http://form.mikecrm.com/f.php?t=GJGlq3" target="_blank">参与产品调查，帮助我们改进3N1WebSite</a>
                            <span class="pull-right">
                                2015-09-28
                            </span>
                        </li>
                        <li>
                            <a>10月初将发布正式版(v1.0)</a>
                            <span class="pull-right">
                                2015-09-25
                            </span>
                        </li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- authors -->
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    开发团队
                </div>
                <div class="panel-body">
                    <div class="item-author">
                        <div class="pic pull-left" style="padding-right:15px;">
                            <img src="https://avatars2.githubusercontent.com/u/5748006?v=3&s=460" style="width:80px; border-radius:50%; border:2px solid #ddd; padding:5px;">
                        </div>
                        <div style="padding:10px 0;">
                            <a href="http://mr.supgeek-rod.com" target="_blank" style="font-size:18px;">Rod</a> <br>
                            <span>Full-stack developer, SOHO freelancer</span>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>

<!-- mike survey -->
<a href="http://form.mikecrm.com/f.php?t=GJGlq3" target="_blank" style="position:fixed;z-index:999;right:-5px;bottom: 20px;display: inline-block;width: 30px;border-radius: 5px;color:white;font-size:14px;line-height:17px;background: #2476CE;box-shadow: 0 0 5px #666;word-wrap: break-word;padding: 10px 6px;border: 2px solid white;">参与产品调查</a>
