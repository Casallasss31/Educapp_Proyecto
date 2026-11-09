<?php

namespace App\Repositories;

use App\Interfaces\LocalidadInterface;
use App\Models\Localidad;
use Illuminate\Database\Eloquent\Collection;

class LocalidadRepository implements LocalidadInterface
{
    public function getAll(): Collection
    {
        return Localidad::all();
    }

    public function findById(int $id): ?Localidad
    {
        return Localidad::find($id);
    }

    public function create(array $data): Localidad
    {
        return Localidad::create($data);
    }

    public function update(int $id, array $data): ?Localidad
    {
        $localidad = Localidad::find($id);

        if (!$localidad) {
            return null;
        }

        $localidad->update($data);

        return $localidad;
    }

    public function delete(int $id): bool
    {
        $localidad = Localidad::find($id);

        if (!$localidad) {
            return false;
        }

        return (bool) $localidad->delete();
    }
}