@if ($topics->count())
    <div class="row items-topic">
        @foreach ($topics as $topic)
            <div class="{{ $colType }} item-topic">
                <!-- Avatar -->
                <div class="avatar pull-left">
                    <a> <img src="{{ $topic->author->avatar }}"> </a>
                </div>
                <!-- Reply count -->
                <div class="badge-number pull-right">
                    <span class="badge">{{ $topic->reply_count }}</span>
                </div>
                <!-- Topics body -->
                <div class="topic-text">
                    <div class="title">
                        <a href="{{ url('topic', [$topic->id]) }}">{{ $topic->title }}</a>
                    </div>
                    <div class="info">
                        <span class="nodeName">
                            <a href="{{ route('topic.index', ['node' => $topic->node_id]) }}">{{ $topic->category->name }}</a>
                        </span>
                        <a>{{ $topic->author->name }}</a>
                        <span class="separator">|</span>
                        <a>{{ $topic->lastCommentUser->name }}</a> {{ trans('app.reply') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div>{{ trans('app.Where is null') }}</div>
@endif
