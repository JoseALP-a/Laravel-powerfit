<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoSemanal extends Model
{
    use HasFactory;

    protected $table = 'progresos_semanales'; // 👈 Nombre correcto de tu tabla en la BD

    protected $fillable = [
        'user_id',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
