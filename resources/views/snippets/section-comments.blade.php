<!-- Comments -->
<div class="panel panel-default section-items-reply">
    <div class="panel-heading">{{ trans('topic.replys') }}</div>
    <div class="panel-body">
        @if (!$entity->comment_count)
            <span>{{ trans('app.No data') }}</span>
        @endif
        @foreach ($entity->comments as $comment)
            <div class="item-reply">
                <div class="avatar pull-left">
                    <img src="{{ $comment->author->avatar }}">
                </div>
                <div class="body">
                    <div class="info">
                        <a>{{ $comment->author->name }}</a>
                        <span class="separator">|</span>
                        <span>{{ $comment->created_at }}</span>
                    </div>
                    <div class="content">
                        {!! $comment->body !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- New Comment -->
<div class="panel panel-default">
    <div id="anchor-reply" class="panel-heading">{{ trans('topic.My Reply') }}</div>
    <div class="panel-body">
        @if (Auth::guest())
            <div>
                {{ trans('app.Please') }}<a href="{{ url('auth/login') }}">{{ trans('app.Login') }}</a>
            </div>
        @else
            {!! Form::open(['url' => route('comment.store', ['id' => $entity->id]), 'class' => '']) !!}
                {!! Form::hidden('entity_id', $entity->id) !!}
                <div class="form-group {{ $errors->has('body') ? 'has-error' : ''  }}">
                    {!! Form::textarea('body', '', ['class' => 'form-control', 'rows' => '3']) !!}
                    <p class="help-block help-block-error">{{ $errors->first('body') }}</p>
                </div>
                <div class="from-group text-right">
                    {!! Form::submit(trans('app.Submit'), ['class' => 'btn btn-default']) !!}
                </div>
            {!! Form::close() !!}
        @endif
    </div>
</div>
