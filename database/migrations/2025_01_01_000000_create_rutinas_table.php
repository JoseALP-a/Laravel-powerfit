<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutinas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->enum('nivel', ['Principiante', 'Intermedio', 'Avanzado']);
            $table->enum('objetivo', ['Aumento de masa muscular', 'Pérdida de peso', 'Mantenimiento y tonificación'])->nullable();
            $table->enum('duracion', ['2 días', '3 días', '5 días'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutinas');
    }
};
