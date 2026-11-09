<?php

namespace App\Services;

use App\Interfaces\TipoCertificadoInterface;
use App\Models\TipoCertificado;
use Illuminate\Database\Eloquent\Collection;

class TipoCertificadoService
{
    protected TipoCertificadoInterface $tipoCertificadoRepository;

    public function __construct(
        TipoCertificadoInterface $tipoCertificadoRepository
    ) {
        $this->tipoCertificadoRepository = $tipoCertificadoRepository;
    }

    public function getAll(): Collection
    {
        return $this->tipoCertificadoRepository->getAll();
    }

    public function findById(int $id): ?TipoCertificado
    {
        return $this->tipoCertificadoRepository->findById($id);
    }

    public function create(array $data): TipoCertificado
    {
        return $this->tipoCertificadoRepository->create($data);
    }

    public function update(int $id, array $data): ?TipoCertificado
    {
        return $this->tipoCertificadoRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->tipoCertificadoRepository->delete($id);
    }
}