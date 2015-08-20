@extends('layouts.dashboard')

@section('nav-option')
    @include('dashboard.category.snippets.sidebar')
@endsection


@section('main-body')
<p>{{ trans('app.Order') }}</p>
{!! Form::open(['url' => route('dashboard.category.order-handle'), 'class' => 'form-horizontal']) !!}
    <ul class="list-group">
        @foreach ($categorys as $category)
            <li class="list-group-item">
                <input type="text" name="{{ $category->id }}" value="{{ $category->weight }}" style="width:2em; margin-right:10px;">
                <span>{{ $category->name }}</span>
            </li>
        @endforeach
    </ul>

    <div class="form-group">
        <div class="col-sm-12">
            {!! Form::submit(trans('app.Store'), ['class' => 'btn btn-primary btn-block']) !!}
        </div>
    </div>
{!! Form::close() !!}
@endsection
