<div class="panel panel-default panel-notice">
    <div class="panel-body">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab-topic" aria-controls="tab-topic" role="tab" data-toggle="tab">{{ trans('app.Topic') }}</a></li>
                <li role="presentation"><a href="#tab-comment" aria-controls="tab-comment" role="tab" data-toggle="tab">{{ trans('app.Comment') }}</a></li>
                <li role="presentation"><a href="#tab-reply" aria-controls="tab-reply" role="tab" data-toggle="tab">{{ trans('app.Reply') }}</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- tab body -->
                <div role="tabpanel" class="tab-pane active" id="tab-topic">
                    <ul class="list-unstyled" style="padding-top:5px">
                        @if (!$user->topics->count())
                            <li>{{ trans('app.Null') }}</li>
                        @endif
                        @foreach ($user->topics->sortByDesc('created_at') as $topic)
                            <li>{{ $topic->updated_at->format('Y-m-d') }} &nbsp;&nbsp; <a href="{{ route('topic.show', $topic->id) }}" target="_blank">{{ $topic->title }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- tab body -->
                <div role="tabpanel" class="tab-pane" id="tab-comment">
                    <ul class="list-unstyled" style="padding-top:5px">
                        @if (!$user->comments->count())
                            <li>{{ trans('app.Null') }}</li>
                        @endif
                        @foreach ($user->comments->sortByDesc('created_at') as $comment)
                            <li>{{ $topic->updated_at->format('Y-m-d') }} &nbsp;&nbsp; <a href="{{ route('comment.show', $comment->id) }}" target="_blank">{{ $comment->body }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- tab body -->
                <div role="tabpanel" class="tab-pane" id="tab-reply">
                    <ul class="list-unstyled" style="padding-top:5px">
                        @if (!$user->replies->count())
                            <li>{{ trans('app.Null') }}</li>
                        @endif
                        @foreach ($user->replies->sortByDesc('created_at') as $reply)
                            <li>{{ $topic->updated_at->format('Y-m-d') }} &nbsp;&nbsp; <a href="{{ route('reply.show', $reply->id) }}" target="_blank">{{ $reply->body }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
