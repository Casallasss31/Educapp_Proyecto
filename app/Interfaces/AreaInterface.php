<?php

namespace App\Interfaces;

use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

interface AreaInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Area;

    public function create(array $data): Area;

    public function update(int $id, array $data): ?Area;

    public function delete(int $id): bool;

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool;

    public function hasMaterias(int $id): bool;
}
