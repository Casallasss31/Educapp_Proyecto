<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'Numero_Telefono',
        'Correo',
        'Id_Rol',
        'Id_EPS',
        'Id_Grupo_Sanguineo',
        'Id_Barrio'
    ];

    protected $casts = [
        'Fecha_Nacimiento' => 'date:Y-m-d'
    ];

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
}
