<?php

namespace App\Repositories;

use App\Interfaces\MatriculaInterface;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Collection;

class MatriculaRepository implements MatriculaInterface
{
    public function getAll(): Collection
    {
        return Matricula::all();
    }

    public function findById(int $id): ?Matricula
    {
        return Matricula::find($id);
    }

    public function create(array $data): Matricula
    {
        return Matricula::create($data);
    }

    public function update(int $id, array $data): ?Matricula
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return null;
        }

        $matricula->update($data);

        return $matricula;
    }

    public function delete(int $id): bool
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return false;
        }

        return (bool) $matricula->delete();
    }
}