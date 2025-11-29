<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('progresos_semanales')) {
            Schema::create('progresos_semanales', function (Blueprint $table) {
                $table->id();

                // Relación con usuarios
                $table->unsignedBigInteger('user_id');

                // Campos de progreso
                $table->integer('lunes')->nullable();
                $table->integer('martes')->nullable();
                $table->integer('miercoles')->nullable();
                $table->integer('jueves')->nullable();
                $table->integer('viernes')->nullable();
                $table->integer('sabado')->nullable();
                $table->integer('domingo')->nullable();

                $table->timestamps();
            });

            // Llave foránea solo si users existe y no existe aún
            if (Schema::hasTable('users')) {
                Schema::table('progresos_semanales', function (Blueprint $table) {
                    $foreignKeys = collect($table->getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($table->getTable()));
                    $exists = $foreignKeys->contains(fn($fk) => $fk->getLocalColumns() === ['user_id']);
                    if (!$exists) {
                        $table->foreign('user_id')
                            ->references('id')
                            ->on('users')
                            ->onDelete('cascade');
                    }
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('progresos_semanales')) {
            Schema::table('progresos_semanales', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
            Schema::dropIfExists('progresos_semanales');
        }
    }
};
