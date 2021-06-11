<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthMiddleware
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
        // ここから追加
        if (! isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
            $this->die();
        }
        if ($_SERVER['PHP_AUTH_USER'] !== env('BASIC_USER') || $_SERVER['PHP_AUTH_PW'] !== env('BASIC_PASS')) {
            $this->die();
        }
        // ここまで追加
        return $next($request);
    }

    // ここから追加
    protected function die()
    {
        header('WWW-Authenticate: Basic realm="Enter username and password."');
        abort(401);
    }
}
