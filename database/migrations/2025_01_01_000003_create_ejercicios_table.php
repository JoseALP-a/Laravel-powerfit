<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ejercicios')) {
            Schema::create('ejercicios', function (Blueprint $table) {
                $table->id();
                $table->string('nombre', 100);
                $table->text('descripcion')->nullable();
                $table->string('video_url', 255)->nullable();
                $table->string('categoria', 100)->nullable();
                $table->enum('nivel', ['Principiante', 'Intermedio', 'Avanzado']);
                $table->enum('objetivo', ['Aumento de masa muscular', 'Pérdida de peso', 'Mantenimiento y tonificación'])->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ejercicios');
    }
};
