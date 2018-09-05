<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized', 401);
            } else {
                if($guard =='admin'){
                    return redirect()->guest('admin/login');
                }
                return redirect()->guest('login');
            }
        }
        if ($request->getPathInfo() == '/admin/login') return redirect('/admin');
        return $next($request);
    }
}
