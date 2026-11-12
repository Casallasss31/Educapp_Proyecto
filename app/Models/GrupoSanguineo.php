<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrupoSanguineo extends Model
{
    protected $table = 'grupo_sanguineo';

    protected $primaryKey = 'Id_GRUPO_SANGUINEO';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Grupo',
        'RH'
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(
            Usuario::class,
            'Id_Grupo_Sanguineo',
            'Id_GRUPO_SANGUINEO'
        );
    }
}
