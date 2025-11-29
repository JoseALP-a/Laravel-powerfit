<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@powerfit.com'], // 👈 correo del admin inicial
            [
                'nombre' => 'Administrador PowerFit',
                'password' => Hash::make('admin12345'), // 👈 contraseña
            ]
        );
    }
}
