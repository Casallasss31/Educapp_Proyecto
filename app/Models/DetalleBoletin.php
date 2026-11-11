<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleBoletin extends Model
{
    protected $table = 'detalle_boletin';

    protected $primaryKey = 'Id_detalle_boletin';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Fallas',
        'Id_docentes',
        'Id_boletin'
    ];

    public function docente(): BelongsTo
    {
        return $this->belongsTo(
            Docente::class,
            'Id_docentes',
            'Id_Docente'
        );
    }

    public function boletin(): BelongsTo
    {
        return $this->belongsTo(
            Boletin::class,
            'Id_boletin',
            'Id_Boletin'
        );
    }
}
