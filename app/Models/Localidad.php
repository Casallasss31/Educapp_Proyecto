<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Localidad extends Model
{
    protected $table = 'localidad';

    protected $primaryKey = 'Id_Localidad';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Localidad'
    ];

    public function barrios(): HasMany
    {
        return $this->hasMany(
            Barrio::class,
            'Id_localidad',
            'Id_Localidad'
        );
    }
}