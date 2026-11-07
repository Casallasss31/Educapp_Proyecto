<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudiante extends Model
{
    protected $table = 'estudiante';

    protected $primaryKey = 'Id_Estudiante';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Id_usuario',
        'Id_acudiente',
        'Id_Curso'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            Usuario::class,
            'Id_usuario',
            'Id_usuario'
        );
    }

    public function acudiente(): BelongsTo
    {
        return $this->belongsTo(
            Acudiente::class,
            'Id_acudiente',
            'Id_Acudiente'
        );
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(
            Curso::class,
            'Id_Curso',
            'Id_Curso'
        );
    }

    public function boletines(): HasMany
    {
        return $this->hasMany(
            Boletin::class,
            'Id_estudiante',
            'Id_Estudiante'
        );
    }

    public function certificados(): HasMany
    {
        return $this->hasMany(
            Certificado::class,
            'Id_estudiante',
            'Id_Estudiante'
        );
    }

    public function matriculas(): HasMany
    {
        return $this->hasMany(
            Matricula::class,
            'Id_estudiante',
            'Id_Estudiante'
        );
    }
}