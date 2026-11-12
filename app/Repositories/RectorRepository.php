<?php

namespace App\Repositories;

use App\Interfaces\RectorInterface;
use App\Models\Rector;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class RectorRepository implements RectorInterface
{
    public function getAll(): Collection
    {
        return Rector::with([
            'usuario.rol',
            'profesion'
        ])->get();
    }

    public function findById(int $id): ?Rector
    {
        return Rector::with([
            'usuario.rol',
            'profesion'
        ])->find($id);
    }

    public function findUsuario(int $idUsuario): ?Usuario
    {
        return Usuario::with('rol')->find($idUsuario);
    }

    public function create(array $data): Rector
    {
        $rector = Rector::create($data);

        return $rector->load([
            'usuario.rol',
            'profesion'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Rector {
        $rector = Rector::find($id);

        if (!$rector) {
            return null;
        }

        $rector->update($data);

        return $rector->refresh()->load([
            'usuario.rol',
            'profesion'
        ]);
    }

    public function delete(int $id): bool
    {
        $rector = Rector::find($id);

        if (!$rector) {
            return false;
        }

        return (bool) $rector->delete();
    }

    public function existsById(int $id): bool
    {
        return Rector::whereKey($id)->exists();
    }

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool {
        return Rector::where(
            'Id_usuario',
            $idUsuario
        )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Rector',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }
}
