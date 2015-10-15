@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Article -->
        <div class="col-sm-6">
            <div class="panel panel-default" id="section-items-article">
                <div class="panel-heading">
                    {{ trans('article.Hot Article') }}
                    <div class="pull-right shortcut">
                        <a href="{{ route('article.index') }}">{{ trans('app.More') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        @if (!$articles->count())
                            <li>{{ trans('app.No data') }}</li>
                        @endif
                        @foreach ($articles as $article)
                            <li>
                                <span class="pull-right">{{ $article->created_at->format('m-d') }}</span>
                                <a href="{{ route('article.show', ['id' => $article->id]) }}" target="{{ $article->target_type ? '_blank' : '_self' }}">{{ $article->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Blog -->
        <div class="col-sm-6">
            <div class="panel panel-default" id="section-items-article">
                <div class="panel-heading">
                    {{ trans('blog.Hot Blog') }}
                    <div class="pull-right shortcut">
                        <a href="{{ route('blog.index') }}">{{ trans('app.More') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        @if (!$blogs->count())
                            <li>{{ trans('app.No data') }}</li>
                        @endif
                        @foreach ($blogs as $blog)
                            <li>
                                <span class="pull-right">{{ $blog->created_at->format('m-d') }}</span>
                                <a href="{{ route('blog.show', ['id' => $blog->id]) }}">{{ $blog->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Topic -->
    <div class="panel panel-default" id="section-items-topic">
        <div class="panel-heading">
            {{ trans('topic.Hot Topic') }}
            <div class="pull-right shortcut">
                <a href="{{ route('topic.index') }}">{{ trans('app.More') }}</a>
            </div>
        </div>
        <div class="panel-body">
            @include('snippets.items-topic', ['topics' => $topics, 'colType' => 'col-sm-6'])
        </div>
    </div>
</div>
@endsection

<!-- mike survey -->
<a href="http://form.mikecrm.com/f.php?t=GJGlq3" target="_blank" style="position:fixed;z-index:999;right:-5px;bottom: 20px;display: inline-block;width: 30px;border-radius: 5px;color:white;font-size:14px;line-height:17px;background: #2476CE;box-shadow: 0 0 5px #666;word-wrap: break-word;padding: 10px 6px;border: 2px solid white;">参与产品调查</a>
