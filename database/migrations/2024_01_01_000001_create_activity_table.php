<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Activity\Models\Activity;
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
    // protected ?string $model_class = Activity::class;
    public function up(): void
    {
        // -- CREATE --
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
        $this->tableCreate(function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableMorphs('subject', 'subject');
            $table->nullableMorphs('causer', 'causer');
            $table->json('properties')->nullable();
            $table->index('log_name');
            $table->uuid('batch_uuid')->nullable();
            $table->string('event')->nullable();
        });
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b1cd7fc (.)
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            // Ensure causer columns are nullable to allow console operations without an authenticated user
            if ($this->hasColumn('causer_id')) {
                $table->unsignedBigInteger('causer_id')->nullable()->change();
            }
            if ($this->hasColumn('causer_type')) {
                $table->string('causer_type')->nullable()->change();
            }
            $this->updateTimestamps($table, true);
        });
<<<<<<< HEAD
=======
=======
=======
>>>>>>> origin/develop
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->string('log_name')->nullable();
                $table->text('description');
                $table->nullableMorphs('subject', 'subject');
                $table->nullableMorphs('causer', 'causer');
                $table->json('properties')->nullable();
                $table->index('log_name');
                $table->uuid('batch_uuid')->nullable();
                $table->string('event')->nullable();
            }
        );
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            // Ensure causer columns are nullable to allow console operations without an authenticated user
            if ($this->hasColumn('causer_id')) {
                $table->unsignedBigInteger('causer_id')->nullable()->change();
            }
<<<<<<< HEAD
        );
>>>>>>> a12f125f4a (.)
=======
            if ($this->hasColumn('causer_type')) {
                $table->string('causer_type')->nullable()->change();
            }
            $this->updateTimestamps($table, true);
        });
>>>>>>> b93ef594b4 (.)
=======
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // Ensure causer columns are nullable to allow console operations without an authenticated user
                if ($this->hasColumn('causer_id')) {
                    $table->unsignedBigInteger('causer_id')->nullable()->change();
                }
                if ($this->hasColumn('causer_type')) {
                    $table->string('causer_type')->nullable()->change();
                }
                $this->updateTimestamps($table, true);
            }
        );
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
    }
};
