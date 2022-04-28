<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcceptLanguage
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language', 'en');
        app()->setLocale($locale);

        return $next($request);
    }
}
