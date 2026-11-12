<?php

namespace App\Repositories;

use App\Interfaces\CursoInterface;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;

class CursoRepository implements CursoInterface
{
    public function getAll(): Collection
    {
        return Curso::with([
            'grado',
            'docente.usuario'
        ])->get();
    }

    public function findById(int $id): ?Curso
    {
        return Curso::with([
            'grado',
            'docente.usuario'
        ])->find($id);
    }

    public function create(array $data): Curso
    {
        $curso = Curso::create($data);

        return $curso->load([
            'grado',
            'docente.usuario'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Curso {
        $curso = Curso::find($id);

        if (!$curso) {
            return null;
        }

        $curso->update($data);

        return $curso->refresh()->load([
            'grado',
            'docente.usuario'
        ]);
    }

    public function delete(int $id): bool
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return false;
        }

        return (bool) $curso->delete();
    }

    public function existsById(int $id): bool
    {
        return Curso::whereKey($id)->exists();
    }

    public function existsByGradoAndAnio(
        int $idGrado,
        int $anio,
        ?int $excludeId = null
    ): bool {
        return Curso::where('Id_grado', $idGrado)
            ->where('Año', $anio)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Curso',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasEstudiantes(int $id): bool
    {
        return Curso::whereKey($id)
            ->whereHas('estudiantes')
            ->exists();
    }
}
