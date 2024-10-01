<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!user()->hasAppAccess()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest(url('/login'));
        }

        return $next($request);
    }
}
