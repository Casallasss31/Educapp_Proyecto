<?php

namespace App\Interfaces;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Collection;

interface MateriaInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Materia;

    public function create(array $data): Materia;

    public function update(
        int $id,
        array $data
    ): ?Materia;

    public function delete(int $id): bool;

    public function existsByNameAndArea(
        string $nombre,
        int $idArea,
        ?int $excludeId = null
    ): bool;

    public function hasHorarios(int $id): bool;
}
