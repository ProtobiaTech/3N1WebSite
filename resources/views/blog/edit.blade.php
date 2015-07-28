@extends('layouts.app')

@section('title')
    {{ trans('blog.Edit Blog') }} - @parent
@endsection

@section('content')
<!-- Blog -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('blog.Edit Blog') }}
                    <div class="pull-right shortcut">
                        <a href="">{{ trans('app.Back') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => route('blog.store'), 'class' => 'form-horizontal']) !!}
                        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('blog.Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value="{{ $blog->title }}">
                                <p class="help-block help-block-error">{{ $errors->first('title') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('category_id') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('blog.Category') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id">
                                    <option disabled selected>{{ trans('app.please select') }}</option>
                                    @foreach ($categorys as $category)
                                        <option {{ $blog->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p class="help-block help-block-error">{{ $errors->first('category_id') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('body') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('blog.Body') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="body" rows="15">{{ str_replace('<br>', "\n", $blog->body) }}</textarea>
                                <p class="help-block help-block-error">{{ $errors->first('body') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                {!! Form::submit(trans('blog.Update Blog'), ['class' => 'btn btn-default btn-block']) !!}
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
