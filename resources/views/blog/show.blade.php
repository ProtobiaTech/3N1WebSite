@extends('layouts.app')

@section('title')
    {{ $blog->title }} - @parent
@endsection

@section('content')
<!-- Blog -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>{{ $blog->title }}</span>
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <div class="btn-group pull-right">
                        <a href="{{ route('blog.edit', ['id' => $blog->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:if (confirm('{{ trans('app.Are you sure?') }}')) { $('#form-blog-destroy').submit(); }" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
                    </div>
                    {!! Form::open(['url' => route('blog.destroy', ['id' => $blog->id]), 'id' => 'form-blog-destroy', 'class' => 'hidden', 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                    @endif
                </div>
                <div class="panel-body">
                    {!! nl2br($blog->body) !!}

                    <hr>
                    <div class="" style="margin-top:-10px">
                        <a><i class="fa fa-thumbs-o-up"></i></a>&nbsp;
                        <a><i class="fa fa-thumbs-o-down"></i></a>&nbsp;
                        <a><i class="fa fa-bookmark"></i></a>

                        <div class="pull-right">
                            <a href="#anchor-reply"><i class="fa fa-reply"></i> {{ trans('topic.Reply') }}</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Comments -->
            @include('snippets.section-comments', ['entity' => $blog])
        </div>
        <div class="col-sm-4">
            <a href="{{ URL::previous() }}" class="btn btn-default btn-block hidden-xs" style="margin-bottom:10px;"><i class="fa fa-arrow-left"></i> {{ trans('app.Back') }}</a>
            @include('snippets.panel-side')
            @include('snippets.panel-categorySide4Blog')
        </div>
    </div>
</div>
@endsection
