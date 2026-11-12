<?php

namespace App\Interfaces;

use App\Models\EPS;
use Illuminate\Database\Eloquent\Collection;

interface EPSInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?EPS;

    public function create(array $data): EPS;

    public function update(int $id, array $data): ?EPS;

    public function delete(int $id): bool;

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool;

    public function hasUsuarios(int $id): bool;
}
