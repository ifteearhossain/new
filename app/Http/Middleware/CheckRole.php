<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
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
        if(Auth::user()->user_role  == 1)
        {
          return redirect('admin');
        }
        elseif(Auth::user()->user_role  == 2)
        {
          return redirect('seller');
        }
        elseif(Auth::user()->user_role  == 3)
        {
          return redirect('customer');
        }
          return $next($request);
    }


}
