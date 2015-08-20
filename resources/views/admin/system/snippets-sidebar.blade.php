<li class="{{ Request::is('admin/system') ? 'active' : '' }}"><a href="{{ route('admin.system.index') }}">{{ trans('app.Overview') }}</a></li>
<li class="{{ Request::is('admin/system/*/edit') ? 'active' : '' }}"><a href="{{ route('admin.system.edit', 1) }}">{{ trans('app.Edit') }}</a></li>
