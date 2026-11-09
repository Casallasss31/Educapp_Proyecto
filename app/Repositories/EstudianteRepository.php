<?php

namespace App\Repositories;

use App\Interfaces\EstudianteInterface;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Collection;

class EstudianteRepository implements EstudianteInterface
{
    public function getAll(): Collection
    {
        return Estudiante::all();
    }

    public function findById(int $id): ?Estudiante
    {
        return Estudiante::find($id);
    }

    public function create(array $data): Estudiante
    {
        return Estudiante::create($data);
    }

    public function update(int $id, array $data): ?Estudiante
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return null;
        }

        $estudiante->update($data);

        return $estudiante;
    }

    public function delete(int $id): bool
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return false;
        }

        return (bool) $estudiante->delete();
    }
}