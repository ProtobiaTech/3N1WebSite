<?php

namespace App\Http\Middleware;

use Closure, Auth, Flash;

class AdminMiddleware
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
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                return $next($request);
            } else {
                Flash::error(trans('app.Authority to operate'));
                return redirect()->back();
            }
        } else {
            return redirect()->to('/auth/login');
        }
    }
}
