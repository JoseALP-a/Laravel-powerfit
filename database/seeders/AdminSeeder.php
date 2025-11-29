<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'nombre' => 'Administrador PowerFit',
            'email' => 'admin@powerfit.com',
            'password' => Hash::make('admin12345'), // CONTRASEÑA SEGURA
        ]);
    }
}
