<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('admins')) {
            // Borrar todos los admins existentes
            DB::table('admins')->truncate();
        }
    }

    public function down(): void
    {
        // No se realiza ninguna acción al revertir
    }
};
