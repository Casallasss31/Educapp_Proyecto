<?php

namespace App\Repositories;

use App\Interfaces\AsistenteAdministrativoInterface;
use App\Models\AsistenteAdministrativo;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class AsistenteAdministrativoRepository implements AsistenteAdministrativoInterface
{
    public function getAll(): Collection
    {
        return AsistenteAdministrativo::with([
            'usuario.rol',
            'profesion'
        ])->get();
    }

    public function findById(
        int $id
    ): ?AsistenteAdministrativo {
        return AsistenteAdministrativo::with([
            'usuario.rol',
            'profesion'
        ])->find($id);
    }

    public function findUsuario(
        int $idUsuario
    ): ?Usuario {
        return Usuario::with('rol')->find($idUsuario);
    }

    public function create(
        array $data
    ): AsistenteAdministrativo {
        $asistente = AsistenteAdministrativo::create(
            $data
        );

        return $asistente->load([
            'usuario.rol',
            'profesion'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?AsistenteAdministrativo {
        $asistente = AsistenteAdministrativo::find($id);

        if (!$asistente) {
            return null;
        }

        $asistente->update($data);

        return $asistente->refresh()->load([
            'usuario.rol',
            'profesion'
        ]);
    }

    public function delete(int $id): bool
    {
        $asistente = AsistenteAdministrativo::find($id);

        if (!$asistente) {
            return false;
        }

        return (bool) $asistente->delete();
    }

    public function existsById(int $id): bool
    {
        return AsistenteAdministrativo::whereKey(
            $id
        )->exists();
    }

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool {
        return AsistenteAdministrativo::where(
            'Id_usuario',
            $idUsuario
        )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Asistente_Administrativo',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }
}
