<?php

namespace App\Interfaces;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

interface UsuarioInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?Usuario;

    public function create(array $data): Usuario;

    public function update(
        int $id,
        array $data
    ): ?Usuario;

    public function delete(int $id): bool;

    public function existsByDocumento(
        string $tipoDocumento,
        string $numeroDocumento,
        ?int $excludeId = null
    ): bool;

    public function existsByCorreo(
        string $correo,
        ?int $excludeId = null
    ): bool;
}
