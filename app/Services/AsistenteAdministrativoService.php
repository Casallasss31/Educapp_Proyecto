<?php

namespace App\Services;

use App\Interfaces\AsistenteAdministrativoInterface;
use App\Models\AsistenteAdministrativo;
use Illuminate\Database\Eloquent\Collection;

class AsistenteAdministrativoService
{
    protected AsistenteAdministrativoInterface $asistenteAdministrativoRepository;

    public function __construct(
        AsistenteAdministrativoInterface $asistenteAdministrativoRepository
    ) {
        $this->asistenteAdministrativoRepository = $asistenteAdministrativoRepository;
    }

    public function getAll(): Collection
    {
        return $this->asistenteAdministrativoRepository->getAll();
    }

    public function findById(int $id): ?AsistenteAdministrativo
    {
        return $this->asistenteAdministrativoRepository->findById($id);
    }

    public function create(array $data): AsistenteAdministrativo
    {
        return $this->asistenteAdministrativoRepository->create($data);
    }

    public function update(int $id, array $data): ?AsistenteAdministrativo
    {
        return $this->asistenteAdministrativoRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->asistenteAdministrativoRepository->delete($id);
    }
}