<?php

namespace App\Repositories;

use App\Interfaces\AcudienteInterface;
use App\Models\Acudiente;
use Illuminate\Database\Eloquent\Collection;

class AcudienteRepository implements AcudienteInterface
{
    public function getAll(): Collection
    {
        return Acudiente::all();
    }

    public function findById(int $id): ?Acudiente
    {
        return Acudiente::find($id);
    }

    public function create(array $data): Acudiente
    {
        return Acudiente::create($data);
    }

    public function update(int $id, array $data): ?Acudiente
    {
        $acudiente = Acudiente::find($id);

        if (!$acudiente) {
            return null;
        }

        $acudiente->update($data);

        return $acudiente;
    }

    public function delete(int $id): bool
    {
        $acudiente = Acudiente::find($id);

        if (!$acudiente) {
            return false;
        }

        return (bool) $acudiente->delete();
    }
}