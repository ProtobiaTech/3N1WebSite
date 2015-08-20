@extends('layouts.dashboard')


@section('content')
<div class="container">
    <div class="row">
        <!-- User -->
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.User') }}
                </div>
                <div class="panel-body">
                    {{ $userCount }}
                </div>
            </div>
        </div>

        <!-- Topic -->
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.Topic') }}
                </div>
                <div class="panel-body">
                    {{ $topicCount }}
                </div>
            </div>
        </div>

        <!-- Article -->
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.Article') }}
                </div>
                <div class="panel-body">
                    {{ $articleCount }}
                </div>
            </div>
        </div>

        <!-- Blog -->
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.Blog') }}
                </div>
                <div class="panel-body">
                    {{ $blogCount }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
