<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progresos_semanales', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios
            $table->unsignedBigInteger('user_id');

            // Campos de progreso (pueden ser enteros, booleanos, o strings según tu uso)
            $table->integer('lunes')->nullable();
            $table->integer('martes')->nullable();
            $table->integer('miercoles')->nullable();
            $table->integer('jueves')->nullable();
            $table->integer('viernes')->nullable();
            $table->integer('sabado')->nullable();
            $table->integer('domingo')->nullable();

            $table->timestamps();

            // Llave foránea
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progresos_semanales');
    }
};
