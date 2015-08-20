@extends('layouts.admin')

@section('nav-option')
    @include('admin.system.snippets-sidebar')
@endsection



@section('main-body')
<div class="panel panel-default">
    <div class="panel-body">
        <p>{{ $system->site_name }}</p>
        <div class="">
            {{ trans('system.Website run') }}
            {{ dayAgo($system->created_at) }}
            {{ trans('app.Day') }}

        </div>
    </div>
</div>
@endsection
