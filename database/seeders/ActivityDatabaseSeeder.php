<?php

declare(strict_types=1);

namespace Modules\Activity\Database\Seeders;

<<<<<<< HEAD
=======
use Database\Seeders\ActivitySeeder;
use Database\Seeders\SnapshotSeeder;
use Database\Seeders\StoredEventSeeder;
>>>>>>> 0a00ff2 (.)
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ActivityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

<<<<<<< HEAD
        $this->call([]);
=======
        $this->call([
            ActivitySeeder::class,
            SnapshotSeeder::class,
            StoredEventSeeder::class,
        ]);
>>>>>>> 0a00ff2 (.)
    }
}
