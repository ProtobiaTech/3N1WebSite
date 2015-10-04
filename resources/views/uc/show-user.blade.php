@extends('layouts.app')

@section('content')
<div id="cy-me" class="page-index">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('uc/snippet-userProfile', $user)
            </div>

            <div class="col-sm-9">
                <div class="panel panel-default panel-notice">
                    <div class="panel-body">
                        <div class="header">
                            <div class="pull-right">
                                <div class="dropdown">
                                    <button class="btn btn-default btn-sm" data-toggle="dropdown">
                                        {{ trans('user.All') }} <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="active"><a>{{ trans('user.All') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <span class="caption">
                                <i class="fa fa-rss"></i> {{ trans('user.Activity') }}
                            </span>
                        </div>

                        <div class="body items-notice" style="">
                            <div class="item-notice">{{ trans('app.No data') }}</div>
                        </div>
                    </div>
                </div>

                <!-- -->
                @include('uc.snippet-releases')
            </div>

        </div>
    </div>

</div>
@endsection
