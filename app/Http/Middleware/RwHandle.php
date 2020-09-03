<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RwHandle
{
    public function handle($request, Closure $next)
    {
        if (!auth::guard('rw')->check()) {

            return redirect('/login-admin');
        }
        return $next($request);
    }
}
