<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    protected $table = 'usuarios';

    protected $primaryKey = 'Id_usuario';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombres',
        'Apellidos',
        'Tipo_Documento',
        'Numero_Documento',
        'Fecha_Nacimiento',
        'Genero',
        'Numero_Telefono',
        'Correo',
        'contraseña',
        'Id_Rol',
        'Id_EPS',
        'Id_Grupo_Sanguineo',
        'Id_Barrio'
    ];

    protected $hidden = [
        'contraseña',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'contraseña' => 'hashed',
            'Fecha_Nacimiento' => 'date:Y-m-d',
        ];
    }

    // AUTENTICACIÓN

    public function getAuthPasswordName(): string
    {
        return 'contraseña';
    }

    // ROLES Y PERMISOS

    public function getRolNombres(): ?string
    {
        return $this->rol?->Tipo;
    }

    public function hasPermission(string $permission): bool
    {
        $rol = $this->getRolNombres();

        if (!$rol) {
            return false;
        }

        $permisos = config("rol.{$rol}", []);

        return in_array($permission, $permisos, true);
    }

    // RELACIONES

    public function rol(): BelongsTo
    {
        return $this->belongsTo(
            Rol::class,
            'Id_Rol',
            'Id_Rol'
        );
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(
            EPS::class,
            'Id_EPS',
            'Id_EPS'
        );
    }

    public function grupoSanguineo(): BelongsTo
    {
        return $this->belongsTo(
            GrupoSanguineo::class,
            'Id_Grupo_Sanguineo',
            'Id_GRUPO_SANGUINEO'
        );
    }

    public function barrio(): BelongsTo
    {
        return $this->belongsTo(
            Barrio::class,
            'Id_Barrio',
            'Id_Barrio'
        );
    }

    // JWT

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'rol' => $this->getRolNombres(),
        ];
    }
}
