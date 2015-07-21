@extends('layouts.app')

@section('content')
<!-- Topic -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default section-panel-topic">
                <div class="panel-heading topic-header">
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
                        <span>{{ i18n('app.PublishedDay', ['day' => 11]) }}</span>
                        <span class="separator">|</span>
                        <span>11 {{ i18n('app.Reply') }}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    {{ $topic->body }}

                    <hr>
                    <div class="" style="margin-top:-10px">
                        <span>{{ i18n('app.Share') }}</span> &nbsp;
                        <a><i class="fa fa-twitter"></i></a>
                        <a><i class="fa fa-facebook"></i></a>
                        <a><i class="fa fa-weibo"></i></a>

                        <div class="pull-right">
                            <a href="#anchor-reply"><i class="fa fa-reply"></i> {{ i18n('app.Reply') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->
            <div class="panel panel-default section-items-reply">
                <div class="panel-heading">{{ i18n('app.replys') }}</div>
                <div class="panel-body">
                    @if (!$topic->comments->count())
                        <span>{{ i18n('app.no replys') }}</span>
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
                                    <span>{{ date('Y-m-d', $comment->create_at) }}</span>
                                </div>
                                <div class="content">
                                    {{ $comment->body }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div id="anchor-reply" class="panel-heading">{{ i18n('app.My Reply') }}</div>
                <div class="panel-body">
                    @if (Auth::guest())
                        <div>
                            {{ i18n('app.Placse') }}
                            <a href="{{ url('auth/login') }}">{{ i18n('app.Login') }}</a>
                        </div>
                    @else
                        {!! Form::open(['url' => '/reply', 'class' => '']) !!}
                            {!! Form::hidden('topic_id', $topic->id) !!}
                            <div class="form-group {{ $errors->has('body') ? 'has-error' : ''  }}">
                                {!! Form::textarea('body', '', ['class' => 'form-control', 'rows' => '3']) !!}
                                <p class="help-block help-block-error">{{ $errors->first('body') }}</p>
                            </div>
                            <div class="from-group text-right">
                                {!! Form::submit(i18n('app.Submit'), ['class' => 'btn btn-default']) !!}
                            </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
         </div>

        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">Community</div>
                <div class="panel-body">
                    hello dev4living/Community
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Category  -->
@include('snippets.panel-category')

@endsection
