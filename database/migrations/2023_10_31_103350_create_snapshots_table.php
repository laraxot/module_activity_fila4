<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

<<<<<<< HEAD
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class extends XotBaseMigration
{
>>>>>>> 0a00ff2 (.)
=======
return new class extends XotBaseMigration {
>>>>>>> 18dcd64 (.)
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
<<<<<<< HEAD
            },
=======
            }
>>>>>>> 0a00ff2 (.)
=======
            },
>>>>>>> 18dcd64 (.)
        );

        $this->tableUpdate(
            /**
             * @param Blueprint $table
             */
            function (Blueprint $table) {
                $this->updateTimestamps($table, false);
<<<<<<< HEAD
<<<<<<< HEAD
            },
=======
            }
>>>>>>> 0a00ff2 (.)
=======
            },
>>>>>>> 18dcd64 (.)
        );
    }
};
