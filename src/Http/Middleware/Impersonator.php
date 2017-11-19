<?php

namespace Matthewbdaly\LaravelImpersonator\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Session\Session;

class Impersonator
{
    protected $auth;

    protected $session;

    public function __construct(Guard $auth, Session $session)
    {
        $this->auth = $auth;
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->session->has('impersonate'))
        {
            $this->auth->onceUsingId($this->session->get('impersonate'));
        }

        return $next($request);
    }
}
