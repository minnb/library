<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use App\Models\User;
use App\Models\Roles;
use Auth;

class RedirectIfAdministrator extends Middleware
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
        if (Auth::check() && Roles::isAdmin(Auth::user()->id)) 
        {
            return $next($request);
        }
        else
        {
            return redirect('/');
        }
    }
}
