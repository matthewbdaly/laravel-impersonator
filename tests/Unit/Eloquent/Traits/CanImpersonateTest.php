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
        $user1->startImpersonating($user2->id, $session);
    }
    
    public function testStopImpersonating()
    {
        $user1 = factory(User::class)->create();
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('forget')->with('impersonate')->once();
        $user1->stopImpersonating($session);
    }
    
    public function testIsImpersonatingTrue()
    {
        $user1 = factory(User::class)->create();
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('has')->with('impersonate')->once()->andReturn(true);
        $this->assertTrue($user1->isImpersonating($session));
    }
 
    public function testIsImpersonatingFalse()
    {
        $user1 = factory(User::class)->create();
        $session = m::mock('Illuminate\Contracts\Session\Session');
        $session->shouldReceive('has')->with('impersonate')->once()->andReturn(false);
        $this->assertFalse($user1->isImpersonating($session));
    }
}
