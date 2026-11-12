<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsistenteAdministrativo extends Model
{
    protected $table = 'asistente_administrativo';

    protected $primaryKey = 'Id_Asistente_Administrativo';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Id_Asistente_Administrativo',
        'Id_usuario',
        'Id_profesion'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            Usuario::class,
            'Id_usuario',
            'Id_usuario'
        );
    }

    public function profesion(): BelongsTo
    {
        return $this->belongsTo(
            Profesion::class,
            'Id_profesion',
            'Id_Profesion'
        );
    }
}
