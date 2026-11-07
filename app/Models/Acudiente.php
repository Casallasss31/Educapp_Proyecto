<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Acudiente extends Model
{
    protected $table = 'acudiente';

    protected $primaryKey = 'Id_Acudiente';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Numero_Telefono',
        'Correo',
        'Id_usuario'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            Usuario::class,
            'Id_usuario',
            'Id_usuario'
        );
    }

    public function estudiantes(): HasMany
    {
        return $this->hasMany(
            Estudiante::class,
            'Id_acudiente',
            'Id_Acudiente'
        );
    }
}