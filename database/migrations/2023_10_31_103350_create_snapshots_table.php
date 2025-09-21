<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class extends XotBaseMigration
{
>>>>>>> a12f125f4a (.)
=======
return new class extends XotBaseMigration {
>>>>>>> b93ef594b4 (.)
=======
return new class extends XotBaseMigration
{
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    public function up(): void
    {
        $this->tableCreate(
            /**
             * @param Blueprint $table
             */
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid('aggregate_uuid');
                $table->unsignedInteger('aggregate_version');
                $table->jsonb('state');
                $table->index('aggregate_uuid');
<<<<<<< HEAD
            },
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            },
=======
            }
>>>>>>> a12f125f4a (.)
=======
            },
>>>>>>> b93ef594b4 (.)
=======
            }
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        );

        $this->tableUpdate(
            /**
             * @param Blueprint $table
             */
            function (Blueprint $table) {
                $this->updateTimestamps($table, false);
<<<<<<< HEAD
            },
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            },
=======
            }
>>>>>>> a12f125f4a (.)
=======
            },
>>>>>>> b93ef594b4 (.)
=======
            }
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
        );
    }
};
