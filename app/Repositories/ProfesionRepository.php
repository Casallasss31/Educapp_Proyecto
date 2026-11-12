<?php

namespace App\Repositories;

use App\Interfaces\ProfesionInterface;
use App\Models\Profesion;
use Illuminate\Database\Eloquent\Collection;

class ProfesionRepository implements ProfesionInterface
{
    public function getAll(): Collection
    {
        return Profesion::all();
    }

    public function findById(int $id): ?Profesion
    {
        return Profesion::find($id);
    }

    public function create(array $data): Profesion
    {
        return Profesion::create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?Profesion {
        $profesion = Profesion::find($id);

        if (!$profesion) {
            return null;
        }

        $profesion->update($data);

        return $profesion->refresh();
    }

    public function delete(int $id): bool
    {
        $profesion = Profesion::find($id);

        if (!$profesion) {
            return false;
        }

        return (bool) $profesion->delete();
    }

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool {
        return Profesion::where('Nombre_Profesion', $nombre)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Profesion',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasAcudientes(int $id): bool
    {
        return Profesion::whereKey($id)
            ->whereHas('acudientes')
            ->exists();
    }
}
