<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cookie;
use Closure;

class AdminLocale
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
        $locale = session()->has('mistershield_staff_language') ? session()->get('mistershield_staff_language') : 'en';
        Cookie::queue('mistershield_staff_language', $locale, 30);
        app()->setLocale($locale);
        return $next($request);
    }
}
