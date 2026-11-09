<?php

namespace App\Services;

use App\Interfaces\CursoInterface;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;

class CursoService
{
    protected CursoInterface $cursoRepository;

    public function __construct(CursoInterface $cursoRepository)
    {
        $this->cursoRepository = $cursoRepository;
    }

    public function getAll(): Collection
    {
        return $this->cursoRepository->getAll();
    }

    public function findById(int $id): ?Curso
    {
        return $this->cursoRepository->findById($id);
    }

    public function create(array $data): Curso
    {
        return $this->cursoRepository->create($data);
    }

    public function update(int $id, array $data): ?Curso
    {
        return $this->cursoRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->cursoRepository->delete($id);
    }
}