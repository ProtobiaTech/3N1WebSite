@extends('layouts.dashboard')


@section('content')
<div class="container">
    <div class="row">
        <!-- User -->
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.Effective') }}
                </div>
                <div class="panel-body">
                    <i class="fa fa-user" style="width:14px; display:inline-block"></i>
                    {{ trans('app.User') }}:
                    {{ $userCount }}
                    <br>

                    <i class="fa fa-comments" style="width:14px; display:inline-block"></i>
                    {{ trans('app.Topic') }}:
                    {{ $topicCount }}
                    <br>

                    <i class="fa fa-leaf" style="width:14px; display:inline-block"></i>
                    {{ trans('app.Article') }}:
                    {{ $articleCount }}
                    <br>

                    <i class="fa fa-file-text" style="width:14px; display:inline-block"></i>
                    {{ trans('app.Blog') }}:
                    {{ $blogCount }}
                </div>
            </div>
        </div>

        <!-- Topic -->
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.Launch') }}
                </div>
                <div class="panel-body">
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.CallBoard') }}
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
