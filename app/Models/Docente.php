<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Docente extends Model
{
    protected $table = 'docente';

    protected $primaryKey = 'Id_Docente';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Id_Docente',
        'Id_usuario',
        'Id_profesion'
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
            'Id_profesion',
            'Id_Profesion'
        );
    }

    public function cursos(): HasMany
    {
        return $this->hasMany(
            Curso::class,
            'Id_docente',
            'Id_Docente'
        );
    }
}
