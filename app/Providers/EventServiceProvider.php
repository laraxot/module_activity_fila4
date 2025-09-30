<?php

declare(strict_types=1);

namespace Modules\Activity\Providers;

<<<<<<< HEAD
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
=======
<<<<<<< HEAD
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;
use Modules\Activity\Listeners\LoginListener;
use Modules\Activity\Listeners\LogoutListener;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
        Login::class => [
            LoginListener::class,
        ],
        Logout::class => [
<<<<<<< HEAD
=======
=======
        \Illuminate\Auth\Events\Login::class => [
            LoginListener::class,
        ],
        \Illuminate\Auth\Events\Logout::class => [
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
            LogoutListener::class,
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
<<<<<<< HEAD
    protected function configureEmailVerification(): void
    {
    }
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    protected function configureEmailVerification(): void
    {
    }
=======
    protected function configureEmailVerification(): void {}
>>>>>>> a12f125f4a (.)
=======
    protected function configureEmailVerification(): void
    {
    }
>>>>>>> b93ef594b4 (.)
=======
    protected function configureEmailVerification(): void {}
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
}
