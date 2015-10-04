@extends('layouts.dashboard')

@section('nav-option')
    @include('dashboard.system.snippets.sidebar')
@endsection



@section('main-body')
<div class="panel panel-default">
    <div class="panel-body">
        <p style="font-size:20px">
            {{ $system->site_name }}
            <small class="text-muted">
                {{ trans('system.Website run') }}
                {{ dayAgo($system->created_at) }}
                {{ trans('app.Day') }}
            </small>
        </p>

        <div>
            {{ trans('system.System version') }}: {{ trans('app.Disabled') }} &nbsp;&nbsp;
            <a>{{ trans('app.Update') }}</a>
            <br>

            {{ trans('system.Theme') }}: {{ trans('app.Disabled') }} &nbsp;&nbsp;
            <a>{{ trans('system.Theme change') }}</a>
            <br>
        </div>


        <hr>
        <div>
            <p style="font-size:20px">
                {{ trans('system.Fault-Hazard-Proposal') }}
            </p>
            {{ trans('app.Disabled') }}

        </div>
    </div>
</div>
@endsection
