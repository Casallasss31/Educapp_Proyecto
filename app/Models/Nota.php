<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nota extends Model
{
    protected $table = 'nota';

    protected $primaryKey = 'Id_Nota';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'Nombre_Nota'
    ];

    public function detallesBoletin(): HasMany
    {
        return $this->hasMany(
            DetalleBoletin::class,
            'Id_Nota',
            'Id_Nota'
        );
    }
}
