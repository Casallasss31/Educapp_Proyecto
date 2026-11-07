<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grado extends Model
{
    protected $table = 'grado';

    protected $primaryKey = 'Id_Grado';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Grado'
    ];

    public function cursos(): HasMany
    {
        return $this->hasMany(
            Curso::class,
            'Id_grado',
            'Id_Grado'
        );
    }
}