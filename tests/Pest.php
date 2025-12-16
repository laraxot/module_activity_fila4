<?php

declare(strict_types=1);

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
use Modules\Activity\Models\Activity;
use Modules\Activity\Tests\TestCase;

/*
<<<<<<< HEAD
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
 * |--------------------------------------------------------------------------
 * | Test Case
 * |--------------------------------------------------------------------------
 * |
 * | The closure you provide to your test functions is always bound to a specific PHPUnit test
 * | case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
 * | need to change it using the "pest()" function to bind a different classes or traits.
 * |
 */
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)

/** @mixin \Modules\Activity\Tests\TestCase */
pest()->extend(TestCase::class)->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeActivity', function () {
    /** @phpstan-ignore-next-line */
    return $this->toBeInstanceOf(Activity::class);
});

/*
<<<<<<< HEAD
=======
 * |--------------------------------------------------------------------------
 * | Functions
 * |--------------------------------------------------------------------------
 * |
 * | While Pest is very powerful out-of-the-box, you may have some testing code specific to your
 * | project that you don't want to repeat in every file. Here you can also expose helpers as
 * | global functions to help you to reduce the number of lines of code in your test files.
 * |
 */
<<<<<<< HEAD
=======
=======
=======
use Modules\Activity\Tests\TestCase;

/*
>>>>>>> origin/develop
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)

pest()->extend(TestCase::class)->in('Feature', 'Unit');

/*
 * |--------------------------------------------------------------------------
 * | Expectations
 * |--------------------------------------------------------------------------
 * |
 * | When you're writing tests, you often need to check that values meet certain conditions. The
 * | "expect()" function gives you access to a set of "expectations" methods that you can use
 * | to assert different things. Of course, you may extend the Expectation API at any time.
 * |
 */

expect()->extend('toBeActivity', fn () => $this->toBeInstanceOf(Activity::class));

/*
<<<<<<< HEAD
=======

pest()->extend(TestCase::class)
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeActivity', function () {
    return $this->toBeInstanceOf(\Modules\Activity\Models\Activity::class);
});

/*
>>>>>>> origin/develop
>>>>>>> 0b410a6 (.)
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
 * |--------------------------------------------------------------------------
 * | Functions
 * |--------------------------------------------------------------------------
 * |
 * | While Pest is very powerful out-of-the-box, you may have some testing code specific to your
 * | project that you don't want to repeat in every file. Here you can also expose helpers as
 * | global functions to help you to reduce the number of lines of code in your test files.
 * |
 */
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)

function createActivity(array $attributes = []): Activity
{
    $activity = Activity::factory()->create($attributes);
    \assert($activity instanceof Activity);

    return $activity;
}

function makeActivity(array $attributes = []): Activity
{
<<<<<<< HEAD
    $activity = Activity::factory()->make($attributes);
    \assert($activity instanceof Activity);

    return $activity;
=======
    return Activity::factory()->make($attributes);
<<<<<<< HEAD
=======
=======

function createActivity(array $attributes = []): \Modules\Activity\Models\Activity
{
    return \Modules\Activity\Models\Activity::factory()->create($attributes);
}

function makeActivity(array $attributes = []): \Modules\Activity\Models\Activity
{
    return \Modules\Activity\Models\Activity::factory()->make($attributes);
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
>>>>>>> 0b410a6 (.)
}
