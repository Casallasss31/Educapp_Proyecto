<?php

namespace App\Repositories;

use App\Interfaces\DetalleBoletinInterface;
use App\Models\DetalleBoletin;
use Illuminate\Database\Eloquent\Collection;

class DetalleBoletinRepository implements DetalleBoletinInterface
{
    public function getAll(): Collection
    {
        return DetalleBoletin::with([
            'docente.usuario',
            'boletin.estudiante.usuario',
            'boletin.materia'
        ])->get();
    }

    public function findById(int $id): ?DetalleBoletin
    {
        return DetalleBoletin::with([
            'docente.usuario',
            'boletin.estudiante.usuario',
            'boletin.materia'
        ])->find($id);
    }

    public function create(array $data): DetalleBoletin
    {
        $detalle = DetalleBoletin::create($data);

        return $detalle->load([
            'docente.usuario',
            'boletin.estudiante.usuario',
            'boletin.materia'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?DetalleBoletin {
        $detalle = DetalleBoletin::find($id);

        if (!$detalle) {
            return null;
        }

        $detalle->update($data);

        return $detalle->refresh()->load([
            'docente.usuario',
            'boletin.estudiante.usuario',
            'boletin.materia'
        ]);
    }

    public function delete(int $id): bool
    {
        $detalle = DetalleBoletin::find($id);

        if (!$detalle) {
            return false;
        }

        return (bool) $detalle->delete();
    }

    public function existsByDocenteAndBoletin(
        int $idDocente,
        int $idBoletin,
        ?int $excludeId = null
    ): bool {
        return DetalleBoletin::where(
            'Id_docentes',
            $idDocente
        )
            ->where('Id_boletin', $idBoletin)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_detalle_boletin',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function getByBoletin(
        int $idBoletin
    ): Collection {
        return DetalleBoletin::with([
            'docente.usuario',
            'boletin.materia'
        ])
            ->where('Id_boletin', $idBoletin)
            ->get();
    }
}
