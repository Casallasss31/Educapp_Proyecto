<?php

namespace App\Services;

use App\Interfaces\BoletinInterface;
use App\Models\Boletin;
use Illuminate\Database\Eloquent\Collection;

class BoletinService
{
    protected BoletinInterface $boletinRepository;

    public function __construct(BoletinInterface $boletinRepository)
    {
        $this->boletinRepository = $boletinRepository;
    }

    public function getAll(): Collection
    {
        return $this->boletinRepository->getAll();
    }

    public function findById(int $id): ?Boletin
    {
        return $this->boletinRepository->findById($id);
    }

    public function create(array $data): Boletin
    {
        return $this->boletinRepository->create($data);
    }

    public function update(int $id, array $data): ?Boletin
    {
        return $this->boletinRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->boletinRepository->delete($id);
    }
}