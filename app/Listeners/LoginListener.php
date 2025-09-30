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
<<<<<<< HEAD
    public function handle(Login $_event): void
=======
    public function handle(Login $event): void
>>>>>>> 0a00ff2 (.)
=======
    public function handle(Login $_event): void
>>>>>>> 18dcd64 (.)
    {
        // ...
    }
}
