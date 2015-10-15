@extends('layouts.app')

@section('title')
    {{ trans('article.Create Article') }} - @parent
@endsection

@section('content')
<!-- article -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.Create Outside Article') }}
                    <div class="pull-right shortcut">
                        <a href="{{ route('article.index') }}">{{ trans('app.Back') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => route('article.store-target'), 'class' => 'form-horizontal']) !!}
                        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('article.Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                <p class="help-block help-block-error">{{ $errors->first('title') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('category_id') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('article.Category') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id">
                                    <option disabled selected>{{ trans('app.please select') }}</option>
                                    @foreach ($categorys as $category)
                                        <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p class="help-block help-block-error">{{ $errors->first('category_id') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('target_type') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('article.Target type') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="target_type">
                                    @foreach ($targetType as $name => $value)
                                        <option {{ old('target_type') == $value ? 'selected' : '' }} value="{{ $value }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <p class="help-block help-block-error">{{ $errors->first('target_type') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('href') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('article.Href') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="href" value="{{ old('href') }}">
                                <p class="help-block help-block-error">{{ $errors->first('href') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                {!! Form::submit(trans('article.Create Article'), ['class' => 'btn btn-default btn-block']) !!}
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

<!-- simditor -->
@include('snippets.ext-simditor')

@endsection
