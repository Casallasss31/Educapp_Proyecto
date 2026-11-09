<?php

namespace App\Services;

use App\Interfaces\RolInterface;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;

class RolService
{
    protected RolInterface $rolRepository;

    public function __construct(RolInterface $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function getAll(): Collection
    {
        return $this->rolRepository->getAll();
    }

    public function findById(int $id): ?Rol
    {
        return $this->rolRepository->findById($id);
    }

    public function create(array $data): Rol
    {
        return $this->rolRepository->create($data);
    }

    public function update(int $id, array $data): ?Rol
    {
        return $this->rolRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->rolRepository->delete($id);
    }
}