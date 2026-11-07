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

    public function docentes(): HasMany
    {
        return $this->hasMany(
            Docente::class,
            'Id_profesion',
            'Id_Profesion'
        );
    }

    public function rectores(): HasMany
    {
        return $this->hasMany(
            Rector::class,
            'Id_profesion',
            'Id_Profesion'
        );
    }

    public function asistentesAdministrativos(): HasMany
    {
        return $this->hasMany(
            AsistenteAdministrativo::class,
            'Id_profesion',
            'Id_Profesion'
        );
    }
}