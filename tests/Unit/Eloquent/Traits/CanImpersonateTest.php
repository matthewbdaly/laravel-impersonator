<?php

namespace Tests\Unit\Eloquent\Traits;

use Tests\TestCase;
use Tests\Fixtures\User;
use Mockery as m;

class CanImpersonateTest extends TestCase
{
    public function testStartImpersonationg()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('put')->with('impersonate', $user2->id)->once();
        $this->app->instance('Illuminate\Contracts\Session\Session', $session);
        $user1->startImpersonating($user2->id);
    }
}
