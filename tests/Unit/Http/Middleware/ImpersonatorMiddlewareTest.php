<?php

namespace Tests\Unit\Http\Middleware;

use Tests\TestCase;
use Matthew\LaravelImpersonator\Http\Middleware\Impersonator;
use Illuminate\Http\Request;
use Mockery as m;

class ImpersonatorMiddlewareTest extends TestCase
{
    public function testChangesUserIdIfNotSet()
    {
        $request = Request::create('http://example.com/admin', 'GET');
        $response = m::mock('Illuminate\Http\Response');
        $middleware = new Impersonator;
        $middlewareResponse = $middleware->handle($request, function () use ($response) {
            return $response;
        });
    }
}
