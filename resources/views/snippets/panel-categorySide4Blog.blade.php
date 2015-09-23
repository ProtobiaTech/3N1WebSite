<div class="panel panel-default">
    <div class="panel-heading">{{ trans('app.Category') }}</div>
    <div class="panel-body">
        <a href="{{ route('blog.index') }}" class="label {{ request()->has('category_id') ? 'label-default' : 'label-primary' }}" style="font-size:13px;">{{ trans('app.All') }}</a>
        <?php
        $categorys = (new \App\Category)->getBlog4TopCategorys();
        ?>
        @foreach ($categorys as $category)
            <?php
            $label = 'label-default';
            if (request()->get('category_id') == $category->id) {
                $label = 'label-primary';
            }
            ?>
            <a href="{{ route('blog.index', ['category_id' => $category->id]) }}" class="label {{ $label }}" style="font-size:13px;">{{ $category->name }}</a>
        @endforeach
    </div>
</div>
