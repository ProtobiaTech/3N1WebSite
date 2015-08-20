@extends('layouts.dashboard')

@section('nav-option')
<li class="active"><a class="">{{ trans('app.List') }}</a></li>
@endsection



@section('main-body')
<ul class="list-group">
    @foreach ($topics as $topic)
        <li class="list-group-item">
            <a href="{{ url('/topic', ['id' => $topic->id]) }}">{{ $topic->title }}</a>
        </li>
    @endforeach
</ul>

{!! $topics->render() !!}
@endsection
