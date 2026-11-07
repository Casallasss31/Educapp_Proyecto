<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    protected $table = 'rol';

    protected $primaryKey = 'Id_Rol';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Tipo'
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(
            Usuario::class,
            'Id_Rol',
            'Id_Rol'
        );
    }
}