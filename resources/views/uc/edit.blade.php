@extends('layouts.app')

@section('content')
<div id="cy-me" class="page-index">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('uc/snippet-myProfile')
            </div>

            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-body">

                        {!! Form::open(['url' => route('uc.update', $user->id), 'class' => 'form-horizontal', 'method' => 'put']) !!}
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">{{ trans('user.Name') }}</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control" name="name" value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                                <label class="col-sm-2 control-label text-right">{{ trans('user.Email') }}</label>
                                <div class="col-sm-9">
                                    <input disabled type="email" class="form-control" name="email" value="{{ $user->email }}">
                                    <p class="help-block help-block-error">{{ $errors->first('email') }}</p>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                                <label class="col-sm-2 control-label text-right">{{ trans('user.Phone') }}</label>
                                <div class="col-sm-9">
                                    <input disabled type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                                    <p class="help-block help-block-error">{{ $errors->first('phone') }}</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    {!! Form::submit(trans('app.Update'), ['class' => 'btn btn-default btn-block', 'disabled']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
