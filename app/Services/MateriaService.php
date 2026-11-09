<?php

namespace App\Services;

use App\Interfaces\MateriaInterface;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Collection;

class MateriaService
{
    protected MateriaInterface $materiaRepository;

    public function __construct(MateriaInterface $materiaRepository)
    {
        $this->materiaRepository = $materiaRepository;
    }

    public function getAll(): Collection
    {
        return $this->materiaRepository->getAll();
    }

    public function findById(int $id): ?Materia
    {
        return $this->materiaRepository->findById($id);
    }

    public function create(array $data): Materia
    {
        return $this->materiaRepository->create($data);
    }

    public function update(int $id, array $data): ?Materia
    {
        return $this->materiaRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->materiaRepository->delete($id);
    }
}