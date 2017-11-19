<?php

namespace Matthewbdaly\LaravelImpersonator\Eloquent\Traits;

use Illuminate\Contracts\Session\Session;

/**
 * Add methods to user model to enable them to impersonate users
 *
 */
trait CanImpersonate
{
    /**
     * Start impersonating user by ID
     *
     * @param integer $id      The user ID to impersonate.
     * @param Session $session The session instance.
     * @return void
     */
    public function startImpersonating(int $id, Session $session)
    {
        $session->put('impersonate', $id);
    }

    /**
     * Stop impersonating user
     *
     * @param Session $session The session instance.
     * @return void
     */
    public function stopImpersonating(Session $session)
    {
        $session->forget('impersonate');
    }

    /**
     * Is user currently impersonating another user?
     *
     * @param Session $session The session instance.
     * @return boolean
     */
    public function isImpersonating(Session $session)
    {
        return $session->has('impersonate');
    }
}
