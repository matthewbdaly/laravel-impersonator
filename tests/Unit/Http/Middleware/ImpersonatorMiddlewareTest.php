<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use Matthewbdaly\LaravelImpersonator\Http\Middleware\Impersonator;
use Illuminate\Http\Request;
use Mockery as m;

class ImpersonatorMiddlewareTest extends TestCase
{
    public function testChangesUserIdIfImpersonating()
    {
        $request = Request::create('http://example.com/admin', 'GET');
        $response = m::mock('Illuminate\Http\Response');
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('has')->with('impersonate')->once()->andReturn(true);
        $session->shouldReceive('get')->with('impersonate')->once()->andReturn(2);
        $auth = m::mock('Illuminate\Contracts\Auth\Guard');
        $auth->shouldReceive('onceUsingId')->with(2)->once();
        $middleware = new Impersonator($auth, $session);
        $middlewareResponse = $middleware->handle($request, function () use ($response) {
            return $response;
        });
    }

    public function testDoesNotChangeUserIdIfNotImpersonating()
    {
        $request = Request::create('http://example.com/admin', 'GET');
        $response = m::mock('Illuminate\Http\Response');
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('has')->with('impersonate')->once()->andReturn(false);
        $auth = m::mock('Illuminate\Contracts\Auth\Guard');
        $middleware = new Impersonator($auth, $session);
        $middlewareResponse = $middleware->handle($request, function () use ($response) {
            return $response;
        });
    }
}
