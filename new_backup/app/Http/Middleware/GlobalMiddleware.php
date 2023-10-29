<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GlobalMiddleware
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
        if (! Auth::check()) {
            return redirect('admin/login');
        }

        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'manager') {
            return $next($request);
        } else {
            Auth::logout();

            return redirect('admin/login');
        }
    }
}
