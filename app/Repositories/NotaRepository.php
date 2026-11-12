<?php

namespace App\Repositories;

use App\Interfaces\NotaInterface;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Collection;

class NotaRepository implements NotaInterface
{
    public function getAll(): Collection
    {
        return Nota::all();
    }

    public function findById(int $id): ?Nota
    {
        return Nota::find($id);
    }

    public function create(array $data): Nota
    {
        return Nota::create($data);
    }

    public function update(int $id, array $data): ?Nota
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return null;
        }

        $nota->update($data);

        return $nota->refresh();
    }

    public function delete(int $id): bool
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return false;
        }

        return (bool) $nota->delete();
    }

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool {
        return Nota::where('Nombre_Nota', $nombre)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Nota',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasDetallesBoletin(int $id): bool
    {
        return Nota::whereKey($id)
            ->whereHas('detallesBoletin')
            ->exists();
    }
}
