<?php

namespace App\Interfaces;

use App\Models\Rector;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

interface RectorInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Rector;

    public function findUsuario(int $idUsuario): ?Usuario;

    public function create(array $data): Rector;

    public function update(
        int $id,
        array $data
    ): ?Rector;

    public function delete(int $id): bool;

    public function existsById(int $id): bool;

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool;
}
