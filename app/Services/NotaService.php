<?php

namespace App\Services;

use App\Interfaces\NotaInterface;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Collection;

class NotaService
{
    protected NotaInterface $notaRepository;

    public function __construct(NotaInterface $notaRepository)
    {
        $this->notaRepository = $notaRepository;
    }

    public function getAll(): Collection
    {
        return $this->notaRepository->getAll();
    }

    public function findById(int $id): ?Nota
    {
        return $this->notaRepository->findById($id);
    }

    public function create(array $data): Nota
    {
        return $this->notaRepository->create($data);
    }

    public function update(int $id, array $data): ?Nota
    {
        return $this->notaRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->notaRepository->delete($id);
    }
}