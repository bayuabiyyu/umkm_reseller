<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        // Get guard value
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()){
                    return redirect()->route('admin.dashboard');
                }
                break;

            case 'customer':
                // return customer page
            break;

            default:
                return $next($request);
                break;
        }

        return $next($request);
    }
}
