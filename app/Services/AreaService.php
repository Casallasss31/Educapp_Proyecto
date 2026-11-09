<?php

namespace App\Services;

use App\Interfaces\AreaInterface;
use App\Models\Area;
use Illuminate\Database\Eloquent\Collection;

class AreaService
{
    protected AreaInterface $areaRepository;

    public function __construct(AreaInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function getAll(): Collection
    {
        return $this->areaRepository->getAll();
    }

    public function findById(int $id): ?Area
    {
        return $this->areaRepository->findById($id);
    }

    public function create(array $data): Area
    {
        return $this->areaRepository->create($data);
    }

    public function update(int $id, array $data): ?Area
    {
        return $this->areaRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->areaRepository->delete($id);
    }
}