<?php

namespace App\Repositories;

use App\Interfaces\BarrioInterface;
use App\Models\Barrio;
use App\Models\Localidad;
use Illuminate\Database\Eloquent\Collection;

class BarrioRepository implements BarrioInterface
{
    public function getAll(): Collection
    {
        return Barrio::with('localidad')->get();
    }

    public function findById(int $id): ?Barrio
    {
        return Barrio::with('localidad')->find($id);
    }

    public function create(array $data): Barrio
    {
        $barrio = Barrio::create($data);

        return $barrio->load('localidad');
    }

    public function update(int $id, array $data): ?Barrio
    {
        $barrio = Barrio::find($id);

        if (!$barrio) {
            return null;
        }

        $barrio->update($data);

        return $barrio->refresh()->load('localidad');
    }

    public function delete(int $id): bool
    {
        $barrio = Barrio::find($id);

        if (!$barrio) {
            return false;
        }

        return (bool) $barrio->delete();
    }

    public function existsByNombreAndLocalidad(
        string $nombre,
        int $idLocalidad,
        ?int $excludeId = null
    ): bool {
        return Barrio::where('Nombre_Barrio', $nombre)
            ->where('Id_localidad', $idLocalidad)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where('Id_Barrio', '!=', $excludeId);
                }
            )
            ->exists();
    }

    public function existsLocalidad(int $idLocalidad): bool
    {
        return Localidad::whereKey($idLocalidad)->exists();
    }

    public function hasUsuarios(int $id): bool
    {
        return Barrio::whereKey($id)
            ->whereHas('usuarios')
            ->exists();
    }
}
