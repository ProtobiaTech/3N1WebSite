<li class="{{ Request::is('dashboard/system') ? 'active' : '' }}"><a href="{{ route('dashboard.system.index') }}">{{ trans('app.Overview') }}</a></li>
<li class="{{ Request::is('dashboard/system/*/edit') ? 'active' : '' }}"><a href="{{ route('dashboard.system.edit', 1) }}">{{ trans('app.Edit') }}</a></li>
