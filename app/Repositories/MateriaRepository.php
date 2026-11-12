<?php

namespace App\Repositories;

use App\Interfaces\MateriaInterface;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Collection;

class MateriaRepository implements MateriaInterface
{
    public function getAll(): Collection
    {
        return Materia::with([
            'area',
            'nota'
        ])->get();
    }

    public function findById(int $id): ?Materia
    {
        return Materia::with([
            'area',
            'nota'
        ])->find($id);
    }

    public function create(array $data): Materia
    {
        $materia = Materia::create($data);

        return $materia->load([
            'area',
            'nota'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Materia {
        $materia = Materia::find($id);

        if (!$materia) {
            return null;
        }

        $materia->update($data);

        return $materia->refresh()->load([
            'area',
            'nota'
        ]);
    }

    public function delete(int $id): bool
    {
        $materia = Materia::find($id);

        if (!$materia) {
            return false;
        }

        return (bool) $materia->delete();
    }

    public function existsByNameAndArea(
        string $nombre,
        int $idArea,
        ?int $excludeId = null
    ): bool {
        return Materia::whereRaw(
            'LOWER(TRIM(Nombre_Materia)) = ?',
            [mb_strtolower(trim($nombre))]
        )
            ->where('Id_area', $idArea)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Materia',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasHorarios(int $id): bool
    {
        return Materia::whereKey($id)
            ->whereHas('horarios')
            ->exists();
    }
}
