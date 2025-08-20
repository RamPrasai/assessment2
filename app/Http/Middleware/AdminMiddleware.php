<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->type !== 'admin') {
            abort(403, 'Only administrators can access this area.');
        }
        return $next($request);
    }
}
