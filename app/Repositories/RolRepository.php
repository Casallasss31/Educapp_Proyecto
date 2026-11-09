<?php

namespace App\Repositories;

use App\Interfaces\RolInterface;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;

class RolRepository implements RolInterface
{
    public function getAll(): Collection
    {
        return Rol::all();
    }

    public function findById(int $id): ?Rol
    {
        return Rol::find($id);
    }

    public function create(array $data): Rol
    {
        return Rol::create($data);
    }

    public function update(int $id, array $data): ?Rol
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return null;
        }

        $rol->update($data);

        return $rol;
    }

    public function delete(int $id): bool
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return false;
        }

        return (bool) $rol->delete();
    }
}