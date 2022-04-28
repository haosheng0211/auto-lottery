<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class Authenticate
{
    protected Auth $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next, string $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            throw new AuthenticationException();
        }

        return $next($request);
    }
}
