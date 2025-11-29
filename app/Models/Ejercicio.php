<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;

    protected $table = 'ejercicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'video_url',
        'categoria',
        'nivel',
        'objetivo',
    ];

    public function detallesRutina()
    {
        return $this->hasMany(EjercicioRutina::class, 'ejercicio_id');
    }
}
