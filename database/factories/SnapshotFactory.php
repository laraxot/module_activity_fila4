<?php

declare(strict_types=1);

namespace Modules\Activity\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Activity\Models\Snapshot;

/**
 * Snapshot Factory
<<<<<<< HEAD
 *
 * Factory for creating Snapshot model instances for testing and seeding.
 *
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
 *
 * Factory for creating Snapshot model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating Snapshot model instances for testing and seeding.
 * 
>>>>>>> a12f125f4a (.)
=======
 *
 * Factory for creating Snapshot model instances for testing and seeding.
 *
>>>>>>> b93ef594b4 (.)
=======
 * 
 * Factory for creating Snapshot model instances for testing and seeding.
 * 
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
 * @extends Factory<Snapshot>
 */
class SnapshotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> a12f125f4a (.)
=======
     *
>>>>>>> b93ef594b4 (.)
=======
     * 
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
     * @var class-string<Snapshot>
     */
    protected $model = Snapshot::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'aggregate_uuid' => $this->faker->uuid(),
            'aggregate_version' => $this->faker->numberBetween(1, 100),
            'state' => [
                'data' => $this->faker->words(5, true),
                'status' => $this->faker->randomElement(['active', 'inactive', 'pending']),
                'metadata' => [
                    'user_id' => $this->faker->numberBetween(1, 100),
                    'timestamp' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
                ],
            ],
        ];
    }

    /**
     * Create snapshot with specific UUID.
     *
     * @param string $uuid
     * @return static
     */
    public function withUuid(string $uuid): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> a12f125f4a (.)
=======
        return $this->state(fn(array $_attributes): array => [
>>>>>>> b93ef594b4 (.)
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
            'aggregate_uuid' => $uuid,
        ]);
    }

    /**
     * Create snapshot with specific version.
     *
     * @param int $version
     * @return static
     */
    public function withVersion(int $version): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> a12f125f4a (.)
=======
        return $this->state(fn(array $_attributes): array => [
>>>>>>> b93ef594b4 (.)
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
            'aggregate_version' => $version,
        ]);
    }

    /**
     * Create snapshot with specific state.
     *
     * @param array<string, mixed> $state
     * @return static
     */
    public function withState(array $state): static
    {
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
        return $this->state(fn(array $_attributes): array => [
            'state' => $state,
        ]);
    }
}
<<<<<<< HEAD
=======
=======
        return $this->state(fn (array $attributes): array => [
=======
        return $this->state(fn(array $_attributes): array => [
>>>>>>> b93ef594b4 (.)
            'state' => $state,
        ]);
    }
}
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
        return $this->state(fn (array $attributes): array => [
            'state' => $state,
        ]);
    }
}
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
