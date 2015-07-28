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
                    {{ trans('article.Hot Article') }}
                </div>
                <div class="panel-body" style="height:192px">
                    <ul class="list-unstyled">
                        @if (!$articles->count())
                            <li>{{ trans('app.No data') }}</li>
                        @endif
                        @foreach ($articles as $key => $article)
                        <?php if ($key == 8) {
                            break;
                        } ?>
                        <li>
                            <span class="pull-right" style="color:#777">
                                <i class="fa fa-thumbs-o-up"></i> {{ $article->view_count }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-eye"></i> {{ $article->view_count }}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ getYMD4datetime($article->created_at) }}
                            </span>
                            <a href="{{ url('/article', ['id' => $article->id]) }}">{{ $article->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('article.Article') }}
                </div>
                <div class="panel-body">
                    <img style="width:100%; height:162px; background-color:#eee;">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($categorys as $key => $category)
        <?php if ($key == 4) break; ?>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $category->name }}
                </div>
                <div class="panel-body" style="height:192px;">
                    <ul class="list-unstyled">
                        @if (!$articles->count())
                            <li>{{ trans('app.No data') }}</li>
                        @endif
                        <?php $articles = $category->getHotContents(); ?>
                        @foreach ($articles as $key => $article)
                        <?php if ($key == 8) {
                            break;
                        } ?>
                        <li>
                            <span class="pull-right" style="color:#777">
                                {{ getYMD4datetime($article->created_at) }}
                            </span>
                            <a href="{{ url('/article', ['id' => $article->id]) }}">{{ $article->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
