<?php

declare(strict_types=1);

namespace Modules\Activity\Listeners;

use Illuminate\Auth\Events\Login;

class LoginListener
{
    /**
     * Handle the event.
     */
<<<<<<< HEAD
    public function handle(Login $_event): void
=======
    public function handle(Login $event): void
>>>>>>> 0a00ff2 (.)
    {
        // ...
    }
}
