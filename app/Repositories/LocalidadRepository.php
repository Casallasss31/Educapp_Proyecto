<?php

namespace App\Repositories;

use App\Interfaces\LocalidadInterface;
use App\Models\Localidad;
use Illuminate\Database\Eloquent\Collection;

class LocalidadRepository implements LocalidadInterface
{
    public function getAll(): Collection
    {
        return Localidad::all();
    }

    public function findById(int $id): ?Localidad
    {
        return Localidad::find($id);
    }

    public function create(array $data): Localidad
    {
        return Localidad::create($data);
    }

    public function update(int $id, array $data): ?Localidad
    {
        $localidad = Localidad::find($id);

        if (!$localidad) {
            return null;
        }

        $localidad->update($data);

        return $localidad->refresh();
    }

    public function delete(int $id): bool
    {
        $localidad = Localidad::find($id);

        if (!$localidad) {
            return false;
        }

        return (bool) $localidad->delete();
    }

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool {
        return Localidad::where('Nombre_Localidad', $nombre)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Localidad',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasBarrios(int $id): bool
    {
        return Localidad::whereKey($id)
            ->whereHas('barrios')
            ->exists();
    }
}
