<?php

namespace App\Interfaces;

use App\Models\AsistenteAdministrativo;
use Illuminate\Database\Eloquent\Collection;

interface AsistenteAdministrativoInterface
{
    public function getAll(): Collection;

    public function findById(int $id): ?AsistenteAdministrativo;

    public function create(array $data): AsistenteAdministrativo;

    public function update(int $id, array $data): ?AsistenteAdministrativo;

    public function delete(int $id): bool;
}