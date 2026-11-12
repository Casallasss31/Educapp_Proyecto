<?php

namespace App\Repositories;

use App\Interfaces\EstudianteInterface;
use App\Models\Estudiante;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class EstudianteRepository implements EstudianteInterface
{
    public function getAll(): Collection
    {
        return Estudiante::with([
            'usuario.rol',
            'acudiente.usuario',
            'curso.grado'
        ])->get();
    }

    public function findById(int $id): ?Estudiante
    {
        return Estudiante::with([
            'usuario.rol',
            'acudiente.usuario',
            'curso.grado',
            'matriculas'
        ])->find($id);
    }

    public function findUsuario(int $idUsuario): ?Usuario
    {
        return Usuario::with('rol')->find($idUsuario);
    }

    public function create(array $data): Estudiante
    {
        $estudiante = Estudiante::create($data);

        return $estudiante->load([
            'usuario.rol',
            'acudiente.usuario',
            'curso.grado'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Estudiante {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return null;
        }

        $estudiante->update($data);

        return $estudiante->refresh()->load([
            'usuario.rol',
            'acudiente.usuario',
            'curso.grado'
        ]);
    }

    public function delete(int $id): bool
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return false;
        }

        return (bool) $estudiante->delete();
    }

    public function existsById(int $id): bool
    {
        return Estudiante::whereKey($id)->exists();
    }

    public function existsByUsuario(
        int $idUsuario,
        ?int $excludeId = null
    ): bool {
        return Estudiante::where(
            'Id_usuario',
            $idUsuario
        )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Estudiante',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasMatriculas(int $id): bool
    {
        return Estudiante::whereKey($id)
            ->whereHas('matriculas')
            ->exists();
    }
}
