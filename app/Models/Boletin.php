<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boletin extends Model
{
    protected $table = 'boletin';

    protected $primaryKey = 'Id_Boletin';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Fecha_publicacion',
        'Periodo',
        'Observacion',
        'Id_materia',
        'Id_estudiante'
    ];

    protected $casts = [
        'Fecha_publicacion' => 'date:Y-m-d',
        'Periodo' => 'string',
        'Id_materia' => 'integer',
        'Id_estudiante' => 'integer'
    ];

    public function materia(): BelongsTo
    {
        return $this->belongsTo(
            Materia::class,
            'Id_materia',
            'Id_Materia'
        );
    }

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(
            Estudiante::class,
            'Id_estudiante',
            'Id_Estudiante'
        );
    }
}
