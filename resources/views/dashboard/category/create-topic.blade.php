@extends('layouts.dashboard')

@section('nav-option')
    @include('dashboard.category.snippets.sidebar')
@endsection


@section('main-body')
<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(['url' => route('dashboard.category.store'), 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('category.Name') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('category.Type') }}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="type_id">
                        @foreach ($types as $type)
                            <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('category.Parent category') }}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="parent_id">
                        <option selected value="0">{{ trans('category.Root category') }}</option>
                        @foreach ($categorys as $category)
                            <option {{ old('parent_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right">{{ trans('category.Description') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    {!! Form::submit(trans('app.Store'), ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
