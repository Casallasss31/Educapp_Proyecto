<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profesion extends Model
{
    protected $table = 'profesion';

    protected $primaryKey = 'Id_Profesion';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Profesion'
    ];

    public function acudientes(): HasMany
    {
        return $this->hasMany(
            Acudiente::class,
            'Id_Profesion',
            'Id_Profesion'
        );
    }
}
