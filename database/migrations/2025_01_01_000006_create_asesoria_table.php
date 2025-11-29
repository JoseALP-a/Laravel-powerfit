<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asesoria', function (Blueprint $table) {
            $table->id();
            $table->string('numero_whatsapp', 20);
            $table->text('mensaje_default')->nullable(); // ❗ FIX
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesoria');
    }
};
