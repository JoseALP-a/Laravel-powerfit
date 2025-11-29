<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaRutina extends Model
{
    use HasFactory;

    protected $table = 'dias_rutina';

    protected $fillable = [
        'rutina_id',
        'dia_numero',
        'grupo_muscular',
    ];

    public function ejercicios()
    {
        return $this->hasMany(EjercicioRutina::class, 'dia_rutina_id');
    }

    public function rutina()
    {
        return $this->belongsTo(Rutina::class, 'rutina_id');
    }
}
