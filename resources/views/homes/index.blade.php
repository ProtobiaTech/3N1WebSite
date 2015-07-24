@extends('layouts.app')

@section('content')
<!-- Excellent Topic -->
<div class="container">
    <div class="panel panel-default" id="section-items-topic">
        <div class="panel-heading">
            {{ trans('topic.Excellent Topics') }}
            <div class="pull-right shortcut">
                <a href="{{ route('topic.index') }}">{{ trans('topic.More') }}</a>
            </div>
        </div>
        <div class="panel-body">
            @include('snippets.items-topic', ['topics' => $topics, 'colType' => 'col-sm-6'])
        </div>
    </div>
</div>


<!-- Category  -->
@include('snippets.panel-category')


@endsection
