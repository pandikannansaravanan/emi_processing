<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        // ✅ Use the 'web' guard by default if none given
        $guard = $guards[0] ?? 'web';

        if (Auth::guard($guard)->check()) {
            // ✅ If authenticated → redirect to /loans
            return redirect('/');
        }

        return $next($request);
    }
}
