@extends('layouts.admin')

@section('nav-option')
<li class="active"><a class="">{{ trans('admin.List') }}</a></li>
@endsection



@section('main-body')
<ul class="list-group">
    @foreach ($blogs as $blog)
        <li class="list-group-item">
            <span class="pull-right">
                {!! Form::open(['url' => route('admin.blog.destroy', ['id' => $blog->id]), 'method' => 'delete']) !!}
                    {!! Form::submit(trans('admin.delete'), ['class' => 'btn btn-xs btn-danger']) !!}
                {!! Form::close() !!}
            </span>
            <a href="{{ url('/blog', ['id' => $blog->id]) }}">{{ $blog->title }}</a>
        </li>
    @endforeach
</ul>

{!! $blogs->render() !!}
@endsection
