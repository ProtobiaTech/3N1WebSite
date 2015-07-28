@extends('layouts.app')

@section('title')
    {{ trans('blog.Blog') }} - @parent
@endsection

@section('content')
<!-- Blog -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            @if (!$blogs->count())
            <div>{{ trans('app.No data') }}</div>
            @endif
            @foreach ($blogs as $key => $blog)
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="caption"><a href="{{ url('/blog', ['id' => $blog->id]) }}" style="font-size:18px;">{{ $blog->title }}</a></p>
                    <p>{!! mb_strcut($blog->body, 0, 400, 'utf-8') !!}</p>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <?php echo $blogs->render(); ?>
        </div>
        <div class="col-sm-4">
            @include('snippets.panel-side')
            @include('snippets.panel-categorySide4Blog')
        </div>
    </div>
</div>
@endsection
