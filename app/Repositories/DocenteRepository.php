<?php

namespace App\Repositories;

use App\Interfaces\DocenteInterface;
use App\Models\Docente;
use Illuminate\Database\Eloquent\Collection;

class DocenteRepository implements DocenteInterface
{
    public function getAll(): Collection
    {
        return Docente::all();
    }

    public function findById(int $id): ?Docente
    {
        return Docente::find($id);
    }

    public function create(array $data): Docente
    {
        return Docente::create($data);
    }

    public function update(int $id, array $data): ?Docente
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return null;
        }

        $docente->update($data);

        return $docente;
    }

    public function delete(int $id): bool
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return false;
        }

        return (bool) $docente->delete();
    }
}