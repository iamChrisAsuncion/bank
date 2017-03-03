<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CSMiddleware
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
        if (Auth::user()->type == 'CS') {
          return $next($request);
        }
        else {
          return redirect()->route('home');
        }
      } else {
        return redirect()->route('login');
      }


    }
}
