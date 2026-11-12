<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rector extends Model
{
    protected $table = 'rector';

    protected $primaryKey = 'Id_Rector';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Id_Rector',
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
