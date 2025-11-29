<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesoria extends Model
{
    use HasFactory;

    protected $table = 'asesoria';

    protected $fillable = [
        'numero_whatsapp',
        'mensaje_default',
        'activo',
    ];

    // ⭐ Valor por defecto para mensaje_default
    protected $attributes = [
        'mensaje_default' => 'Hola, necesito asesoría sobre mi rutina PowerFit.',
    ];
}
