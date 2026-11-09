<?php

namespace App\Services;

use App\Interfaces\MatriculaInterface;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Collection;

class MatriculaService
{
    protected MatriculaInterface $matriculaRepository;

    public function __construct(MatriculaInterface $matriculaRepository)
    {
        $this->matriculaRepository = $matriculaRepository;
    }

    public function getAll(): Collection
    {
        return $this->matriculaRepository->getAll();
    }

    public function findById(int $id): ?Matricula
    {
        return $this->matriculaRepository->findById($id);
    }

    public function create(array $data): Matricula
    {
        return $this->matriculaRepository->create($data);
    }

    public function update(int $id, array $data): ?Matricula
    {
        return $this->matriculaRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->matriculaRepository->delete($id);
    }
}