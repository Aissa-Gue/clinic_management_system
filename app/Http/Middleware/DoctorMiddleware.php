<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class DoctorMiddleware
{
    protected $auth;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->getUser()->id <= 2) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
