<div class="item-notice item-notice-{{ $notice->id }}" data-notice-id="{{ $notice->id }}">
    @if (!$notice->is_checked)
        <a href="javascript:checkNotice('.item-notice-{{ $notice->id }}')" class="pull-right btn btn-xs btn-link"><i class="fa fa-trash"></i></a>
    @endif

    <span>{{ $notice->created_at->format('m-d H:i') }}</span> &nbsp;&nbsp;
    <a target="_blank" href="{{ route('uc.show', $notice->offer_user_id) }}">{{ $notice->offerUser->name }}</a>
    {{ trans('user.In') }}{{ trans('app.' . $entityName) }}:
    <a target="_blank" href="{{ route('blog.show', $notice->entity_id) }}">{{ $notice->entity->title }}</a>
    {{ trans('user.reply to you') }}
</div>
