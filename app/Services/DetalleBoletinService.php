<?php

namespace App\Services;

use App\Interfaces\DetalleBoletinInterface;
use App\Models\DetalleBoletin;
use Illuminate\Database\Eloquent\Collection;

class DetalleBoletinService
{
    protected DetalleBoletinInterface $detalleBoletinRepository;

    public function __construct(DetalleBoletinInterface $detalleBoletinRepository)
    {
        $this->detalleBoletinRepository = $detalleBoletinRepository;
    }

    public function getAll(): Collection
    {
        return $this->detalleBoletinRepository->getAll();
    }

    public function findById(int $id): ?DetalleBoletin
    {
        return $this->detalleBoletinRepository->findById($id);
    }

    public function create(array $data): DetalleBoletin
    {
        return $this->detalleBoletinRepository->create($data);
    }

    public function update(int $id, array $data): ?DetalleBoletin
    {
        return $this->detalleBoletinRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->detalleBoletinRepository->delete($id);
    }
}
