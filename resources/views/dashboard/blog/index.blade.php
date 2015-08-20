@extends('layouts.dashboard')

@section('nav-option')
<li class="active"><a class="">{{ trans('app.List') }}</a></li>
@endsection



@section('main-body')
<ul class="list-group">
    @foreach ($blogs as $blog)
        <li class="list-group-item">
            <a href="{{ url('/blog', ['id' => $blog->id]) }}">{{ $blog->title }}</a>
        </li>
    @endforeach
</ul>

{!! $blogs->render() !!}
@endsection
