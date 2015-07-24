@extends('layouts.app')

@section('title')
    {{ trans('blog.Blog') }} - @parent
@endsection

@section('content')
<!-- Blog -->
<div class="container">
    <div class="row">
        <div class="col-sm-8">
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('blog.Blog') }}
                </div>
                <div class="panel-body">
                    <img style="width:100%; height:162px; background-color:#eee;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
