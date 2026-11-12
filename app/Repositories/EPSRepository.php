<?php

namespace App\Repositories;

use App\Interfaces\EPSInterface;
use App\Models\EPS;
use Illuminate\Database\Eloquent\Collection;

class EPSRepository implements EPSInterface
{
    public function getAll(): Collection
    {
        return EPS::all();
    }

    public function findById(int $id): ?EPS
    {
        return EPS::find($id);
    }

    public function create(array $data): EPS
    {
        return EPS::create($data);
    }

    public function update(int $id, array $data): ?EPS
    {
        $eps = EPS::find($id);

        if (!$eps) {
            return null;
        }

        $eps->update($data);

        return $eps->refresh();
    }

    public function delete(int $id): bool
    {
        $eps = EPS::find($id);

        if (!$eps) {
            return false;
        }

        return (bool) $eps->delete();
    }

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool {
        return EPS::where('Nombre_Eps', $nombre)
            ->when($excludeId !== null, function ($query) use ($excludeId) {
                $query->where('Id_EPS', '!=', $excludeId);
            })
            ->exists();
    }

    public function hasUsuarios(int $id): bool
    {
        return EPS::whereKey($id)
            ->whereHas('usuarios')
            ->exists();
    }
}
