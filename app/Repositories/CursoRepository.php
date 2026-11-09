<?php

namespace App\Repositories;

use App\Interfaces\CursoInterface;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;

class CursoRepository implements CursoInterface
{
    public function getAll(): Collection
    {
        return Curso::all();
    }

    public function findById(int $id): ?Curso
    {
        return Curso::find($id);
    }

    public function create(array $data): Curso
    {
        return Curso::create($data);
    }

    public function update(int $id, array $data): ?Curso
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return null;
        }

        $curso->update($data);

        return $curso;
    }

    public function delete(int $id): bool
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return false;
        }

        return (bool) $curso->delete();
    }
}