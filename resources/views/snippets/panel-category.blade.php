<!-- Category  -->
<div class="container">
    <div class="panel panel-default" id="section-items-nodeCategory">
        <div class="panel-heading">{{ trans('topic.Node List') }}</div>
        <div class="panel-body">
            <!-- Node category -->
            <?php $nodeCategorys = with(new \App\Category)->getTopic4TopCategorys(); ?>
            @if ($nodeCategorys->count())
                @foreach ($nodeCategorys as $nodeCategory)
                    <div class="row item-nodeCategory">
                        <div class="col-xs-2 text-right">
                            <div class="name">
                                <a href="{{ route('topic.index', ['category_id' => $nodeCategory->id]) }}">{{ $nodeCategory->name }}</a>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <!-- Node -->
                            <div class="items-node">
                                <?php $nodes = $nodeCategory->childCategorys; ?>
                                @if ($nodes->count())
                                    @foreach ($nodes as $node)
                                        <a href="{{ route('topic.index', ['category_id' => $node->id]) }}">{{ $node->name }}</a>
                                    @endforeach
                                @else
                                    <a>{{ trans('app.Null') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>{{ trans('app.No data') }}</div>
            @endif
        </div>
    </div>
</div>
