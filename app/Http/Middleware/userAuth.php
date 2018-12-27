<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class userAuth
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
        if (empty(session('user_info'))) {
            return redirect('login');
        }
        return $next($request);
    }
}