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

    public function update(int $id, array $data): ?TipoCertificado
    {
        $tipoCertificado = TipoCertificado::find($id);

        if (!$tipoCertificado) {
            return null;
        }

        $tipoCertificado->update($data);

        return $tipoCertificado;
    }

    public function delete(int $id): bool
    {
        $tipoCertificado = TipoCertificado::find($id);

        if (!$tipoCertificado) {
            return false;
        }

        return (bool) $tipoCertificado->delete();
    }
}