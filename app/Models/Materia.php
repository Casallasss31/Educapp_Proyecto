<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    protected $table = 'materia';

    protected $primaryKey = 'Id_Materia';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Materia',
        'Id_area',
        'Id_nota'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(
            Area::class,
            'Id_area',
            'Id_Area'
        );
    }

    public function nota(): BelongsTo
    {
        return $this->belongsTo(
            Nota::class,
            'Id_nota',
            'Id_Nota'
        );
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(
            HorarioAcademico::class,
            'Id_materia',
            'Id_Materia'
        );
    }
}
