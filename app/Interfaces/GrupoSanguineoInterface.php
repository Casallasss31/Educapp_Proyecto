<?php

namespace App\Interfaces;

use App\Models\GrupoSanguineo;
use Illuminate\Database\Eloquent\Collection;

interface GrupoSanguineoInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?GrupoSanguineo;

    public function create(array $data): GrupoSanguineo;

    public function update(
        int $id,
        array $data
    ): ?GrupoSanguineo;

    public function delete(int $id): bool;

    public function existsByGrupoAndRH(
        string $grupo,
        string $rh,
        ?int $excludeId = null
    ): bool;

    public function hasUsuarios(int $id): bool;
}
