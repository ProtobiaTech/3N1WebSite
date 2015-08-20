<div class="dropdown">
    <button id="dropdown-create" class="btn btn-default" type="button" data-toggle="dropdown">
        {{ trans('category.Create category') }}
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdown-create">
        <li><a href="{{ route('dashboard.category.create', ['typeId' => \App\Category::TYPE_TOPIC]) }}">{{ trans('category.Create topic category') }}</a></li>
        <li><a href="{{ route('dashboard.category.create', ['typeId' => \App\Category::TYPE_BLOG]) }}">{{ trans('category.Create blog category') }}</a></li>
        <li><a href="{{ route('dashboard.category.create', ['typeId' => \App\Category::TYPE_ARTICLE]) }}">{{ trans('category.Create article category') }}</a></li>
    </ul>
</div>
<br>
<li class="{{ Input::get('typeId') == \App\Category::TYPE_TOPIC ? 'active' : '' }}"><a href="{{ route('dashboard.category.index', ['typeId' => \App\Category::TYPE_TOPIC]) }}">{{ trans('category.Topic category') }}</a></li>
<li class="{{ Input::get('typeId') == \App\Category::TYPE_BLOG ? 'active' : '' }}"><a href="{{ route('dashboard.category.index', ['typeId' => \App\Category::TYPE_BLOG]) }}">{{ trans('category.Blog category') }}</a></li>
<li class="{{ Input::get('typeId') == \App\Category::TYPE_ARTICLE ? 'active' : '' }}"><a href="{{ route('dashboard.category.index', ['typeId' => \App\Category::TYPE_ARTICLE]) }}">{{ trans('category.Article category') }}</a></li>
