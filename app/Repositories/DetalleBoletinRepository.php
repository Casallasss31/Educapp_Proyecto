<?php

namespace App\Repositories;

use App\Interfaces\DetalleBoletinInterface;
use App\Models\DetalleBoletin;
use Illuminate\Database\Eloquent\Collection;

class DetalleBoletinRepository implements DetalleBoletinInterface
{
    public function getAll(): Collection
    {
        return DetalleBoletin::all();
    }

    public function findById(int $id): ?DetalleBoletin
    {
        return DetalleBoletin::find($id);
    }

    public function create(array $data): DetalleBoletin
    {
        return DetalleBoletin::create($data);
    }

    public function update(int $id, array $data): ?DetalleBoletin
    {
        $detalleBoletin = DetalleBoletin::find($id);

        if (!$detalleBoletin) {
            return null;
        }

        $detalleBoletin->update($data);

        return $detalleBoletin;
    }

    public function delete(int $id): bool
    {
        $detalleBoletin = DetalleBoletin::find($id);

        if (!$detalleBoletin) {
            return false;
        }

        return (bool) $detalleBoletin->delete();
    }
}
