<?php
use App\Notice;
?>
@extends('layouts.app')

@section('content')
<div id="cy-me" class="page-index">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="panel panel-default panel-notice">
                    <div class="panel-body">
                        <div class="header">
                            <div class="pull-right">
                                <div class="dropdown">
                                    <button class="btn btn-default btn-sm" data-toggle="dropdown">
                                        {{ trans('user.' . $noticeType) }} <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="{{ Input::get('notice') === 'uncheck' ? 'active' : '' }}">
                                            <a href="{{ route('uc.show', ['id' => $user->id, 'notice' => 'uncheck']) }}">{{ trans('user.uncheck') }}</a>
                                        </li>
                                        <li class="{{ Input::get('notice') === 'checked' ? 'active' : '' }}">
                                            <a href="{{ route('uc.show', ['id' => $user->id, 'notice' => 'checked']) }}">{{ trans('user.checked') }}</a>
                                        </li>
                                        <li class="{{ !Input::has('notice') || Input::get('notice') === 'all' ? 'active' : '' }}">
                                            <a href="{{ route('uc.show', ['id' => $user->id, 'notice' => 'all']) }}">{{ trans('user.All') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <span class="caption">
                                <i class="fa fa-bell"></i> {{ trans('user.Notice') }}
                            </span>
                        </div>

                        <div class="body items-notice" style="height:300px">
                            @if ($notices->count())
                                @foreach ($notices as $notice)
                                    @if ($notice->type_id === Notice::TYPE_COMMENT_TOPIC)
                                        @include('uc.notice.snippet-notice-topic')
                                    @elseif ($notice->type_id === Notice::TYPE_COMMENT_BLOG)
                                        @include('uc.notice.snippet-notice-blog')
                                    @elseif ($notice->type_id === Notice::TYPE_COMMENT_ARTICLE)
                                        @include('uc.notice.snippet-notice-article')
                                    @endif
                                @endforeach
                            @else
                                <div class="item-notice">{{ trans('app.No data') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                @include('uc/snippet-myProfile')
            </div>

        </div>
    </div>

</div>
@endsection
