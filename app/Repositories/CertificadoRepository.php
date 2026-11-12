<?php

namespace App\Repositories;

use App\Interfaces\CertificadoInterface;
use App\Models\Certificado;
use Illuminate\Database\Eloquent\Collection;

class CertificadoRepository implements CertificadoInterface
{
    public function getAll(): Collection
    {
        return Certificado::with([
            'tipoCertificado',
            'estudiante.usuario'
        ])->get();
    }

    public function findById(int $id): ?Certificado
    {
        return Certificado::with([
            'tipoCertificado',
            'estudiante.usuario'
        ])->find($id);
    }

    public function create(array $data): Certificado
    {
        $certificado = Certificado::create($data);

        return $certificado->load([
            'tipoCertificado',
            'estudiante.usuario'
        ]);
    }

    public function update(
        int $id,
        array $data
    ): ?Certificado {
        $certificado = Certificado::find($id);

        if (!$certificado) {
            return null;
        }

        $certificado->update($data);

        return $certificado->refresh()->load([
            'tipoCertificado',
            'estudiante.usuario'
        ]);
    }

    public function delete(int $id): bool
    {
        $certificado = Certificado::find($id);

        if (!$certificado) {
            return false;
        }

        return (bool) $certificado->delete();
    }

    public function existsByDetails(
        string $nombre,
        int $anio,
        int $idTipo,
        int $idEstudiante,
        ?int $excludeId = null
    ): bool {
        return Certificado::whereRaw(
            'LOWER(TRIM(Nombre_Certificado)) = ?',
            [mb_strtolower(trim($nombre))]
        )
            ->where('Año', $anio)
            ->where('Id_Tipo_Certificado', $idTipo)
            ->where('Id_estudiante', $idEstudiante)
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Certificado',
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
        return Certificado::with([
            'tipoCertificado',
            'estudiante.usuario'
        ])
            ->where('Id_estudiante', $idEstudiante)
            ->orderByDesc('Año')
            ->get();
    }
}
