<?php

namespace App\Repositories;

use App\Interfaces\BarrioInterface;
use App\Models\Barrio;
use Illuminate\Database\Eloquent\Collection;

class BarrioRepository implements BarrioInterface
{
    public function getAll(): Collection
    {
        return Barrio::all();
    }

    public function findById(int $id): ?Barrio
    {
        return Barrio::find($id);
    }

    public function create(array $data): Barrio
    {
        return Barrio::create($data);
    }

    public function update(int $id, array $data): ?Barrio
    {
        $barrio = Barrio::find($id);

        if (!$barrio) {
            return null;
        }

        $barrio->update($data);

        return $barrio;
    }

    public function delete(int $id): bool
    {
        $barrio = Barrio::find($id);

        if (!$barrio) {
            return false;
        }

        return (bool) $barrio->delete();
    }
}