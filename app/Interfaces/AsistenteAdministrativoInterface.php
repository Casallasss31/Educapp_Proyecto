<?php

namespace App\Interfaces;

use App\Models\AsistenteAdministrativo;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

interface AsistenteAdministrativoInterface
{
    public function getAll(): Collection;

    public function findById(
        int $id
    ): ?AsistenteAdministrativo;

    public function findUsuario(
        int $idUsuario
    ): ?Usuario;

    public function create(
        array $data
    ): AsistenteAdministrativo;

    public function update(
        int $id,
        array $data
    ): ?AsistenteAdministrativo;

    public function delete(int $id): bool;

    public function existsById(int $id): bool;

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool;
}
