<?php

namespace App\Repositories;

use App\Interfaces\GrupoSanguineoInterface;
use App\Models\GrupoSanguineo;
use Illuminate\Database\Eloquent\Collection;

class GrupoSanguineoRepository implements GrupoSanguineoInterface
{
    public function getAll(): Collection
    {
        return GrupoSanguineo::all();
    }

    public function findById(int $id): ?GrupoSanguineo
    {
        return GrupoSanguineo::find($id);
    }

    public function create(array $data): GrupoSanguineo
    {
        return GrupoSanguineo::create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?GrupoSanguineo {
        $grupoSanguineo = GrupoSanguineo::find($id);

        if (!$grupoSanguineo) {
            return null;
        }

        $grupoSanguineo->update($data);

        return $grupoSanguineo->refresh();
    }

    public function delete(int $id): bool
    {
        $grupoSanguineo = GrupoSanguineo::find($id);

        if (!$grupoSanguineo) {
            return false;
        }

        return (bool) $grupoSanguineo->delete();
    }

    public function existsByGrupoAndRH(
        string $grupo,
        string $rh,
        ?int $excludeId = null
    ): bool {
        return GrupoSanguineo::where('Grupo', $grupo)
            ->where('RH', $rh)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_GRUPO_SANGUINEO',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasUsuarios(int $id): bool
    {
        return GrupoSanguineo::whereKey($id)
            ->whereHas('usuarios')
            ->exists();
    }
}
