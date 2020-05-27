<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IfCustomer
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
        if(Auth::user()->user_role == 3)
        {
          return back();
        }
        return $next($request);
    }
}
