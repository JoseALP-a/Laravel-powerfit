<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjercicioRutina extends Model
{
    use HasFactory;

    protected $table = 'ejercicios_rutina';

    protected $fillable = [
        'dia_rutina_id',
        'ejercicio_id',
        'series',
        'repeticiones', // json column
        'recomendacion',
    ];

    protected $casts = [
        'repeticiones' => 'array',
    ];

    public function dia()
    {
        return $this->belongsTo(DiaRutina::class, 'dia_rutina_id');
    }

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class, 'ejercicio_id');
    }
}
