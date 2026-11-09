<?php

namespace App\Services;

use App\Interfaces\AcudienteInterface;
use App\Models\Acudiente;
use Illuminate\Database\Eloquent\Collection;

class AcudienteService
{
    protected AcudienteInterface $acudienteRepository;

    public function __construct(AcudienteInterface $acudienteRepository)
    {
        $this->acudienteRepository = $acudienteRepository;
    }

    public function getAll(): Collection
    {
        return $this->acudienteRepository->getAll();
    }

    public function findById(int $id): ?Acudiente
    {
        return $this->acudienteRepository->findById($id);
    }

    public function create(array $data): Acudiente
    {
        return $this->acudienteRepository->create($data);
    }

    public function update(int $id, array $data): ?Acudiente
    {
        return $this->acudienteRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->acudienteRepository->delete($id);
    }
}