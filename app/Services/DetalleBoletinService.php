<?php

namespace App\Services;

use App\Interfaces\DetalleBoletinInterface;
use App\Models\DetalleBoletin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class DetalleBoletinService
{
    protected DetalleBoletinInterface $detalleRepository;

    public function __construct(
        DetalleBoletinInterface $detalleRepository
    ) {
        $this->detalleRepository = $detalleRepository;
    }

    public function getAll(): Collection
    {
        return $this->detalleRepository->getAll();
    }

    public function findById(int $id): ?DetalleBoletin
    {
        return $this->detalleRepository->findById($id);
    }

    public function getByBoletin(
        int $idBoletin
    ): Collection {
        return $this->detalleRepository->getByBoletin(
            $idBoletin
        );
    }

    public function create(array $data): DetalleBoletin
    {
        $this->validarFallas(
            $data['Fallas'] ?? null
        );

        $this->validarDuplicado(
            (int) $data['Id_docentes'],
            (int) $data['Id_boletin']
        );

        return $this->detalleRepository->create(
            $data
        );
    }

    public function update(
        int $id,
        array $data
    ): ?DetalleBoletin {
        $detalle = $this->detalleRepository->findById(
            $id
        );

        if (!$detalle) {
            return null;
        }

        $fallas = array_key_exists('Fallas', $data)
            ? $data['Fallas']
            : $detalle->Fallas;

        $idDocente = (int) (
            $data['Id_docentes']
            ?? $detalle->Id_docentes
        );

        $idBoletin = (int) (
            $data['Id_boletin']
            ?? $detalle->Id_boletin
        );

        $this->validarFallas($fallas);

        $this->validarDuplicado(
            $idDocente,
            $idBoletin,
            $id
        );

        return $this->detalleRepository->update(
            $id,
            $data
        );
    }

    public function delete(int $id): bool
    {
        $detalle = $this->detalleRepository->findById(
            $id
        );

        if (!$detalle) {
            return false;
        }

        try {
            return $this->detalleRepository->delete(
                $id
            );
        } catch (QueryException $exception) {
            if (
                $exception->getCode() === '23000' &&
                (int) ($exception->errorInfo[1] ?? 0) === 1451
            ) {
                throw new ConflictHttpException(
                    'No se puede eliminar el detalle porque tiene registros relacionados.'
                );
            }

            throw $exception;
        }
    }

    private function validarFallas(
        ?int $fallas
    ): void {
        if ($fallas !== null && $fallas < 0) {
            throw ValidationException::withMessages([
                'Fallas' => [
                    'La cantidad de fallas no puede ser negativa.'
                ]
            ]);
        }
    }

    private function validarDuplicado(
        int $idDocente,
        int $idBoletin,
        ?int $excludeId = null
    ): void {
        if (
            $this->detalleRepository->existsByDocenteAndBoletin(
                $idDocente,
                $idBoletin,
                $excludeId
            )
        ) {
            throw ValidationException::withMessages([
                'Id_docentes' => [
                    'Ya existe un detalle de este docente para el boletín seleccionado.'
                ]
            ]);
        }
    }
}
