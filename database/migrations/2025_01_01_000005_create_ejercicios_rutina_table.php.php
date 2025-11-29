<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ejercicios_rutina')) {
            Schema::create('ejercicios_rutina', function (Blueprint $table) {
                $table->id();
                $table->foreignId('dia_rutina_id')->constrained('dias_rutina')->onDelete('cascade');
                $table->foreignId('ejercicio_id')->constrained('ejercicios')->onDelete('cascade');
                $table->integer('series')->default(3);
                $table->json('repeticiones')->nullable(); // Ejemplo: ["12","10","8"]
                $table->text('recomendacion')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ejercicios_rutina');
    }
};
