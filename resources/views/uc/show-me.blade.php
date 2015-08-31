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
                                        {{ trans('user.All') }} <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="active"><a>{{ trans('user.All') }}</a></li>
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
                                    <div class="item-notice">
                                        <a>{{ $notice->offerUser->name }}</a>
                                        在
                                        <a>{{ $notice->notice->title }}</a>
                                        回复了你
                                    </div>
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
