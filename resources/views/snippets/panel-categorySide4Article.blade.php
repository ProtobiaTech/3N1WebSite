<div class="panel panel-default">
    <div class="panel-heading">{{ trans('app.Category') }}</div>
    <div class="panel-body">
        <?php
        $categorys = (new \App\Category)->getArticle4TopCategorys();
        ?>
        @foreach ($categorys as $category)
            <a href="{{ route('article.index', ['category_id' => $category->id]) }}" class="label label-default" style="font-size:13px;">{{ $category->name }}</a>
        @endforeach
    </div>
</div>
