@extends('layouts.dashboard')

@section('nav-option')
    @include('dashboard.category.snippets.sidebar')
@endsection


@section('main-body')
<ul class="list-group">
    @foreach ($categorys as $category)
        <li class="list-group-item">
            <div class="btn-group pull-right">
                <a href="javascript:if (confirm('{{ trans('app.Are you sure?') }}')) { $('#form-category-destroy-{{ $category->id }}').submit(); }" class="btn btn-danger btn-xs">{{ trans('app.Delete') }}</a>
            </div>
            {!! Form::open(['url' => route('dashboard.category.destroy', ['id' => $category->id]), 'id' => ('form-category-destroy-' . $category->id), 'class' => 'hidden', 'method' => 'delete']) !!}
                {!! Form::submit(trans('app.Delete'), ['class' => 'btn btn-xs btn-danger']) !!}
            {!! Form::close() !!}

            <div class="pull-right" style="margin-right:5px;">
                <a href="{{ route('dashboard.category.edit', ['id' => $category->id, 'typeId' => $category->type_id]) }}" class="btn btn-default btn-xs">{{ trans('app.Edit') }}</a>
            </div>

            <div class="pull-right" style="margin-right:5px;">
                <a href="{{ route('dashboard.category.order', ['id' => $category->id, 'typeId' => $category->type_id]) }}" class="btn btn-default btn-xs">{{ trans('app.Order') }}</a>
            </div>

            <span style="display:inline-block; width:2em;"><i class="fa fa-bookmark"></i></span>
            <span>{{ $category->name }}</span>
        </li>
        <?php $childCategorys = $category->childCategorys; ?>
        @foreach ($childCategorys as $childCategory)
            <li class="list-group-item">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="btn-group pull-right">
                    <a href="javascript:if (confirm('{{ trans('app.Are you sure?') }}')) { $('#form-category-destroy-{{ $childCategory->id }}').submit(); }" class="btn btn-danger btn-xs">{{ trans('app.Delete') }}</a>
                </div>
                {!! Form::open(['url' => route('dashboard.category.destroy', ['id' => $childCategory->id]), 'id' => ('form-category-destroy-' . $childCategory->id), 'class' => 'hidden', 'method' => 'delete']) !!}
                    {!! Form::submit(trans('app.Delete'), ['class' => 'btn btn-xs btn-danger']) !!}
                {!! Form::close() !!}

                <div class="pull-right" style="margin-right:5px;">
                    <a href="{{ route('dashboard.category.edit', ['id' => $childCategory->id, 'typeId' => $childCategory->type_id]) }}" class="btn btn-default btn-xs">{{ trans('app.Edit') }}</a>
                </div>

                <div class="pull-right" style="margin-right:5px;">
                    <a href="{{ route('dashboard.category.order', ['id' => $childCategory->id, 'typeId' => $childCategory->type_id]) }}" class="btn btn-default btn-xs">{{ trans('app.Order') }}</a>
                </div>

                <span style="display:inline-block; width:2em;"><i class="fa fa-bookmark-o"></i></span>
                <span>{{ $childCategory->name }}</span>
            </li>
        @endforeach
    @endforeach
</ul>
@endsection
