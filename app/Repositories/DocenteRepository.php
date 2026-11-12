<?php

namespace App\Repositories;

use App\Interfaces\DocenteInterface;
use App\Models\Docente;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class DocenteRepository implements DocenteInterface
{
    public function getAll(): Collection
    {
        return Docente::with([
            'usuario.rol',
            'profesion'
        ])->get();
    }

    public function findById(int $id): ?Docente
    {
        return Docente::with([
            'usuario.rol',
            'profesion',
            'cursos'
        ])->find($id);
    }

    public function findUsuario(int $idUsuario): ?Usuario
    {
        return Usuario::with('rol')->find($idUsuario);
    }

    public function create(array $data): Docente
    {
        $docente = Docente::create($data);

        return $docente->load([
            'usuario.rol',
            'profesion'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Docente {
        $docente = Docente::find($id);

        if (!$docente) {
            return null;
        }

        $docente->update($data);

        return $docente->refresh()->load([
            'usuario.rol',
            'profesion'
        ]);
    }

    public function delete(int $id): bool
    {
        $docente = Docente::find($id);

        if (!$docente) {
            return false;
        }

        return (bool) $docente->delete();
    }

    public function existsById(int $id): bool
    {
        return Docente::whereKey($id)->exists();
    }

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool {
        return Docente::where(
            'Id_usuario',
            $idUsuario
        )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Docente',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasCursos(int $id): bool
    {
        return Docente::whereKey($id)
            ->whereHas('cursos')
            ->exists();
    }
}
