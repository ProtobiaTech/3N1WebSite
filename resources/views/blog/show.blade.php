@extends('layouts.app')

@section('title')
    {{ $blog->title }} - @parent
@endsection

@section('content')
<!-- Blog -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default section-panel-content">
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
                    {!! $blog->body !!}

                    <hr>
                    <div class="" style="margin-top:-10px">
                        <?php $myVote = Auth::guest() ? null : $blog->myVote(); ?>
                        @if ($myVote && $myVote->value == \App\ContentVote::VALUE_UP)
                            <a class="text-muted" href="{{ route('content.vote', ['content_id' => $blog->id, 'voteType' => 'vote_up_cancel', 'route' => 'blog.show']) }}">
                                <i class="fa fa-thumbs-o-up"></i>
                                {{ $blog->vote_up_count }}
                            </a>&nbsp;
                        @else
                            <a href="{{ route('content.vote', ['content_id' => $blog->id, 'voteType' => 'vote_up', 'route' => 'blog.show']) }}">
                                <i class="fa fa-thumbs-o-up"></i>
                                {{ $blog->vote_up_count }}
                            </a>&nbsp;
                        @endif
                        @if ($myVote && $myVote->value == \App\ContentVote::VALUE_DOWN)
                            <a class="text-muted" href="{{ route('content.vote', ['content_id' => $blog->id, 'voteType' => 'vote_down_cancel', 'route' => 'blog.show']) }}">
                                <i class="fa fa-thumbs-o-down"></i>
                                {{ $blog->vote_down_count }}
                            </a>&nbsp;
                        @else
                            <a href="{{ route('content.vote', ['content_id' => $blog->id, 'voteType' => 'vote_down', 'route' => 'blog.show']) }}">
                                <i class="fa fa-thumbs-o-down"></i>
                                {{ $blog->vote_down_count }}
                            </a>&nbsp;
                        @endif
                        &nbsp;<i class="fa fa-bookmark hidden"></i>

                        <div class="pull-right">
                            <a href="#panel-comments" onclick="$('#panel-comments textarea').focus()"><i class="fa fa-comments"></i> {{ trans('app.Comment') }}</a>
                            &nbsp;&nbsp;
                            <a class="cursor-pointer" onclick="$('#section-content-replys').fadeToggle()">{{ trans('app.Reply') }}({{ $blog->replys->count() }})</a>
                        </div>

                        <!-- Reply -->
                        @include('snippets.section-replys', ['entity' => $blog])
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
