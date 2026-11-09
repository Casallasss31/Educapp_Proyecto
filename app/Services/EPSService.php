<?php

namespace App\Services;

use App\Interfaces\EPSInterface;
use App\Models\EPS;
use Illuminate\Database\Eloquent\Collection;

class EPSService
{
    protected EPSInterface $epsRepository;

    public function __construct(EPSInterface $epsRepository)
    {
        $this->epsRepository = $epsRepository;
    }

    public function getAll(): Collection
    {
        return $this->epsRepository->getAll();
    }

    public function findById(int $id): ?EPS
    {
        return $this->epsRepository->findById($id);
    }

    public function create(array $data): EPS
    {
        return $this->epsRepository->create($data);
    }

    public function update(int $id, array $data): ?EPS
    {
        return $this->epsRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->epsRepository->delete($id);
    }
}