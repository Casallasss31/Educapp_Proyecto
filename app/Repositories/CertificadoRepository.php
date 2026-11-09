<?php

namespace App\Repositories;

use App\Interfaces\CertificadoInterface;
use App\Models\Certificado;
use Illuminate\Database\Eloquent\Collection;

class CertificadoRepository implements CertificadoInterface
{
    public function getAll(): Collection
    {
        return Certificado::all();
    }

    public function findById(int $id): ?Certificado
    {
        return Certificado::find($id);
    }

    public function create(array $data): Certificado
    {
        return Certificado::create($data);
    }

    public function update(int $id, array $data): ?Certificado
    {
        $certificado = Certificado::find($id);

        if (!$certificado) {
            return null;
        }

        $certificado->update($data);

        return $certificado;
    }

    public function delete(int $id): bool
    {
        $certificado = Certificado::find($id);

        if (!$certificado) {
            return false;
        }

        return (bool) $certificado->delete();
    }
}