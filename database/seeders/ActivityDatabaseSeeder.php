<?php

declare(strict_types=1);

namespace Modules\Activity\Database\Seeders;

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Database\Seeders\ActivitySeeder;
use Database\Seeders\SnapshotSeeder;
use Database\Seeders\StoredEventSeeder;
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        $this->call([]);
=======
        $this->call([
            ActivitySeeder::class,
            SnapshotSeeder::class,
            StoredEventSeeder::class,
        ]);
>>>>>>> a12f125f4a (.)
=======
        $this->call([]);
>>>>>>> b93ef594b4 (.)
=======
        $this->call([
            \Database\Seeders\ActivitySeeder::class,
            \Database\Seeders\SnapshotSeeder::class,
            \Database\Seeders\StoredEventSeeder::class,
        ]);
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    }
}
