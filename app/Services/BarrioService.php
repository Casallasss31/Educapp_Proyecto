<?php

namespace App\Services;

use App\Interfaces\BarrioInterface;
use App\Models\Barrio;
use Illuminate\Database\Eloquent\Collection;

class BarrioService
{
    protected BarrioInterface $barrioRepository;

    public function __construct(BarrioInterface $barrioRepository)
    {
        $this->barrioRepository = $barrioRepository;
    }

    public function getAll(): Collection
    {
        return $this->barrioRepository->getAll();
    }

    public function findById(int $id): ?Barrio
    {
        return $this->barrioRepository->findById($id);
    }

    public function create(array $data): Barrio
    {
        return $this->barrioRepository->create($data);
    }

    public function update(int $id, array $data): ?Barrio
    {
        return $this->barrioRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->barrioRepository->delete($id);
    }
}