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
        'Id_Curso',
        'Año',
        'Id_grado',
        'Id_docente'
    ];

    protected $casts = [
        'Id_Curso' => 'integer',
        'Año' => 'integer',
        'Id_grado' => 'integer',
        'Id_docente' => 'integer'
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
}
