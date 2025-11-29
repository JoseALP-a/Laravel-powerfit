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
}
