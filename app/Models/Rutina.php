<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $table = 'rutinas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'nivel',
        'objetivo',
        'duracion',
        // 'administrador_id' // añadir si decides migrar la DB para soportarlo
    ];

    public function dias()
    {
        return $this->hasMany(DiaRutina::class, 'rutina_id');
    }
}
