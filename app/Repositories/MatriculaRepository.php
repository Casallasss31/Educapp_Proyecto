<?php

namespace App\Repositories;

use App\Interfaces\MatriculaInterface;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Collection;

class MatriculaRepository implements MatriculaInterface
{
    public function getAll(): Collection
    {
        return Matricula::with([
            'estudiante.usuario',
            'estudiante.curso',
            'estudiante.acudiente'
        ])
            ->orderByDesc('Fecha_Matricula')
            ->get();
    }

    public function findById(int $id): ?Matricula
    {
        return Matricula::with([
            'estudiante.usuario',
            'estudiante.curso',
            'estudiante.acudiente'
        ])->find($id);
    }

    public function create(array $data): Matricula
    {
        $matricula = Matricula::create($data);

        return $matricula->load([
            'estudiante.usuario',
            'estudiante.curso',
            'estudiante.acudiente'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Matricula {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return null;
        }

        $matricula->update($data);

        return $matricula->refresh()->load([
            'estudiante.usuario',
            'estudiante.curso',
            'estudiante.acudiente'
        ]);
    }

    public function delete(int $id): bool
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return false;
        }

        return (bool) $matricula->delete();
    }

    public function existsByEstudianteAndAnio(
        int $idEstudiante,
        int $anio,
        ?int $excludeId = null
    ): bool {
        return Matricula::where(
            'Id_estudiante',
            $idEstudiante
        )
            ->whereYear('Fecha_Matricula', $anio)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Matricula',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function getByEstudiante(
        int $idEstudiante
    ): Collection {
        return Matricula::with([
            'estudiante.usuario',
            'estudiante.curso'
        ])
            ->where('Id_estudiante', $idEstudiante)
            ->orderByDesc('Fecha_Matricula')
            ->get();
    }
}
