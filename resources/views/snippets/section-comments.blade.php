<!-- Comments -->
<div class="panel panel-default" id="section-items-comment">
    <div class="panel-heading">{{ trans('app.comments') }}</div>
    <div class="panel-body">
        @if (!$entity->comments->count())
            <span>{{ trans('app.No data') }}</span>
        @endif
        @foreach ($entity->comments as $comment)
            <div id="section-comment-{{ $comment->id }}" class="item-comment">
                <div class="avatar pull-left">
                    <img src="{{ $comment->author->avatar }}">
                </div>
                <div class="body">
                    <div class="info">
                        <a>{{ $comment->author->name }}</a>
                        <span class="separator">|</span>
                        <span>{{ $comment->created_at }}</span>
                        <span class="pull-right">
                            <a class="cursor-pointer" onclick="$('#section-comment-replys-{{ $comment->id }}').fadeToggle()">{{ trans('app.Reply') }}({{ $comment->replys->count() }})</a>
                        </span>
                    </div>
                    <div class="content" style="word-break:normal; word-wrap:break-word; ">
                        {!! $comment->body !!}
                    </div>
                </div>

                <!-- Reply -->
                @include('snippets.section-replys', ['entity' => $comment])
            </div>
        @endforeach
    </div>
</div>

<!-- New Comment -->
<div id="panel-comments"  class="panel panel-default">
    <div id="anchor-comment" class="panel-heading">{{ trans('app.My comment') }}</div>
    <div class="panel-body">
        @if (Auth::guest())
            <div>
                {{ trans('app.Please') }}<a href="{{ url('auth/login') }}">{{ trans('app.Login') }}</a>
            </div>
        @else
            {!! Form::open(['url' => route('comment.store', ['id' => $entity->id]), 'class' => '']) !!}
                {!! Form::hidden('entity_id', $entity->id) !!}
                <div class="form-group {{ $errors->has('body') ? 'has-error' : ''  }}">
                    {!! Form::textarea('body', '', ['class' => 'form-control', 'rows' => '3', 'id' => 'simditor']) !!}
                    <p class="help-block help-block-error">{{ $errors->first('body') }}</p>
                </div>
                <div class="from-group text-right">
                    {!! Form::submit(trans('app.Submit'), ['class' => 'btn btn-default']) !!}
                </div>
            {!! Form::close() !!}
        @endif
    </div>
</div>

<!-- simditor -->
@include('snippets.ext-simditor')
<script>
</script>
