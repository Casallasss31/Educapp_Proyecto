<?php

namespace App\Repositories;

use App\Interfaces\AreaInterface;
use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

class AreaRepository implements AreaInterface
{
    public function getAll(): Collection
    {
        return Area::all();
    }

    public function findById(int $id): ?Area
    {
        return Area::find($id);
    }

    public function create(array $data): Area
    {
        return Area::create($data);
    }

    public function update(int $id, array $data): ?Area
    {
        $area = Area::find($id);

        if (!$area) {
            return null;
        }

        $area->update($data);

        return $area->refresh();
    }

    public function delete(int $id): bool
    {
        $area = Area::find($id);

        if (!$area) {
            return false;
        }

        return (bool) $area->delete();
    }

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool {
        return Area::where('Nombre_Area', $nombre)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Area',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasMaterias(int $id): bool
    {
        return Area::whereKey($id)
            ->whereHas('materias')
            ->exists();
    }
}
