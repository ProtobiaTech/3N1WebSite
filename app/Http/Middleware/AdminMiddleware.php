<?php

namespace App\Http\Middleware;

use Closure, Auth;

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
        if (!Auth::guest() && Auth::user()->hasRole('admin')) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
