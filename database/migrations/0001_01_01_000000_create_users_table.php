<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Crear tabla users solo si no existe
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');

                // Campos físicos
                $table->integer('edad')->nullable();
                $table->decimal('peso', 5, 2)->nullable();
                $table->decimal('altura', 5, 2)->nullable();
                $table->enum('sexo', ['M', 'F', 'Otro'])->nullable();
                $table->enum('nivel_experiencia', ['Principiante', 'Intermedio', 'Avanzado'])->nullable();
                $table->enum('objetivo', ['Aumento de masa muscular', 'Pérdida de peso', 'Mantenimiento y tonificación'])->nullable();
                $table->enum('tiempo_disponible', ['2 días', '3 días', '5 días'])->nullable();

                // rutina_id solo como columna, aún sin constraint
                $table->unsignedBigInteger('rutina_id')->nullable();

                $table->rememberToken();
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();
                $table->timestamps();
            });
        }

        // Crear tabla password_reset_tokens solo si no existe
        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        // Crear tabla sessions solo si no existe
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
