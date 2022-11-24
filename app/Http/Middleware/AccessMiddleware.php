<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('access') || $request->header('access') !== config('auth.access')) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
