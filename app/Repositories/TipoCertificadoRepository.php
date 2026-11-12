<?php

namespace App\Repositories;

use App\Interfaces\TipoCertificadoInterface;
use App\Models\TipoCertificado;
use Illuminate\Database\Eloquent\Collection;

class TipoCertificadoRepository implements TipoCertificadoInterface
{
    public function getAll(): Collection
    {
        return TipoCertificado::all();
    }

    public function findById(int $id): ?TipoCertificado
    {
        return TipoCertificado::find($id);
    }

    public function create(array $data): TipoCertificado
    {
        return TipoCertificado::create($data);
    }

    public function update(
        int $id,
        array $data
    ): ?TipoCertificado {
        $tipoCertificado = TipoCertificado::find($id);

        if (!$tipoCertificado) {
            return null;
        }

        $tipoCertificado->update($data);

        return $tipoCertificado->refresh();
    }

    public function delete(int $id): bool
    {
        $tipoCertificado = TipoCertificado::find($id);

        if (!$tipoCertificado) {
            return false;
        }

        return (bool) $tipoCertificado->delete();
    }

    public function existsByNombre(
        string $nombre,
        ?int $excludeId = null
    ): bool {
        return TipoCertificado::where(
            'Nombre_Certificado',
            $nombre
        )
            ->when(
                $excludeId !== null,
                function ($query) use ($excludeId) {
                    $query->where(
                        'Id_Tipo_Certificado',
                        '!=',
                        $excludeId
                    );
                }
            )
            ->exists();
    }

    public function hasCertificados(int $id): bool
    {
        return TipoCertificado::whereKey($id)
            ->whereHas('certificados')
            ->exists();
    }
}

