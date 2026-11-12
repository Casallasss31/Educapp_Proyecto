<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoCertificado extends Model
{
    protected $table = 'tipo_certificado';

    protected $primaryKey = 'Id_Tipo_Certificado';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Certificado'
    ];

    public function certificados(): HasMany
    {
        return $this->hasMany(
            Certificado::class,
            'Id_Tipo_Certificado',
            'Id_Tipo_Certificado'
        );
    }
}
