<?php

namespace App\Repositories;

use App\Interfaces\BoletinInterface;
use App\Models\Boletin;
use Illuminate\Database\Eloquent\Collection;

class BoletinRepository implements BoletinInterface
{
    public function getAll(): Collection
    {
        return Boletin::with([
            'estudiante.usuario',
            'materia.area'
        ])
            ->orderByDesc('Fecha_publicacion')
            ->get();
    }

    public function findById(int $id): ?Boletin
    {
        return Boletin::with([
            'estudiante.usuario',
            'materia.area'
        ])->find($id);
    }

    public function create(array $data): Boletin
    {
        $boletin = Boletin::create($data);

        return $boletin->load([
            'estudiante.usuario',
            'materia.area'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Boletin {
        $boletin = Boletin::find($id);

        if (!$boletin) {
            return null;
        }

        $boletin->update($data);

        return $boletin->refresh()->load([
            'estudiante.usuario',
            'materia.area'
        ]);
    }

    public function delete(int $id): bool
    {
        $boletin = Boletin::find($id);

        if (!$boletin) {
            return false;
        }

        return (bool) $boletin->delete();
    }

    public function existsByPeriodo(
        int $idEstudiante,
        int $idMateria,
        string $periodo,
        int $anio,
        ?int $excludeId = null
    ): bool {
        return Boletin::where(
            'Id_estudiante',
            $idEstudiante
        )
            ->where('Id_materia', $idMateria)
            ->where('Periodo', $periodo)
            ->whereYear('Fecha_publicacion', $anio)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Boletin',
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
        return Boletin::with([
            'estudiante.usuario',
            'materia.area'
        ])
            ->where('Id_estudiante', $idEstudiante)
            ->orderByDesc('Fecha_publicacion')
            ->get();
    }
}
