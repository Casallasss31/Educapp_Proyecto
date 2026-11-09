<?php

namespace App\Services;

use App\Interfaces\CertificadoInterface;
use App\Models\Certificado;
use Illuminate\Database\Eloquent\Collection;

class CertificadoService
{
    protected CertificadoInterface $certificadoRepository;

    public function __construct(CertificadoInterface $certificadoRepository)
    {
        $this->certificadoRepository = $certificadoRepository;
    }

    public function getAll(): Collection
    {
        return $this->certificadoRepository->getAll();
    }

    public function findById(int $id): ?Certificado
    {
        return $this->certificadoRepository->findById($id);
    }

    public function create(array $data): Certificado
    {
        return $this->certificadoRepository->create($data);
    }

    public function update(int $id, array $data): ?Certificado
    {
        return $this->certificadoRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->certificadoRepository->delete($id);
    }
}