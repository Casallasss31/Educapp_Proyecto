<?php

namespace App\Interfaces;

use App\Models\Certificado;
use Illuminate\Database\Eloquent\Collection;

interface CertificadoInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Certificado;

    public function create(array $data): Certificado;

    public function update(int $id, array $data): ?Certificado;

    public function delete(int $id): bool;
}