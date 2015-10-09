@extends('layouts.app')

@section('title')
    {{ $topic->title }} - @parent
@endsection

@section('content')
<!-- Topic -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default section-panel-topic section-panel-content">
                <div class="panel-heading topic-header">
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <div class="btn-group pull-right">
                        <a href="{{ route('topic.edit', ['id' => $topic->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:if (confirm('{{ trans('app.Are you sure?') }}')) { $('#form-topic-destroy').submit(); }" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                    </div>
                    {!! Form::open(['url' => route('topic.destroy', ['id' => $topic->id]), 'id' => 'form-topic-destroy', 'class' => 'hidden', 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                    @endif

                    <div class="avatar pull-left">
                        <img src="{{ $topic->author->avatar }}">
                    </div>
                    <span class="title">
                        {{ $topic->title }}
                    </span>
                    <div class="info">
                        <a href="#">{{ $topic->author->name }}</a>
                        <span class="nodeName">{{ $topic->category->name }}</span>
                        <span class="separator">|</span>
                        <span>{{ timeAgo($topic->updated_at) }}</span>
                        <span class="separator">|</span>
                        <span>{{ trans('topic.ReplyCount', ['count' => $topic->comment_count]) }}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    {!! $topic->body !!}

                    <hr>
                    <div class="" style="margin-top:-10px">
                        <?php $myVote = Auth::guest() ? null : $topic->myVote(); ?>
                        @if ($myVote && $myVote->value == \App\ContentVote::VALUE_UP)
                            <a class="text-muted" href="{{ route('content.vote', ['content_id' => $topic->id, 'voteType' => 'vote_up_cancel', 'route' => 'topic.show']) }}">
                                <i class="fa fa-thumbs-o-up"></i>
                                {{ $topic->vote_up_count }}
                            </a>&nbsp;
                        @else
                            <a href="{{ route('content.vote', ['content_id' => $topic->id, 'voteType' => 'vote_up', 'route' => 'topic.show']) }}">
                                <i class="fa fa-thumbs-o-up"></i>
                                {{ $topic->vote_up_count }}
                            </a>&nbsp;
                        @endif
                        @if ($myVote && $myVote->value == \App\ContentVote::VALUE_DOWN)
                            <a class="text-muted" href="{{ route('content.vote', ['content_id' => $topic->id, 'voteType' => 'vote_down_cancel', 'route' => 'topic.show']) }}">
                                <i class="fa fa-thumbs-o-down"></i>
                                {{ $topic->vote_down_count }}
                            </a>&nbsp;
                        @else
                            <a href="{{ route('content.vote', ['content_id' => $topic->id, 'voteType' => 'vote_down', 'route' => 'topic.show']) }}">
                                <i class="fa fa-thumbs-o-down"></i>
                                {{ $topic->vote_down_count }}
                            </a>&nbsp;
                        @endif
                        &nbsp;<i class="fa fa-bookmark hidden"></i>

                        <div class="pull-right">
                            <a href="#panel-comments" onclick="$('#panel-comments textarea').focus()"><i class="fa fa-comments"></i> {{ trans('app.Comment') }}</a>
                            &nbsp;&nbsp;
                            <a class="cursor-pointer" onclick="$('#section-content-replys').fadeToggle()">{{ trans('app.Reply') }}({{ $topic->replys->count() }})</a>
                        </div>

                        <!-- Reply -->
                        @include('snippets.section-replys', ['entity' => $topic])
                    </div>
                </div>
            </div>


            <!-- Comments -->
            @include('snippets.section-comments', ['entity' => $topic])
         </div>

        <div class="col-sm-4">
            <a href="{{ URL::previous() }}" class="btn btn-default btn-block hidden-xs" style="margin-bottom:10px;"><i class="fa fa-arrow-left"></i> {{ trans('app.Back') }}</a>
            @include('snippets.panel-side')
            @include('snippets.panel-categorySide4Topic')
        </div>
    </div>
</div>
@endsection
