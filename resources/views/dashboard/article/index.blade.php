@extends('layouts.dashboard')

@section('nav-option')
<li class="active"><a class="">{{ trans('app.List') }}</a></li>
@endsection



@section('main-body')
<ul class="list-group">
    @foreach ($articles as $article)
        <li class="list-group-item">
            <a href="{{ url('/article', ['id' => $article->id]) }}">{{ $article->title }}</a>
        </li>
    @endforeach
</ul>

{!! $articles->render() !!}
@endsection
