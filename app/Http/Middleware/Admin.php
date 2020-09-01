<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (!auth::guard('admin')->check()) {

            return redirect('/login-admin');
        }
        return $next($request);
    }
}
