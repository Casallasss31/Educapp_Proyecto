<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    protected $table = 'curso';

    protected $primaryKey = 'Id_Curso';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Año',
        'Id_grado',
        'Id_docente'
    ];

    public function grado(): BelongsTo
    {
        return $this->belongsTo(
            Grado::class,
            'Id_grado',
            'Id_Grado'
        );
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(
            Docente::class,
            'Id_docente',
            'Id_Docente'
        );
    }

    public function estudiantes(): HasMany
    {
        return $this->hasMany(
            Estudiante::class,
            'Id_Curso',
            'Id_Curso'
        );
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(
            HorarioAcademico::class,
            'Id_curso',
            'Id_Curso'
        );
    }
}