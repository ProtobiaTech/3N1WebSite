@extends('layouts.app')

@section('title')
    {{ trans('article.Edit Article') }} - @parent
@endsection

@section('content')
<!-- Article -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('article.Edit Article') }}
                    <div class="pull-right shortcut">
                        <a href="{{ route('article.show', ['id' => $article->id]) }}">{{ trans('app.Back') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => route('article.store'), 'class' => 'form-horizontal']) !!}
                        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('article.Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value="{{ $article->title }}">
                                <p class="help-block help-block-error">{{ $errors->first('title') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('category_id') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('article.Category') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id">
                                    <option disabled selected>{{ trans('app.please select') }}</option>
                                    @foreach ($categorys as $category)
                                        <option {{ $article->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p class="help-block help-block-error">{{ $errors->first('category_id') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('body') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('article.Body') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="body" rows="15">{{ str_replace('<br>', "\n", $article->body) }}</textarea>
                                <p class="help-block help-block-error">{{ $errors->first('body') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                {!! Form::submit(trans('article.Update Article'), ['class' => 'btn btn-default btn-block']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
         </div>

        <div class="col-sm-4">
            @include('snippets.panel-side')
        </div>
    </div>
</div>


@endsection
