<?php

namespace App\Http\Middleware;

use Closure, Auth;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $modelName)
    {
        if (Auth::check()) {
            $resourceId = $request->route()->parameter(strtolower($modelName));
            $resourceId = intval($resourceId);
            $modelName = '\\App\\' . $modelName;
            $model = with(new $modelName)->findOrFail(1);
            if ($model->user_id === Auth::user()->id) {
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            return redirect()->to('/auth/login');
        }
    }
}
