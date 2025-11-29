<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Borrar todos los admins existentes
        DB::table('admins')->truncate();
    }

    public function down(): void
    {
        //
    }
};
