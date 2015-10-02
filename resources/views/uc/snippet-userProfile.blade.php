<!-- User Panel -->
<div class="panel panel-default panel-userProfile">
    <div class="panel-heading">
        <i class="fa fa-user"></i>
        {{ trans('user.My profile') }}
    </div>
    <div class="panel-body">
        <div class="pic text-center">
            <img class="img-rounded" src="{{ $user->avatar }}">
        </div>

        <p class="text-center">
            <b>{{ trans('user.Name') }}:</b>
            {{ $user->name }}
        </p>
    </div>
</div>
