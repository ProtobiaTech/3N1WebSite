@extends('layouts.app')

@section('title')
    {{ trans('topic.Topic') }} - @parent
@endsection

@section('content')
<!-- Article -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>{{ $article->title }}</span>
                </div>
                <div class="panel-body">
                    {!! $article->body !!}

                    <hr>
                    <div class="" style="margin-top:-10px">
                        <span>{{ trans('app.Share') }}</span> &nbsp;
                        <a><i class="fa fa-twitter"></i></a>
                        <a><i class="fa fa-facebook"></i></a>
                        <a><i class="fa fa-weibo"></i></a>

                        <div class="pull-right">
                            <a href="#anchor-reply"><i class="fa fa-reply"></i> {{ trans('topic.Reply') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('article.Article') }}
                </div>
                <div class="panel-body">
                    {{ trans('article.Enjoy Reading') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
