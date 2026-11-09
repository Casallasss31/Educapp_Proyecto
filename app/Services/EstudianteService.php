<?php

namespace App\Services;

use App\Interfaces\EstudianteInterface;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Collection;

class EstudianteService
{
    protected EstudianteInterface $estudianteRepository;

    public function __construct(EstudianteInterface $estudianteRepository)
    {
        $this->estudianteRepository = $estudianteRepository;
    }

    public function getAll(): Collection
    {
        return $this->estudianteRepository->getAll();
    }

    public function findById(int $id): ?Estudiante
    {
        return $this->estudianteRepository->findById($id);
    }

    public function create(array $data): Estudiante
    {
        return $this->estudianteRepository->create($data);
    }

    public function update(int $id, array $data): ?Estudiante
    {
        return $this->estudianteRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->estudianteRepository->delete($id);
    }
}