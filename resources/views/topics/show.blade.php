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


            <!-- Comments -->
            @include('snippets.section-comments', ['entity' => $topic])
         </div>

        <div class="col-sm-4">
            <a href="{{ URL::previous() }}" class="btn btn-default btn-block" style="margin-bottom:10px;"><i class="fa fa-arrow-left"></i> {{ trans('app.Back') }}</a>
            @include('snippets.panel-side')
            @include('snippets.panel-categorySide4Topic')
        </div>
    </div>
</div>
@endsection
