<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barrio extends Model
{
    protected $table = 'barrio';

    protected $primaryKey = 'Id_Barrio';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Estrato',
        'Nombre_Barrio',
        'Direccion',
        'Id_localidad'
    ];

    public function localidad(): BelongsTo
    {
        return $this->belongsTo(
            Localidad::class,
            'Id_localidad',
            'Id_Localidad'
        );
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(
            Usuario::class,
            'Id_Barrio',
            'Id_Barrio'
        );
    }
}