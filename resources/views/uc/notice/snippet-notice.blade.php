<?php
use App\Notice;
?>
<div class="item-notice item-notice-{{ $notice->id }}" data-notice-id="{{ $notice->id }}">
    @if (!$notice->is_checked)
        <a href="javascript:checkNotice('.item-notice-{{ $notice->id }}')" class="pull-right btn btn-xs btn-link"><i class="fa fa-trash"></i></a>
    @endif

    <span>{{ $notice->created_at->format('m-d H:i') }}</span> &nbsp;&nbsp;
    <a target="_blank" href="{{ route('uc.show', $notice->offer_user_id) }}">{{ $notice->offerUser->name }}</a>
    @if ($notice->type_id == Notice::TYPE_COMMENT_TOPIC)
        {{ trans('user.In') }}{{ trans('app.Topic') }}:
        <a target="_blank" href="{{ route('notice.show', $notice->id) }}">{{ $notice->entity->entity->title }}</a>
        {{ trans('user.comment to you') }}
    @elseif ($notice->type_id == Notice::TYPE_COMMENT_BLOG)
        {{ trans('user.In') }}{{ trans('app.Blog') }}:
        <a target="_blank" href="{{ route('notice.show', $notice->id) }}">{{ $notice->entity->entity->title }}</a>
        {{ trans('user.comment to you') }}
    @elseif ($notice->type_id == Notice::TYPE_COMMENT_ARTICLE)
        {{ trans('user.In') }}{{ trans('app.Article') }}:
        <a target="_blank" href="{{ route('notice.show', $notice->id) }}">{{ $notice->entity->entity->title }}</a>
        {{ trans('user.comment to you') }}
    @elseif ($notice->type_id == Notice::TYPE_REPLY_CONTENT)
        {{ trans('user.In') }}
        <a target="_blank" href="{{ route('notice.show', $notice->id) }}">{{ $notice->entity->entity->title }}</a>
        {{ trans('user.reply to you') }}
    @elseif ($notice->type_id == Notice::TYPE_REPLY_COMMENT)
        {{ trans('user.In') }}
        <a target="_blank" href="{{ route('notice.show', $notice->id) }}">{{ $notice->entity->entity->entity->title }}</a>
        {{ trans('user.reply to you comment') }}
    @endif
</div>
