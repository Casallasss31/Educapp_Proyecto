<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matricula extends Model
{
    protected $table = 'matricula';

    protected $primaryKey = 'Id_Matricula';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Fecha_Matricula',
        'Id_estudiante'
    ];

    protected $casts = [
        'Fecha_Matricula' => 'date:Y-m-d',
        'Id_estudiante' => 'integer'
    ];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(
            Estudiante::class,
            'Id_estudiante',
            'Id_Estudiante'
        );
    }
}
