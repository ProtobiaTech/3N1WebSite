@extends('layouts.app')

@section('title')
    {{ trans('user.Register') }} - @parent
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('user.Register') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('user.E-Mail') }}</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                <p class="help-block help-block-error {{ $errors->has('email') ? '' : 'hidden' }}">{{ $errors->first('email') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('user.Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                <p class="help-block help-block-error {{ $errors->has('name') ? '' : 'hidden' }}">{{ $errors->first('name') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('user.Phone') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="phone" class="form-control" name="phone" value="{{ old('phone') }}">
                                    <span class="input-group-btn">
                                        <button type="button" id="btn-requestSmsCode" class="btn btn-default" onclick="requestSmsCode()">{{ trans('user.Seed the verification code') }}</button>
                                    </span>
                                </div>
                                <p class="help-block help-block-error {{ $errors->has('phone') ? '' : 'hidden' }}">{{ $errors->first('phone') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('verifyCode') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('user.Verification code') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="verifyCode" value="{{ old('verifyCode') }}">
                                <p class="help-block help-block-error {{ $errors->has('verifyCode') ? '' : 'hidden' }}">{{ $errors->first('verifyCode') }}</p>
                            </div>
                        </div>
                        <script>
                        /**
                         * request sms code function
                         */
                        function requestSmsCode() {
                            var phoneNumber = $('input[name=phone]').val();
                            if (phoneNumber.length != 11) {
                                alert("{{ trans('user.Please enter the 11-digit phone number') }}");
                                return false;
                            } else {
                                // request
                                $.get('{{ url("/auth/get-register-phone-code") }}', {phoneNumber: phoneNumber}, function(ret) {
                                    alert("{{ trans('user.verification code sent successfully') }}");
                                    requestSmsCodeSuccess();
                                }).fail(function(ret) {
                                    alert("{{ trans('user.verification code sent failed') }}");
                                });
                            }
                        }

                        /**
                         * request sms code success function
                         */
                        function requestSmsCodeSuccess() {
                            $('#btn-requestSmsCode').attr('disabled', true);
                            var countDownNum = 70;
                            var timer = setInterval(function() {
                                countDownNum--;
                                if (countDownNum == 0) {
                                    clearInterval(timer)
                                    $('#btn-requestSmsCode').attr('disabled', false);
                                    $('#btn-requestSmsCode').text("{{ trans('user.Seed Verify Code') }}");
                                } else {
                                    $('#btn-requestSmsCode').text(countDownNum);
                                }
                            }, 1000)
                        }
                        </script>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('user.Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                                <p class="help-block help-block-error {{ $errors->has('password') ? '' : 'hidden' }}">{{ $errors->first('password') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('user.Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
