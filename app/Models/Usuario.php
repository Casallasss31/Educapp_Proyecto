<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
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
        'Id_Rol',
        'Id_EPS',
        'Id_Grupo_Sanguineo',
        'Id_Barrio'
    ];

    protected function casts(): array
    {
        return [
            'Fecha_Nacimiento' => 'date',
            'Numero_Documento' => 'integer'
        ];
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'Id_Rol', 'Id_Rol');
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(EPS::class, 'Id_EPS', 'Id_EPS');
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
        return $this->belongsTo(Barrio::class, 'Id_Barrio', 'Id_Barrio');
    }

    public function estudiante(): HasOne
    {
        return $this->hasOne(Estudiante::class, 'Id_usuario', 'Id_usuario');
    }

    public function acudiente(): HasOne
    {
        return $this->hasOne(Acudiente::class, 'Id_usuario', 'Id_usuario');
    }

    public function docente(): HasOne
    {
        return $this->hasOne(Docente::class, 'Id_usuario', 'Id_usuario');
    }

    public function rector(): HasOne
    {
        return $this->hasOne(Rector::class, 'Id_usuario', 'Id_usuario');
    }

    public function asistenteAdministrativo(): HasOne
    {
        return $this->hasOne(
            AsistenteAdministrativo::class,
            'Id_usuario',
            'Id_usuario'
        );
    }
}