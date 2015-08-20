@extends('layouts.admin')

@section('nav-option')
<li class="active"><a class="">{{ trans('admin.List') }}</a></li>
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
