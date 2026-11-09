<?php

namespace App\Services;

use App\Interfaces\RectorInterface;
use App\Models\Rector;
use Illuminate\Database\Eloquent\Collection;

class RectorService
{
    protected RectorInterface $rectorRepository;

    public function __construct(RectorInterface $rectorRepository)
    {
        $this->rectorRepository = $rectorRepository;
    }

    public function getAll(): Collection
    {
        return $this->rectorRepository->getAll();
    }

    public function findById(int $id): ?Rector
    {
        return $this->rectorRepository->findById($id);
    }

    public function create(array $data): Rector
    {
        return $this->rectorRepository->create($data);
    }

    public function update(int $id, array $data): ?Rector
    {
        return $this->rectorRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->rectorRepository->delete($id);
    }
}