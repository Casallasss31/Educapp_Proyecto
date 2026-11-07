<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EPS extends Model
{
    protected $table = 'eps';

    protected $primaryKey = 'Id_EPS';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Eps'
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(
            Usuario::class,
            'Id_EPS',
            'Id_EPS'
        );
    }
}