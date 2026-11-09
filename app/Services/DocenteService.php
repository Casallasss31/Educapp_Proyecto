<?php

namespace App\Services;

use App\Interfaces\DocenteInterface;
use App\Models\Docente;
use Illuminate\Database\Eloquent\Collection;

class DocenteService
{
    protected DocenteInterface $docenteRepository;

    public function __construct(DocenteInterface $docenteRepository)
    {
        $this->docenteRepository = $docenteRepository;
    }

    public function getAll(): Collection
    {
        return $this->docenteRepository->getAll();
    }

    public function findById(int $id): ?Docente
    {
        return $this->docenteRepository->findById($id);
    }

    public function create(array $data): Docente
    {
        return $this->docenteRepository->create($data);
    }

    public function update(int $id, array $data): ?Docente
    {
        return $this->docenteRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->docenteRepository->delete($id);
    }
}