<?php

namespace App\Interfaces;

use App\Models\Certificado;
use Illuminate\Database\Eloquent\Collection;

interface CertificadoInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Certificado;

    public function create(array $data): Certificado;

    public function update(
        int $id,
        array $data
    ): ?Certificado;

    public function delete(int $id): bool;

    public function existsByDetails(
        string $nombre,
        int $anio,
        int $idTipo,
        int $idEstudiante,
        ?int $excludeId = null
    ): bool;

    public function getByEstudiante(
        int $idEstudiante
    ): Collection;
}
