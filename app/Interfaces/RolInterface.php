<?php

namespace App\Interfaces;

use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;

interface RolInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Rol;

    public function create(array $data): Rol;

    public function update(int $id, array $data): ?Rol;

    public function delete(int $id): bool;

    public function existsByTipo(
        string $tipo,
        ?int $excludeId = null
    ): bool;

    public function hasUsuarios(int $id): bool;
}
