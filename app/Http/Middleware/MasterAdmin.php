<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MasterAdmin
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
      if(Auth::user()->user_role != 0)
      {
        echo "hobe na";
        die();
      }
        return $next($request);
    }
}
