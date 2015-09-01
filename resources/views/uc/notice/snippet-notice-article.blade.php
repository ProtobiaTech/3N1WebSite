<div class="item-notice">
    <a class="pull-right btn btn-xs btn-link"><i class="fa fa-trash"></i></a>
    <span>{{ $notice->created_at->format('m-d H:i') }}</span> &nbsp;&nbsp;
    <a target="_blank" href="{{ route('uc.show', $notice->offer_user_id) }}">{{ $notice->offerUser->name }}</a>
    {{ trans('user.In') }}{{ trans('app.Article') }}:
    <a target="_blank" href="{{ route('article.show', $notice->entity_id) }}">{{ $notice->entity->title }}</a>
    {{ trans('user.reply to you') }}
</div>
