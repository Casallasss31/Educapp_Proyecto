<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Acudiente extends Model
{
    protected $table = 'acudiente';

    protected $primaryKey = 'Id_Acudiente';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Id_usuario',
        'Id_Profesion'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            Usuario::class,
            'Id_usuario',
            'Id_usuario'
        );
    }

    public function profesion(): BelongsTo
    {
        return $this->belongsTo(
            Profesion::class,
            'Id_Profesion',
            'Id_Profesion'
        );
    }

    public function estudiantes(): HasMany
    {
        return $this->hasMany(
            Estudiante::class,
            'Id_Acudiente',
            'Id_Acudiente'
        );
    }
}
