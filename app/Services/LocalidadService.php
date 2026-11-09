<?php

namespace App\Services;

use App\Interfaces\LocalidadInterface;
use App\Models\Localidad;
use Illuminate\Database\Eloquent\Collection;

class LocalidadService
{
    protected LocalidadInterface $localidadRepository;

    public function __construct(LocalidadInterface $localidadRepository)
    {
        $this->localidadRepository = $localidadRepository;
    }

    public function getAll(): Collection
    {
        return $this->localidadRepository->getAll();
    }

    public function findById(int $id): ?Localidad
    {
        return $this->localidadRepository->findById($id);
    }

    public function create(array $data): Localidad
    {
        return $this->localidadRepository->create($data);
    }

    public function update(int $id, array $data): ?Localidad
    {
        return $this->localidadRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->localidadRepository->delete($id);
    }
}