<?php

declare(strict_types=1);

namespace Modules\Activity\Listeners;

use Illuminate\Auth\Events\Logout;

class LogoutListener
{
    /**
     * Handle the event.
     */
<<<<<<< HEAD
    public function handle(Logout $_event): void
=======
    public function handle(Logout $event): void
>>>>>>> 0a00ff2 (.)
    {
        // Implementazione del logout tracking
    }
}
