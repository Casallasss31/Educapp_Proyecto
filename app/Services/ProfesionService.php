<?php

namespace App\Services;

use App\Interfaces\ProfesionInterface;
use App\Models\Profesion;
use Illuminate\Database\Eloquent\Collection;

class ProfesionService
{
    protected ProfesionInterface $profesionRepository;

    public function __construct(ProfesionInterface $profesionRepository)
    {
        $this->profesionRepository = $profesionRepository;
    }

    public function getAll(): Collection
    {
        return $this->profesionRepository->getAll();
    }

    public function findById(int $id): ?Profesion
    {
        return $this->profesionRepository->findById($id);
    }

    public function create(array $data): Profesion
    {
        return $this->profesionRepository->create($data);
    }

    public function update(int $id, array $data): ?Profesion
    {
        return $this->profesionRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->profesionRepository->delete($id);
    }
}