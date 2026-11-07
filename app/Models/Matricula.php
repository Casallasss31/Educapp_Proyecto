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

    protected function casts(): array
    {
        return [
            'Fecha_Matricula' => 'date'
        ];
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