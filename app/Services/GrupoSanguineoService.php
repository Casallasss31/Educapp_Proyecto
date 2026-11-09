<?php

namespace App\Services;

use App\Interfaces\GrupoSanguineoInterface;
use App\Models\GrupoSanguineo;
use Illuminate\Database\Eloquent\Collection;

class GrupoSanguineoService
{
    protected GrupoSanguineoInterface $grupoSanguineoRepository;

    public function __construct(
        GrupoSanguineoInterface $grupoSanguineoRepository
    ) {
        $this->grupoSanguineoRepository = $grupoSanguineoRepository;
    }

    public function getAll(): Collection
    {
        return $this->grupoSanguineoRepository->getAll();
    }

    public function findById(int $id): ?GrupoSanguineo
    {
        return $this->grupoSanguineoRepository->findById($id);
    }

    public function create(array $data): GrupoSanguineo
    {
        return $this->grupoSanguineoRepository->create($data);
    }

    public function update(int $id, array $data): ?GrupoSanguineo
    {
        return $this->grupoSanguineoRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->grupoSanguineoRepository->delete($id);
    }
}