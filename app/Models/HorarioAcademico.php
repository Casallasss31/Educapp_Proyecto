<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioAcademico extends Model
{
    protected $table = 'horario_academico';

    protected $primaryKey = 'Id_Horario_Academico';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Dias_semana',
        'Hora_inicio',
        'Horario_final',
        'Id_curso',
        'Id_materia'
    ];

    protected $casts = [
        'Id_curso' => 'integer',
        'Id_materia' => 'integer'
    ];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(
            Curso::class,
            'Id_curso',
            'Id_Curso'
        );
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(
            Materia::class,
            'Id_materia',
            'Id_Materia'
        );
    }
}
