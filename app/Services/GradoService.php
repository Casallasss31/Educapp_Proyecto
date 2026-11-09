<?php

namespace App\Services;

use App\Interfaces\GradoInterface;
use App\Models\Grado;
use Illuminate\Database\Eloquent\Collection;

class GradoService
{
    protected GradoInterface $gradoRepository;

    public function __construct(GradoInterface $gradoRepository)
    {
        $this->gradoRepository = $gradoRepository;
    }

    public function getAll(): Collection
    {
        return $this->gradoRepository->getAll();
    }

    public function findById(int $id): ?Grado
    {
        return $this->gradoRepository->findById($id);
    }

    public function create(array $data): Grado
    {
        return $this->gradoRepository->create($data);
    }

    public function update(int $id, array $data): ?Grado
    {
        return $this->gradoRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->gradoRepository->delete($id);
    }
}