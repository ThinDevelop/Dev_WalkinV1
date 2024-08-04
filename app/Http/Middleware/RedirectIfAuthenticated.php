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
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);
            $user = Auth::user();
            if ($user->hasRole('root')) {
                return redirect()->route('root.dashboard');
            }elseif($user->hasRole('admin')){
                return redirect()->route('admin.dashboard');
            }elseif($user->hasRole('superadmin')){
                return redirect()->route('superadmin.dashboard');
            }else{
                Auth::logout();
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
