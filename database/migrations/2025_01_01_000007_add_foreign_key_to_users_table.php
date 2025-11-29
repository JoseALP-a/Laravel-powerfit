<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users') && Schema::hasTable('rutinas')) {
            Schema::table('users', function (Blueprint $table) {
                $foreignKeys = collect($table->getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($table->getTable()));
                $exists = $foreignKeys->contains(fn($fk) => $fk->getLocalColumns() === ['rutina_id']);
                if (!$exists) {
                    $table->foreign('rutina_id')
                        ->references('id')
                        ->on('rutinas')
                        ->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['rutina_id']);
            });
        }
    }
};
