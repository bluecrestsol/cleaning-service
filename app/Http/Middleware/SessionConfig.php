<?php

namespace App\Http\Middleware;

use Closure;

class SessionConfig
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
        $middleware = $request->route()->middleware()[0];
        $name = 'mistershield_session';
        if ($middleware === 'admin') {
            $name = 'mistershield_staff_session';
        }
        config([
            'session.cookie' => $name
        ]);
        return $next($request);
    }
}
