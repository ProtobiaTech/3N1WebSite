@extends('install.layout')

@section('content')
<div class="container">
    <div class="text-center" style="margin-bottom:30px">
        <h1><i class="fa fa-cubes"></i> 安装3N1WebSite</h1>
        <span class="text-muted">系统配置</span>
    </div>


    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            {!! Form::open(['url' => url('install/setup'), 'class' => 'form-horizontal', 'method' => 'post']) !!}
                <div class="form-group {{ $errors->first('db_host') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('install.Database host') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="db_host" class="form-control" value="{{ old('db_host') ? old('db_host') : 'localhost' }}">
                        <span class="help-block help-block-error {{ $errors->first('db_host') ? '' : 'hidden' }}">{{ $errors->first('db_host') }}</span>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('db_name') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('install.Database name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="db_name" class="form-control" value="{{ old('db_name') ? old('db_name') : '3n1website' }}">
                        <span class="help-block help-block-error {{ $errors->first('db_name') ? '' : 'hidden' }}">{{ $errors->first('db_name') }}</span>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('db_user') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('install.Database user') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="db_user" class="form-control" value="{{ old('db_user') ? old('db_user') : 'root' }}">
                        <span class="help-block help-block-error {{ $errors->first('db_user') ? '' : 'hidden' }}">{{ $errors->first('db_user') }}</span>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('db_password') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('install.Database password') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="db_password" class="form-control" value="{{ old('db_password') }}">
                        <span class="help-block help-block-error {{ $errors->first('db_password') ? '' : 'hidden' }}">{{ $errors->first('db_password') }}</span>
                    </div>
                </div>

                <div class="text-right text-danger">{{ $errors->first('db_connect') ? $errors->first('db_connect') : '' }}</div>

                <hr>

                <div class="form-group {{ $errors->first('site_name') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('system.Site name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="site_name" class="form-control" value="{{ old('site_name') ? old('site_name') : 'New 3N1WebSite' }}">
                        <span class="help-block help-block-error {{ $errors->first('site_name') ? '' : 'hidden' }}">{{ $errors->first('site_name') }}</span>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('site_slogan') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('system.Site slogan') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="site_slogan" class="form-control" value="{{ old('site_slogan') ? old('site_slogan') : 'Use Blog/BBS/CMS to build your website' }}">
                        <span class="help-block help-block-error {{ $errors->first('site_slogan') ? '' : 'hidden' }}">{{ $errors->first('site_slogan') }}</span>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('contact_email') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('system.Contact email') }}</label>
                    <div class="col-sm-9">
                        <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email') }}">
                        <span class="help-block help-block-error {{ $errors->first('contact_email') ? '' : 'hidden' }}">{{ $errors->first('contact_email') }}</span>
                    </div>
                </div>

                <hr>

                <div class="form-group {{ $errors->first('admin_name') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('system.Admin name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="admin_name" class="form-control" value="{{ old('admin_name') ? old('admin_name') : 'admin' }}">
                        <span class="help-block help-block-error {{ $errors->first('admin_name') ? '' : 'hidden' }}">{{ $errors->first('admin_name') }}</span>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('admin_email') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('system.Admin email') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="admin_email" class="form-control" value="{{ old('admin_email') ? old('admin_email') : 'admin@3n1website.local' }}">
                        <span class="help-block help-block-error {{ $errors->first('admin_email') ? '' : 'hidden' }}">{{ $errors->first('admin_email') }}</span>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('admin_password') ? 'has-error' : '' }}">
                    <label class="col-sm-3 control-label">{{ trans('system.Admin password') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="admin_password" class="form-control" value="{{ old('admin_password') ? old('admin_password') : '3n1website' }}">
                        <span class="help-block help-block-error {{ $errors->first('admin_password') ? '' : 'hidden' }}">{{ $errors->first('admin_password') }}</span>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <input class="btn btn-primary btn-block" type="submit" value="{{ trans('app.Submit') }}">
                        <a href="{{ url('install/check') }}" class="btn btn-default btn-block">{{ trans('app.Prev step') }}</a>
                    </div>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
