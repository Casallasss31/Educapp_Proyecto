<?php

namespace App\Repositories;

use App\Interfaces\BoletinInterface;
use App\Models\Boletin;
use Illuminate\Database\Eloquent\Collection;

class BoletinRepository implements BoletinInterface
{
    public function getAll(): Collection
    {
        return Boletin::all();
    }

    public function findById(int $id): ?Boletin
    {
        return Boletin::find($id);
    }

    public function create(array $data): Boletin
    {
        return Boletin::create($data);
    }

    public function update(int $id, array $data): ?Boletin
    {
        $boletin = Boletin::find($id);

        if (!$boletin) {
            return null;
        }

        $boletin->update($data);

        return $boletin;
    }

    public function delete(int $id): bool
    {
        $boletin = Boletin::find($id);

        if (!$boletin) {
            return false;
        }

        return (bool) $boletin->delete();
    }
}