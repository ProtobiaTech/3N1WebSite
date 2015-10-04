<?php

namespace App\Http\Middleware;

use Closure;
use Flash;

class InstallableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (file_exists(base_path() . '/install.lock')) {
            Flash::error(trans('install.remove /install.lock files, and then install'));
            return redirect()->route('home');
        }

        return $next($request);
    }
}
