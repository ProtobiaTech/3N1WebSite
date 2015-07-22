<!-- Category  -->
<div class="container">
    <div class="panel panel-default" id="section-items-nodeCategory">
        <div class="panel-heading">{{ trans('app.Node List') }}</div>
        <div class="panel-body">
            <!-- Node category -->
            <?php $nodeCategorys = with(new \App\Category)->getTopic4TopCategorys(); ?>
            @if ($nodeCategorys->count())
                @foreach ($nodeCategorys as $nodeCategory)
                    <div class="row item-nodeCategory">
                        <div class="col-xs-2 text-right">
                            <div class="name">
                                <a href="{{ route('topic.index', ['node' => $nodeCategory->id]) }}">{{ $nodeCategory->name }}</a>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <!-- Node -->
                            <div class="items-node">
                                <?php $nodes = $nodeCategory->childCategorys; ?>
                                @if ($nodes->count())
                                    @foreach ($nodes as $node)
                                        <a href="{{ route('topic.index', ['node' => $node->id]) }}">{{ $node->name }}</a>
                                    @endforeach
                                @else
                                    <a>{{ trans('app.Null') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>{{ trans('app.Where is null') }}</div>
            @endif
        </div>
    </div>
</div>
