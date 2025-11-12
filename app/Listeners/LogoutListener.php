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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function handle(Logout $_event): void
=======
    public function handle(Logout $event): void
>>>>>>> a12f125f4a (.)
=======
    public function handle(Logout $_event): void
>>>>>>> b93ef594b4 (.)
=======
    public function handle(Logout $event): void
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    {
        // Implementazione del logout tracking
    }
}
