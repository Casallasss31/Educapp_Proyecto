<?php

namespace App\Interfaces;

use App\Models\DetalleBoletin;
use Illuminate\Database\Eloquent\Collection;

interface DetalleBoletinInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?DetalleBoletin;

    public function create(array $data): DetalleBoletin;

    public function update(
        int $id,
        array $data
    ): ?DetalleBoletin;

    public function delete(int $id): bool;

    public function existsByDocenteAndBoletin(
        int $idDocente,
        int $idBoletin,
        ?int $excludeId = null
    ): bool;

    public function getByBoletin(
        int $idBoletin
    ): Collection;
}
