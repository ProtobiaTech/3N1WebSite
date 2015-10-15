@extends('layouts.app')

@section('title')
    {{ trans('app.Article') }} - @parent
@endsection

@section('content')
<!-- Article -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default" id="section-items-article">
                <div class="panel-heading">
                    {{ trans('article.Hot Article') }}
                </div>
                <div class="panel-body" style="height:192px">
                    <ul class="list-unstyled">
                        @if (!$articles->count())
                            <li>{{ trans('app.No data') }}</li>
                        @endif
                        @foreach ($articles as $key => $article)
                        <li>
                            <span class="pull-right" style="color:#777">
                                <span class="hidden-xs">
                                    <i class="fa fa-thumbs-o-up"></i>
                                    <span style="display:inline-block;width:2em">{{ $article->vote_up_count }}</span>
                                    <i class="fa fa-eye"></i>
                                    <span style="display:inline-block; width:2em">{{ $article->view_count }}</span>
                                </span>
                                {{ $article->created_at->format('m-d') }}
                            </span>
                            <a href="{{ url('/article', ['id' => $article->id]) }}" target="{{ $article->target_type ? '_blank' : '_self' }}">{{ $article->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            @include('snippets.panel-side')
        </div>
    </div>

    <div class="row">
        @foreach ($categorys as $key => $category)
            <div class="col-sm-6">
                <div class="panel panel-default" id="section-items-article">
                    <div class="panel-heading">
                        {{ $category->name }}
                    </div>
                    <div class="panel-body" style="height:192px;">
                        <ul class="list-unstyled">
                            <?php $articles = $category->contents->sortByDesc('created_at')->sortByDesc('id'); ?>
                            @if (!$articles->count())
                                <li>{{ trans('app.No data') }}</li>
                            @endif
                            @foreach ($articles as $key => $article)
                                <?php if ($key == 8) {
                                    break;
                                } ?>
                                <li>
                                    <span class="pull-right" style="color:#777">
                                        {{ $article->created_at->format('m-d') }}
                                    </span>
                                    <a href="{{ url('/article', ['id' => $article->id]) }}" target="{{ $article->target_type ? '_blank' : '_self' }}">{{ $article->title }}</a>
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
