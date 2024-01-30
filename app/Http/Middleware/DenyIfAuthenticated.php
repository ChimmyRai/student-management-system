<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DenyIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guard )
    {

      foreach($guard as $guard){
        if (Auth::guard($guard)->check()) {
            abort(401);
        }
        }

        return $next($request);

}
}
