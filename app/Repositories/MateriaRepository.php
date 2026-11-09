<?php

namespace App\Repositories;

use App\Interfaces\MateriaInterface;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Collection;

class MateriaRepository implements MateriaInterface
{
    public function getAll(): Collection
    {
        return Materia::all();
    }

    public function findById(int $id): ?Materia
    {
        return Materia::find($id);
    }

    public function create(array $data): Materia
    {
        return Materia::create($data);
    }

    public function update(int $id, array $data): ?Materia
    {
        $materia = Materia::find($id);

        if (!$materia) {
            return null;
        }

        $materia->update($data);

        return $materia;
    }

    public function delete(int $id): bool
    {
        $materia = Materia::find($id);

        if (!$materia) {
            return false;
        }

        return (bool) $materia->delete();
    }
}