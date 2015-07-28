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
                    <span class="badge"><i class="fa fa-comments"></i>&nbsp;&nbsp;{{ $topic->comment_count }}</span>
                </div>
                <!-- Topics body -->
                <div class="topic-text">
                    <div class="title">
                        <a href="{{ url('topic', [$topic->id]) }}">{{ $topic->title }}</a>
                    </div>
                    <div class="info">
                        <span class="nodeName">
                            <a href="{{ route('topic.index', ['category_id' => $topic->category_id]) }}">{{ $topic->category->name }}</a>
                        </span>
                        <a>{{ $topic->author->name }}</a>
                        <span class="separator">|</span>
                        @if ($topic->comment_count)
                            <a>{{ $topic->getLastCommentUser()->author->name }}</a>
                            {{ timeAgo($topic->updated_at) }}{{ trans('topic.reply') }}
                        @else
                            {{ trans('topic.No reply') }}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div>{{ trans('app.No data') }}</div>
@endif
