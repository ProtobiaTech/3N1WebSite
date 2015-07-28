@extends('layouts.app')

@section('title')
    {{ trans('topic.Create Topic') }} - @parent
@endsection

@section('content')
<!-- Topic -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.Create Topic') }}
                    <div class="pull-right shortcut">
                        <a href="{{ route('topic.index') }}">{{ trans('app.Back') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/topic', 'class' => 'form-horizontal']) !!}
                        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('topic.Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                <p class="help-block help-block-error">{{ $errors->first('title') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('node_id') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('topic.Node') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="node_id">
                                    <option disabled selected>{{ trans('app.please select') }}</option>
                                    @foreach ($nodeCategorys as $nodeCategory)
                                        <optgroup label="{{ $nodeCategory->name }}">
                                            @if ($nodeCategory->childCategorys->count())
                                                @foreach ($nodeCategory->childCategorys as $node)
                                                    <option {{ old('node_id') == $node->id ? 'selected' : '' }} value="{{ $node->id }}">{{ $node->name }}</option>
                                                @endforeach
                                            @else
                                                <option disabled>{{ trans('topic.Non Nodes') }}</option>
                                            @endif
                                        </optgroup>
                                    @endforeach
                                </select>
                                <p class="help-block help-block-error">{{ $errors->first('node_id') }}</p>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('body') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label text-right">{{ trans('topic.Body') }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="body" rows="15">{{ old('body') }}</textarea>
                                <p class="help-block help-block-error">{{ $errors->first('body') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                {!! Form::submit(trans('topic.Create Topic'), ['class' => 'btn btn-default btn-block']) !!}
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


<!-- Category  -->
@include('snippets.panel-category')

@endsection
