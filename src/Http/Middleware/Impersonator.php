<?php

namespace Matthewbdaly\LaravelImpersonator\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Session\Session;

/**
 * Impersonate another user
 */
class Impersonator
{
    /**
     * Auth service
     *
     * @var $auth
     */
    protected $auth;

    /**
     * Session service
     *
     * @var $session
     */
    protected $session;

    /**
     * Constructor
     *
     * @param Guard   $auth    The auth instance.
     * @param Session $session The session instance.
     * @return void
     */
    public function __construct(Guard $auth, Session $session)
    {
        $this->auth = $auth;
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request The HTTP request object.
     * @param  \Closure                 $next    The closure to return the response.
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->session->has('impersonate')) {
            $this->auth->onceUsingId($this->session->get('impersonate'));
        }

        return $next($request);
    }
}
