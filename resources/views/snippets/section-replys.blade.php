<?php
    if (get_class($entity) === 'App\Comment') {
        $entityType = 'comment';
        $contentId = $entity->entity->id;
    } else {
        $entityType = 'content';
        $contentId = $entity->id;
    }
?>
@if ($entityType === 'content')
    <div id="section-content-replys" style="margin-top:12px;">
@else
    <div id="section-comment-replys-{{ $entity->id }}" style="margin-top:12px; display:none">
@endif
    @if (Auth::guest())
        <div>
            {{ trans('app.Please') }}<a href="{{ url('auth/login') }}">{{ trans('app.Login') }}</a>
        </div>
    @else
        {!! Form::open(['url' => route('reply.store'), 'class' => 'form-horizontal']) !!}
            <input name="entity_id" type="hidden" value="{{ $entity->id }}">
            <input name="content_id" type="hidden" value="{{ $contentId }}">
            <input name="entity_type" type="hidden" value="{{ $entityType }}">
            <?php
                $inputName = 'body-reply';
                if ($entityType === 'comment') {
                    $inputName = 'body-reply-comment' . $entity->id;
                }
            ?>
            <div class="form-group {{ $errors->first($inputName) ? 'has-error' : '' }}" style="margin-bottom:0;">
                <div class="col-sm-12">
                    <div class="input-group">
                        <input name="{{ $inputName }}" type="text" class="form-control" placeholder="{{ trans('app.Simple reply') }}" value="{{ old($inputName) }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">{{ trans('app.Reply') }}</button>
                        </span>
                    </div>
                    <p class="help-block help-block-error">{{ $errors->first($inputName) }}</p>
                </div>
            </div>
        {!! Form::close() !!}
    @endif


    <div style="">
        @foreach ($entity->replys as $index => $reply)
            <?php if ($index == 10) { break; } ?>
            <div class="item" style="padding-bottom:5px; word-wrap:break-word; word-break:normal;">
                <div class="pic pull-left">
                    <a href="{{ route('uc.show', $reply->author->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $reply->author->name }}">
                        <img src="{{ $reply->author->avatar }}" style="margin-right:4px; width:20px; height:20px; border-radius:2px; vertical-align:top;">
                    </a>
                </div>
                {{ $reply->body }}
            </div>
        @endforeach
    </div>
</div>

<script>$('[data-toggle="tooltip"]').tooltip();</script>
