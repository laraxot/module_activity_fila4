<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    public function up(): void
    {
        $this->tableCreate(
<<<<<<< HEAD
            function (Blueprint $table): void {
=======
            function (Blueprint $table) {
>>>>>>> 9baa519 (.)
                $table->bigIncrements('id');
                $table->uuid('aggregate_uuid');
                $table->unsignedInteger('aggregate_version');
                $table->jsonb('state');
                $table->index('aggregate_uuid');
            },
        );

        $this->tableUpdate(
<<<<<<< HEAD
            function (Blueprint $table): void {
=======
            function (Blueprint $table) {
>>>>>>> 9baa519 (.)
                $this->updateTimestamps($table, false);
            },
        );
    }
};
