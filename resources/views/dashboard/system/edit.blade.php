@extends('layouts.dashboard')

@section('nav-option')
    @include('dashboard.system.snippets.sidebar')
@endsection



@section('main-body')
<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(['url' => route('dashboard.system.update', 1), 'class' => 'form-horizontal', 'method' => 'put']) !!}
            <!-- Site name -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('system.Site name') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="site_name" value="{{ $system->site_name }}">
                </div>
            </div>

            <!-- Site slogan -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('system.Site slogan') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="site_slogan" value="{{ $system->site_slogan }}">
                </div>
            </div>

            <!-- Site keywords -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('system.Site keywords') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="site_keywords" value="{{ $system->site_keywords }}">
                </div>
            </div>

            <!-- Site description -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('system.Site description') }}</label>
                <div class="col-sm-9">
                    <textarea name="site_description" class="form-control">{{ $system->site_description }}</textarea>
                </div>
            </div>

            <!-- Site analytic -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('system.Site analytic') }}</label>
                <div class="col-sm-9">
                    <textarea name="site_analytic" class="form-control">{{ $system->site_analytic }}</textarea>
                </div>
            </div>

            <!-- Contact Email -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('system.Contact email') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="contact_email" value="{{ $system->contact_email }}">
                </div>
            </div>

            <!-- Site IPC -->
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('system.Site IPC') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="site_ipc" value="{{ $system->site_ipc }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    {!! Form::submit(trans('app.Update'), ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
