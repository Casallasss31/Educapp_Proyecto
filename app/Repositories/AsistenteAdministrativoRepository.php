<?php

namespace App\Repositories;

use App\Interfaces\AsistenteAdministrativoInterface;
use App\Models\AsistenteAdministrativo;
use Illuminate\Database\Eloquent\Collection;

class AsistenteAdministrativoRepository implements AsistenteAdministrativoInterface
{
    public function getAll(): Collection
    {
        return AsistenteAdministrativo::all();
    }

    public function findById(int $id): ?AsistenteAdministrativo
    {
        return AsistenteAdministrativo::find($id);
    }

    public function create(array $data): AsistenteAdministrativo
    {
        return AsistenteAdministrativo::create($data);
    }

    public function update(int $id, array $data): ?AsistenteAdministrativo
    {
        $asistente = AsistenteAdministrativo::find($id);

        if (!$asistente) {
            return null;
        }

        $asistente->update($data);

        return $asistente;
    }

    public function delete(int $id): bool
    {
        $asistente = AsistenteAdministrativo::find($id);

        if (!$asistente) {
            return false;
        }

        return (bool) $asistente->delete();
    }
}