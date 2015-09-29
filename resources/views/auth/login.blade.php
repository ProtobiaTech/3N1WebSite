@extends('layouts.app')

@section('title')
    {{ trans('user.Login') }} - @parent
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('user.Login') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" autocomplete="on" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('user.E-Mail') }}</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                <p class="help-block help-block-error {{ $errors->has('email') ? '' : 'hidden' }}">{{ $errors->first('email') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('user.Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                                <p class="help-block help-block-error {{ $errors->has('password') ? '' : 'hidden' }}">{{ $errors->first('password') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" checked> {{ trans('user.Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">{{ trans('user.Login') }}</button>

                                <a class="btn btn-link" href="{{ url('/password/email') }}">{{ trans('user.Forgot Your Password?') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
