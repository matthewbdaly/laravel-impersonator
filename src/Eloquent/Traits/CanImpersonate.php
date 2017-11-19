<?php

namespace Matthewbdaly\LaravelImpersonator\Eloquent\Traits;

use Illuminate\Contracts\Session\Session;

trait CanImpersonate
{
    public function startImpersonating(int $id, Session $session)
    {
        $session->put('impersonate', $id);
    }

    public function stopImpersonating(Session $session)
    {
        $session->forget('impersonate');
    }
}
