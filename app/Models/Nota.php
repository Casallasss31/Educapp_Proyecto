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

    public $timestamps = false;

    protected $fillable = [
        'Nombre_Nota',
        'nota'
    ];

    protected function casts(): array
    {
        return [
            'nota' => 'decimal:1'
        ];
    }

    public function materias(): HasMany
    {
        return $this->hasMany(
            Materia::class,
            'Id_nota',
            'Id_Nota'
        );
    }
}