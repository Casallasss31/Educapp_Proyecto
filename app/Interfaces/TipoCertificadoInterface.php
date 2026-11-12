<?php

namespace App\Interfaces;

use App\Models\TipoCertificado;
use Illuminate\Database\Eloquent\Collection;

interface TipoCertificadoInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?TipoCertificado;
    public function create(array $data): TipoCertificado;
    public function update(int $id, array $data): ?TipoCertificado;
    public function delete(int $id): bool;
    public function existsByNombre(string $nombre, ?int $excludeId = null): bool;
    public function hasCertificados(int $id): bool;
}
