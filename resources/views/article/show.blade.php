@extends('layouts.app')

@section('title')
    {{ $article->title }} - @parent
@endsection

@section('content')
<!-- Article -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default section-panel-content">
                <div class="panel-heading">
                    <span>{{ $article->title }}</span>
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <div class="btn-group pull-right">
                        <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:if (confirm('{{ trans('app.Are you sure?') }}')) { $('#form-article-destroy').submit(); }" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                    </div>
                    {!! Form::open(['url' => route('article.destroy', ['id' => $article->id]), 'id' => 'form-article-destroy', 'class' => 'hidden', 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                    @endif
                </div>
                <div class="panel-body">
                    {!! $article->body !!}

                    <hr>
                    <div class="" style="margin-top:-10px">
                        <?php $myVote = Auth::guest() ? null : $article->myVote(); ?>
                        @if ($myVote && $myVote->value == \App\ContentVote::VALUE_UP)
                            <a class="text-muted" href="{{ route('content.vote', ['content_id' => $article->id, 'voteType' => 'vote_up_cancel', 'route' => 'article.show']) }}">
                                <i class="fa fa-thumbs-o-up"></i>
                                {{ $article->vote_up_count }}
                            </a>&nbsp;
                        @else
                            <a href="{{ route('content.vote', ['content_id' => $article->id, 'voteType' => 'vote_up', 'route' => 'article.show']) }}">
                                <i class="fa fa-thumbs-o-up"></i>
                                {{ $article->vote_up_count }}
                            </a>&nbsp;
                        @endif
                        @if ($myVote && $myVote->value == \App\ContentVote::VALUE_DOWN)
                            <a class="text-muted" href="{{ route('content.vote', ['content_id' => $article->id, 'voteType' => 'vote_down_cancel', 'route' => 'article.show']) }}">
                                <i class="fa fa-thumbs-o-down"></i>
                                {{ $article->vote_down_count }}
                            </a>&nbsp;
                        @else
                            <a href="{{ route('content.vote', ['content_id' => $article->id, 'voteType' => 'vote_down', 'route' => 'article.show']) }}">
                                <i class="fa fa-thumbs-o-down"></i>
                                {{ $article->vote_down_count }}
                            </a>&nbsp;
                        @endif
                        &nbsp;<i class="fa fa-bookmark hidden"></i>

                        <div class="pull-right">
                            <a href="#panel-comments" onclick="$('#panel-comments ').focus()"><i class="fa fa-comments"></i> {{ trans('app.Comment') }}</a>
                            &nbsp;&nbsp;
                            <a class="cursor-pointer" onclick="$('#section-content-replys').fadeToggle()">{{ trans('app.Reply') }}({{ $article->replys->count() }})</a>
                        </div>
                    </div>

                    <!-- Reply -->
                    @include('snippets.section-replys', ['entity' => $article])
                </div>
            </div>


            <!-- Comments -->
            @include('snippets.section-comments', ['entity' => $article])
        </div>

        <div class="col-sm-4">
            <a href="{{ URL::previous() }}" class="btn btn-default btn-block hidden-xs" style="margin-bottom:10px;"><i class="fa fa-arrow-left"></i> {{ trans('app.Back') }}</a>
            @include('snippets.panel-side')
        </div>
    </div>
</div>
@endsection
