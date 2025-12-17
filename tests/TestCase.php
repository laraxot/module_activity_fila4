<?php

declare(strict_types=1);

namespace Modules\Activity\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Modules\Activity\Providers\ActivityServiceProvider;
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

        // Configure testing connection
        $this->app['config']->set('database.default', 'testing');
        $this->app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Configure activity connection to match testing (separate in-memory instance unfortunately, checking if we can share)
        // For simplicity, we define it as another shared memory or just another memory instance.
        // If we want them to be the SAME, we need to handle PDO sharing which is complex in simple config.
        // Let's assume separate is fine for now, but we must migrate both.
        $this->app['config']->set('database.connections.activity', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Ensure sqlite connection is also defined as it is requested by TenantServiceProvider or others
        $this->app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Actually, if we use the same database definition ':memory:', PHP SQLite creates separate DBs for each connection.
        // Ideally we check if we can override the connection name in the model or config to point to 'testing'.
        // If we point 'database.connections.activity' to 'database.connections.testing' config? No.

        // Let's try to just migrate 'testing' and assume 'Activity' model might fall back if we strip the property? No we can't strip property easily.

        // Correct approach for tests: define 'activity' connection same as 'testing'.
        // AND run migrations on 'activity' connection as well.

        // Run base Laravel migrations (to create users table etc)
        $this->artisan('migrate', [
            '--database' => 'testing',
            '--path' => 'database/migrations',
        ]);

        $this->artisan('migrate', ['--database' => 'testing']);
        $this->artisan('migrate', ['--database' => 'activity']);

        // Seed any required data for Activity tests
        $this->artisan('module:seed', ['module' => 'Activity']);
    }

    /**
     * Get package providers.
     *
     * @return array<int, class-string>
     */
    protected function getPackageProviders($_app): array
    {
        return [
            ActivityServiceProvider::class,
        ];
    }
}
