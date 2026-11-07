<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificado extends Model
{
    protected $table = 'certificado';

    protected $primaryKey = 'Id_Certificado';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Año',
        'Nombre_Certificado',
        'Id_Tipo_Certificado',
        'Id_estudiante'
    ];

    public function tipoCertificado(): BelongsTo
    {
        return $this->belongsTo(
            TipoCertificado::class,
            'Id_Tipo_Certificado',
            'Id_Tipo_Certificado'
        );
    }

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(
            Estudiante::class,
            'Id_estudiante',
            'Id_Estudiante'
        );
    }
}