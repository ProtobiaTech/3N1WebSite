@extends('layouts.app')

@section('title')
    {{ trans('topic.Topic') }}: {{ $topic->title }} - @parent
@endsection

@section('content')
<!-- Topic -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default section-panel-topic">
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
                    {!! nl2br($topic->body) !!}

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

            <!--  -->
            <div class="panel panel-default section-items-reply">
                <div class="panel-heading">{{ trans('topic.replys') }}</div>
                <div class="panel-body">
                    @if (!$topic->comment_count)
                        <span>{{ trans('topic.no replys') }}</span>
                    @endif
                    @foreach ($topic->comments as $comment)
                        <div class="item-reply">
                            <div class="avatar pull-left">
                                <img src="{{ $comment->author->avatar }}">
                            </div>
                            <div class="body">
                                <div class="info">
                                    <a>{{ $comment->author->name }}</a>
                                    <span class="separator">|</span>
                                    <span>{{ $comment->created_at }}</span>
                                </div>
                                <div class="content">
                                    {!! nl2br($comment->body) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div id="anchor-reply" class="panel-heading">{{ trans('topic.My Reply') }}</div>
                <div class="panel-body">
                    @if (Auth::guest())
                        <div>
                            {{ trans('app.Please') }}<a href="{{ url('auth/login') }}">{{ trans('app.Login') }}</a>
                        </div>
                    @else
                        {!! Form::open(['url' => '/reply', 'class' => '']) !!}
                            {!! Form::hidden('topic_id', $topic->id) !!}
                            <div class="form-group {{ $errors->has('body') ? 'has-error' : ''  }}">
                                {!! Form::textarea('body', '', ['class' => 'form-control', 'rows' => '3']) !!}
                                <p class="help-block help-block-error">{{ $errors->first('body') }}</p>
                            </div>
                            <div class="from-group text-right">
                                {!! Form::submit(trans('app.Submit'), ['class' => 'btn btn-default']) !!}
                            </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
         </div>

        <div class="col-sm-4">
            <a href="{{ URL::previous() }}" class="btn btn-default btn-block" style="margin-bottom:10px;"><i class="fa fa-arrow-left"></i> {{ trans('app.Back') }}</a>
            @include('snippets.panel-side')
            @include('snippets.panel-categorySide4Topic')
        </div>
    </div>
</div>
@endsection
