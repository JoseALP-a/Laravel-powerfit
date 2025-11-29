<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Rutina;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /* --------------------------------------------------------------------------
     |  CAMPOS QUE SE PUEDEN ASIGNAR EN MASA
     |--------------------------------------------------------------------------*/
    protected $fillable = [
        'name',
        'email',
        'password',
        'edad',
        'peso',
        'altura',
        'sexo',
        'nivel_experiencia',
        'objetivo',
        'tiempo_disponible',
        'rutina_id', // Rutina asignada
    ];

    /* --------------------------------------------------------------------------
     |  CAMPOS OCULTOS AL SERIALIZAR
     |--------------------------------------------------------------------------*/
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /* --------------------------------------------------------------------------
     |  CAMPOS ADICIONALES AUTOMÁTICOS
     |--------------------------------------------------------------------------*/
    protected $appends = [
        'profile_photo_url',
    ];

    /* --------------------------------------------------------------------------
     |  TIPOS DE DATOS / CASTS
     |--------------------------------------------------------------------------*/
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'peso' => 'decimal:2',
            'altura' => 'decimal:2',
        ];
    }

    /* --------------------------------------------------------------------------
     |  RELACIONES ELOQUENT
     |--------------------------------------------------------------------------*/

    /**
     * Un usuario puede tener una rutina asignada (opcional).
     */
    public function rutina()
    {
        return $this->belongsTo(Rutina::class, 'rutina_id');
    }

    // ✅ Método para saber si completó su registro
    public function registroCompleto(): bool
    {
        return $this->edad && $this->peso && $this->altura &&
               $this->sexo && $this->nivel_experiencia &&
               $this->objetivo && $this->tiempo_disponible;
    }
}
