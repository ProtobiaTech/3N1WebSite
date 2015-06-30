<!-- User Panel -->
<div class="panel panel-default panel-userProfile">
    <div class="panel-heading">
        <i class="fa fa-user"></i>
        {{ trans('user.My profile') }}
    </div>
    <div class="panel-body">
        <div class="pic text-center">
            <img class="img-rounded" src="{{ Auth::user()->avatar }}">
            <a class="btn-float" href="{{ route('uc.edit-avatar', ['id' => $user->id]) }}">{{ trans('user.Update Avatar') }}</a>
        </div>

        <p class="text-center">
            <b>{{ trans('user.Name') }}:</b>
            {{ Auth::user()->name }}
        </p>

        <div class="">
            <a class="btn btn-primary btn-block" href="{{ route('uc.edit', $user->id) }}">{{ trans('user.Edit profile') }}</a>
        </div>
    </div>
</div>
