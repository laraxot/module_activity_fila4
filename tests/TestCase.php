<?php

declare(strict_types=1);

namespace Modules\Activity\Tests;

<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Foundation\Application;
use Modules\Activity\Providers\ActivityServiceProvider;
=======
use Modules\Activity\Providers\ActivityServiceProvider;
use Illuminate\Foundation\Application;
>>>>>>> 0a00ff2 (.)
=======
use Illuminate\Foundation\Application;
use Modules\Activity\Providers\ActivityServiceProvider;
>>>>>>> 18dcd64 (.)
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Modules\Xot\Tests\CreatesApplication;

/**
 * Base test case for Activity module tests.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Load Activity module specific configurations
        $this->artisan('migrate', ['--database' => 'testing']);
<<<<<<< HEAD
<<<<<<< HEAD

=======
        
>>>>>>> 0a00ff2 (.)
=======

>>>>>>> 18dcd64 (.)
        // Seed any required data for Activity tests
        $this->artisan('module:seed', ['module' => 'Activity']);
    }

    /**
     * Get package providers.
     *
     * @param Application $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            ActivityServiceProvider::class,
        ];
    }
}
