<?php

namespace App\Http\Middleware;

use Closure;

class CheckRolePolicy
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
        if(user_role() == 2 || user_role() == 3)
        {
            return back();
        }
        return $next($request);
    }
}
