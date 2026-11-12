<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $table = 'area';

    protected $primaryKey = 'Id_Area';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Area',
        'Descripcion_Area'
    ];

    public function materias(): HasMany
    {
        return $this->hasMany(
            Materia::class,
            'Id_Area',
            'Id_Area'
        );
    }
}
